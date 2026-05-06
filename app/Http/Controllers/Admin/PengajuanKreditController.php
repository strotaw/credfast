<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asuransi;
use App\Models\JenisCicilan;
use App\Models\MetodeBayar;
use App\Models\Motor;
use App\Models\PengajuanKredit;
use App\Support\CreditWorkflow;
use App\Support\PengajuanService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use RuntimeException;

class PengajuanKreditController extends Controller
{
    public function index(Request $request): View
    {
        $pengajuan = PengajuanKredit::query()
            ->with(['pelanggan.user', 'motor', 'jenisCicilan', 'metodeBayar', 'marketing', 'admin', 'kredit'])
            ->when($request->filled('status'), fn ($query) => $query->where('status_pengajuan', $request->string('status')))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('admin.pengajuan.index', [
            'pengajuanList' => $pengajuan,
            'statusOptions' => PengajuanKredit::STATUS_OPTIONS,
        ]);
    }

    public function show(PengajuanKredit $pengajuan): View
    {
        return view('admin.pengajuan.show', [
            'pengajuan' => $pengajuan->load(['pelanggan.user', 'motor.jenisMotor', 'jenisCicilan', 'asuransi', 'metodeBayar', 'marketing', 'admin', 'kredit.angsuran', 'kredit.metodeBayar']),
        ]);
    }

    public function approve(Request $request, PengajuanKredit $pengajuan): RedirectResponse
    {
        $validated = $request->validate([
            'keterangan_status_pengajuan' => ['nullable', 'string'],
        ]);

        $pengajuan->update([
            'status_pengajuan' => PengajuanKredit::STATUS_DITERIMA,
            'admin_id' => auth()->id(),
            'keterangan_status_pengajuan' => $validated['keterangan_status_pengajuan'] ?? 'Disetujui admin.',
        ]);

        return back()->with('success', 'Pengajuan berhasil disetujui.');
    }

    public function reject(Request $request, PengajuanKredit $pengajuan): RedirectResponse
    {
        $validated = $request->validate([
            'keterangan_status_pengajuan' => ['required', 'string'],
        ]);

        $pengajuan->update([
            'status_pengajuan' => PengajuanKredit::STATUS_DIBATALKAN_PENJUAL,
            'admin_id' => auth()->id(),
            'keterangan_status_pengajuan' => $validated['keterangan_status_pengajuan'],
        ]);

        return back()->with('success', 'Pengajuan berhasil dibatalkan penjual.');
    }

    public function buatKredit(Request $request, PengajuanKredit $pengajuan): RedirectResponse
    {
        $validated = $request->validate([
            'tgl_mulai_kredit' => ['nullable', 'date'],
        ]);

        try {
            $kredit = CreditWorkflow::createKredit(
                $pengajuan->load(['motor', 'jenisCicilan', 'metodeBayar']),
                null,
                $request->filled('tgl_mulai_kredit') ? Carbon::parse($validated['tgl_mulai_kredit']) : null,
            );
        } catch (RuntimeException $exception) {
            return back()->withErrors(['buat_kredit' => $exception->getMessage()]);
        }

        return redirect()->route('admin.kredit.show', $kredit)->with('success', 'Kredit dan jadwal angsuran berhasil dibuat.');
    }

    public function createOffline(): View
    {
        return view('admin.pengajuan.create', [
            'motors' => Motor::query()->with('jenisMotor')->where('status', Motor::STATUS_TERSEDIA)->get(),
            'jenisCicilan' => JenisCicilan::query()->orderBy('lama_cicilan')->get(),
            'asuransi' => Asuransi::query()->orderBy('nama_asuransi')->get(),
            'metodeBayar' => MetodeBayar::query()->where('status', MetodeBayar::STATUS_AKTIF)->orderBy('nama_bank')->get(),
        ]);
    }

    public function storeOffline(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'no_hp' => ['nullable', 'string', 'max:25'],
            'alamat' => ['nullable', 'string'],
            'kota' => ['nullable', 'string', 'max:100'],
            'provinsi' => ['nullable', 'string', 'max:100'],
            'kode_pos' => ['nullable', 'string', 'max:20'],
            'motor_id' => ['required', 'exists:motor,id'],
            'jenis_cicilan_id' => ['required', 'exists:jenis_cicilan,id'],
            'asuransi_id' => ['nullable', 'exists:asuransi,id'],
            'metode_bayar_id' => ['required', Rule::exists('metode_bayar', 'id')->where('status', MetodeBayar::STATUS_AKTIF)],
            'dp' => ['required', 'numeric', 'min:0'],
            'url_kk' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
            'url_ktp' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
            'url_npwp' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
            'url_slip_gaji' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
            'url_foto' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
        ]);

        $motor = Motor::query()->findOrFail($validated['motor_id']);
        abort_if((int) $validated['dp'] > $motor->harga_jual, 422, 'DP tidak boleh lebih besar dari harga motor.');

        $user = PengajuanService::findOrCreateOfflineUser($validated);

        $pengajuan = PengajuanService::create(
            $user,
            $motor,
            JenisCicilan::query()->findOrFail($validated['jenis_cicilan_id']),
            $request->filled('asuransi_id') ? Asuransi::query()->findOrFail($validated['asuransi_id']) : null,
            (int) $validated['dp'],
            [
                'url_kk' => $this->storePublicFile($request, 'url_kk', 'dokumen_pengajuan'),
                'url_ktp' => $this->storePublicFile($request, 'url_ktp', 'dokumen_pengajuan'),
                'url_npwp' => $this->storePublicFile($request, 'url_npwp', 'dokumen_pengajuan'),
                'url_slip_gaji' => $this->storePublicFile($request, 'url_slip_gaji', 'dokumen_pengajuan'),
                'url_foto' => $this->storePublicFile($request, 'url_foto', 'dokumen_pengajuan'),
            ],
            [
                'admin_id' => auth()->id(),
                'metode_bayar_id' => $validated['metode_bayar_id'],
                'keterangan_status_pengajuan' => 'Pengajuan offline dibuat oleh admin.',
                'status_pengajuan' => PengajuanKredit::STATUS_DIPROSES,
            ],
        );

        return redirect()->route('admin.pengajuan.show', $pengajuan)->with('success', 'Pengajuan offline berhasil dibuat.');
    }
}

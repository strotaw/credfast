<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Angsuran;
use App\Models\Asuransi;
use App\Models\JenisCicilan;
use App\Models\MetodeBayar;
use App\Models\Motor;
use App\Models\PengajuanKredit;
use App\Support\ActivityLogger;
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
            ->with(['user', 'motor', 'jenisCicilan', 'marketing', 'admin', 'kredit'])
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
            'pengajuan' => $pengajuan->load(['user', 'motor.jenisMotor', 'jenisCicilan', 'asuransi', 'marketing', 'admin', 'kredit.angsuran']),
            'metodeBayar' => MetodeBayar::query()->where('status', MetodeBayar::STATUS_AKTIF)->get(),
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

        ActivityLogger::log(auth()->user(), 'approve_pengajuan', 'pengajuan_kredit', $pengajuan->id, 'Admin menyetujui pengajuan.');

        return back()->with('success', 'Pengajuan berhasil disetujui.');
    }

    public function reject(Request $request, PengajuanKredit $pengajuan): RedirectResponse
    {
        $validated = $request->validate([
            'keterangan_status_pengajuan' => ['required', 'string'],
        ]);

        $pengajuan->update([
            'status_pengajuan' => PengajuanKredit::STATUS_DITOLAK,
            'admin_id' => auth()->id(),
            'keterangan_status_pengajuan' => $validated['keterangan_status_pengajuan'],
        ]);

        ActivityLogger::log(auth()->user(), 'reject_pengajuan', 'pengajuan_kredit', $pengajuan->id, 'Admin menolak pengajuan.');

        return back()->with('success', 'Pengajuan berhasil ditolak.');
    }

    public function buatKredit(Request $request, PengajuanKredit $pengajuan): RedirectResponse
    {
        $validated = $request->validate([
            'metode_bayar_id' => ['nullable', 'exists:metode_bayar,id'],
            'tgl_mulai_kredit' => ['nullable', 'date'],
        ]);

        try {
            $kredit = CreditWorkflow::createKredit(
                $pengajuan->load(['motor', 'jenisCicilan']),
                $request->filled('metode_bayar_id') ? MetodeBayar::query()->findOrFail($validated['metode_bayar_id']) : null,
                $request->filled('tgl_mulai_kredit') ? Carbon::parse($validated['tgl_mulai_kredit']) : null,
            );
        } catch (RuntimeException $exception) {
            return back()->withErrors(['buat_kredit' => $exception->getMessage()]);
        }

        ActivityLogger::log(auth()->user(), 'buat_kredit', 'kredit', $kredit->id, 'Admin membuat kredit dari pengajuan.');

        return redirect()->route('admin.kredit.show', $kredit)->with('success', 'Kredit dan jadwal angsuran berhasil dibuat.');
    }

    public function createOffline(): View
    {
        return view('admin.pengajuan.create', [
            'motors' => Motor::query()->with('jenisMotor')->where('status', Motor::STATUS_TERSEDIA)->get(),
            'jenisCicilan' => JenisCicilan::query()->orderBy('lama_cicilan')->get(),
            'asuransi' => Asuransi::query()->orderBy('nama_asuransi')->get(),
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
                'keterangan_status_pengajuan' => 'Pengajuan offline dibuat oleh admin.',
                'status_pengajuan' => PengajuanKredit::STATUS_DIPROSES,
            ],
        );

        ActivityLogger::log(auth()->user(), 'buat_pengajuan_offline_admin', 'pengajuan_kredit', $pengajuan->id, 'Admin membuat pengajuan offline.');

        return redirect()->route('admin.pengajuan.show', $pengajuan)->with('success', 'Pengajuan offline berhasil dibuat.');
    }
}

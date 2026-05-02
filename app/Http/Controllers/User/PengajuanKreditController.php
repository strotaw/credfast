<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Asuransi;
use App\Models\JenisCicilan;
use App\Models\Motor;
use App\Models\PengajuanKredit;
use App\Support\ActivityLogger;
use App\Support\PengajuanService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PengajuanKreditController extends Controller
{
    public function index(): View
    {
        return view('user.pengajuan.index', [
            'pengajuanList' => auth()->user()
                ->pengajuanKredit()
                ->with(['motor.jenisMotor', 'jenisCicilan', 'asuransi', 'marketing', 'admin', 'kredit'])
                ->latest()
                ->paginate(10),
        ]);
    }

    public function create(Motor $motor): View
    {
        abort_if($motor->status !== Motor::STATUS_TERSEDIA || $motor->stok <= 0, 404);

        return view('user.pengajuan.create', [
            'motor' => $motor->load('jenisMotor'),
            'jenisCicilan' => JenisCicilan::query()->orderBy('lama_cicilan')->get(),
            'asuransi' => Asuransi::query()->orderBy('nama_asuransi')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'motor_id' => ['required', 'exists:motor,id'],
            'jenis_cicilan_id' => ['required', 'exists:jenis_cicilan,id'],
            'asuransi_id' => ['nullable', 'exists:asuransi,id'],
            'dp' => ['required', 'numeric', 'min:0'],
            'url_kk' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
            'url_ktp' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
            'url_npwp' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
            'url_slip_gaji' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
            'url_foto' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
        ]);

        $motor = Motor::query()->findOrFail($validated['motor_id']);
        abort_if($motor->status !== Motor::STATUS_TERSEDIA || $motor->stok <= 0, 422, 'Motor tidak tersedia.');
        abort_if((int) $validated['dp'] > $motor->harga_jual, 422, 'DP tidak boleh lebih besar dari harga motor.');

        $pengajuan = PengajuanService::create(
            auth()->user(),
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
        );

        ActivityLogger::log(auth()->user(), 'buat_pengajuan', 'pengajuan_kredit', $pengajuan->id, 'User mengajukan kredit motor.');

        return redirect()->route('user.pengajuan.show', $pengajuan)->with('success', 'Pengajuan kredit berhasil dikirim.');
    }

    public function show(PengajuanKredit $pengajuan): View
    {
        abort_if($pengajuan->user_id !== auth()->id(), 403);

        return view('user.pengajuan.show', [
            'pengajuan' => $pengajuan->load(['motor.jenisMotor', 'jenisCicilan', 'asuransi', 'marketing', 'admin', 'kredit.pengiriman']),
        ]);
    }
}

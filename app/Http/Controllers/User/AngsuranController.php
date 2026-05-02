<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Angsuran;
use App\Support\ActivityLogger;
use App\Support\CreditWorkflow;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AngsuranController extends Controller
{
    public function index(): View
    {
        CreditWorkflow::syncOverdueStatuses();

        return view('user.angsuran.index', [
            'angsuranList' => Angsuran::query()
                ->with(['kredit.pengajuanKredit.motor', 'verifiedBy'])
                ->whereHas('kredit.pengajuanKredit', fn ($query) => $query->where('user_id', auth()->id()))
                ->orderBy('tanggal_jatuh_tempo')
                ->paginate(12),
        ]);
    }

    public function show(Angsuran $angsuran): View
    {
        abort_if($angsuran->kredit->pengajuanKredit->user_id !== auth()->id(), 403);

        return view('user.angsuran.show', [
            'angsuran' => $angsuran->load(['kredit.pengajuanKredit.motor', 'verifiedBy', 'kredit.metodeBayar']),
        ]);
    }

    public function uploadBukti(Request $request, Angsuran $angsuran): RedirectResponse
    {
        abort_if($angsuran->kredit->pengajuanKredit->user_id !== auth()->id(), 403);
        abort_if($angsuran->status === Angsuran::STATUS_VALID, 422, 'Angsuran ini sudah tervalidasi.');

        $request->validate([
            'bukti_bayar' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
        ]);

        $isLate = now()->toDateString() > $angsuran->tanggal_jatuh_tempo->toDateString();
        $denda = $isLate ? 50000 : (float) $angsuran->denda;

        $angsuran->update([
            'bukti_bayar' => $this->storePublicFile($request, 'bukti_bayar', 'bukti_bayar', $angsuran->bukti_bayar),
            'tanggal_bayar' => now()->toDateString(),
            'status' => Angsuran::STATUS_DIBAYAR,
            'denda' => $denda,
            'total_bayar' => $angsuran->nominal + $denda,
            'verified_by' => null,
            'verified_at' => null,
            'keterangan' => $isLate ? 'Pembayaran diunggah melewati jatuh tempo.' : $angsuran->keterangan,
        ]);

        ActivityLogger::log(auth()->user(), 'upload_bukti_bayar', 'angsuran', $angsuran->id, 'User mengunggah bukti pembayaran.');

        return back()->with('success', 'Bukti pembayaran berhasil diunggah.');
    }

    public function pembayaran(): View
    {
        return view('user.pembayaran.index', [
            'payments' => Angsuran::query()
                ->with(['kredit.pengajuanKredit.motor', 'verifiedBy'])
                ->whereHas('kredit.pengajuanKredit', fn ($query) => $query->where('user_id', auth()->id()))
                ->whereIn('status', [Angsuran::STATUS_DIBAYAR, Angsuran::STATUS_VALID, Angsuran::STATUS_DITOLAK, Angsuran::STATUS_TELAT])
                ->latest('updated_at')
                ->paginate(10),
        ]);
    }

    public function receipt(Angsuran $angsuran): View
    {
        abort_if($angsuran->kredit->pengajuanKredit->user_id !== auth()->id(), 403);
        abort_if($angsuran->status !== Angsuran::STATUS_VALID, 403);

        return view('user.angsuran.receipt', [
            'angsuran' => $angsuran->load(['kredit.pengajuanKredit.user', 'kredit.pengajuanKredit.motor', 'verifiedBy']),
        ]);
    }
}

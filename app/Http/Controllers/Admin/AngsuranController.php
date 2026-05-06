<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Angsuran;
use App\Support\CreditWorkflow;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AngsuranController extends Controller
{
    public function index(Request $request): View
    {
        CreditWorkflow::syncOverdueStatuses();

        return view('admin.angsuran.index', [
            'items' => Angsuran::query()
                ->with(['kredit.pengajuanKredit.pelanggan.user', 'kredit.pengajuanKredit.motor', 'verifiedBy'])
                ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')))
                ->orderBy('tanggal_jatuh_tempo')
                ->paginate(15)
                ->withQueryString(),
            'statusOptions' => Angsuran::STATUS_OPTIONS,
        ]);
    }

    public function show(Angsuran $angsuran): View
    {
        return view('admin.angsuran.show', [
            'item' => $angsuran->load(['kredit.pengajuanKredit.pelanggan.user', 'kredit.pengajuanKredit.motor', 'verifiedBy']),
        ]);
    }

    public function validasi(Request $request, Angsuran $angsuran): RedirectResponse
    {
        $validated = $request->validate([
            'keterangan' => ['nullable', 'string'],
        ]);

        $angsuran->update([
            'status' => Angsuran::STATUS_VALID,
            'verified_by' => auth()->id(),
            'verified_at' => now(),
            'keterangan' => $validated['keterangan'] ?? $angsuran->keterangan,
            'total_bayar' => $angsuran->nominal + $angsuran->denda,
        ]);

        CreditWorkflow::refreshKreditStatus($angsuran->kredit);

        return back()->with('success', 'Pembayaran berhasil divalidasi.');
    }

    public function tolak(Request $request, Angsuran $angsuran): RedirectResponse
    {
        $validated = $request->validate([
            'keterangan' => ['required', 'string'],
        ]);

        $angsuran->update([
            'status' => Angsuran::STATUS_DITOLAK,
            'verified_by' => auth()->id(),
            'verified_at' => now(),
            'keterangan' => $validated['keterangan'],
        ]);

        return back()->with('success', 'Pembayaran berhasil ditolak.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kredit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class KreditController extends Controller
{
    public function index(Request $request): View
    {
        $kredit = Kredit::query()
            ->with(['pengajuanKredit.pelanggan.user', 'pengajuanKredit.motor', 'metodeBayar', 'pengiriman'])
            ->when($request->filled('status'), fn ($query) => $query->where('status_kredit', $request->string('status')))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('admin.kredit.index', [
            'kreditList' => $kredit,
            'statusOptions' => Kredit::STATUS_OPTIONS,
        ]);
    }

    public function show(Kredit $kredit): View
    {
        return view('admin.kredit.show', [
            'kredit' => $kredit->load(['pengajuanKredit.pelanggan.user', 'pengajuanKredit.motor.jenisMotor', 'metodeBayar', 'pengiriman', 'angsuran']),
        ]);
    }

    public function updateStatus(Request $request, Kredit $kredit): RedirectResponse
    {
        $validated = $request->validate([
            'status_kredit' => ['required', Rule::in(Kredit::STATUS_OPTIONS)],
            'keterangan_status_kredit' => ['nullable', 'string'],
        ]);

        $payload = $validated;
        if ($validated['status_kredit'] === Kredit::STATUS_LUNAS) {
            $payload['sisa_kredit'] = 0;
        }

        $kredit->update($payload);

        return back()->with('success', 'Status kredit berhasil diperbarui.');
    }
}

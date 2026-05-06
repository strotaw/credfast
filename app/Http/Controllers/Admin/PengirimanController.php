<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kredit;
use App\Models\Pengiriman;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PengirimanController extends Controller
{
    public function index(): View
    {
        return view('admin.pengiriman.index', [
            'items' => Pengiriman::query()->with(['kredit.pengajuanKredit.pelanggan.user', 'kredit.pengajuanKredit.motor'])->latest()->paginate(12),
        ]);
    }

    public function show(Pengiriman $pengiriman): View
    {
        return view('admin.pengiriman.show', [
            'item' => $pengiriman->load(['kredit.pengajuanKredit.pelanggan.user', 'kredit.pengajuanKredit.motor']),
        ]);
    }

    public function edit(Pengiriman $pengiriman): View
    {
        return view('admin.pengiriman.form', [
            'item' => $pengiriman,
            'kreditList' => Kredit::query()->with(['pengajuanKredit.pelanggan.user', 'pengajuanKredit.motor'])->get(),
            'statuses' => [Pengiriman::STATUS_DIPROSES, Pengiriman::STATUS_DIKIRIM, Pengiriman::STATUS_DITERIMA],
            'action' => route('admin.pengiriman.update', $pengiriman),
            'method' => 'PUT',
        ]);
    }

    public function update(Request $request, Pengiriman $pengiriman): RedirectResponse
    {
        $validated = $request->validate([
            'kredit_id' => ['required', 'exists:kredit,id', Rule::unique('pengiriman', 'kredit_id')->ignore($pengiriman->id)],
            'no_invoice' => ['required', 'string', 'max:255', Rule::unique('pengiriman', 'no_invoice')->ignore($pengiriman->id)],
            'tgl_kirim' => ['nullable', 'date'],
            'tgl_tiba' => ['nullable', 'date'],
            'status_kirim' => ['required', Rule::in([Pengiriman::STATUS_DIPROSES, Pengiriman::STATUS_DIKIRIM, Pengiriman::STATUS_DITERIMA])],
            'nama_kurir' => ['nullable', 'string', 'max:255'],
            'telpon_kurir' => ['nullable', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string'],
            'bukti_foto' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
        ]);

        $validated['bukti_foto'] = $this->storePublicFile($request, 'bukti_foto', 'pengiriman', $pengiriman->bukti_foto);
        $pengiriman->update($validated);

        return redirect()->route('admin.pengiriman.index')->with('success', 'Data pengiriman berhasil diperbarui.');
    }
}

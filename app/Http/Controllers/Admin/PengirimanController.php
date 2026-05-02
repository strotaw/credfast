<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kredit;
use App\Models\Pengiriman;
use App\Support\ActivityLogger;
use App\Support\CreditWorkflow;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PengirimanController extends Controller
{
    public function index(): View
    {
        return view('admin.pengiriman.index', [
            'items' => Pengiriman::query()->with(['kredit.pengajuanKredit.user', 'kredit.pengajuanKredit.motor'])->latest()->paginate(12),
        ]);
    }

    public function create(): View
    {
        return view('admin.pengiriman.form', [
            'item' => new Pengiriman(),
            'kreditList' => Kredit::query()->with(['pengajuanKredit.user', 'pengajuanKredit.motor'])->doesntHave('pengiriman')->get(),
            'statuses' => [Pengiriman::STATUS_DIPROSES, Pengiriman::STATUS_DIKIRIM, Pengiriman::STATUS_DITERIMA],
            'action' => route('admin.pengiriman.store'),
            'method' => 'POST',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'kredit_id' => ['required', 'exists:kredit,id', 'unique:pengiriman,kredit_id'],
            'no_invoice' => ['nullable', 'string', 'max:255', 'unique:pengiriman,no_invoice'],
            'tgl_kirim' => ['nullable', 'date'],
            'tgl_tiba' => ['nullable', 'date'],
            'status_kirim' => ['required', Rule::in([Pengiriman::STATUS_DIPROSES, Pengiriman::STATUS_DIKIRIM, Pengiriman::STATUS_DITERIMA])],
            'nama_kurir' => ['nullable', 'string', 'max:255'],
            'telpon_kurir' => ['nullable', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string'],
            'bukti_foto' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
        ]);

        $validated['bukti_foto'] = $this->storePublicFile($request, 'bukti_foto', 'pengiriman');
        $validated['no_invoice'] = $validated['no_invoice'] ?: CreditWorkflow::generateInvoiceNumber();

        $item = Pengiriman::create($validated);

        ActivityLogger::log(auth()->user(), 'create_pengiriman', 'pengiriman', $item->id, 'Admin membuat data pengiriman.');

        return redirect()->route('admin.pengiriman.index')->with('success', 'Data pengiriman berhasil ditambahkan.');
    }

    public function show(Pengiriman $pengiriman): View
    {
        return view('admin.pengiriman.show', [
            'item' => $pengiriman->load(['kredit.pengajuanKredit.user', 'kredit.pengajuanKredit.motor']),
        ]);
    }

    public function edit(Pengiriman $pengiriman): View
    {
        return view('admin.pengiriman.form', [
            'item' => $pengiriman,
            'kreditList' => Kredit::query()->with(['pengajuanKredit.user', 'pengajuanKredit.motor'])->get(),
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

        ActivityLogger::log(auth()->user(), 'update_pengiriman', 'pengiriman', $pengiriman->id, 'Admin memperbarui pengiriman.');

        return redirect()->route('admin.pengiriman.index')->with('success', 'Data pengiriman berhasil diperbarui.');
    }

    public function destroy(Pengiriman $pengiriman): RedirectResponse
    {
        $this->deletePublicFile($pengiriman->bukti_foto);
        $pengiriman->delete();

        ActivityLogger::log(auth()->user(), 'delete_pengiriman', 'pengiriman', $pengiriman->id, 'Admin menghapus pengiriman.');

        return redirect()->route('admin.pengiriman.index')->with('success', 'Data pengiriman berhasil dihapus.');
    }
}

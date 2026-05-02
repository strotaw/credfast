<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asuransi;
use App\Support\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AsuransiController extends Controller
{
    public function index(): View
    {
        return view('admin.asuransi.index', [
            'items' => Asuransi::query()->latest()->paginate(12),
        ]);
    }

    public function create(): View
    {
        return view('admin.asuransi.form', [
            'item' => new Asuransi(),
            'action' => route('admin.asuransi.store'),
            'method' => 'POST',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_perusahaan_asuransi' => ['required', 'string', 'max:255'],
            'nama_asuransi' => ['required', 'string', 'max:255'],
            'margin_asuransi' => ['required', 'numeric', 'min:0'],
            'no_rekening' => ['nullable', 'string', 'max:255'],
            'url_logo' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
        ]);

        $validated['url_logo'] = $this->storePublicFile($request, 'url_logo', 'motor');
        $item = Asuransi::create($validated);

        ActivityLogger::log(auth()->user(), 'create_asuransi', 'asuransi', $item->id, 'Admin menambah asuransi.');

        return redirect()->route('admin.asuransi.index')->with('success', 'Asuransi berhasil ditambahkan.');
    }

    public function show(Asuransi $asuransi): View
    {
        return view('admin.asuransi.show', [
            'item' => $asuransi,
        ]);
    }

    public function edit(Asuransi $asuransi): View
    {
        return view('admin.asuransi.form', [
            'item' => $asuransi,
            'action' => route('admin.asuransi.update', $asuransi),
            'method' => 'PUT',
        ]);
    }

    public function update(Request $request, Asuransi $asuransi): RedirectResponse
    {
        $validated = $request->validate([
            'nama_perusahaan_asuransi' => ['required', 'string', 'max:255'],
            'nama_asuransi' => ['required', 'string', 'max:255'],
            'margin_asuransi' => ['required', 'numeric', 'min:0'],
            'no_rekening' => ['nullable', 'string', 'max:255'],
            'url_logo' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
        ]);

        $validated['url_logo'] = $this->storePublicFile($request, 'url_logo', 'motor', $asuransi->url_logo);
        $asuransi->update($validated);

        ActivityLogger::log(auth()->user(), 'update_asuransi', 'asuransi', $asuransi->id, 'Admin memperbarui asuransi.');

        return redirect()->route('admin.asuransi.index')->with('success', 'Asuransi berhasil diperbarui.');
    }

    public function destroy(Asuransi $asuransi): RedirectResponse
    {
        $this->deletePublicFile($asuransi->url_logo);
        $asuransi->delete();

        ActivityLogger::log(auth()->user(), 'delete_asuransi', 'asuransi', $asuransi->id, 'Admin menghapus asuransi.');

        return redirect()->route('admin.asuransi.index')->with('success', 'Asuransi berhasil dihapus.');
    }
}

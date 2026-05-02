<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MetodeBayar;
use App\Support\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class MetodeBayarController extends Controller
{
    public function index(): View
    {
        return view('admin.metode_bayar.index', [
            'items' => MetodeBayar::query()->latest()->paginate(12),
        ]);
    }

    public function create(): View
    {
        return view('admin.metode_bayar.form', [
            'item' => new MetodeBayar(),
            'action' => route('admin.metode-bayar.store'),
            'method' => 'POST',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_bank' => ['required', 'string', 'max:255'],
            'nomor_rekening' => ['required', 'string', 'max:255'],
            'atas_nama' => ['required', 'string', 'max:255'],
            'status' => ['required', Rule::in([MetodeBayar::STATUS_AKTIF, MetodeBayar::STATUS_NONAKTIF])],
            'url_logo' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
        ]);

        $validated['url_logo'] = $this->storePublicFile($request, 'url_logo', 'motor');
        $item = MetodeBayar::create($validated);

        ActivityLogger::log(auth()->user(), 'create_metode_bayar', 'metode_bayar', $item->id, 'Admin menambah metode bayar.');

        return redirect()->route('admin.metode-bayar.index')->with('success', 'Metode bayar berhasil ditambahkan.');
    }

    public function show(MetodeBayar $metode_bayar): View
    {
        return view('admin.metode_bayar.show', [
            'item' => $metode_bayar,
        ]);
    }

    public function edit(MetodeBayar $metode_bayar): View
    {
        return view('admin.metode_bayar.form', [
            'item' => $metode_bayar,
            'action' => route('admin.metode-bayar.update', $metode_bayar),
            'method' => 'PUT',
        ]);
    }

    public function update(Request $request, MetodeBayar $metode_bayar): RedirectResponse
    {
        $validated = $request->validate([
            'nama_bank' => ['required', 'string', 'max:255'],
            'nomor_rekening' => ['required', 'string', 'max:255'],
            'atas_nama' => ['required', 'string', 'max:255'],
            'status' => ['required', Rule::in([MetodeBayar::STATUS_AKTIF, MetodeBayar::STATUS_NONAKTIF])],
            'url_logo' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
        ]);

        $validated['url_logo'] = $this->storePublicFile($request, 'url_logo', 'motor', $metode_bayar->url_logo);
        $metode_bayar->update($validated);

        ActivityLogger::log(auth()->user(), 'update_metode_bayar', 'metode_bayar', $metode_bayar->id, 'Admin memperbarui metode bayar.');

        return redirect()->route('admin.metode-bayar.index')->with('success', 'Metode bayar berhasil diperbarui.');
    }

    public function destroy(MetodeBayar $metode_bayar): RedirectResponse
    {
        $this->deletePublicFile($metode_bayar->url_logo);
        $metode_bayar->delete();

        ActivityLogger::log(auth()->user(), 'delete_metode_bayar', 'metode_bayar', $metode_bayar->id, 'Admin menghapus metode bayar.');

        return redirect()->route('admin.metode-bayar.index')->with('success', 'Metode bayar berhasil dihapus.');
    }
}

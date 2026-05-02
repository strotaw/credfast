<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisCicilan;
use App\Support\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JenisCicilanController extends Controller
{
    public function index(): View
    {
        return view('admin.jenis_cicilan.index', [
            'items' => JenisCicilan::query()->orderBy('lama_cicilan')->paginate(12),
        ]);
    }

    public function create(): View
    {
        return view('admin.jenis_cicilan.form', [
            'item' => new JenisCicilan(),
            'action' => route('admin.jenis-cicilan.store'),
            'method' => 'POST',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'lama_cicilan' => ['required', 'integer', 'min:1'],
            'margin_kredit' => ['required', 'numeric', 'min:0'],
        ]);

        $item = JenisCicilan::create($validated);

        ActivityLogger::log(auth()->user(), 'create_jenis_cicilan', 'jenis_cicilan', $item->id, 'Admin menambah jenis cicilan.');

        return redirect()->route('admin.jenis-cicilan.index')->with('success', 'Jenis cicilan berhasil ditambahkan.');
    }

    public function show(JenisCicilan $jenis_cicilan): View
    {
        return view('admin.jenis_cicilan.show', [
            'item' => $jenis_cicilan,
        ]);
    }

    public function edit(JenisCicilan $jenis_cicilan): View
    {
        return view('admin.jenis_cicilan.form', [
            'item' => $jenis_cicilan,
            'action' => route('admin.jenis-cicilan.update', $jenis_cicilan),
            'method' => 'PUT',
        ]);
    }

    public function update(Request $request, JenisCicilan $jenis_cicilan): RedirectResponse
    {
        $validated = $request->validate([
            'lama_cicilan' => ['required', 'integer', 'min:1'],
            'margin_kredit' => ['required', 'numeric', 'min:0'],
        ]);

        $jenis_cicilan->update($validated);

        ActivityLogger::log(auth()->user(), 'update_jenis_cicilan', 'jenis_cicilan', $jenis_cicilan->id, 'Admin memperbarui jenis cicilan.');

        return redirect()->route('admin.jenis-cicilan.index')->with('success', 'Jenis cicilan berhasil diperbarui.');
    }

    public function destroy(JenisCicilan $jenis_cicilan): RedirectResponse
    {
        $jenis_cicilan->delete();

        ActivityLogger::log(auth()->user(), 'delete_jenis_cicilan', 'jenis_cicilan', $jenis_cicilan->id, 'Admin menghapus jenis cicilan.');

        return redirect()->route('admin.jenis-cicilan.index')->with('success', 'Jenis cicilan berhasil dihapus.');
    }
}

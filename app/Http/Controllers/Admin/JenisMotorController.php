<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisMotor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class JenisMotorController extends Controller
{
    private const TYPE_OPTIONS = [
        'bebek', 'skuter', 'dual_sport', 'naked_sport', 'sport_bike', 'retro',
        'cruiser', 'sport_touring', 'dirt_bike', 'motocross', 'scrambler', 'atv',
        'motor_adventure', 'lainnya',
    ];

    public function index(): View
    {
        return view('admin.jenis_motor.index', [
            'items' => JenisMotor::query()->latest()->paginate(12),
        ]);
    }

    public function create(): View
    {
        return view('admin.jenis_motor.form', [
            'item' => new JenisMotor,
            'types' => self::TYPE_OPTIONS,
            'action' => route('admin.jenis-motor.store'),
            'method' => 'POST',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'merk' => ['required', 'string', 'max:255'],
            'tipe' => ['required', Rule::in(self::TYPE_OPTIONS)],
            'deskripsi_jenis' => ['nullable', 'string'],
            'image_url' => $this->imageUploadRules(),
        ]);

        $validated['image_url'] = $this->storePublicFile($request, 'image_url', 'motor');

        $item = JenisMotor::create($validated);

        return redirect()->route('admin.jenis-motor.index')->with('success', 'Jenis motor berhasil ditambahkan.');
    }

    public function show(JenisMotor $jenis_motor): View
    {
        return view('admin.jenis_motor.show', [
            'item' => $jenis_motor->load('motor'),
        ]);
    }

    public function edit(JenisMotor $jenis_motor): View
    {
        return view('admin.jenis_motor.form', [
            'item' => $jenis_motor,
            'types' => self::TYPE_OPTIONS,
            'action' => route('admin.jenis-motor.update', $jenis_motor),
            'method' => 'PUT',
        ]);
    }

    public function update(Request $request, JenisMotor $jenis_motor): RedirectResponse
    {
        $validated = $request->validate([
            'merk' => ['required', 'string', 'max:255'],
            'tipe' => ['required', Rule::in(self::TYPE_OPTIONS)],
            'deskripsi_jenis' => ['nullable', 'string'],
            'image_url' => $this->imageUploadRules(),
        ]);

        $validated['image_url'] = $this->storePublicFile($request, 'image_url', 'motor', $jenis_motor->image_url);
        $jenis_motor->update($validated);

        return redirect()->route('admin.jenis-motor.index')->with('success', 'Jenis motor berhasil diperbarui.');
    }

    public function destroy(JenisMotor $jenis_motor): RedirectResponse
    {
        $this->deletePublicFile($jenis_motor->image_url);
        $jenis_motor->delete();

        return redirect()->route('admin.jenis-motor.index')->with('success', 'Jenis motor berhasil dihapus.');
    }
}

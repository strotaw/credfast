<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisMotor;
use App\Models\Motor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class MotorController extends Controller
{
    public function index(Request $request): View
    {
        $items = Motor::query()
            ->with('jenisMotor')
            ->when($request->filled('q'), fn ($query) => $query->where('nama_motor', 'like', '%'.$request->string('q').'%'))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('admin.motor.index', [
            'items' => $items,
        ]);
    }

    public function create(): View
    {
        return view('admin.motor.form', [
            'item' => new Motor,
            'jenisMotor' => JenisMotor::query()->orderBy('merk')->get(),
            'statuses' => Motor::STATUS_OPTIONS,
            'action' => route('admin.motor.store'),
            'method' => 'POST',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'jenis_motor_id' => ['required', 'exists:jenis_motor,id'],
            'nama_motor' => ['required', 'string', 'max:255'],
            'harga_jual' => ['required', 'numeric', 'min:0'],
            'deskripsi_motor' => ['required', 'string'],
            'warna' => ['nullable', 'string', 'max:100'],
            'kapasitas_mesin' => ['nullable', 'string', 'max:100'],
            'tahun' => ['nullable', 'integer', 'min:2000', 'max:2100'],
            'stok' => ['required', 'integer', 'min:0'],
            'status' => ['required', Rule::in(Motor::STATUS_OPTIONS)],
            'foto1' => $this->imageUploadRules(required: true),
            'foto2' => $this->imageUploadRules(),
            'foto3' => $this->imageUploadRules(),
        ]);

        $validated['foto1'] = $this->storePublicFile($request, 'foto1', 'motor');
        $validated['foto2'] = $this->storePublicFile($request, 'foto2', 'motor');
        $validated['foto3'] = $this->storePublicFile($request, 'foto3', 'motor');

        $item = Motor::create($validated);

        return redirect()->route('admin.motor.index')->with('success', 'Motor berhasil ditambahkan.');
    }

    public function show(Motor $motor): View
    {
        return view('admin.motor.show', [
            'item' => $motor->load(['jenisMotor', 'pengajuanKredit']),
        ]);
    }

    public function edit(Motor $motor): View
    {
        return view('admin.motor.form', [
            'item' => $motor,
            'jenisMotor' => JenisMotor::query()->orderBy('merk')->get(),
            'statuses' => Motor::STATUS_OPTIONS,
            'action' => route('admin.motor.update', $motor),
            'method' => 'PUT',
        ]);
    }

    public function update(Request $request, Motor $motor): RedirectResponse
    {
        $validated = $request->validate([
            'jenis_motor_id' => ['required', 'exists:jenis_motor,id'],
            'nama_motor' => ['required', 'string', 'max:255'],
            'harga_jual' => ['required', 'numeric', 'min:0'],
            'deskripsi_motor' => ['required', 'string'],
            'warna' => ['nullable', 'string', 'max:100'],
            'kapasitas_mesin' => ['nullable', 'string', 'max:100'],
            'tahun' => ['nullable', 'integer', 'min:2000', 'max:2100'],
            'stok' => ['required', 'integer', 'min:0'],
            'status' => ['required', Rule::in(Motor::STATUS_OPTIONS)],
            'foto1' => $this->imageUploadRules(),
            'foto2' => $this->imageUploadRules(),
            'foto3' => $this->imageUploadRules(),
        ]);

        $validated['foto1'] = $this->storePublicFile($request, 'foto1', 'motor', $motor->foto1);
        $validated['foto2'] = $this->storePublicFile($request, 'foto2', 'motor', $motor->foto2);
        $validated['foto3'] = $this->storePublicFile($request, 'foto3', 'motor', $motor->foto3);

        $motor->update($validated);

        return redirect()->route('admin.motor.index')->with('success', 'Motor berhasil diperbarui.');
    }

    public function destroy(Motor $motor): RedirectResponse
    {
        $this->deletePublicFile($motor->foto1);
        $this->deletePublicFile($motor->foto2);
        $this->deletePublicFile($motor->foto3);
        $motor->delete();

        return redirect()->route('admin.motor.index')->with('success', 'Motor berhasil dihapus.');
    }
}

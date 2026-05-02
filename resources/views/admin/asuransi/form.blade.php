@extends('layouts.panel', ['panel' => 'admin'])
@section('page-title', $item->exists ? 'Edit Asuransi' : 'Tambah Asuransi')
@section('content')
    <form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="shell-card p-8">
        @csrf
        @if ($method !== 'POST') @method($method) @endif
        <div class="grid gap-4 md:grid-cols-2">
            <input type="text" name="nama_perusahaan_asuransi" value="{{ old('nama_perusahaan_asuransi', $item->nama_perusahaan_asuransi) }}" class="shell-input" placeholder="Perusahaan">
            <input type="text" name="nama_asuransi" value="{{ old('nama_asuransi', $item->nama_asuransi) }}" class="shell-input" placeholder="Nama asuransi">
            <input type="number" step="0.01" name="margin_asuransi" value="{{ old('margin_asuransi', $item->margin_asuransi) }}" class="shell-input" placeholder="Margin">
            <input type="text" name="no_rekening" value="{{ old('no_rekening', $item->no_rekening) }}" class="shell-input" placeholder="No rekening">
            <div class="md:col-span-2"><input type="file" name="url_logo" class="shell-input"></div>
        </div>
        <button class="btn-primary mt-6">Simpan</button>
    </form>
@endsection

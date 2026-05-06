@extends('layouts.panel', ['panel' => 'admin'])
@section('page-title', $item->exists ? 'Edit Asuransi' : 'Tambah Asuransi')
@section('content')
    <form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="shell-card p-8">
        @csrf
        @if ($method !== 'POST') @method($method) @endif
        <div class="grid gap-4 md:grid-cols-2">
            <input type="text" name="nama_perusahaan_asuransi" value="{{ old('nama_perusahaan_asuransi', $item->nama_perusahaan_asuransi) }}" class="shell-input" placeholder="Nama perusahaan">
            <input type="text" name="nama_asuransi" value="{{ old('nama_asuransi', $item->nama_asuransi) }}" class="shell-input" placeholder="Nama asuransi">
            <input type="number" step="0.01" name="margin_asuransi" value="{{ old('margin_asuransi', $item->margin_asuransi) }}" class="shell-input" placeholder="Margin asuransi (%)">
            <input type="text" name="no_rekening" value="{{ old('no_rekening', $item->no_rekening) }}" class="shell-input" placeholder="Nomor rekening">
            <div class="md:col-span-2">
                <label class="mb-2 block text-sm font-medium text-slate-700">Logo asuransi</label>
                @if ($item->logoUrl())
                    <x-uploaded-image
                        :src="$item->logoUrl()"
                        :alt="$item->nama_asuransi"
                        :label="str($item->nama_asuransi)->substr(0, 2)->upper()"
                        class="mb-3 h-24 w-36 rounded-[22px] object-contain p-3"
                    />
                @endif
                <input type="file" name="url_logo" class="shell-input" accept="image/jpeg,image/png,image/webp">
            </div>
        </div>
        <button class="btn-primary mt-6">Simpan</button>
    </form>
@endsection

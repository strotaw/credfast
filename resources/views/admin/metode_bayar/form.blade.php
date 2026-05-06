@extends('layouts.panel', ['panel' => 'admin'])
@section('page-title', $item->exists ? 'Edit Metode Bayar' : 'Tambah Metode Bayar')
@section('content')
    <form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="shell-card p-8">
        @csrf
        @if ($method !== 'POST') @method($method) @endif
        <div class="grid gap-4 md:grid-cols-2">
            <input type="text" name="nama_bank" value="{{ old('nama_bank', $item->nama_bank) }}" class="shell-input" placeholder="Masukkan nama bank pembayaran">
            <input type="text" name="nomor_rekening" value="{{ old('nomor_rekening', $item->nomor_rekening) }}" class="shell-input" placeholder="Masukkan nomor rekening pembayaran">
            <input type="text" name="atas_nama" value="{{ old('atas_nama', $item->atas_nama) }}" class="shell-input" placeholder="Masukkan nama pemilik rekening">
            <select name="status" class="shell-select">
                <option value="aktif" @selected(old('status', $item->status) === 'aktif')>Aktif</option>
                <option value="nonaktif" @selected(old('status', $item->status) === 'nonaktif')>Nonaktif</option>
            </select>
            <div class="md:col-span-2">
                <label class="mb-2 block text-sm font-medium text-slate-700">Logo metode bayar</label>
                @if ($item->logoUrl())
                    <x-uploaded-image
                        :src="$item->logoUrl()"
                        :alt="$item->nama_bank"
                        :label="str($item->nama_bank)->substr(0, 2)->upper()"
                        class="mb-3 h-24 w-36 rounded-[22px] object-contain p-3"
                    />
                @endif
                <input type="file" name="url_logo" class="shell-input" accept="image/jpeg,image/png,image/webp">
            </div>
        </div>
        <button class="btn-primary mt-6">Simpan</button>
    </form>
@endsection

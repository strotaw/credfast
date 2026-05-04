@extends('layouts.panel', ['panel' => 'admin'])
@section('page-title', $item->exists ? 'Edit Jenis Motor' : 'Tambah Jenis Motor')
@section('content')
    <form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="shell-card p-8">
        @csrf
        @if ($method !== 'POST') @method($method) @endif
        <div class="grid gap-4 md:grid-cols-2">
            <input type="text" name="merk" value="{{ old('merk', $item->merk) }}" class="shell-input" placeholder="Merk">
            <select name="tipe" class="shell-select">
                @foreach ($types as $type)
                    <option value="{{ $type }}" @selected(old('tipe', $item->tipe) === $type)>{{ str($type)->replace('_', ' ')->title() }}</option>
                @endforeach
            </select>
            <div class="md:col-span-2"><textarea name="deskripsi_jenis" class="shell-textarea" placeholder="Deskripsi">{{ old('deskripsi_jenis', $item->deskripsi_jenis) }}</textarea></div>
            <div class="md:col-span-2">
                <label class="mb-2 block text-sm font-medium text-slate-700">Gambar jenis motor</label>
                @if ($item->imageUrl())
                    <x-uploaded-image
                        :src="$item->imageUrl()"
                        :alt="$item->merk"
                        :label="str($item->merk)->substr(0, 2)->upper()"
                        class="mb-3 h-36 w-full rounded-[22px] object-cover"
                    />
                @endif
                <input type="file" name="image_url" class="shell-input" accept="image/jpeg,image/png,image/webp">
            </div>
        </div>
        <button class="btn-primary mt-6">Simpan</button>
    </form>
@endsection

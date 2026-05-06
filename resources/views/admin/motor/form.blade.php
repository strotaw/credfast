@extends('layouts.panel', ['panel' => 'admin'])
@section('page-title', $item->exists ? 'Edit Motor' : 'Tambah Motor')
@section('content')
    <form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="shell-card p-8">
        @csrf
        @if ($method !== 'POST') @method($method) @endif
        <div class="grid gap-4 md:grid-cols-2">
            <select name="jenis_motor_id" class="shell-select">
                @foreach ($jenisMotor as $jenis)
                    <option value="{{ $jenis->id }}" @selected(old('jenis_motor_id', $item->jenis_motor_id) == $jenis->id)>{{ $jenis->merk }} - {{ str($jenis->tipe)->replace('_', ' ')->title() }}</option>
                @endforeach
            </select>
            <input type="text" name="nama_motor" value="{{ old('nama_motor', $item->nama_motor) }}" class="shell-input" placeholder="Nama motor">
            <input type="number" name="harga_jual" value="{{ old('harga_jual', $item->harga_jual) }}" class="shell-input" placeholder="Harga jual">
            <input type="number" name="stok" value="{{ old('stok', $item->stok) }}" class="shell-input" placeholder="Stok">
            <input type="text" name="warna" value="{{ old('warna', $item->warna) }}" class="shell-input" placeholder="Warna">
            <input type="text" name="kapasitas_mesin" value="{{ old('kapasitas_mesin', $item->kapasitas_mesin) }}" class="shell-input" placeholder="Kapasitas mesin">
            <input type="number" name="tahun" value="{{ old('tahun', $item->tahun) }}" class="shell-input" placeholder="Tahun produksi">
            <select name="status" class="shell-select">
                @foreach ($statuses as $status)
                    <option value="{{ $status }}" @selected(old('status', $item->status) === $status)>{{ str($status)->title() }}</option>
                @endforeach
            </select>
            <div class="md:col-span-2"><textarea name="deskripsi_motor" class="shell-textarea" placeholder="Deskripsi">{{ old('deskripsi_motor', $item->deskripsi_motor) }}</textarea></div>
            @foreach (['foto1' => 'Foto utama motor', 'foto2' => 'Foto detail motor', 'foto3' => 'Foto tambahan motor'] as $field => $label)
                <div class="{{ $field === 'foto3' ? 'md:col-span-2' : '' }}">
                    <label class="mb-2 block text-sm font-medium text-slate-700">{{ $label }}</label>
                    @if ($item->fotoUrl($field))
                        <x-uploaded-image
                            :src="$item->fotoUrl($field)"
                            :alt="$item->nama_motor"
                            label="Motor"
                            class="mb-3 h-36 w-full rounded-[22px] object-cover"
                        />
                    @endif
                    <input
                        type="file"
                        name="{{ $field }}"
                        class="shell-input"
                        accept="image/jpeg,image/png,image/webp"
                        @required($field === 'foto1' && ! $item->exists)
                    >
                </div>
            @endforeach
        </div>
        <button class="btn-primary mt-6">Simpan Motor</button>
    </form>
@endsection

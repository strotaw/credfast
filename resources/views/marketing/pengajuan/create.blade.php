@extends('layouts.panel', ['panel' => 'marketing'])

@section('page-title', 'Pengajuan Offline Marketing')

@section('content')
    <form method="POST" action="{{ route('marketing.pengajuan.offline.store') }}" enctype="multipart/form-data" class="shell-card p-8">
        @csrf
        <div class="grid gap-4 lg:grid-cols-2">
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Nama pelanggan</label>
                <input type="text" name="name" value="{{ old('name') }}" class="shell-input">
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Email pelanggan</label>
                <input type="email" name="email" value="{{ old('email') }}" class="shell-input">
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">No. HP</label>
                <input type="text" name="no_hp" value="{{ old('no_hp') }}" class="shell-input">
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Password awal</label>
                <input type="password" name="password" class="shell-input" placeholder="Opsional, default password">
            </div>
            <div class="lg:col-span-2">
                <label class="mb-2 block text-sm font-medium text-slate-700">Alamat</label>
                <textarea name="alamat" class="shell-textarea">{{ old('alamat') }}</textarea>
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Kota</label>
                <input type="text" name="kota" value="{{ old('kota') }}" class="shell-input">
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Provinsi</label>
                <input type="text" name="provinsi" value="{{ old('provinsi') }}" class="shell-input">
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Kode Pos</label>
                <input type="text" name="kode_pos" value="{{ old('kode_pos') }}" class="shell-input">
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="shell-input">
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Motor</label>
                <select name="motor_id" class="shell-select">
                    @foreach ($motors as $motor)
                        <option value="{{ $motor->id }}">{{ $motor->nama_motor }} - Rp {{ number_format($motor->harga_jual, 0, ',', '.') }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Tenor</label>
                <select name="jenis_cicilan_id" class="shell-select">
                    @foreach ($jenisCicilan as $item)
                        <option value="{{ $item->id }}">{{ $item->lama_cicilan }} bulan</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Asuransi</label>
                <select name="asuransi_id" class="shell-select">
                    <option value="">Tanpa asuransi</option>
                    @foreach ($asuransi as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_asuransi }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">DP</label>
                <input type="number" name="dp" value="{{ old('dp') }}" class="shell-input">
            </div>
        </div>
        <div class="mt-5 grid gap-4 md:grid-cols-2">
            <input type="file" name="url_kk" class="shell-input">
            <input type="file" name="url_ktp" class="shell-input">
            <input type="file" name="url_npwp" class="shell-input">
            <input type="file" name="url_slip_gaji" class="shell-input">
            <div class="md:col-span-2">
                <input type="file" name="url_foto" class="shell-input">
            </div>
        </div>
        <button class="btn-primary mt-6">Simpan Pengajuan Offline</button>
    </form>
@endsection

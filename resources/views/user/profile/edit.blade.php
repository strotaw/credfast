@extends('layouts.panel', ['panel' => 'user'])

@section('page-title', 'Profil Pelanggan')

@section('content')
    <form method="POST" action="{{ route('user.profil.update') }}" enctype="multipart/form-data" class="shell-card p-8">
        @csrf
        @method('PUT')
        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Nama</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="shell-input">
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="shell-input">
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Nomor HP</label>
                <input type="text" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" class="shell-input">
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Kode Pos</label>
                <input type="text" name="kode_pos" value="{{ old('kode_pos', $user->kode_pos) }}" class="shell-input">
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Kota</label>
                <input type="text" name="kota" value="{{ old('kota', $user->kota) }}" class="shell-input">
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Provinsi</label>
                <input type="text" name="provinsi" value="{{ old('provinsi', $user->provinsi) }}" class="shell-input">
            </div>
            <div class="md:col-span-2">
                <label class="mb-2 block text-sm font-medium text-slate-700">Alamat</label>
                <textarea name="alamat" class="shell-textarea">{{ old('alamat', $user->alamat) }}</textarea>
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Password baru</label>
                <input type="password" name="password" class="shell-input">
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Konfirmasi password</label>
                <input type="password" name="password_confirmation" class="shell-input">
            </div>
            <div class="md:col-span-2">
                <label class="mb-2 block text-sm font-medium text-slate-700">Foto profil</label>
                <input type="file" name="foto" class="shell-input">
            </div>
        </div>
        <button class="btn-primary mt-6">Simpan Profil</button>
    </form>
@endsection

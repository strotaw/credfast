@extends('layouts.panel', ['panel' => 'user'])

@section('page-title', 'Profil Pelanggan')

@section('content')
    <form method="POST" action="{{ route('user.profil.update') }}" enctype="multipart/form-data" class="shell-card p-8">
        @csrf
        @method('PUT')
        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center">
            <x-uploaded-image
                :src="$user->fotoUrl()"
                :alt="$user->name"
                :label="str($user->name)->substr(0, 1)->upper()"
                class="h-28 w-28 rounded-[28px] object-cover"
            />
            <div>
                <p class="text-sm uppercase tracking-[0.28em] text-slate-400">Foto profil</p>
                <h2 class="mt-2 text-2xl font-semibold">{{ $user->name }}</h2>
                <p class="mt-1 text-sm text-slate-500">{{ $user->email }}</p>
            </div>
        </div>
        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Nama</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="shell-input" placeholder="Nama lengkap">
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="shell-input" placeholder="Email">
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Nomor HP</label>
                <input type="text" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" class="shell-input" placeholder="Nomor HP">
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Kode Pos</label>
                <input type="text" name="kode_pos" value="{{ old('kode_pos', $user->kode_pos) }}" class="shell-input" placeholder="Kode pos">
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Kota</label>
                <input type="text" name="kota" value="{{ old('kota', $user->kota) }}" class="shell-input" placeholder="Kota">
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Provinsi</label>
                <input type="text" name="provinsi" value="{{ old('provinsi', $user->provinsi) }}" class="shell-input" placeholder="Provinsi">
            </div>
            <div class="md:col-span-2">
                <label class="mb-2 block text-sm font-medium text-slate-700">Alamat</label>
                <textarea name="alamat" class="shell-textarea" placeholder="Alamat">{{ old('alamat', $user->alamat) }}</textarea>
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Password baru</label>
                <input type="password" name="password" class="shell-input" placeholder="Password baru">
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Konfirmasi password</label>
                <input type="password" name="password_confirmation" class="shell-input" placeholder="Konfirmasi password">
            </div>
            <div class="md:col-span-2">
                <label class="mb-2 block text-sm font-medium text-slate-700">Foto profil</label>
                <input type="file" name="foto" class="shell-input" accept="image/jpeg,image/png,image/webp">
            </div>
        </div>
        <button class="btn-primary mt-6">Simpan Profil</button>
    </form>
@endsection

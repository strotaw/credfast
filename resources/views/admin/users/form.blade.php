@extends('layouts.panel', ['panel' => 'admin'])

@section('page-title', $user->exists ? 'Edit User' : 'Tambah User')

@section('content')
    <form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="shell-card p-8">
        @csrf
        @if ($method !== 'POST')
            @method($method)
        @endif
        <div class="grid gap-4 md:grid-cols-2">
            @if ($user->fotoUrl())
                <div class="md:col-span-2">
                    <x-uploaded-image
                        :src="$user->fotoUrl()"
                        :alt="$user->name"
                        :label="str($user->name)->substr(0, 1)->upper()"
                        class="h-32 w-32 rounded-[28px] object-cover"
                    />
                </div>
            @endif
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="shell-input" placeholder="Masukkan nama lengkap user">
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="shell-input" placeholder="Masukkan email login user">
            <select name="role" class="shell-select">
                @foreach ($roles as $role)
                    <option value="{{ $role }}" @selected(old('role', $user->role) === $role)>{{ strtoupper($role) }}</option>
                @endforeach
            </select>
            <input type="text" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" class="shell-input" placeholder="Masukkan nomor HP user">
            <input type="password" name="password" class="shell-input" placeholder="Masukkan password user">
            <input type="password" name="password_confirmation" class="shell-input" placeholder="Ulangi password user">
            <input type="text" name="kota" value="{{ old('kota', $user->kota) }}" class="shell-input" placeholder="Masukkan kota domisili user">
            <input type="text" name="provinsi" value="{{ old('provinsi', $user->provinsi) }}" class="shell-input" placeholder="Masukkan provinsi domisili user">
            <input type="text" name="kode_pos" value="{{ old('kode_pos', $user->kode_pos) }}" class="shell-input" placeholder="Masukkan kode pos user">
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Foto profil user</label>
                <input type="file" name="foto" class="shell-input" accept="image/jpeg,image/png,image/webp">
            </div>
            <div class="md:col-span-2">
                <textarea name="alamat" class="shell-textarea" placeholder="Masukkan alamat lengkap user">{{ old('alamat', $user->alamat) }}</textarea>
            </div>
        </div>
        <button class="btn-primary mt-6">Simpan User</button>
    </form>
@endsection

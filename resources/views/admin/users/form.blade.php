@extends('layouts.panel', ['panel' => 'admin'])

@section('page-title', $user->exists ? 'Edit User' : 'Tambah User')

@section('content')
    <form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="shell-card p-8">
        @csrf
        @if ($method !== 'POST')
            @method($method)
        @endif
        <div class="grid gap-4 md:grid-cols-2">
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="shell-input" placeholder="Nama">
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="shell-input" placeholder="Email">
            <select name="role" class="shell-select">
                @foreach ($roles as $role)
                    <option value="{{ $role }}" @selected(old('role', $user->role) === $role)>{{ strtoupper($role) }}</option>
                @endforeach
            </select>
            <input type="text" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" class="shell-input" placeholder="Nomor HP">
            <input type="password" name="password" class="shell-input" placeholder="Password">
            <input type="password" name="password_confirmation" class="shell-input" placeholder="Konfirmasi password">
            <input type="text" name="kota" value="{{ old('kota', $user->kota) }}" class="shell-input" placeholder="Kota">
            <input type="text" name="provinsi" value="{{ old('provinsi', $user->provinsi) }}" class="shell-input" placeholder="Provinsi">
            <input type="text" name="kode_pos" value="{{ old('kode_pos', $user->kode_pos) }}" class="shell-input" placeholder="Kode Pos">
            <input type="file" name="foto" class="shell-input">
            <div class="md:col-span-2">
                <textarea name="alamat" class="shell-textarea" placeholder="Alamat">{{ old('alamat', $user->alamat) }}</textarea>
            </div>
        </div>
        <button class="btn-primary mt-6">Simpan User</button>
    </form>
@endsection

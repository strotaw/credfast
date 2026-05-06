@extends('layouts.auth')

@section('title', 'Register CredFast')

@section('content')
    <h1 class="text-3xl font-semibold">Daftar akun user</h1>

    <form method="POST" action="{{ route('register.store') }}" class="mt-8 space-y-4">
        @csrf
        <div>
            <label class="mb-2 block text-sm font-medium text-slate-700">Nama lengkap</label>
            <input type="text" name="name" value="{{ old('name') }}" class="shell-input" placeholder="Nama lengkap" required>
        </div>
        <div>
            <label class="mb-2 block text-sm font-medium text-slate-700">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="shell-input" placeholder="Email" required>
        </div>
        <div>
            <label class="mb-2 block text-sm font-medium text-slate-700">Password</label>
            <input type="password" name="password" class="shell-input" placeholder="Password" required>
        </div>
        <div>
            <label class="mb-2 block text-sm font-medium text-slate-700">Konfirmasi password</label>
            <input type="password" name="password_confirmation" class="shell-input" placeholder="Konfirmasi password" required>
        </div>
        <button class="btn-primary w-full">Buat Akun</button>
    </form>

    <p class="mt-6 text-sm text-slate-500">Sudah punya akun? <a href="{{ route('login') }}" class="font-semibold text-slate-900">Masuk di sini</a></p>
@endsection

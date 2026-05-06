@extends('layouts.auth')

@section('title', 'Login CredFast')

@section('content')
    <h1 class="text-3xl font-semibold">Login ke CredFast</h1>

    <form method="POST" action="{{ route('login.store') }}" class="mt-8 space-y-4">
        @csrf
        <div>
            <label class="mb-2 block text-sm font-medium text-slate-700">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="shell-input" placeholder="Masukkan email akun" required>
        </div>
        <div>
            <label class="mb-2 block text-sm font-medium text-slate-700">Password</label>
            <input type="password" name="password" class="shell-input" placeholder="Masukkan password akun" required>
        </div>
        <label class="flex items-center gap-2 text-sm text-slate-600">
            <input type="checkbox" name="remember" value="1" class="rounded border-slate-300">
            Ingat saya
        </label>
        <button class="btn-primary w-full">Masuk</button>
    </form>

    <p class="mt-6 text-sm text-slate-500">Belum punya akun? <a href="{{ route('register') }}" class="font-semibold text-slate-900">Daftar sebagai user</a></p>
@endsection

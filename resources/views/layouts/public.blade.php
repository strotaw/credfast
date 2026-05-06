<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'CredFast')</title>
    @include('layouts.partials.assets')
</head>
<body class="app-shell app-shell--public">
    <div class="relative min-h-screen overflow-hidden">
        <div class="pointer-events-none absolute inset-x-0 top-0 h-[30rem] bg-[radial-gradient(circle_at_top,_rgba(56,189,248,0.16),_transparent_40%),radial-gradient(circle_at_right,_rgba(99,102,241,0.14),_transparent_26%)]"></div>

        <header class="sticky top-0 z-40 border-b border-slate-200/80 bg-white/85 backdrop-blur-xl">
            <div class="mx-auto flex max-w-7xl flex-col gap-4 px-6 py-4 lg:flex-row lg:items-center lg:justify-between">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <x-brand-logo />
                </a>

                <nav class="flex flex-wrap items-center gap-2 text-sm font-semibold text-slate-500">
                    <a href="{{ route('public.motor') }}" class="rounded-full px-4 py-2 transition hover:bg-slate-100 hover:text-slate-950">Motor</a>
                    <a href="{{ route('public.simulasi') }}" class="rounded-full px-4 py-2 transition hover:bg-slate-100 hover:text-slate-950">Simulasi</a>
                    <a href="{{ route('public.tentang') }}" class="rounded-full px-4 py-2 transition hover:bg-slate-100 hover:text-slate-950">Tentang</a>
                    <a href="{{ route('public.kontak') }}" class="rounded-full px-4 py-2 transition hover:bg-slate-100 hover:text-slate-950">Kontak</a>
                </nav>

                <div class="flex flex-wrap items-center gap-3">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-primary">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-secondary">Login</a>
                        <a href="{{ route('register') }}" class="btn-primary">Daftar</a>
                    @endauth
                </div>
            </div>
        </header>

        <main class="relative mx-auto max-w-7xl px-6 py-10">
            @if (session('success'))
                <div class="mb-6 rounded-[24px] border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-[24px] border border-rose-200 bg-rose-50 px-5 py-4 text-sm text-rose-700">
                    {{ $errors->first() }}
                </div>
            @endif

            @yield('content')
        </main>

        <footer class="relative border-t border-slate-200/80 bg-white/85">
            <div class="mx-auto grid max-w-7xl gap-5 px-6 py-8 text-sm text-slate-500 md:grid-cols-[1.2fr_0.8fr] md:items-center">
                <div>
                    <p class="text-xs uppercase tracking-[0.32em] text-slate-400">CredFast</p>
                    <p class="mt-3 max-w-2xl leading-7">Kredit motor cepat, jelas, dan mudah dipantau dari pengajuan sampai angsuran.</p>
                </div>
                <div class="space-y-2 md:text-right">
                    <p class="font-semibold text-slate-900">Kontak CredFast</p>
                    <p>+6283875223935</p>
                    <p>akmalzahir931@gmail.com</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>

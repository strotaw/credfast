<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Auth CredFast')</title>
    @include('layouts.partials.assets')
</head>
<body class="app-shell app-shell--auth">
    <div class="relative min-h-screen overflow-hidden bg-[linear-gradient(180deg,_#f8fafc,_#eef2ff_45%,_#f8fafc)]">
        <div class="pointer-events-none absolute inset-x-0 top-0 h-[32rem] bg-[radial-gradient(circle_at_top_left,_rgba(56,189,248,0.2),_transparent_38%),radial-gradient(circle_at_right,_rgba(99,102,241,0.18),_transparent_28%)]"></div>

        <div class="relative mx-auto flex min-h-screen max-w-7xl items-center px-6 py-10">
            <div class="grid w-full gap-8 lg:grid-cols-[1.05fr_0.95fr]">
                <section class="hidden overflow-hidden rounded-[32px] border border-white/70 bg-white/75 p-10 shadow-[0_30px_80px_rgba(15,23,42,0.08)] backdrop-blur-xl lg:block">
                    <h1 class="max-w-2xl text-5xl font-semibold leading-tight text-slate-950">Akses akun CredFast.</h1>
                </section>

                <section class="shell-card mx-auto w-full max-w-xl p-8 sm:p-10">
                    <a href="{{ route('home') }}" class="mb-8 inline-flex items-center gap-3">
                        <x-brand-logo />
                    </a>

                    @if ($errors->any())
                        <div class="mb-6 rounded-[24px] border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="mb-6 rounded-[24px] border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                            {{ session('success') }}
                        </div>
                    @endif

                    @yield('content')
                </section>
            </div>
        </div>
    </div>
</body>
</html>

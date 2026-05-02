@php
    $user = auth()->user();
    $panel = $panel ?? 'user';
    $isUserPanel = $panel === 'user';

    $panelLabels = [
        'user' => 'Portal User',
        'marketing' => 'Marketing Workspace',
        'admin' => 'Admin Workspace',
        'ceo' => 'Executive Workspace',
    ];

    $themes = [
        'user' => [
            'badge' => 'bg-sky-50 text-sky-700 ring-sky-200',
            'mark' => 'from-sky-500 via-cyan-500 to-indigo-500',
            'active' => 'bg-sky-50 text-sky-700 ring-1 ring-sky-100',
            'initial' => 'bg-sky-600 text-white',
        ],
        'marketing' => [
            'badge' => 'bg-emerald-50 text-emerald-700 ring-emerald-200',
            'mark' => 'from-emerald-500 via-teal-500 to-cyan-500',
            'active' => 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-100',
            'initial' => 'bg-emerald-600 text-white',
        ],
        'admin' => [
            'badge' => 'bg-indigo-50 text-indigo-700 ring-indigo-200',
            'mark' => 'from-indigo-500 via-blue-500 to-cyan-500',
            'active' => 'bg-indigo-50 text-indigo-700 ring-1 ring-indigo-100',
            'initial' => 'bg-indigo-600 text-white',
        ],
        'ceo' => [
            'badge' => 'bg-amber-50 text-amber-700 ring-amber-200',
            'mark' => 'from-amber-400 via-orange-500 to-rose-500',
            'active' => 'bg-amber-50 text-amber-700 ring-1 ring-amber-100',
            'initial' => 'bg-amber-500 text-slate-950',
        ],
    ];

    $userMenus = [
        ['label' => 'Dashboard', 'route' => 'user.dashboard', 'active' => 'user.dashboard'],
        ['label' => 'Pengajuan Saya', 'route' => 'user.pengajuan.index', 'active' => 'user.pengajuan.*'],
        ['label' => 'My Kredit', 'route' => 'user.kredit.index', 'active' => 'user.kredit.*'],
        ['label' => 'Angsuran', 'route' => 'user.angsuran.index', 'active' => 'user.angsuran.*'],
        ['label' => 'Pembayaran', 'route' => 'user.pembayaran.index', 'active' => 'user.pembayaran.*'],
        ['label' => 'Profil', 'route' => 'user.profil.edit', 'active' => 'user.profil.*'],
    ];

    $panelMenus = [
        'marketing' => [
            'Pipeline' => [
                ['label' => 'Dashboard', 'route' => 'marketing.dashboard', 'active' => 'marketing.dashboard'],
                ['label' => 'Pengajuan', 'route' => 'marketing.pengajuan.index', 'active' => 'marketing.pengajuan.*'],
                ['label' => 'Buat Offline', 'route' => 'marketing.pengajuan.offline.create', 'active' => 'marketing.pengajuan.offline.*'],
            ],
            'Relasi' => [
                ['label' => 'Follow Up', 'route' => 'marketing.follow-up.index', 'active' => 'marketing.follow-up.*'],
                ['label' => 'User Potensial', 'route' => 'marketing.user-potensial.index', 'active' => 'marketing.user-potensial.*'],
            ],
        ],
        'admin' => [
            'Master Data' => [
                ['label' => 'Dashboard', 'route' => 'admin.dashboard', 'active' => 'admin.dashboard'],
                ['label' => 'Users', 'route' => 'admin.users.index', 'active' => 'admin.users.*'],
                ['label' => 'Jenis Motor', 'route' => 'admin.jenis-motor.index', 'active' => 'admin.jenis-motor.*'],
                ['label' => 'Motor', 'route' => 'admin.motor.index', 'active' => 'admin.motor.*'],
                ['label' => 'Jenis Cicilan', 'route' => 'admin.jenis-cicilan.index', 'active' => 'admin.jenis-cicilan.*'],
                ['label' => 'Asuransi', 'route' => 'admin.asuransi.index', 'active' => 'admin.asuransi.*'],
                ['label' => 'Metode Bayar', 'route' => 'admin.metode-bayar.index', 'active' => 'admin.metode-bayar.*'],
            ],
            'Transaksi' => [
                ['label' => 'Pengajuan', 'route' => 'admin.pengajuan.index', 'active' => 'admin.pengajuan.*'],
                ['label' => 'Kredit', 'route' => 'admin.kredit.index', 'active' => 'admin.kredit.*'],
                ['label' => 'Angsuran', 'route' => 'admin.angsuran.index', 'active' => 'admin.angsuran.*'],
                ['label' => 'Pengiriman', 'route' => 'admin.pengiriman.index', 'active' => 'admin.pengiriman.*'],
                ['label' => 'Laporan', 'route' => 'admin.laporan.index', 'active' => 'admin.laporan.*'],
            ],
        ],
        'ceo' => [
            'Monitoring' => [
                ['label' => 'Dashboard', 'route' => 'ceo.dashboard', 'active' => 'ceo.dashboard'],
                ['label' => 'Monitoring Pengajuan', 'route' => 'ceo.pengajuan.index', 'active' => 'ceo.pengajuan.*'],
                ['label' => 'Monitoring Kredit', 'route' => 'ceo.kredit.index', 'active' => 'ceo.kredit.*'],
                ['label' => 'Monitoring Angsuran', 'route' => 'ceo.angsuran.index', 'active' => 'ceo.angsuran.*'],
                ['label' => 'Monitoring Pengiriman', 'route' => 'ceo.pengiriman.index', 'active' => 'ceo.pengiriman.*'],
            ],
            'Laporan' => [
                ['label' => 'Laporan Keuntungan', 'route' => 'ceo.laporan.keuntungan', 'active' => 'ceo.laporan.keuntungan'],
                ['label' => 'Laporan Penjualan', 'route' => 'ceo.laporan.penjualan', 'active' => 'ceo.laporan.penjualan'],
                ['label' => 'Kredit Macet', 'route' => 'ceo.laporan.kredit-macet', 'active' => 'ceo.laporan.kredit-macet'],
            ],
        ],
    ];

    $theme = $themes[$panel];
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard CredFast')</title>
    @include('layouts.partials.assets')
</head>
<body class="app-shell {{ $isUserPanel ? 'app-shell--user' : 'app-shell--panel' }}">
    @if ($isUserPanel)
        <div class="relative min-h-screen overflow-hidden">
            <div class="pointer-events-none absolute inset-x-0 top-0 h-72 bg-[radial-gradient(circle_at_top,_rgba(14,165,233,0.16),_transparent_40%),radial-gradient(circle_at_right,_rgba(99,102,241,0.16),_transparent_30%)]"></div>

            <header class="sticky top-0 z-40 border-b border-slate-200/80 bg-white/85 backdrop-blur-xl">
                <div class="mx-auto max-w-7xl px-6 py-4">
                    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                        <div class="flex items-center gap-3">
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-950 text-lg font-bold text-white">CF</div>
                            <div>
                                <p class="text-lg font-extrabold text-slate-950">CredFast</p>
                                <p class="text-xs uppercase tracking-[0.32em] text-slate-400">Customer Portal</p>
                            </div>
                        </div>

                        <div class="flex flex-wrap items-center gap-3">
                            <a href="{{ route('public.motor') }}" class="btn-secondary">Lihat Katalog</a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-primary">Logout</button>
                            </form>
                        </div>
                    </div>

                    <nav class="mt-4 overflow-x-auto pb-1">
                        <div class="flex min-w-max gap-2">
                            @foreach ($userMenus as $menu)
                                <a href="{{ route($menu['route']) }}" class="{{ request()->routeIs($menu['active']) ? 'bg-slate-950 text-white shadow-sm shadow-slate-300/40' : 'border border-slate-200 bg-white text-slate-600 hover:border-slate-300 hover:text-slate-950' }} inline-flex items-center rounded-full px-4 py-2 text-sm font-semibold transition">
                                    {{ $menu['label'] }}
                                </a>
                            @endforeach
                        </div>
                    </nav>
                </div>
            </header>

            <main class="relative mx-auto max-w-7xl px-6 py-8">
                <section class="shell-card overflow-hidden">
                    <div class="grid gap-5 px-6 py-6 sm:px-8 lg:grid-cols-[1.2fr_0.8fr] lg:items-center">
                        <div>
                            <p class="text-xs uppercase tracking-[0.32em] text-slate-400">{{ $panelLabels[$panel] }}</p>
                            <h1 class="mt-2 text-3xl font-semibold text-slate-950">@yield('page-title', 'Dashboard')</h1>
                        </div>

                        <div class="grid gap-3 sm:grid-cols-2">
                            <div class="rounded-[26px] border border-slate-200 bg-slate-50 p-4">
                                <p class="text-xs uppercase tracking-[0.28em] text-slate-400">Akun aktif</p>
                                <p class="mt-3 text-lg font-semibold text-slate-950">{{ $user->name }}</p>
                                <p class="text-sm text-slate-500">{{ $user->email }}</p>
                            </div>
                            <div class="rounded-[26px] border border-slate-200 bg-slate-50 p-4">
                                <p class="text-xs uppercase tracking-[0.28em] text-slate-400">Status portal</p>
                                <span class="mt-3 inline-flex rounded-full px-3 py-1 text-xs font-semibold ring-1 ring-inset {{ $theme['badge'] }}">{{ strtoupper($user->role) }}</span>
                                <p class="mt-3 text-sm text-slate-500">{{ now()->translatedFormat('d F Y') }}</p>
                            </div>
                        </div>
                    </div>
                </section>

                @if (session('success'))
                    <div class="mt-6 rounded-[24px] border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm text-emerald-700">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mt-6 rounded-[24px] border border-rose-200 bg-rose-50 px-5 py-4 text-sm text-rose-700">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="mt-8">
                    @yield('content')
                </div>
            </main>
        </div>
    @else
        <div class="min-h-screen xl:flex">
            <div id="panel-overlay" class="fixed inset-0 z-40 hidden bg-slate-950/45 backdrop-blur-sm xl:hidden"></div>

            <aside id="panel-sidebar" class="fixed left-0 top-0 z-50 flex h-screen w-[290px] -translate-x-full flex-col border-r border-slate-200 bg-white transition-transform duration-300 xl:translate-x-0">
                <div class="flex items-center justify-between px-5 pb-7 pt-8">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-950 text-lg font-bold text-white">CF</div>
                        <div>
                            <p class="text-lg font-extrabold text-slate-950">CredFast</p>
                            <p class="text-xs uppercase tracking-[0.32em] text-slate-400">{{ strtoupper($panel) }} panel</p>
                        </div>
                    </a>

                    <button type="button" data-panel-close class="inline-flex h-10 w-10 items-center justify-center rounded-2xl border border-slate-200 text-slate-500 xl:hidden">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M18 6L6 18" />
                        </svg>
                    </button>
                </div>

                <div class="px-5">
                    <div class="overflow-hidden rounded-[30px] bg-slate-950 p-5 text-white shadow-xl shadow-slate-300/20">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <p class="text-xs uppercase tracking-[0.28em] text-slate-400">Signed in</p>
                                <p class="mt-3 text-lg font-semibold">{{ $user->name }}</p>
                                <p class="mt-1 text-sm text-slate-400">{{ $user->email }}</p>
                            </div>
                            <div class="h-12 w-12 rounded-2xl bg-gradient-to-br {{ $theme['mark'] }}"></div>
                        </div>
                        <span class="mt-5 inline-flex rounded-full px-3 py-1 text-xs font-semibold ring-1 ring-inset {{ $theme['badge'] }}">{{ strtoupper($user->role) }}</span>
                    </div>
                </div>

                <div class="mt-7 flex-1 overflow-y-auto px-4 pb-6">
                    @foreach ($panelMenus[$panel] as $groupLabel => $items)
                        <section class="mb-6">
                            <p class="px-3 text-[11px] font-semibold uppercase tracking-[0.32em] text-slate-400">{{ $groupLabel }}</p>
                            <div class="mt-3 space-y-1">
                                @foreach ($items as $menu)
                                    @php
                                        $active = request()->routeIs($menu['active']);
                                        $initial = collect(explode(' ', $menu['label']))
                                            ->take(2)
                                            ->map(fn ($word) => strtoupper(substr($word, 0, 1)))
                                            ->implode('');
                                    @endphp
                                    <a href="{{ route($menu['route']) }}" class="{{ $active ? $theme['active'] : 'text-slate-600 hover:bg-slate-100 hover:text-slate-950' }} flex items-center gap-3 rounded-2xl px-3 py-3 text-sm font-semibold transition">
                                        <span class="{{ $active ? $theme['initial'] : 'bg-slate-200 text-slate-600' }} flex h-10 w-10 items-center justify-center rounded-2xl text-[11px] font-bold tracking-[0.18em]">
                                            {{ $initial }}
                                        </span>
                                        <span>{{ $menu['label'] }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </section>
                    @endforeach
                </div>

                <div class="border-t border-slate-200 px-5 py-5">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-secondary w-full">Logout</button>
                    </form>
                </div>
            </aside>

            <div class="flex min-h-screen flex-1 flex-col xl:ml-[290px]">
                <header class="sticky top-0 z-30 border-b border-slate-200/80 bg-white/90 backdrop-blur-xl">
                    <div class="mx-auto flex max-w-[1600px] items-center justify-between gap-4 px-4 py-4 sm:px-6 lg:px-8">
                        <div class="flex items-center gap-3">
                            <button type="button" data-panel-open class="inline-flex h-11 w-11 items-center justify-center rounded-2xl border border-slate-200 text-slate-500 xl:hidden">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h10" />
                                </svg>
                            </button>
                            <div>
                                <p class="text-[11px] font-semibold uppercase tracking-[0.32em] text-slate-400">{{ $panelLabels[$panel] }}</p>
                                <h1 class="mt-1 text-2xl font-semibold text-slate-950">@yield('page-title', 'Dashboard')</h1>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="hidden text-right sm:block">
                                <p class="text-[11px] font-semibold uppercase tracking-[0.32em] text-slate-400">Today</p>
                                <p class="mt-1 text-sm font-semibold text-slate-900">{{ now()->translatedFormat('d F Y') }}</p>
                            </div>
                            <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold ring-1 ring-inset {{ $theme['badge'] }}">{{ strtoupper($user->role) }}</span>
                        </div>
                    </div>
                </header>

                <main class="flex-1">
                    <div class="mx-auto max-w-[1600px] px-4 py-6 sm:px-6 lg:px-8">
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
                    </div>
                </main>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const sidebar = document.getElementById('panel-sidebar');
                const overlay = document.getElementById('panel-overlay');
                const openButtons = document.querySelectorAll('[data-panel-open]');
                const closeButtons = document.querySelectorAll('[data-panel-close]');

                const openSidebar = function () {
                    sidebar.classList.remove('-translate-x-full');
                    overlay.classList.remove('hidden');
                    document.body.classList.add('overflow-hidden');
                };

                const closeSidebar = function () {
                    sidebar.classList.add('-translate-x-full');
                    overlay.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                };

                openButtons.forEach(function (button) {
                    button.addEventListener('click', openSidebar);
                });

                closeButtons.forEach(function (button) {
                    button.addEventListener('click', closeSidebar);
                });

                overlay.addEventListener('click', closeSidebar);

                window.addEventListener('resize', function () {
                    if (window.innerWidth >= 1280) {
                        overlay.classList.add('hidden');
                        document.body.classList.remove('overflow-hidden');
                    } else {
                        sidebar.classList.add('-translate-x-full');
                    }
                });
            });
        </script>
    @endif
</body>
</html>

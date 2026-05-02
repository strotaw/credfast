@extends('layouts.panel', ['panel' => 'admin'])
@section('page-title', 'Laporan Operasional')
@section('content')
    <div class="mb-6 flex flex-wrap gap-3">
        <a href="{{ route('admin.laporan.export-pdf') }}" class="btn-secondary">Print View</a>
        <a href="{{ route('admin.laporan.export-excel') }}" class="btn-primary">Export CSV</a>
    </div>
    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        <x-stat-card title="Total Revenue" :value="'Rp '.number_format($totalRevenue, 0, ',', '.')" />
        <x-stat-card title="Total Profit" :value="'Rp '.number_format($totalProfit, 0, ',', '.')" />
        <x-stat-card title="Top Motors" :value="$topMotors->count()" />
        <x-stat-card title="Kredit Macet" :value="$badCredits->count()" />
    </div>
    <div class="mt-8 grid gap-6 xl:grid-cols-[1fr_1fr]">
        <section class="shell-card p-8">
            <h2 class="section-title">Pendapatan 6 bulan</h2>
            <div class="mt-6 space-y-4">
                @php $maxRevenue = max(collect($monthlyRevenue)->pluck('total')->max(), 1); @endphp
                @foreach ($monthlyRevenue as $point)
                    <div>
                        <div class="mb-2 flex items-center justify-between text-sm text-slate-500"><span>{{ $point['label'] }}</span><span>Rp {{ number_format($point['total'], 0, ',', '.') }}</span></div>
                        <div class="h-3 rounded-full bg-slate-100"><div class="h-3 rounded-full bg-indigo-500" style="width: {{ ($point['total'] / $maxRevenue) * 100 }}%"></div></div>
                    </div>
                @endforeach
            </div>
        </section>
        <section class="shell-card p-8">
            <h2 class="section-title">Status kredit</h2>
            <div class="mt-6 grid gap-4 sm:grid-cols-2">
                @foreach ($creditStatusBreakdown as $status => $total)
                    <div class="rounded-2xl border border-slate-200 p-5">
                        <x-status-badge :status="$status" />
                        <p class="mt-3 text-2xl font-semibold">{{ $total }}</p>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection

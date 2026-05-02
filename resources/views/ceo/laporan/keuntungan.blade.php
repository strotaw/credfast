@extends('layouts.panel', ['panel' => 'ceo'])
@section('page-title', 'Laporan Keuntungan')
@section('content')
    <div class="mb-6 flex flex-wrap gap-3">
        <a href="{{ route('ceo.laporan.export-pdf') }}" class="btn-secondary">Print View</a>
        <a href="{{ route('ceo.laporan.export-excel') }}" class="btn-primary">Export CSV</a>
    </div>
    <div class="grid gap-4 md:grid-cols-2">
        <x-stat-card title="Total Profit" :value="'Rp '.number_format($totalProfit, 0, ',', '.')" />
        <x-stat-card title="Total Revenue" :value="'Rp '.number_format($totalRevenue, 0, ',', '.')" />
    </div>
    <section class="shell-card mt-8 p-8">
        <h2 class="section-title">Pendapatan 12 bulan</h2>
        @php $maxRevenue = max(collect($monthlyRevenue)->pluck('total')->max(), 1); @endphp
        <div class="mt-6 space-y-4">
            @foreach ($monthlyRevenue as $point)
                <div>
                    <div class="mb-2 flex items-center justify-between text-sm text-slate-500"><span>{{ $point['label'] }}</span><span>Rp {{ number_format($point['total'], 0, ',', '.') }}</span></div>
                    <div class="h-3 rounded-full bg-slate-100"><div class="h-3 rounded-full bg-amber-500" style="width: {{ ($point['total'] / $maxRevenue) * 100 }}%"></div></div>
                </div>
            @endforeach
        </div>
    </section>
@endsection

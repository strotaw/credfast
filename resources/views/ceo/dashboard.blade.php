@extends('layouts.panel', ['panel' => 'ceo'])

@section('page-title', 'CEO Executive Dashboard')

@section('content')
    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-5">
        <x-stat-card title="Total Profit" :value="'Rp '.number_format($totalProfit, 0, ',', '.')" />
        <x-stat-card title="Pendapatan Valid" :value="'Rp '.number_format($totalRevenue, 0, ',', '.')" />
        <x-stat-card title="Kredit Aktif" :value="$totalKreditAktif" />
        <x-stat-card title="Kredit Macet" :value="$totalKreditMacet" />
        <x-stat-card title="Pengajuan Disetujui" :value="$totalPengajuanDiterima" />
    </div>

    <div class="mt-8 grid gap-6 xl:grid-cols-[1fr_1fr]">
        <section class="shell-card p-8">
            <h2 class="section-title">Grafik pendapatan bulanan</h2>
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
        <section class="shell-card p-8">
            <h2 class="section-title">Grafik pengajuan bulanan</h2>
            @php $maxApps = max(collect($monthlyApplications)->pluck('total')->max(), 1); @endphp
            <div class="mt-6 space-y-4">
                @foreach ($monthlyApplications as $point)
                    <div>
                        <div class="mb-2 flex items-center justify-between text-sm text-slate-500"><span>{{ $point['label'] }}</span><span>{{ $point['total'] }} pengajuan</span></div>
                        <div class="h-3 rounded-full bg-slate-100"><div class="h-3 rounded-full bg-sky-500" style="width: {{ ($point['total'] / $maxApps) * 100 }}%"></div></div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>

    <div class="mt-8 grid gap-6 xl:grid-cols-[0.9fr_1.1fr]">
        <section class="shell-card p-8">
            <h2 class="section-title">Status kredit</h2>
            <div class="mt-6 grid gap-4 sm:grid-cols-2">
                @foreach ($creditStatusBreakdown as $status => $total)
                    <div class="rounded-3xl border border-slate-200 p-5">
                        <x-status-badge :status="$status" />
                        <p class="mt-3 text-3xl font-semibold">{{ $total }}</p>
                    </div>
                @endforeach
            </div>
        </section>
        <section class="shell-card overflow-hidden">
            <div class="border-b border-slate-200 px-6 py-5">
                <h2 class="section-title">Motor paling banyak terjual</h2>
            </div>
            <table class="table-shell">
                <thead class="bg-slate-50"><tr><th>Motor</th><th>Total Terjual</th></tr></thead>
                <tbody class="divide-y divide-slate-200 bg-white">
                    @foreach ($topMotors as $motor)
                        <tr><td>{{ $motor->nama_motor }}</td><td>{{ $motor->total_terjual }}</td></tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </div>

    <section class="shell-card mt-8 overflow-hidden">
        <div class="border-b border-slate-200 px-6 py-5">
            <h2 class="section-title">Tabel kredit macet</h2>
        </div>
        <table class="table-shell">
            <thead class="bg-slate-50"><tr><th>No. Kontrak</th><th>Pelanggan</th><th>Motor</th><th>Sisa Kredit</th></tr></thead>
            <tbody class="divide-y divide-slate-200 bg-white">
                @foreach ($badCredits as $item)
                    <tr>
                        <td>{{ $item->no_kontrak }}</td>
                        <td>{{ $item->pengajuanKredit->user->name }}</td>
                        <td>{{ $item->pengajuanKredit->motor->nama_motor }}</td>
                        <td>Rp {{ number_format($item->sisa_kredit, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection

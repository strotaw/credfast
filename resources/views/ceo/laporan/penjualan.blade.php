@extends('layouts.panel', ['panel' => 'ceo'])
@section('page-title', 'Laporan Penjualan')
@section('content')
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-sm text-slate-500">CEO hanya melihat ringkasan penjualan dan daftar pelanggan yang sudah membuka kredit.</p>
        </div>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('ceo.laporan.export-pdf') }}" class="btn-secondary">Print View</a>
            <a href="{{ route('ceo.laporan.export-excel') }}" class="btn-primary">Export CSV</a>
        </div>
    </div>

    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        <x-stat-card title="Kredit Dibuka" :value="$totalOpenedCredits" />
        <x-stat-card title="Nilai Kontrak" :value="'Rp '.number_format($totalSalesValue, 0, ',', '.')" />
        <x-stat-card title="Margin Keuntungan" :value="number_format($profitMargin, 2, ',', '.').'%'" />
        <x-stat-card title="Margin Penjualan" :value="number_format($salesMargin, 2, ',', '.').'%'" />
    </div>

    <div class="grid gap-6 xl:grid-cols-[0.9fr_1.1fr]">
        <section class="shell-card p-8">
            <h2 class="section-title">Kredit dibuka 12 bulan</h2>
            @php $maxCredits = max(collect($monthlyOpenedCredits)->pluck('total')->max(), 1); @endphp
            <div class="mt-6 space-y-4">
                @foreach ($monthlyOpenedCredits as $point)
                    <div>
                        <div class="mb-2 flex items-center justify-between text-sm text-slate-500"><span>{{ $point['label'] }}</span><span>{{ $point['total'] }} kredit</span></div>
                        <div class="h-3 rounded-full bg-slate-100"><div class="h-3 rounded-full bg-sky-500" style="width: {{ ($point['total'] / $maxCredits) * 100 }}%"></div></div>
                    </div>
                @endforeach
            </div>
        </section>
        <section class="shell-card overflow-hidden">
            <div class="border-b border-slate-200 px-6 py-5"><h2 class="section-title">Top motor terjual</h2></div>
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
            <h2 class="section-title">Pelanggan yang buka kredit</h2>
        </div>
        <table class="table-shell">
            <thead class="bg-slate-50">
                <tr>
                    <th>Tanggal</th>
                    <th>No. Kontrak</th>
                    <th>Pelanggan</th>
                    <th>Motor</th>
                    <th>Status</th>
                    <th>Total Kredit</th>
                    <th>Sisa</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 bg-white">
                @forelse ($openedCredits as $kredit)
                    <tr>
                        <td>{{ $kredit->tgl_mulai_kredit->translatedFormat('d M Y') }}</td>
                        <td>{{ $kredit->no_kontrak }}</td>
                        <td>{{ $kredit->pengajuanKredit?->user?->name ?? '-' }}</td>
                        <td>{{ $kredit->pengajuanKredit?->motor?->nama_motor ?? '-' }}</td>
                        <td><x-status-badge :status="$kredit->status_kredit" /></td>
                        <td>Rp {{ number_format($kredit->total_kredit, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($kredit->sisa_kredit, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-slate-500">Belum ada kredit yang dibuka.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>

    <div class="mt-6">{{ $openedCredits->links() }}</div>
@endsection

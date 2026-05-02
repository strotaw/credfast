@extends('layouts.panel', ['panel' => 'ceo'])
@section('page-title', 'Laporan Penjualan')
@section('content')
    <div class="grid gap-6 xl:grid-cols-[0.9fr_1.1fr]">
        <section class="shell-card p-8">
            <h2 class="section-title">Pengajuan 12 bulan</h2>
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
@endsection

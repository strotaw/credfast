@extends('layouts.panel', ['panel' => 'admin'])

@section('page-title', 'Admin Dashboard')

@section('content')
    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        <x-stat-card title="Total User" :value="$totalUser" />
        <x-stat-card title="Total Motor" :value="$totalMotor" />
        <x-stat-card title="Total Pengajuan" :value="$totalPengajuan" />
        <x-stat-card title="Kredit Aktif" :value="$totalKreditAktif" />
        <x-stat-card title="Pembayaran Menunggu" :value="$pembayaranMenunggu" />
        <x-stat-card title="Kredit Macet" :value="$totalKreditMacet" />
        <x-stat-card title="Pendapatan Bulan Ini" :value="'Rp '.number_format($pendapatanBulanIni, 0, ',', '.')" />
    </div>

    <section class="shell-card mt-8 overflow-hidden">
        <div class="border-b border-slate-200 px-6 py-5">
            <h2 class="section-title">Pengajuan terbaru</h2>
        </div>
        <table class="table-shell">
            <thead class="bg-slate-50">
                <tr>
                    <th>Pelanggan</th>
                    <th>Motor</th>
                    <th>Status</th>
                    <th>Marketing</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 bg-white">
                @foreach ($recentPengajuan as $item)
                    @php
                        $customerName = $item->pelanggan?->nama_pelanggan ?? $item->user?->name ?? '-';
                    @endphp
                    <tr>
                        <td>{{ $customerName }}</td>
                        <td>{{ $item->motor->nama_motor }}</td>
                        <td><x-status-badge :status="$item->status_pengajuan" /></td>
                        <td>{{ $item->marketing?->name ?? '-' }}</td>
                        <td><a href="{{ route('admin.pengajuan.show', $item) }}" class="btn-secondary">Detail</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection

@extends('layouts.panel', ['panel' => 'marketing'])

@section('page-title', 'Marketing Dashboard')

@section('content')
    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-5">
        <x-stat-card title="Pengajuan Baru" :value="$newCount" />
        <x-stat-card title="Diproses" :value="$processedCount" />
        <x-stat-card title="Data Kurang" :value="$missingCount" />
        <x-stat-card title="Direkomendasikan" :value="$recommendedCount" />
        <x-stat-card title="Tidak Direkomendasikan" :value="$rejectedCount" />
    </div>

    <section class="shell-card mt-8 overflow-hidden">
        <div class="flex items-center justify-between border-b border-slate-200 px-6 py-5">
            <div>
                <h2 class="section-title">Pipeline pengajuan terbaru</h2>
            </div>
            <a href="{{ route('marketing.pengajuan.index') }}" class="btn-secondary">Semua Pengajuan</a>
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
                @foreach ($latestPengajuan as $item)
                    <tr>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->motor->nama_motor }}</td>
                        <td><x-status-badge :status="$item->status_pengajuan" /></td>
                        <td>{{ $item->marketing?->name ?? '-' }}</td>
                        <td><a href="{{ route('marketing.pengajuan.show', $item) }}" class="btn-secondary">Review</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection

@extends('layouts.panel', ['panel' => 'marketing'])

@section('page-title', 'Pengajuan Kredit Masuk')

@section('content')
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <form method="GET" class="flex flex-wrap gap-3">
            <select name="status" class="shell-select">
                <option value="">Semua status</option>
                @foreach ($statusOptions as $status)
                    <option value="{{ $status }}" @selected(request('status') === $status)>{{ str($status)->replace('_', ' ')->title() }}</option>
                @endforeach
            </select>
            <button class="btn-secondary">Filter</button>
        </form>
        <a href="{{ route('marketing.pengajuan.offline.create') }}" class="btn-primary">Input Pengajuan Offline</a>
    </div>

    <div class="shell-card overflow-hidden">
        <table class="table-shell">
            <thead class="bg-slate-50">
                <tr>
                    <th>Pelanggan</th>
                    <th>Motor</th>
                    <th>Tenor</th>
                    <th>Status</th>
                    <th>Dibuat</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 bg-white">
                @foreach ($pengajuanList as $item)
                    <tr>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->motor->nama_motor }}</td>
                        <td>{{ $item->jenisCicilan->lama_cicilan }} bulan</td>
                        <td><x-status-badge :status="$item->status_pengajuan" /></td>
                        <td>{{ $item->created_at->format('d M Y') }}</td>
                        <td><a href="{{ route('marketing.pengajuan.show', $item) }}" class="btn-secondary">Detail</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $pengajuanList->links() }}</div>
@endsection

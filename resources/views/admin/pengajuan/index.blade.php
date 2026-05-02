@extends('layouts.panel', ['panel' => 'admin'])
@section('page-title', 'Kelola Pengajuan Kredit')
@section('content')
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <form method="GET" class="flex gap-3">
            <select name="status" class="shell-select">
                <option value="">Semua status</option>
                @foreach ($statusOptions as $status)
                    <option value="{{ $status }}" @selected(request('status') === $status)>{{ str($status)->replace('_', ' ')->title() }}</option>
                @endforeach
            </select>
            <button class="btn-secondary">Filter</button>
        </form>
        <a href="{{ route('admin.pengajuan.offline.create') }}" class="btn-primary">Input Pengajuan Offline</a>
    </div>
    <div class="shell-card overflow-hidden">
        <table class="table-shell">
            <thead class="bg-slate-50"><tr><th>Pelanggan</th><th>Motor</th><th>Status</th><th>Marketing</th><th>Kredit</th><th></th></tr></thead>
            <tbody class="divide-y divide-slate-200 bg-white">
                @foreach ($pengajuanList as $item)
                    <tr>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->motor->nama_motor }}</td>
                        <td><x-status-badge :status="$item->status_pengajuan" /></td>
                        <td>{{ $item->marketing?->name ?? '-' }}</td>
                        <td>{{ $item->kredit?->no_kontrak ?? '-' }}</td>
                        <td><a href="{{ route('admin.pengajuan.show', $item) }}" class="btn-secondary">Detail</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $pengajuanList->links() }}</div>
@endsection

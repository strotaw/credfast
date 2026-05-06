@extends('layouts.panel', ['panel' => 'admin'])
@section('page-title', 'Data Pengajuan Kredit')
@section('content')
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-sm text-slate-500">Pengajuan dari pelanggan dan input offline tampil di sini.</p>
        </div>
        <div class="flex flex-col gap-3 sm:flex-row">
            <form method="GET" class="flex gap-3">
                <select name="status" class="shell-select">
                    <option value="">Semua status</option>
                    @foreach ($statusOptions as $status)
                        <option value="{{ $status }}" @selected(request('status') === $status)>{{ str($status)->replace('_', ' ')->title() }}</option>
                    @endforeach
                </select>
                <button class="btn-secondary">Filter</button>
            </form>
        </div>
        <a href="{{ route('admin.pengajuan.offline.create') }}" class="btn-primary">Input Pengajuan Offline</a>
    </div>
    <div class="shell-card overflow-hidden">
        <table class="table-shell">
            <thead class="bg-slate-50"><tr><th>Pelanggan</th><th>Kontak</th><th>Motor</th><th>Bayar</th><th>Status</th><th>Sumber</th><th>Kredit</th><th></th></tr></thead>
            <tbody class="divide-y divide-slate-200 bg-white">
                @forelse ($pengajuanList as $item)
                    @php
                        $pelanggan = $item->pelanggan;
                        $customerName = $pelanggan?->nama_pelanggan ?? $item->user?->name ?? '-';
                        $customerEmail = $pelanggan?->email ?? $item->user?->email ?? '-';
                        $customerPhone = $pelanggan?->no_telp ?? $item->user?->no_hp ?? '-';
                    @endphp
                    <tr>
                        <td>{{ $customerName }}</td>
                        <td>
                            <div>{{ $customerEmail }}</div>
                            <div class="mt-1 text-xs text-slate-500">{{ $customerPhone }}</div>
                        </td>
                        <td>{{ $item->motor->nama_motor }}</td>
                        <td>{{ $item->metodeBayar?->nama_bank ?? '-' }}</td>
                        <td><x-status-badge :status="$item->status_pengajuan" /></td>
                        <td>{{ $item->admin_id ? 'Offline Admin' : 'Pelanggan' }}</td>
                        <td>{{ $item->kredit?->no_kontrak ?? '-' }}</td>
                        <td><a href="{{ route('admin.pengajuan.show', $item) }}" class="btn-secondary">Detail</a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-slate-500">Belum ada pengajuan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $pengajuanList->links() }}</div>
@endsection

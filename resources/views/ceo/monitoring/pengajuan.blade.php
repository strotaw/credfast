@extends('layouts.panel', ['panel' => 'ceo'])
@section('page-title', 'Monitoring Pengajuan')
@section('content')
    <div class="shell-card overflow-hidden">
        <table class="table-shell"><thead class="bg-slate-50"><tr><th>Pelanggan</th><th>Motor</th><th>Status</th><th>Marketing</th><th>Admin</th></tr></thead>
            <tbody class="divide-y divide-slate-200 bg-white">
                @foreach ($items as $item)
                    <tr><td>{{ $item->user->name }}</td><td>{{ $item->motor->nama_motor }}</td><td><x-status-badge :status="$item->status_pengajuan" /></td><td>{{ $item->marketing?->name ?? '-' }}</td><td>{{ $item->admin?->name ?? '-' }}</td></tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $items->links() }}</div>
@endsection

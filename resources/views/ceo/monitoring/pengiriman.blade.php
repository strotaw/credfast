@extends('layouts.panel', ['panel' => 'ceo'])
@section('page-title', 'Monitoring Pengiriman')
@section('content')
    <div class="shell-card overflow-hidden">
        <table class="table-shell"><thead class="bg-slate-50"><tr><th>Invoice</th><th>Pelanggan</th><th>Motor</th><th>Status</th><th>Kurir</th></tr></thead>
            <tbody class="divide-y divide-slate-200 bg-white">
                @foreach ($items as $item)
                    <tr><td>{{ $item->no_invoice }}</td><td>{{ $item->kredit->pengajuanKredit->user->name }}</td><td>{{ $item->kredit->pengajuanKredit->motor->nama_motor }}</td><td><x-status-badge :status="$item->status_kirim" kirim /></td><td>{{ $item->nama_kurir ?? '-' }}</td></tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $items->links() }}</div>
@endsection

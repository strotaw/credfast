@extends('layouts.panel', ['panel' => 'ceo'])
@section('page-title', 'Monitoring Angsuran')
@section('content')
    <div class="shell-card overflow-hidden">
        <table class="table-shell"><thead class="bg-slate-50"><tr><th>Pelanggan</th><th>Motor</th><th>Ke</th><th>Total</th><th>Status</th></tr></thead>
            <tbody class="divide-y divide-slate-200 bg-white">
                @foreach ($items as $item)
                    <tr><td>{{ $item->kredit->pengajuanKredit->user->name }}</td><td>{{ $item->kredit->pengajuanKredit->motor->nama_motor }}</td><td>{{ $item->angsuran_ke }}</td><td>Rp {{ number_format($item->total_bayar, 0, ',', '.') }}</td><td><x-status-badge :status="$item->status" /></td></tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $items->links() }}</div>
@endsection

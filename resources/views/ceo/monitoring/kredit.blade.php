@extends('layouts.panel', ['panel' => 'ceo'])
@section('page-title', 'Monitoring Kredit')
@section('content')
    <div class="shell-card overflow-hidden">
        <table class="table-shell"><thead class="bg-slate-50"><tr><th>No. Kontrak</th><th>Pelanggan</th><th>Motor</th><th>Status</th><th>Sisa</th></tr></thead>
            <tbody class="divide-y divide-slate-200 bg-white">
                @foreach ($items as $item)
                    <tr><td>{{ $item->no_kontrak }}</td><td>{{ $item->pengajuanKredit->user->name }}</td><td>{{ $item->pengajuanKredit->motor->nama_motor }}</td><td><x-status-badge :status="$item->status_kredit" /></td><td>Rp {{ number_format($item->sisa_kredit, 0, ',', '.') }}</td></tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $items->links() }}</div>
@endsection

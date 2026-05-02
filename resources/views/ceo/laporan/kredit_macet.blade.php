@extends('layouts.panel', ['panel' => 'ceo'])
@section('page-title', 'Laporan Kredit Macet')
@section('content')
    <div class="shell-card overflow-hidden">
        <table class="table-shell">
            <thead class="bg-slate-50"><tr><th>No. Kontrak</th><th>Pelanggan</th><th>Motor</th><th>Sisa Kredit</th><th>Status</th></tr></thead>
            <tbody class="divide-y divide-slate-200 bg-white">
                @foreach ($badCredits as $item)
                    <tr>
                        <td>{{ $item->no_kontrak }}</td>
                        <td>{{ $item->pengajuanKredit->user->name }}</td>
                        <td>{{ $item->pengajuanKredit->motor->nama_motor }}</td>
                        <td>Rp {{ number_format($item->sisa_kredit, 0, ',', '.') }}</td>
                        <td><x-status-badge :status="$item->status_kredit" /></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

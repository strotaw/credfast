@extends('layouts.panel', ['panel' => 'user'])

@section('page-title', 'My Kredit')

@section('content')
    @if ($kreditList->isEmpty())
        <x-empty-state title="Belum ada kredit aktif" />
    @else
        <div class="shell-card overflow-hidden">
            <table class="table-shell">
                <thead class="bg-slate-50">
                    <tr>
                        <th>No. Kontrak</th>
                        <th>Motor</th>
                        <th>Status</th>
                        <th>Pengiriman</th>
                        <th>Total Kredit</th>
                        <th>Sisa</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white">
                    @foreach ($kreditList as $item)
                        <tr>
                            <td>{{ $item->no_kontrak }}</td>
                            <td>{{ $item->pengajuanKredit->motor->nama_motor }}</td>
                            <td><x-status-badge :status="$item->status_kredit" /></td>
                            <td>@if ($item->pengiriman)<x-status-badge :status="$item->pengiriman->status_kirim" kirim />@else - @endif</td>
                            <td>Rp {{ number_format($item->total_kredit, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($item->sisa_kredit, 0, ',', '.') }}</td>
                            <td><a href="{{ route('user.kredit.show', $item) }}" class="btn-secondary">Detail</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6">{{ $kreditList->links() }}</div>
    @endif
@endsection

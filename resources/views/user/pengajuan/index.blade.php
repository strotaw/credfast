@extends('layouts.panel', ['panel' => 'user'])

@section('page-title', 'Pengajuan Saya')

@section('content')
    <div class="mb-6 flex justify-end">
        <a href="{{ route('public.motor') }}" class="btn-primary">Pilih Motor Baru</a>
    </div>

    @if ($pengajuanList->isEmpty())
        <x-empty-state title="Belum ada pengajuan" />
    @else
        <div class="shell-card overflow-hidden">
            <table class="table-shell">
                <thead class="bg-slate-50">
                    <tr>
                        <th>Motor</th>
                        <th>Tenor</th>
                        <th>DP</th>
                        <th>Bayar</th>
                        <th>Status</th>
                        <th>Dibuat</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white">
                    @foreach ($pengajuanList as $item)
                        <tr>
                            <td>{{ $item->motor->nama_motor }}</td>
                            <td>{{ $item->jenisCicilan->lama_cicilan }} bulan</td>
                            <td>Rp {{ number_format($item->dp, 0, ',', '.') }}</td>
                            <td>{{ $item->metodeBayar?->nama_bank ?? '-' }}</td>
                            <td><x-status-badge :status="$item->status_pengajuan" /></td>
                            <td>{{ $item->created_at->format('d M Y') }}</td>
                            <td><a href="{{ route('user.pengajuan.show', $item) }}" class="btn-secondary">Detail</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6">{{ $pengajuanList->links() }}</div>
    @endif
@endsection

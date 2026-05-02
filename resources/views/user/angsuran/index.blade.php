@extends('layouts.panel', ['panel' => 'user'])

@section('page-title', 'Daftar Angsuran')

@section('content')
    @if ($angsuranList->isEmpty())
        <x-empty-state title="Belum ada data angsuran" />
    @else
        <div class="shell-card overflow-hidden">
            <table class="table-shell">
                <thead class="bg-slate-50">
                    <tr>
                        <th>Motor</th>
                        <th>Ke</th>
                        <th>Jatuh Tempo</th>
                        <th>Total Bayar</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white">
                    @foreach ($angsuranList as $item)
                        <tr>
                            <td>{{ $item->kredit->pengajuanKredit->motor->nama_motor }}</td>
                            <td>{{ $item->angsuran_ke }}</td>
                            <td>{{ $item->tanggal_jatuh_tempo->format('d M Y') }}</td>
                            <td>Rp {{ number_format($item->total_bayar, 0, ',', '.') }}</td>
                            <td><x-status-badge :status="$item->status" /></td>
                            <td><a href="{{ route('user.angsuran.show', $item) }}" class="btn-secondary">Detail</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6">{{ $angsuranList->links() }}</div>
    @endif
@endsection

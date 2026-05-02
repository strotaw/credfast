@extends('layouts.panel', ['panel' => 'user'])

@section('page-title', 'Riwayat Pembayaran')

@section('content')
    @if ($payments->isEmpty())
        <x-empty-state title="Belum ada riwayat pembayaran" />
    @else
        <div class="shell-card overflow-hidden">
            <table class="table-shell">
                <thead class="bg-slate-50">
                    <tr>
                        <th>Motor</th>
                        <th>Angsuran</th>
                        <th>Tanggal Bayar</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white">
                    @foreach ($payments as $item)
                        <tr>
                            <td>{{ $item->kredit->pengajuanKredit->motor->nama_motor }}</td>
                            <td>#{{ $item->angsuran_ke }}</td>
                            <td>{{ $item->tanggal_bayar?->format('d M Y') ?? '-' }}</td>
                            <td>Rp {{ number_format($item->total_bayar, 0, ',', '.') }}</td>
                            <td><x-status-badge :status="$item->status" /></td>
                            <td>
                                @if ($item->status === 'valid')
                                    <a href="{{ route('user.angsuran.receipt', $item) }}" class="btn-secondary">Bukti</a>
                                @else
                                    <a href="{{ route('user.angsuran.show', $item) }}" class="btn-secondary">Detail</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6">{{ $payments->links() }}</div>
    @endif
@endsection

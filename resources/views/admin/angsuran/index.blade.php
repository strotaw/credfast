@extends('layouts.panel', ['panel' => 'admin'])
@section('page-title', 'Kelola Angsuran')
@section('content')
    <form method="GET" class="mb-6 flex gap-3">
        <select name="status" class="shell-select">
            <option value="">Semua status</option>
            @foreach ($statusOptions as $status)
                <option value="{{ $status }}" @selected(request('status') === $status)>{{ str($status)->replace('_', ' ')->title() }}</option>
            @endforeach
        </select>
        <button class="btn-secondary">Filter</button>
    </form>
    <div class="shell-card overflow-hidden">
        <table class="table-shell">
            <thead class="bg-slate-50"><tr><th>Pelanggan</th><th>Motor</th><th>Ke</th><th>Total</th><th>Status</th><th></th></tr></thead>
            <tbody class="divide-y divide-slate-200 bg-white">
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->kredit->pengajuanKredit->user->name }}</td>
                        <td>{{ $item->kredit->pengajuanKredit->motor->nama_motor }}</td>
                        <td>{{ $item->angsuran_ke }}</td>
                        <td>Rp {{ number_format($item->total_bayar, 0, ',', '.') }}</td>
                        <td><x-status-badge :status="$item->status" /></td>
                        <td><a href="{{ route('admin.angsuran.show', $item) }}" class="btn-secondary">Detail</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $items->links() }}</div>
@endsection

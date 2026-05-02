@extends('layouts.panel', ['panel' => 'admin'])
@section('page-title', 'Kelola Kredit')
@section('content')
    <form method="GET" class="mb-6 flex gap-3">
        <select name="status" class="shell-select">
            <option value="">Semua status</option>
            @foreach ($statusOptions as $status)
                <option value="{{ $status }}" @selected(request('status') === $status)>{{ str($status)->title() }}</option>
            @endforeach
        </select>
        <button class="btn-secondary">Filter</button>
    </form>
    <div class="shell-card overflow-hidden">
        <table class="table-shell">
            <thead class="bg-slate-50"><tr><th>No. Kontrak</th><th>Pelanggan</th><th>Motor</th><th>Status</th><th>Sisa</th><th></th></tr></thead>
            <tbody class="divide-y divide-slate-200 bg-white">
                @foreach ($kreditList as $item)
                    <tr>
                        <td>{{ $item->no_kontrak }}</td>
                        <td>{{ $item->pengajuanKredit->user->name }}</td>
                        <td>{{ $item->pengajuanKredit->motor->nama_motor }}</td>
                        <td><x-status-badge :status="$item->status_kredit" /></td>
                        <td>Rp {{ number_format($item->sisa_kredit, 0, ',', '.') }}</td>
                        <td><a href="{{ route('admin.kredit.show', $item) }}" class="btn-secondary">Detail</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $kreditList->links() }}</div>
@endsection

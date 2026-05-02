@extends('layouts.panel', ['panel' => 'admin'])
@section('page-title', 'Kelola Metode Bayar')
@section('content')
    <div class="mb-6 flex justify-end"><a href="{{ route('admin.metode-bayar.create') }}" class="btn-primary">Tambah Metode Bayar</a></div>
    <div class="shell-card overflow-hidden">
        <table class="table-shell"><thead class="bg-slate-50"><tr><th>Bank</th><th>Nomor Rekening</th><th>Atas Nama</th><th>Status</th><th></th></tr></thead>
            <tbody class="divide-y divide-slate-200 bg-white">
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->nama_bank }}</td>
                        <td>{{ $item->nomor_rekening }}</td>
                        <td>{{ $item->atas_nama }}</td>
                        <td><x-status-badge :status="$item->status" bank /></td>
                        <td class="flex gap-2"><a href="{{ route('admin.metode-bayar.show', $item) }}" class="btn-secondary">Lihat</a><a href="{{ route('admin.metode-bayar.edit', $item) }}" class="btn-secondary">Edit</a><form method="POST" action="{{ route('admin.metode-bayar.destroy', $item) }}">@csrf @method('DELETE')<button class="btn-danger" onclick="return confirm('Hapus data ini?')">Hapus</button></form></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $items->links() }}</div>
@endsection

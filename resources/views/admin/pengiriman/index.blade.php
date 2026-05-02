@extends('layouts.panel', ['panel' => 'admin'])
@section('page-title', 'Kelola Pengiriman')
@section('content')
    <div class="mb-6 flex justify-end"><a href="{{ route('admin.pengiriman.create') }}" class="btn-primary">Tambah Pengiriman</a></div>
    <div class="shell-card overflow-hidden">
        <table class="table-shell"><thead class="bg-slate-50"><tr><th>Invoice</th><th>Pelanggan</th><th>Motor</th><th>Status</th><th></th></tr></thead>
            <tbody class="divide-y divide-slate-200 bg-white">
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->no_invoice }}</td>
                        <td>{{ $item->kredit->pengajuanKredit->user->name }}</td>
                        <td>{{ $item->kredit->pengajuanKredit->motor->nama_motor }}</td>
                        <td><x-status-badge :status="$item->status_kirim" kirim /></td>
                        <td class="flex gap-2"><a href="{{ route('admin.pengiriman.show', $item) }}" class="btn-secondary">Lihat</a><a href="{{ route('admin.pengiriman.edit', $item) }}" class="btn-secondary">Edit</a><form method="POST" action="{{ route('admin.pengiriman.destroy', $item) }}">@csrf @method('DELETE')<button class="btn-danger" onclick="return confirm('Hapus data ini?')">Hapus</button></form></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $items->links() }}</div>
@endsection

@extends('layouts.panel', ['panel' => 'admin'])
@section('page-title', 'Kelola Pengiriman')
@section('content')
    <div class="shell-card overflow-hidden">
        <table class="table-shell"><thead class="bg-slate-50"><tr><th>Invoice</th><th>Pelanggan</th><th>Motor</th><th>Status</th><th></th></tr></thead>
            <tbody class="divide-y divide-slate-200 bg-white">
                @forelse ($items as $item)
                    <tr>
                        <td>{{ $item->no_invoice }}</td>
                        <td>{{ $item->kredit->pengajuanKredit->user->name }}</td>
                        <td>{{ $item->kredit->pengajuanKredit->motor->nama_motor }}</td>
                        <td><x-status-badge :status="$item->status_kirim" kirim /></td>
                        <td class="flex gap-2"><a href="{{ route('admin.pengiriman.show', $item) }}" class="btn-secondary">Lihat</a><a href="{{ route('admin.pengiriman.edit', $item) }}" class="btn-secondary">Edit</a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-slate-500">Pengiriman muncul setelah pengajuan di-approve.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $items->links() }}</div>
@endsection

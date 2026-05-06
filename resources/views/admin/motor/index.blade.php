@extends('layouts.panel', ['panel' => 'admin'])
@section('page-title', 'Kelola Motor')
@section('content')
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <form method="GET"><input type="text" name="q" value="{{ request('q') }}" class="shell-input" placeholder="Cari motor"></form>
        <a href="{{ route('admin.motor.create') }}" class="btn-primary">Tambah Motor</a>
    </div>
    <div class="shell-card overflow-hidden">
        <table class="table-shell">
            <thead class="bg-slate-50"><tr><th>Foto</th><th>Nama</th><th>Jenis</th><th>Harga</th><th>Stok</th><th>Status</th><th></th></tr></thead>
            <tbody class="divide-y divide-slate-200 bg-white">
                @foreach ($items as $item)
                    <tr>
                        <td>
                            <x-uploaded-image
                                :src="$item->primaryFotoUrl()"
                                :alt="$item->nama_motor"
                                label="Motor"
                                class="h-16 w-24 rounded-2xl object-cover"
                            />
                        </td>
                        <td>{{ $item->nama_motor }}</td>
                        <td>{{ $item->jenisMotor->merk }}</td>
                        <td>Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                        <td>{{ $item->stok }}</td>
                        <td><x-status-badge :status="$item->status" /></td>
                        <td class="flex gap-2">
                            <a href="{{ route('admin.motor.show', $item) }}" class="btn-secondary">Lihat</a>
                            <a href="{{ route('admin.motor.edit', $item) }}" class="btn-secondary">Edit</a>
                            <form method="POST" action="{{ route('admin.motor.destroy', $item) }}">@csrf @method('DELETE')<button class="btn-danger" onclick="return confirm('Hapus motor ini?')">Hapus</button></form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $items->links() }}</div>
@endsection

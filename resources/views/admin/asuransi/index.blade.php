@extends('layouts.panel', ['panel' => 'admin'])
@section('page-title', 'Kelola Asuransi')
@section('content')
    <div class="mb-6 flex justify-end"><a href="{{ route('admin.asuransi.create') }}" class="btn-primary">Tambah Asuransi</a></div>
    <div class="shell-card overflow-hidden">
        <table class="table-shell"><thead class="bg-slate-50"><tr><th>Logo</th><th>Perusahaan</th><th>Produk</th><th>Margin</th><th></th></tr></thead>
            <tbody class="divide-y divide-slate-200 bg-white">
                @foreach ($items as $item)
                    <tr>
                        <td>
                            <x-uploaded-image
                                :src="$item->logoUrl()"
                                :alt="$item->nama_asuransi"
                                :label="str($item->nama_asuransi)->substr(0, 2)->upper()"
                                class="h-14 w-20 rounded-2xl object-contain p-2"
                            />
                        </td>
                        <td>{{ $item->nama_perusahaan_asuransi }}</td>
                        <td>{{ $item->nama_asuransi }}</td>
                        <td>{{ $item->margin_asuransi }}%</td>
                        <td class="flex gap-2"><a href="{{ route('admin.asuransi.show', $item) }}" class="btn-secondary">Lihat</a><a href="{{ route('admin.asuransi.edit', $item) }}" class="btn-secondary">Edit</a><form method="POST" action="{{ route('admin.asuransi.destroy', $item) }}">@csrf @method('DELETE')<button class="btn-danger" onclick="return confirm('Hapus data ini?')">Hapus</button></form></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $items->links() }}</div>
@endsection

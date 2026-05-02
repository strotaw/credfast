@extends('layouts.panel', ['panel' => 'admin'])
@section('page-title', 'Kelola Jenis Cicilan')
@section('content')
    <div class="mb-6 flex justify-end"><a href="{{ route('admin.jenis-cicilan.create') }}" class="btn-primary">Tambah Jenis Cicilan</a></div>
    <div class="shell-card overflow-hidden">
        <table class="table-shell">
            <thead class="bg-slate-50"><tr><th>Lama Cicilan</th><th>Margin</th><th></th></tr></thead>
            <tbody class="divide-y divide-slate-200 bg-white">
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->lama_cicilan }} bulan</td>
                        <td>{{ $item->margin_kredit }}%</td>
                        <td class="flex gap-2">
                            <a href="{{ route('admin.jenis-cicilan.show', $item) }}" class="btn-secondary">Lihat</a>
                            <a href="{{ route('admin.jenis-cicilan.edit', $item) }}" class="btn-secondary">Edit</a>
                            <form method="POST" action="{{ route('admin.jenis-cicilan.destroy', $item) }}">@csrf @method('DELETE')<button class="btn-danger" onclick="return confirm('Hapus data ini?')">Hapus</button></form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $items->links() }}</div>
@endsection

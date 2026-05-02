@extends('layouts.panel', ['panel' => 'admin'])
@section('page-title', 'Detail Jenis Motor')
@section('content')
    <div class="shell-card p-8">
        <h2 class="text-3xl font-semibold">{{ $item->merk }}</h2>
        <p class="mt-2 text-sm text-slate-500">{{ str($item->tipe)->replace('_', ' ')->title() }}</p>
        <p class="mt-6 text-slate-600">{{ $item->deskripsi_jenis ?: 'Belum ada deskripsi.' }}</p>
        <div class="mt-6">
            <p class="font-semibold text-slate-900">Daftar motor</p>
            <div class="mt-3 space-y-3">
                @forelse ($item->motor as $motor)
                    <div class="rounded-2xl border border-slate-200 px-4 py-3">{{ $motor->nama_motor }}</div>
                @empty
                    <p class="text-sm text-slate-500">Belum ada motor pada kategori ini.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection

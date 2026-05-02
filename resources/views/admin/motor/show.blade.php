@extends('layouts.panel', ['panel' => 'admin'])
@section('page-title', 'Detail Motor')
@section('content')
    <div class="shell-card p-8">
        <div class="flex items-center justify-between gap-3">
            <div>
                <p class="text-sm uppercase tracking-[0.28em] text-slate-400">{{ $item->jenisMotor->merk }}</p>
                <h2 class="mt-2 text-3xl font-semibold">{{ $item->nama_motor }}</h2>
            </div>
            <x-status-badge :status="$item->status" />
        </div>
        <p class="mt-6 text-slate-600">{{ $item->deskripsi_motor }}</p>
        <div class="mt-6 grid gap-4 sm:grid-cols-3 text-sm text-slate-600">
            <div>Harga: <span class="font-semibold text-slate-900">Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</span></div>
            <div>Stok: <span class="font-semibold text-slate-900">{{ $item->stok }}</span></div>
            <div>Pengajuan: <span class="font-semibold text-slate-900">{{ $item->pengajuanKredit->count() }}</span></div>
        </div>
    </div>
@endsection

@extends('layouts.panel', ['panel' => 'admin'])
@section('page-title', 'Detail Pengiriman')
@section('content')
    <div class="shell-card p-8 text-sm text-slate-600">
        <div class="flex items-center justify-between gap-3">
            <div><p class="text-sm uppercase tracking-[0.28em] text-slate-400">Pengiriman</p><h2 class="mt-2 text-3xl font-semibold">{{ $item->no_invoice }}</h2></div>
            <x-status-badge :status="$item->status_kirim" kirim />
        </div>
        <div class="mt-6 grid gap-4 sm:grid-cols-2">
            <div>Pelanggan: <span class="font-semibold text-slate-900">{{ $item->kredit->pengajuanKredit->user->name }}</span></div>
            <div>Motor: <span class="font-semibold text-slate-900">{{ $item->kredit->pengajuanKredit->motor->nama_motor }}</span></div>
            <div>Kurir: <span class="font-semibold text-slate-900">{{ $item->nama_kurir ?? '-' }}</span></div>
            <div>Telpon: <span class="font-semibold text-slate-900">{{ $item->telpon_kurir ?? '-' }}</span></div>
            <div>Tgl kirim: <span class="font-semibold text-slate-900">{{ $item->tgl_kirim?->format('d M Y H:i') ?? '-' }}</span></div>
            <div>Tgl tiba: <span class="font-semibold text-slate-900">{{ $item->tgl_tiba?->format('d M Y H:i') ?? '-' }}</span></div>
        </div>
    </div>
@endsection

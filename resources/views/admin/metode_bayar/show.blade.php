@extends('layouts.panel', ['panel' => 'admin'])
@section('page-title', 'Detail Metode Bayar')
@section('content')
    <div class="shell-card p-8 text-sm text-slate-600">
        <x-uploaded-image
            :src="$item->logoUrl()"
            :alt="$item->nama_bank"
            :label="str($item->nama_bank)->substr(0, 2)->upper()"
            class="mb-6 h-28 w-44 rounded-[24px] object-contain p-4"
        />
        <p>Bank: <span class="font-semibold text-slate-900">{{ $item->nama_bank }}</span></p>
        <p class="mt-3">Nomor Rekening: <span class="font-semibold text-slate-900">{{ $item->nomor_rekening }}</span></p>
        <p class="mt-3">Atas Nama: <span class="font-semibold text-slate-900">{{ $item->atas_nama }}</span></p>
        <p class="mt-3">Status: <x-status-badge :status="$item->status" bank /></p>
    </div>
@endsection

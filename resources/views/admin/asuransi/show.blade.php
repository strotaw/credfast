@extends('layouts.panel', ['panel' => 'admin'])
@section('page-title', 'Detail Asuransi')
@section('content')
    <div class="shell-card p-8 text-sm text-slate-600">
        <x-uploaded-image
            :src="$item->logoUrl()"
            :alt="$item->nama_asuransi"
            :label="str($item->nama_asuransi)->substr(0, 2)->upper()"
            class="mb-6 h-28 w-44 rounded-[24px] object-contain p-4"
        />
        <p>Perusahaan: <span class="font-semibold text-slate-900">{{ $item->nama_perusahaan_asuransi }}</span></p>
        <p class="mt-3">Produk: <span class="font-semibold text-slate-900">{{ $item->nama_asuransi }}</span></p>
        <p class="mt-3">Margin: <span class="font-semibold text-slate-900">{{ $item->margin_asuransi }}%</span></p>
        <p class="mt-3">No Rekening: <span class="font-semibold text-slate-900">{{ $item->no_rekening ?? '-' }}</span></p>
    </div>
@endsection

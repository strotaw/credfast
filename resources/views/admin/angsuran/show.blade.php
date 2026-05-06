@extends('layouts.panel', ['panel' => 'admin'])
@section('page-title', 'Review Angsuran')
@section('content')
    <div class="grid gap-6 xl:grid-cols-[1fr_1fr]">
        <section class="shell-card p-8 text-sm text-slate-600">
            <div class="flex items-center justify-between gap-3">
                <div><p class="text-sm uppercase tracking-[0.28em] text-slate-400">Angsuran</p><h2 class="mt-2 text-3xl font-semibold">#{{ $item->angsuran_ke }}</h2></div>
                <x-status-badge :status="$item->status" />
            </div>
            <div class="mt-6 space-y-3">
                <div>Pelanggan: <span class="font-semibold text-slate-900">{{ $item->kredit->pengajuanKredit->user->name }}</span></div>
                <div>Motor: <span class="font-semibold text-slate-900">{{ $item->kredit->pengajuanKredit->motor->nama_motor }}</span></div>
                <div>Total bayar: <span class="font-semibold text-slate-900">Rp {{ number_format($item->total_bayar, 0, ',', '.') }}</span></div>
                <div>Keterangan: <span class="font-semibold text-slate-900">{{ $item->keterangan ?? '-' }}</span></div>
            </div>
        </section>
        <div class="space-y-6">
            <form method="POST" action="{{ route('admin.angsuran.validasi', $item) }}" class="shell-card p-8">
                @csrf @method('PUT')
                <h3 class="section-title">Validasi pembayaran</h3>
                <textarea name="keterangan" class="shell-textarea mt-4" placeholder="Catatan">{{ $item->keterangan }}</textarea>
                <button class="btn-success mt-4">Validasi</button>
            </form>
            <form method="POST" action="{{ route('admin.angsuran.tolak', $item) }}" class="shell-card p-8">
                @csrf @method('PUT')
                <h3 class="section-title">Tolak pembayaran</h3>
                <textarea name="keterangan" class="shell-textarea mt-4" placeholder="Keterangan"></textarea>
                <button class="btn-danger mt-4">Tolak</button>
            </form>
        </div>
    </div>
@endsection

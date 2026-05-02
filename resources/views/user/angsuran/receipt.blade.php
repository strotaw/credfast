@extends('layouts.panel', ['panel' => 'user'])

@section('page-title', 'Bukti Pembayaran')

@section('content')
    <section class="mx-auto max-w-3xl shell-card p-8">
        <p class="text-sm uppercase tracking-[0.28em] text-slate-400">Receipt</p>
        <h2 class="mt-2 text-3xl font-semibold">Bukti pembayaran angsuran tervalidasi</h2>
        <div class="mt-6 grid gap-4 sm:grid-cols-2 text-sm text-slate-600">
            <div>Pelanggan: <span class="font-semibold text-slate-900">{{ $angsuran->kredit->pengajuanKredit->user->name }}</span></div>
            <div>Motor: <span class="font-semibold text-slate-900">{{ $angsuran->kredit->pengajuanKredit->motor->nama_motor }}</span></div>
            <div>No. kontrak: <span class="font-semibold text-slate-900">{{ $angsuran->kredit->no_kontrak }}</span></div>
            <div>Angsuran ke: <span class="font-semibold text-slate-900">{{ $angsuran->angsuran_ke }}</span></div>
            <div>Total bayar: <span class="font-semibold text-slate-900">Rp {{ number_format($angsuran->total_bayar, 0, ',', '.') }}</span></div>
            <div>Diverifikasi: <span class="font-semibold text-slate-900">{{ $angsuran->verified_at?->format('d M Y H:i') }}</span></div>
        </div>
        <div class="mt-8 rounded-3xl bg-slate-950 p-6 text-white">
            <p class="text-sm text-slate-300">Verified by</p>
            <p class="mt-2 text-2xl font-semibold">{{ $angsuran->verifiedBy?->name ?? 'Admin CredFast' }}</p>
        </div>
    </section>
@endsection

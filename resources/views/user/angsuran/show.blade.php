@extends('layouts.panel', ['panel' => 'user'])

@section('page-title', 'Detail Angsuran')

@section('content')
    <div class="grid gap-6 lg:grid-cols-[1fr_1fr]">
        <section class="shell-card p-8">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="text-sm uppercase tracking-[0.28em] text-slate-400">Angsuran #{{ $angsuran->angsuran_ke }}</p>
                    <h2 class="mt-2 text-3xl font-semibold">{{ $angsuran->kredit->pengajuanKredit->motor->nama_motor }}</h2>
                </div>
                <x-status-badge :status="$angsuran->status" />
            </div>
            <div class="mt-6 space-y-3 text-sm text-slate-600">
                <div>Jatuh tempo: <span class="font-semibold text-slate-900">{{ $angsuran->tanggal_jatuh_tempo->format('d M Y') }}</span></div>
                <div>Nominal: <span class="font-semibold text-slate-900">Rp {{ number_format($angsuran->nominal, 0, ',', '.') }}</span></div>
                <div>Denda: <span class="font-semibold text-slate-900">Rp {{ number_format($angsuran->denda, 0, ',', '.') }}</span></div>
                <div>Total bayar: <span class="font-semibold text-slate-900">Rp {{ number_format($angsuran->total_bayar, 0, ',', '.') }}</span></div>
                <div>Bank tujuan: <span class="font-semibold text-slate-900">{{ $angsuran->kredit->metodeBayar?->nama_bank ?? 'Belum ditentukan admin' }}</span></div>
                <div>Verifikator: <span class="font-semibold text-slate-900">{{ $angsuran->verifiedBy?->name ?? '-' }}</span></div>
            </div>

            @if ($angsuran->status === 'valid')
                <a href="{{ route('user.angsuran.receipt', $angsuran) }}" class="btn-success mt-6">Lihat Bukti Pembayaran</a>
            @endif
        </section>

        <section class="shell-card p-8">
            <h3 class="section-title">Upload bukti bayar</h3>
            <p class="mt-2 text-sm text-slate-500">Maksimal 2MB. Format `jpg`, `jpeg`, `png`, atau `pdf`.</p>
            <form method="POST" action="{{ route('user.angsuran.upload-bukti', $angsuran) }}" enctype="multipart/form-data" class="mt-6 space-y-4">
                @csrf
                <input type="file" name="bukti_bayar" class="shell-input" @if ($angsuran->status === 'valid') disabled @endif>
                <button class="btn-primary w-full" @if ($angsuran->status === 'valid') disabled @endif>Upload Bukti</button>
            </form>
            @if ($angsuran->keterangan)
                <div class="mt-6 rounded-2xl bg-slate-50 p-4 text-sm text-slate-600">
                    <p class="font-semibold text-slate-900">Keterangan</p>
                    <p class="mt-2">{{ $angsuran->keterangan }}</p>
                </div>
            @endif
        </section>
    </div>
@endsection

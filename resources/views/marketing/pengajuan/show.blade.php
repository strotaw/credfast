@extends('layouts.panel', ['panel' => 'marketing'])

@section('page-title', 'Review Pengajuan')

@section('content')
    <div class="grid gap-6 xl:grid-cols-[1.05fr_0.95fr]">
        <section class="shell-card p-8">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="text-sm uppercase tracking-[0.28em] text-slate-400">Pengajuan</p>
                    <h2 class="mt-2 text-3xl font-semibold">{{ $pengajuan->user->name }}</h2>
                </div>
                <x-status-badge :status="$pengajuan->status_pengajuan" />
            </div>
            <div class="mt-6 grid gap-4 sm:grid-cols-2 text-sm text-slate-600">
                <div>Motor: <span class="font-semibold text-slate-900">{{ $pengajuan->motor->nama_motor }}</span></div>
                <div>Tenor: <span class="font-semibold text-slate-900">{{ $pengajuan->jenisCicilan->lama_cicilan }} bulan</span></div>
                <div>DP: <span class="font-semibold text-slate-900">Rp {{ number_format($pengajuan->dp, 0, ',', '.') }}</span></div>
                <div>Harga kredit: <span class="font-semibold text-slate-900">Rp {{ number_format($pengajuan->harga_kredit, 0, ',', '.') }}</span></div>
                <div>Email: <span class="font-semibold text-slate-900">{{ $pengajuan->user->email }}</span></div>
                <div>Nomor HP: <span class="font-semibold text-slate-900">{{ $pengajuan->user->no_hp ?? '-' }}</span></div>
            </div>
            <div class="mt-6 rounded-3xl bg-slate-50 p-5 text-sm text-slate-600">
                <p class="font-semibold text-slate-900">Dokumen</p>
                <div class="mt-3 grid gap-3 sm:grid-cols-2">
                    <div>KK: {{ $pengajuan->url_kk ? 'Tersedia' : 'Belum ada' }}</div>
                    <div>KTP: {{ $pengajuan->url_ktp ? 'Tersedia' : 'Belum ada' }}</div>
                    <div>NPWP: {{ $pengajuan->url_npwp ? 'Tersedia' : 'Belum ada' }}</div>
                    <div>Slip Gaji: {{ $pengajuan->url_slip_gaji ? 'Tersedia' : 'Belum ada' }}</div>
                </div>
            </div>
        </section>

        <div class="space-y-6">
            <form method="POST" action="{{ route('marketing.pengajuan.status', $pengajuan) }}" class="shell-card p-8">
                @csrf
                @method('PUT')
                <h3 class="section-title">Update status pengajuan</h3>
                <div class="mt-5 grid gap-4">
                    <select name="status_pengajuan" class="shell-select">
                        @foreach ($statusOptions as $status)
                            <option value="{{ $status }}" @selected($pengajuan->status_pengajuan === $status)>{{ str($status)->replace('_', ' ')->title() }}</option>
                        @endforeach
                    </select>
                    <textarea name="keterangan_status_pengajuan" class="shell-textarea" placeholder="Tambahkan alasan perubahan status">{{ old('keterangan_status_pengajuan', $pengajuan->keterangan_status_pengajuan) }}</textarea>
                    <button class="btn-primary">Simpan Status</button>
                </div>
            </form>

            <form method="POST" action="{{ route('marketing.pengajuan.catatan', $pengajuan) }}" class="shell-card p-8">
                @csrf
                @method('PUT')
                <h3 class="section-title">Catatan marketing</h3>
                <div class="mt-5 grid gap-4">
                    <textarea name="catatan_marketing" class="shell-textarea" placeholder="Tulis hasil follow-up, observasi, dan rekomendasi">{{ old('catatan_marketing', $pengajuan->catatan_marketing) }}</textarea>
                    <textarea name="keterangan_status_pengajuan" class="shell-textarea" placeholder="Ringkasan tambahan untuk status">{{ old('keterangan_status_pengajuan', $pengajuan->keterangan_status_pengajuan) }}</textarea>
                    <button class="btn-success">Simpan Catatan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

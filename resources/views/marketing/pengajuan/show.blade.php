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
                <div>Asuransi: <span class="font-semibold text-slate-900">{{ $pengajuan->asuransi?->nama_asuransi ?? 'Tanpa asuransi' }}</span></div>
                <div>Metode bayar: <span class="font-semibold text-slate-900">{{ $pengajuan->metodeBayar?->nama_bank ?? '-' }}</span></div>
            </div>
            <div class="mt-6 grid gap-4 sm:grid-cols-2">
                <div class="flex items-center gap-3 rounded-3xl bg-slate-50 p-4 text-sm">
                    <x-uploaded-image
                        :src="$pengajuan->asuransi?->logoUrl()"
                        :alt="$pengajuan->asuransi?->nama_asuransi ?? 'Tanpa asuransi'"
                        label="AS"
                        class="h-14 w-16 shrink-0 rounded-2xl object-contain p-2"
                    />
                    <div>
                        <p class="font-semibold text-slate-900">{{ $pengajuan->asuransi?->nama_asuransi ?? 'Tanpa asuransi' }}</p>
                        <p class="mt-1 text-slate-500">Pilihan asuransi</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 rounded-3xl bg-slate-50 p-4 text-sm">
                    <x-uploaded-image
                        :src="$pengajuan->metodeBayar?->logoUrl()"
                        :alt="$pengajuan->metodeBayar?->nama_bank ?? 'Metode bayar'"
                        label="MB"
                        class="h-14 w-16 shrink-0 rounded-2xl object-contain p-2"
                    />
                    <div>
                        <p class="font-semibold text-slate-900">{{ $pengajuan->metodeBayar?->nama_bank ?? '-' }}</p>
                        <p class="mt-1 text-slate-500">{{ $pengajuan->metodeBayar?->nomor_rekening ?? '-' }}</p>
                    </div>
                </div>
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

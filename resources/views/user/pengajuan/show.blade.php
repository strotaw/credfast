@extends('layouts.panel', ['panel' => 'user'])

@section('page-title', 'Detail Pengajuan')

@section('content')
    <div class="grid gap-6 lg:grid-cols-[1.02fr_0.98fr]">
        <section class="shell-card p-8">
            <x-uploaded-image
                :src="$pengajuan->motor->primaryFotoUrl()"
                :alt="$pengajuan->motor->nama_motor"
                label="Motor"
                class="mb-6 h-56 w-full rounded-[24px] object-cover"
            />
            <div class="flex flex-wrap items-center justify-between gap-3">
                <div>
                    <p class="text-sm uppercase tracking-[0.28em] text-slate-400">Pengajuan Kredit</p>
                    <h2 class="mt-2 text-3xl font-semibold">{{ $pengajuan->motor->nama_motor }}</h2>
                </div>
                <x-status-badge :status="$pengajuan->status_pengajuan" />
            </div>
            <div class="mt-6 grid gap-4 sm:grid-cols-2 text-sm text-slate-600">
                <div>Harga cash: <span class="font-semibold text-slate-900">Rp {{ number_format($pengajuan->harga_cash, 0, ',', '.') }}</span></div>
                <div>DP: <span class="font-semibold text-slate-900">Rp {{ number_format($pengajuan->dp, 0, ',', '.') }}</span></div>
                <div>Harga kredit: <span class="font-semibold text-slate-900">Rp {{ number_format($pengajuan->harga_kredit, 0, ',', '.') }}</span></div>
                <div>Cicilan / bulan: <span class="font-semibold text-slate-900">Rp {{ number_format($pengajuan->cicilan_perbulan, 0, ',', '.') }}</span></div>
                <div>Tenor: <span class="font-semibold text-slate-900">{{ $pengajuan->jenisCicilan->lama_cicilan }} bulan</span></div>
                <div>Asuransi: <span class="font-semibold text-slate-900">{{ $pengajuan->asuransi?->nama_asuransi ?? 'Tanpa asuransi' }}</span></div>
                <div>Metode bayar: <span class="font-semibold text-slate-900">{{ $pengajuan->metodeBayar?->nama_bank ?? 'Belum dipilih' }}</span></div>
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
                        <p class="font-semibold text-slate-900">{{ $pengajuan->metodeBayar?->nama_bank ?? 'Belum dipilih' }}</p>
                        <p class="mt-1 text-slate-500">{{ $pengajuan->metodeBayar?->nomor_rekening ?? 'Metode bayar' }}</p>
                    </div>
                </div>
            </div>

            <div class="mt-6 rounded-3xl bg-slate-50 p-5 text-sm text-slate-600">
                <p class="font-semibold text-slate-900">Catatan marketing</p>
                <p class="mt-2">{{ $pengajuan->catatan_marketing ?: 'Belum ada catatan dari marketing.' }}</p>
                <p class="mt-4 font-semibold text-slate-900">Keterangan status</p>
                <p class="mt-2">{{ $pengajuan->keterangan_status_pengajuan ?: 'Belum ada keterangan tambahan.' }}</p>
            </div>
        </section>

        <section class="grid gap-6">
            <div class="shell-card p-8">
                <h3 class="section-title">Penanggung jawab</h3>
                <div class="mt-4 space-y-4 text-sm text-slate-600">
                    <div class="rounded-2xl border border-slate-200 p-4">
                        <p class="font-semibold text-slate-900">Marketing</p>
                        <p class="mt-1">{{ $pengajuan->marketing?->name ?? 'Belum ditentukan' }}</p>
                    </div>
                    <div class="rounded-2xl border border-slate-200 p-4">
                        <p class="font-semibold text-slate-900">Admin</p>
                        <p class="mt-1">{{ $pengajuan->admin?->name ?? 'Belum ditentukan' }}</p>
                    </div>
                </div>
            </div>

            <div class="shell-card p-8">
                <h3 class="section-title">Status kredit setelah disetujui</h3>
                @if ($pengajuan->kredit)
                    <p class="mt-3 text-sm text-slate-600">No. kontrak: <span class="font-semibold text-slate-900">{{ $pengajuan->kredit->no_kontrak }}</span></p>
                    <p class="mt-2 text-sm text-slate-600">Status kredit: <x-status-badge :status="$pengajuan->kredit->status_kredit" /></p>
                    <a href="{{ route('user.kredit.show', $pengajuan->kredit) }}" class="btn-secondary mt-5">Lihat Detail Kredit</a>
                @else
                    <p class="mt-3 text-sm text-slate-500">Data kredit akan dibuat admin setelah pengajuan disetujui.</p>
                @endif
            </div>

            <div class="shell-card p-8">
                <h3 class="section-title">Status pengiriman motor</h3>
                @if ($pengajuan->kredit?->pengiriman)
                    <div class="mt-4 space-y-3 text-sm text-slate-600">
                        <div>No. invoice: <span class="font-semibold text-slate-900">{{ $pengajuan->kredit->pengiriman->no_invoice }}</span></div>
                        <div>Status: <x-status-badge :status="$pengajuan->kredit->pengiriman->status_kirim" kirim /></div>
                        <div>Kurir: <span class="font-semibold text-slate-900">{{ $pengajuan->kredit->pengiriman->nama_kurir ?? 'Belum ditentukan' }}</span></div>
                        <div>Tanggal kirim: <span class="font-semibold text-slate-900">{{ $pengajuan->kredit->pengiriman->tgl_kirim?->format('d M Y H:i') ?? '-' }}</span></div>
                        <div>Tanggal tiba: <span class="font-semibold text-slate-900">{{ $pengajuan->kredit->pengiriman->tgl_tiba?->format('d M Y H:i') ?? '-' }}</span></div>
                    </div>
                @else
                    <p class="mt-3 text-sm text-slate-500">Status pengiriman muncul setelah pengajuan disetujui admin.</p>
                @endif
            </div>
        </section>
    </div>
@endsection

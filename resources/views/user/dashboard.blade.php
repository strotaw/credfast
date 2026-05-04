@extends('layouts.panel', ['panel' => 'user'])

@section('page-title', 'User Dashboard')

@section('content')
    <x-motor-carousel :motors="$carouselMotors" eyebrow="Rekomendasi katalog" subtitle="Pilih motor, simulasi, lalu ajukan dari portal user" />

    <div class="mt-8 grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        <x-stat-card title="Total Pengajuan" :value="$totalPengajuan" />
        <x-stat-card title="Pengajuan Aktif" :value="$pengajuanAktif" />
        <x-stat-card title="Kredit Aktif" :value="$kreditAktif" />
        <x-stat-card title="Angsuran Belum Bayar" :value="$angsuranBelumDibayar" />
    </div>

    <div class="mt-8 grid gap-6 xl:grid-cols-[1.1fr_0.9fr]">
        <section class="shell-card overflow-hidden">
            <div class="flex items-center justify-between border-b border-slate-200 px-6 py-5">
                <div>
                    <h2 class="section-title">Status pengajuan terbaru</h2>
                </div>
                <a href="{{ route('user.pengajuan.index') }}" class="btn-secondary">Semua Pengajuan</a>
            </div>

            @if ($pengajuanTerbaru->isEmpty())
                <div class="p-6">
                    <x-empty-state title="Belum ada pengajuan" />
                </div>
            @else
                <div class="divide-y divide-slate-200">
                    @foreach ($pengajuanTerbaru as $item)
                        <div class="flex flex-col gap-3 px-6 py-5 md:flex-row md:items-center md:justify-between">
                            <div class="flex items-center gap-4">
                                <x-uploaded-image
                                    :src="$item->motor->primaryFotoUrl()"
                                    :alt="$item->motor->nama_motor"
                                    label="Motor"
                                    class="h-16 w-20 shrink-0 rounded-2xl object-cover"
                                />
                                <div>
                                    <p class="font-semibold">{{ $item->motor->nama_motor }}</p>
                                    <p class="mt-1 text-sm text-slate-500">Tenor {{ $item->jenisCicilan->lama_cicilan }} bulan &middot; DP Rp {{ number_format($item->dp, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <x-status-badge :status="$item->status_pengajuan" />
                                <a href="{{ route('user.pengajuan.show', $item) }}" class="btn-secondary">Detail</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>

        <section class="shell-card overflow-hidden">
            <div class="border-b border-slate-200 px-6 py-5">
                <h2 class="section-title">Kredit aktif</h2>
            </div>
            <div class="space-y-4 p-6">
                @forelse ($kreditTerbaru as $item)
                    <div class="rounded-3xl border border-slate-200 p-5">
                        <div class="flex items-center justify-between gap-3">
                            <div class="flex items-center gap-4">
                                <x-uploaded-image
                                    :src="$item->pengajuanKredit->motor->primaryFotoUrl()"
                                    :alt="$item->pengajuanKredit->motor->nama_motor"
                                    label="Motor"
                                    class="h-16 w-20 shrink-0 rounded-2xl object-cover"
                                />
                                <div>
                                    <p class="font-semibold">{{ $item->pengajuanKredit->motor->nama_motor }}</p>
                                    <p class="text-sm text-slate-500">No. kontrak {{ $item->no_kontrak }}</p>
                                </div>
                            </div>
                            <x-status-badge :status="$item->status_kredit" />
                        </div>
                        <div class="mt-4 grid grid-cols-2 gap-3 text-sm text-slate-600">
                            <div>Sisa kredit: <span class="font-semibold text-slate-900">Rp {{ number_format($item->sisa_kredit, 0, ',', '.') }}</span></div>
                            <div>Pengiriman: <span class="font-semibold text-slate-900">{{ optional($item->pengiriman)->status_kirim ? str(optional($item->pengiriman)->status_kirim)->title() : '-' }}</span></div>
                        </div>
                        <a href="{{ route('user.kredit.show', $item) }}" class="btn-secondary mt-4">Lihat Kredit</a>
                    </div>
                @empty
                    <x-empty-state title="Belum ada kredit aktif" />
                @endforelse
            </div>
        </section>
    </div>

    <div class="mt-8 grid gap-6 lg:grid-cols-2">
        <section class="shell-card p-6">
            <p class="text-sm uppercase tracking-[0.28em] text-slate-400">Metode bayar</p>
            <h2 class="section-title mt-2">Tersedia dari admin</h2>
            <div class="mt-5 grid gap-4">
                @foreach ($metodeBayarList as $item)
                    <div class="flex items-center gap-4 rounded-3xl border border-slate-200 p-4">
                        <x-uploaded-image
                            :src="$item->logoUrl()"
                            :alt="$item->nama_bank"
                            :label="str($item->nama_bank)->substr(0, 2)->upper()"
                            class="h-14 w-16 shrink-0 rounded-2xl object-contain p-2"
                        />
                        <div>
                            <p class="font-semibold">{{ $item->nama_bank }}</p>
                            <p class="mt-1 text-sm text-slate-500">{{ $item->nomor_rekening }} &middot; {{ $item->atas_nama }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="shell-card p-6">
            <p class="text-sm uppercase tracking-[0.28em] text-slate-400">Asuransi</p>
            <h2 class="section-title mt-2">Proteksi kredit</h2>
            <div class="mt-5 grid gap-4">
                @foreach ($asuransiList as $item)
                    <div class="flex items-center gap-4 rounded-3xl border border-slate-200 p-4">
                        <x-uploaded-image
                            :src="$item->logoUrl()"
                            :alt="$item->nama_asuransi"
                            :label="str($item->nama_asuransi)->substr(0, 2)->upper()"
                            class="h-14 w-16 shrink-0 rounded-2xl object-contain p-2"
                        />
                        <div>
                            <p class="font-semibold">{{ $item->nama_asuransi }}</p>
                            <p class="mt-1 text-sm text-slate-500">{{ $item->nama_perusahaan_asuransi }} &middot; {{ $item->margin_asuransi }}%</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection

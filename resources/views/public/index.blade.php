@extends('layouts.public')

@section('title', 'CredFast - Kredit Motor')

@section('content')
    <x-motor-carousel :motors="$featuredMotors" eyebrow="CredFast showroom" subtitle="Motor unggulan dari katalog aktif" />

    <section class="mt-8 grid gap-8 lg:grid-cols-[1.15fr_0.85fr] lg:items-center">
        <div class="shell-card overflow-hidden p-8 sm:p-10">
            <p class="text-sm uppercase tracking-[0.35em] text-sky-600">CredFast showroom</p>
            <h1 class="mt-5 max-w-3xl text-4xl font-semibold leading-tight sm:text-6xl">Kredit motor dengan katalog rapi, simulasi akurat, dan approval berlapis.</h1>
            <div class="mt-8 flex flex-wrap gap-3">
                <a href="{{ route('public.motor') }}" class="btn-primary">Lihat Katalog Motor</a>
                <a href="{{ route('public.simulasi') }}" class="btn-secondary">Coba Simulasi Kredit</a>
            </div>
            <div class="mt-10 grid gap-4 sm:grid-cols-3">
                <x-stat-card title="Motor Tersedia" :value="$motorCount" />
                <x-stat-card title="Jenis Cicilan" :value="$tenorCount" />
                <x-stat-card title="Brand Aktif" :value="$brandCount" />
            </div>
        </div>

        <div class="grid gap-4">
            @foreach ($featuredMotors->take(3) as $motor)
                <div class="shell-card p-6">
                    <div class="flex items-start gap-4">
                        <x-uploaded-image
                            :src="$motor->primaryFotoUrl()"
                            :alt="$motor->nama_motor"
                            label="Motor"
                            class="h-24 w-28 shrink-0 rounded-[22px] object-cover"
                        />
                        <div>
                            <p class="text-sm uppercase tracking-[0.25em] text-slate-400">{{ $motor->jenisMotor->merk }}</p>
                            <h2 class="mt-2 text-2xl font-semibold">{{ $motor->nama_motor }}</h2>
                            <p class="mt-2 text-sm text-slate-600">{{ \Illuminate\Support\Str::limit($motor->deskripsi_motor, 95) }}</p>
                        </div>
                    </div>
                    <div class="mt-4"><x-status-badge :status="$motor->status" /></div>
                    <div class="mt-5 flex items-center justify-between">
                        <p class="text-xl font-semibold text-slate-950">Rp {{ number_format($motor->harga_jual, 0, ',', '.') }}</p>
                        <a href="{{ route('public.motor.show', $motor) }}" class="btn-secondary">Detail</a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="mt-10">
        <div class="mb-5 flex items-center justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.28em] text-slate-400">Jenis motor</p>
                <h2 class="section-title mt-2">Brand dan tipe yang tersedia</h2>
            </div>
            <a href="{{ route('public.motor') }}" class="btn-secondary">Lihat Katalog</a>
        </div>

        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($jenisMotors as $jenis)
                <article class="shell-card overflow-hidden">
                    <x-uploaded-image
                        :src="$jenis->imageUrl()"
                        :alt="$jenis->merk"
                        :label="str($jenis->merk)->substr(0, 2)->upper()"
                        class="h-40 w-full object-cover"
                    />
                    <div class="p-5">
                        <p class="text-sm uppercase tracking-[0.25em] text-slate-400">{{ str($jenis->tipe)->replace('_', ' ')->title() }}</p>
                        <h3 class="mt-2 text-xl font-semibold">{{ $jenis->merk }}</h3>
                        <p class="mt-2 text-sm text-slate-500">{{ $jenis->motor_count }} motor di katalog</p>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <section class="mt-10">
        <div class="mb-5 flex items-center justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.28em] text-slate-400">Highlighted catalog</p>
                <h2 class="section-title mt-2">Motor populer untuk pembiayaan cepat</h2>
            </div>
            <a href="{{ route('public.motor') }}" class="btn-secondary">Lihat Semua</a>
        </div>

        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($featuredMotors as $motor)
                <article class="shell-card p-6">
                    <x-uploaded-image
                        :src="$motor->primaryFotoUrl()"
                        :alt="$motor->nama_motor"
                        label="Motor"
                        class="h-52 w-full rounded-[24px] object-cover"
                    />
                    <div class="mt-5">
                        <p class="text-sm uppercase tracking-[0.25em] text-sky-700">{{ $motor->jenisMotor->tipe }}</p>
                        <h3 class="mt-2 text-2xl font-semibold">{{ $motor->nama_motor }}</h3>
                        <p class="mt-2 text-sm text-slate-600">{{ \Illuminate\Support\Str::limit($motor->deskripsi_motor, 110) }}</p>
                    </div>
                    <div class="mt-5 flex items-center justify-between gap-4">
                        <div>
                            <p class="text-sm text-slate-500">Harga mulai</p>
                            <p class="text-xl font-semibold">Rp {{ number_format($motor->harga_jual, 0, ',', '.') }}</p>
                        </div>
                        <a href="{{ route('public.motor.show', $motor) }}" class="btn-primary">Ajukan Kredit</a>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <section class="mt-10 grid gap-6 lg:grid-cols-2">
        <div>
            <div class="mb-5">
                <p class="text-sm uppercase tracking-[0.28em] text-slate-400">Asuransi</p>
                <h2 class="section-title mt-2">Pilihan proteksi</h2>
            </div>
            <div class="grid gap-4">
                @foreach ($asuransiList as $item)
                    <article class="shell-card flex items-center gap-4 p-5">
                        <x-uploaded-image
                            :src="$item->logoUrl()"
                            :alt="$item->nama_asuransi"
                            :label="str($item->nama_asuransi)->substr(0, 2)->upper()"
                            class="h-16 w-20 shrink-0 rounded-2xl object-contain p-2"
                        />
                        <div>
                            <h3 class="font-semibold">{{ $item->nama_asuransi }}</h3>
                            <p class="mt-1 text-sm text-slate-500">{{ $item->nama_perusahaan_asuransi }} &middot; margin {{ $item->margin_asuransi }}%</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>

        <div>
            <div class="mb-5">
                <p class="text-sm uppercase tracking-[0.28em] text-slate-400">Metode bayar</p>
                <h2 class="section-title mt-2">Rekening pembayaran aktif</h2>
            </div>
            <div class="grid gap-4">
                @foreach ($metodeBayarList as $item)
                    <article class="shell-card flex items-center gap-4 p-5">
                        <x-uploaded-image
                            :src="$item->logoUrl()"
                            :alt="$item->nama_bank"
                            :label="str($item->nama_bank)->substr(0, 2)->upper()"
                            class="h-16 w-20 shrink-0 rounded-2xl object-contain p-2"
                        />
                        <div>
                            <h3 class="font-semibold">{{ $item->nama_bank }}</h3>
                            <p class="mt-1 text-sm text-slate-500">{{ $item->nomor_rekening }} &middot; {{ $item->atas_nama }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection

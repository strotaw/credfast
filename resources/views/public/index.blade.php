@extends('layouts.public')

@section('title', 'CredFast - Kredit Motor')

@section('content')
    <section class="grid gap-8 lg:grid-cols-[1.15fr_0.85fr] lg:items-center">
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
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-sm uppercase tracking-[0.25em] text-slate-400">{{ $motor->jenisMotor->merk }}</p>
                            <h2 class="mt-2 text-2xl font-semibold">{{ $motor->nama_motor }}</h2>
                            <p class="mt-2 text-sm text-slate-600">{{ \Illuminate\Support\Str::limit($motor->deskripsi_motor, 95) }}</p>
                        </div>
                        <x-status-badge :status="$motor->status" />
                    </div>
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
                <p class="text-sm uppercase tracking-[0.28em] text-slate-400">Highlighted catalog</p>
                <h2 class="section-title mt-2">Motor populer untuk pembiayaan cepat</h2>
            </div>
            <a href="{{ route('public.motor') }}" class="btn-secondary">Lihat Semua</a>
        </div>

        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($featuredMotors as $motor)
                <article class="shell-card p-6">
                    <div class="rounded-3xl bg-[linear-gradient(135deg,_#dbeafe,_#f8fafc)] p-6">
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
@endsection

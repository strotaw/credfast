@extends('layouts.public')

@section('title', $motor->nama_motor)

@section('content')
    <section class="grid gap-8 lg:grid-cols-[1.05fr_0.95fr]">
        <div class="shell-card p-8">
            <p class="text-sm uppercase tracking-[0.28em] text-slate-400">{{ $motor->jenisMotor->merk }} &middot; {{ str($motor->jenisMotor->tipe)->replace('_', ' ')->title() }}</p>
            <h1 class="mt-3 text-4xl font-semibold">{{ $motor->nama_motor }}</h1>
            <div class="mt-4 flex flex-wrap gap-3">
                <x-status-badge :status="$motor->status" />
                <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">Stok {{ $motor->stok }}</span>
            </div>
            <p class="mt-6 leading-7 text-slate-600">{{ $motor->deskripsi_motor }}</p>

            <div class="mt-8 grid gap-4 sm:grid-cols-2">
                <div class="shell-card bg-slate-50 p-5">
                    <p class="text-sm text-slate-500">Harga jual</p>
                    <p class="mt-2 text-2xl font-semibold">Rp {{ number_format($motor->harga_jual, 0, ',', '.') }}</p>
                </div>
                <div class="shell-card bg-slate-50 p-5">
                    <p class="text-sm text-slate-500">Kapasitas mesin</p>
                    <p class="mt-2 text-2xl font-semibold">{{ $motor->kapasitas_mesin ?? '-' }}</p>
                </div>
                <div class="shell-card bg-slate-50 p-5">
                    <p class="text-sm text-slate-500">Tahun</p>
                    <p class="mt-2 text-2xl font-semibold">{{ $motor->tahun ?? '-' }}</p>
                </div>
                <div class="shell-card bg-slate-50 p-5">
                    <p class="text-sm text-slate-500">Warna</p>
                    <p class="mt-2 text-2xl font-semibold">{{ $motor->warna ?? '-' }}</p>
                </div>
            </div>
        </div>

        <div class="grid gap-6">
            <div class="shell-card p-7">
                <p class="text-sm uppercase tracking-[0.28em] text-slate-400">Pengajuan</p>
                <h2 class="mt-2 text-2xl font-semibold">Simulasi dan pengajuan</h2>
                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="{{ route('public.simulasi', ['motor_id' => $motor->id]) }}" class="btn-secondary">Simulasi Kredit</a>
                    @auth
                        <a href="{{ route('user.pengajuan.create', $motor) }}" class="btn-primary">Ajukan Kredit</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-primary">Login untuk Ajukan</a>
                    @endauth
                </div>
            </div>

            <div class="shell-card p-7">
                <p class="text-sm uppercase tracking-[0.28em] text-slate-400">Motor sejenis</p>
                <div class="mt-4 space-y-4">
                    @forelse ($relatedMotors as $item)
                        <a href="{{ route('public.motor.show', $item) }}" class="block rounded-2xl border border-slate-200 px-4 py-4 hover:bg-slate-50">
                            <p class="font-semibold">{{ $item->nama_motor }}</p>
                            <p class="mt-1 text-sm text-slate-500">Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</p>
                        </a>
                    @empty
                        <p class="text-sm text-slate-500">Belum ada motor serupa lain di katalog.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
@endsection

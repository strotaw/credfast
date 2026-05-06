@extends('layouts.public')

@section('title', 'Simulasi Kredit')

@section('content')
    <section class="grid gap-8 lg:grid-cols-[0.95fr_1.05fr]">
        <form method="GET" class="shell-card p-8">
            <p class="text-sm uppercase tracking-[0.28em] text-slate-400">Simulasi</p>
            <h1 class="mt-2 text-3xl font-semibold">Hitung cicilan sebelum mengajukan.</h1>
            <div class="mt-6 grid gap-4">
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Motor</label>
                    <select name="motor_id" class="shell-select">
                        <option value="">Pilih motor</option>
                        @foreach ($motors as $motor)
                            <option value="{{ $motor->id }}" @selected((string) request('motor_id') === (string) $motor->id)>{{ $motor->nama_motor }} - Rp {{ number_format($motor->harga_jual, 0, ',', '.') }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Tenor</label>
                    <select name="jenis_cicilan_id" class="shell-select">
                        <option value="">Pilih tenor</option>
                        @foreach ($jenisCicilan as $item)
                            <option value="{{ $item->id }}" @selected((string) request('jenis_cicilan_id') === (string) $item->id)>{{ $item->lama_cicilan }} bulan (margin {{ $item->margin_kredit }}%)</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Asuransi</label>
                    <select name="asuransi_id" class="shell-select">
                        <option value="">Tanpa asuransi</option>
                        @foreach ($asuransi as $item)
                            <option value="{{ $item->id }}" @selected((string) request('asuransi_id') === (string) $item->id)>{{ $item->nama_asuransi }} ({{ $item->margin_asuransi }}%)</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Down Payment</label>
                    <input type="number" name="dp" value="{{ request('dp') }}" class="shell-input" placeholder="Masukkan nominal down payment">
                </div>
                <button class="btn-primary w-full">Hitung Simulasi</button>
            </div>
        </form>

        <section class="shell-card p-8">
            <p class="text-sm uppercase tracking-[0.28em] text-slate-400">Hasil</p>
            @if ($simulation)
                <x-uploaded-image
                    :src="$simulation['motor']->primaryFotoUrl()"
                    :alt="$simulation['motor']->nama_motor"
                    label="Motor"
                    class="mt-5 h-56 w-full rounded-[24px] object-cover"
                />
                <h2 class="mt-2 text-3xl font-semibold">{{ $simulation['motor']->nama_motor }}</h2>
                <p class="mt-2 text-sm text-slate-500">Tenor {{ $simulation['jenisCicilan']->lama_cicilan }} bulan @if($simulation['asuransi']) &middot; {{ $simulation['asuransi']->nama_asuransi }} @endif</p>
                <div class="mt-6 grid gap-4 sm:grid-cols-2">
                    <x-stat-card title="Pokok Kredit" :value="'Rp '.number_format($simulation['pokok_kredit'], 0, ',', '.')" />
                    <x-stat-card title="Margin Nominal" :value="'Rp '.number_format($simulation['margin_nominal'], 0, ',', '.')" />
                    <x-stat-card title="Asuransi / Bulan" :value="'Rp '.number_format($simulation['biaya_asuransi_perbulan'], 0, ',', '.')" />
                    <x-stat-card title="Cicilan / Bulan" :value="'Rp '.number_format($simulation['cicilan_perbulan'], 0, ',', '.')" />
                </div>
                <div class="mt-6 rounded-3xl bg-slate-950 p-6 text-white">
                    <p class="text-sm uppercase tracking-[0.25em] text-slate-300">Total harga kredit</p>
                    <p class="mt-3 text-4xl font-semibold">Rp {{ number_format($simulation['harga_kredit'], 0, ',', '.') }}</p>
                    <div class="mt-6 flex flex-wrap gap-3">
                        @auth
                            <a href="{{ route('user.pengajuan.create', $simulation['motor']) }}" class="btn-success">Lanjut Ajukan Kredit</a>
                        @else
                            <a href="{{ route('login') }}" class="btn-success">Login untuk Ajukan</a>
                        @endauth
                    </div>
                </div>
            @else
                <x-empty-state title="Belum ada simulasi" />
            @endif
        </section>
    </section>
@endsection

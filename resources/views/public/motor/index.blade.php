@extends('layouts.public')

@section('title', 'Katalog Motor')

@section('content')
    <section class="shell-card p-6">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.28em] text-slate-400">Catalog</p>
                <h1 class="mt-2 text-3xl font-semibold">Katalog motor CredFast</h1>
            </div>

            <form method="GET" class="grid gap-3 sm:grid-cols-3">
                <input type="text" name="q" value="{{ request('q') }}" class="shell-input" placeholder="Cari motor berdasarkan nama">
                <select name="jenis_motor_id" class="shell-select">
                    <option value="">Semua jenis</option>
                    @foreach ($jenisMotors as $jenis)
                        <option value="{{ $jenis->id }}" @selected((string) request('jenis_motor_id') === (string) $jenis->id)>{{ $jenis->merk }} - {{ str($jenis->tipe)->replace('_', ' ')->title() }}</option>
                    @endforeach
                </select>
                <button class="btn-primary">Filter</button>
            </form>
        </div>
    </section>

    <section class="mt-8">
        @if ($motors->isEmpty())
            <x-empty-state title="Motor tidak ditemukan" />
        @else
            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($motors as $motor)
                    <article class="shell-card p-6">
                        <x-uploaded-image
                            :src="$motor->primaryFotoUrl()"
                            :alt="$motor->nama_motor"
                            label="Motor"
                            class="mb-5 h-48 w-full rounded-[24px] object-cover"
                        />
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-sm uppercase tracking-[0.25em] text-slate-400">{{ $motor->jenisMotor->merk }}</p>
                                <h2 class="mt-2 text-2xl font-semibold">{{ $motor->nama_motor }}</h2>
                            </div>
                            <x-status-badge :status="$motor->status" />
                        </div>
                        <p class="mt-4 text-sm text-slate-600">{{ \Illuminate\Support\Str::limit($motor->deskripsi_motor, 120) }}</p>
                        <div class="mt-5 grid grid-cols-2 gap-3 text-sm text-slate-500">
                            <div><span class="font-semibold text-slate-700">Mesin:</span> {{ $motor->kapasitas_mesin ?? '-' }}</div>
                            <div><span class="font-semibold text-slate-700">Stok:</span> {{ $motor->stok }}</div>
                            <div><span class="font-semibold text-slate-700">Tahun:</span> {{ $motor->tahun ?? '-' }}</div>
                            <div><span class="font-semibold text-slate-700">Warna:</span> {{ $motor->warna ?? '-' }}</div>
                        </div>
                        <div class="mt-6 flex items-center justify-between">
                            <p class="text-xl font-semibold">Rp {{ number_format($motor->harga_jual, 0, ',', '.') }}</p>
                            <a href="{{ route('public.motor.show', $motor) }}" class="btn-secondary">Detail</a>
                        </div>
                    </article>
                @endforeach
            </div>
            <div class="mt-6">
                {{ $motors->links() }}
            </div>
        @endif
    </section>
@endsection

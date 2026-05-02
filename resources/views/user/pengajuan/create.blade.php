@extends('layouts.panel', ['panel' => 'user'])

@section('page-title', 'Ajukan Kredit')

@section('content')
    <div class="grid gap-8 lg:grid-cols-[0.92fr_1.08fr]">
        <section class="shell-card p-8">
            <p class="text-sm uppercase tracking-[0.28em] text-slate-400">Motor pilihan</p>
            <h2 class="mt-2 text-3xl font-semibold">{{ $motor->nama_motor }}</h2>
            <p class="mt-4 text-sm leading-7 text-slate-600">{{ $motor->deskripsi_motor }}</p>
            <div class="mt-6 grid gap-3 sm:grid-cols-2">
                <div class="rounded-2xl bg-slate-50 p-4 text-sm text-slate-600">Harga: <span class="font-semibold text-slate-900">Rp {{ number_format($motor->harga_jual, 0, ',', '.') }}</span></div>
                <div class="rounded-2xl bg-slate-50 p-4 text-sm text-slate-600">Stok: <span class="font-semibold text-slate-900">{{ $motor->stok }}</span></div>
                <div class="rounded-2xl bg-slate-50 p-4 text-sm text-slate-600">Mesin: <span class="font-semibold text-slate-900">{{ $motor->kapasitas_mesin ?? '-' }}</span></div>
                <div class="rounded-2xl bg-slate-50 p-4 text-sm text-slate-600">Tahun: <span class="font-semibold text-slate-900">{{ $motor->tahun ?? '-' }}</span></div>
            </div>
        </section>

        <form method="POST" action="{{ route('user.pengajuan.store') }}" enctype="multipart/form-data" class="shell-card p-8">
            @csrf
            <input type="hidden" name="motor_id" value="{{ $motor->id }}">
            <div class="grid gap-4">
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Tenor</label>
                    <select name="jenis_cicilan_id" class="shell-select" required>
                        <option value="">Pilih tenor</option>
                        @foreach ($jenisCicilan as $item)
                            <option value="{{ $item->id }}">{{ $item->lama_cicilan }} bulan (margin {{ $item->margin_kredit }}%)</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Asuransi</label>
                    <select name="asuransi_id" class="shell-select">
                        <option value="">Tanpa asuransi</option>
                        @foreach ($asuransi as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_asuransi }} ({{ $item->margin_asuransi }}%)</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Down Payment</label>
                    <input type="number" name="dp" value="{{ old('dp') }}" class="shell-input" required>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Upload KK</label>
                        <input type="file" name="url_kk" class="shell-input" required>
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Upload KTP</label>
                        <input type="file" name="url_ktp" class="shell-input" required>
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">NPWP</label>
                        <input type="file" name="url_npwp" class="shell-input">
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Slip Gaji</label>
                        <input type="file" name="url_slip_gaji" class="shell-input">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="mb-2 block text-sm font-medium text-slate-700">Foto Diri</label>
                        <input type="file" name="url_foto" class="shell-input" required>
                    </div>
                </div>
                <button class="btn-primary w-full">Kirim Pengajuan</button>
            </div>
        </form>
    </div>
@endsection

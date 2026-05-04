@extends('layouts.panel', ['panel' => 'user'])

@section('page-title', 'Ajukan Kredit')

@section('content')
    <div class="grid gap-8 lg:grid-cols-[0.92fr_1.08fr]">
        <section class="shell-card p-8">
            <x-uploaded-image
                :src="$motor->primaryFotoUrl()"
                :alt="$motor->nama_motor"
                label="Motor"
                class="mb-6 h-56 w-full rounded-[24px] object-cover"
            />
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
            @php
                $selectedAsuransi = (string) old('asuransi_id', '');
                $selectedMetodeBayar = (string) old('metode_bayar_id', $metodeBayar->first()?->id);
            @endphp
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
                    <p class="mb-2 block text-sm font-medium text-slate-700">Asuransi</p>
                    <div class="grid gap-3 sm:grid-cols-2">
                        <label class="cursor-pointer">
                            <input type="radio" name="asuransi_id" value="" class="peer sr-only" @checked($selectedAsuransi === '')>
                            <span class="block rounded-[22px] border border-slate-200 bg-white p-4 text-sm transition peer-checked:border-slate-950 peer-checked:ring-2 peer-checked:ring-slate-950/10">
                                <span class="block font-semibold text-slate-900">Tanpa asuransi</span>
                                <span class="mt-1 block text-slate-500">Tidak ada biaya asuransi tambahan</span>
                            </span>
                        </label>
                        @foreach ($asuransi as $item)
                            <label class="cursor-pointer">
                                <input type="radio" name="asuransi_id" value="{{ $item->id }}" class="peer sr-only" @checked($selectedAsuransi === (string) $item->id)>
                                <span class="flex h-full gap-3 rounded-[22px] border border-slate-200 bg-white p-4 text-sm transition peer-checked:border-slate-950 peer-checked:ring-2 peer-checked:ring-slate-950/10">
                                    <x-uploaded-image
                                        :src="$item->logoUrl()"
                                        :alt="$item->nama_asuransi"
                                        :label="str($item->nama_asuransi)->substr(0, 2)->upper()"
                                        class="h-14 w-16 shrink-0 rounded-2xl object-contain p-2"
                                    />
                                    <span>
                                        <span class="block font-semibold text-slate-900">{{ $item->nama_asuransi }}</span>
                                        <span class="mt-1 block text-slate-500">{{ $item->margin_asuransi }}% dari harga motor</span>
                                    </span>
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>
                <div>
                    <p class="mb-2 block text-sm font-medium text-slate-700">Metode bayar</p>
                    <div class="grid gap-3 sm:grid-cols-2">
                        @forelse ($metodeBayar as $item)
                            <label class="cursor-pointer">
                                <input type="radio" name="metode_bayar_id" value="{{ $item->id }}" class="peer sr-only" required @checked($selectedMetodeBayar === (string) $item->id)>
                                <span class="flex h-full gap-3 rounded-[22px] border border-slate-200 bg-white p-4 text-sm transition peer-checked:border-slate-950 peer-checked:ring-2 peer-checked:ring-slate-950/10">
                                    <x-uploaded-image
                                        :src="$item->logoUrl()"
                                        :alt="$item->nama_bank"
                                        :label="str($item->nama_bank)->substr(0, 2)->upper()"
                                        class="h-14 w-16 shrink-0 rounded-2xl object-contain p-2"
                                    />
                                    <span>
                                        <span class="block font-semibold text-slate-900">{{ $item->nama_bank }}</span>
                                        <span class="mt-1 block text-slate-500">{{ $item->nomor_rekening }}</span>
                                        <span class="mt-1 block text-slate-500">{{ $item->atas_nama }}</span>
                                    </span>
                                </span>
                            </label>
                        @empty
                            <div class="rounded-[22px] border border-rose-200 bg-rose-50 p-4 text-sm text-rose-700 sm:col-span-2">
                                Belum ada metode bayar aktif. Silakan hubungi admin.
                            </div>
                        @endforelse
                    </div>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Down Payment</label>
                    <input type="number" name="dp" value="{{ old('dp') }}" class="shell-input" required>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Dokumen KK</label>
                        <input type="file" name="url_kk" class="shell-input" required>
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Dokumen KTP</label>
                        <input type="file" name="url_ktp" class="shell-input" required>
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Dokumen NPWP</label>
                        <input type="file" name="url_npwp" class="shell-input">
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Dokumen slip gaji</label>
                        <input type="file" name="url_slip_gaji" class="shell-input">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="mb-2 block text-sm font-medium text-slate-700">Foto diri pelanggan</label>
                        <input type="file" name="url_foto" class="shell-input" required>
                    </div>
                </div>
                <button class="btn-primary w-full">Kirim Pengajuan</button>
            </div>
        </form>
    </div>
@endsection

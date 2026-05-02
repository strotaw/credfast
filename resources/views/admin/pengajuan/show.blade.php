@extends('layouts.panel', ['panel' => 'admin'])
@section('page-title', 'Detail Pengajuan')
@section('content')
    <div class="grid gap-6 xl:grid-cols-[1fr_1fr]">
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
                <div>Harga kredit: <span class="font-semibold text-slate-900">Rp {{ number_format($pengajuan->harga_kredit, 0, ',', '.') }}</span></div>
                <div>Cicilan / bulan: <span class="font-semibold text-slate-900">Rp {{ number_format($pengajuan->cicilan_perbulan, 0, ',', '.') }}</span></div>
                <div>Marketing: <span class="font-semibold text-slate-900">{{ $pengajuan->marketing?->name ?? '-' }}</span></div>
                <div>Admin: <span class="font-semibold text-slate-900">{{ $pengajuan->admin?->name ?? '-' }}</span></div>
            </div>
            <div class="mt-6 rounded-3xl bg-slate-50 p-5 text-sm text-slate-600">
                <p class="font-semibold text-slate-900">Catatan marketing</p>
                <p class="mt-2">{{ $pengajuan->catatan_marketing ?: 'Belum ada.' }}</p>
                <p class="mt-4 font-semibold text-slate-900">Keterangan status</p>
                <p class="mt-2">{{ $pengajuan->keterangan_status_pengajuan ?: 'Belum ada.' }}</p>
            </div>
        </section>

        <div class="space-y-6">
            <form method="POST" action="{{ route('admin.pengajuan.approve', $pengajuan) }}" class="shell-card p-8">
                @csrf
                @method('PUT')
                <h3 class="section-title">Approve pengajuan</h3>
                <textarea name="keterangan_status_pengajuan" class="shell-textarea mt-4" placeholder="Catatan approval">Disetujui admin.</textarea>
                <button class="btn-success mt-4">Approve</button>
            </form>

            <form method="POST" action="{{ route('admin.pengajuan.reject', $pengajuan) }}" class="shell-card p-8">
                @csrf
                @method('PUT')
                <h3 class="section-title">Reject pengajuan</h3>
                <textarea name="keterangan_status_pengajuan" class="shell-textarea mt-4" placeholder="Alasan penolakan"></textarea>
                <button class="btn-danger mt-4">Reject</button>
            </form>

            <form method="POST" action="{{ route('admin.pengajuan.buat-kredit', $pengajuan) }}" class="shell-card p-8">
                @csrf
                <h3 class="section-title">Buat kredit & jadwal angsuran</h3>
                <div class="mt-4 grid gap-4">
                    <select name="metode_bayar_id" class="shell-select">
                        <option value="">Pilih metode bayar</option>
                        @foreach ($metodeBayar as $metode)
                            <option value="{{ $metode->id }}">{{ $metode->nama_bank }} - {{ $metode->nomor_rekening }}</option>
                        @endforeach
                    </select>
                    <input type="date" name="tgl_mulai_kredit" value="{{ now()->toDateString() }}" class="shell-input">
                    <button class="btn-primary">Buat Kredit</button>
                </div>
            </form>
        </div>
    </div>
@endsection

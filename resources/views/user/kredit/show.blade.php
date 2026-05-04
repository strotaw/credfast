@extends('layouts.panel', ['panel' => 'user'])

@section('page-title', 'Detail Kredit')

@section('content')
    <div class="grid gap-6 lg:grid-cols-[1fr_1fr]">
        <section class="shell-card p-8">
            <x-uploaded-image
                :src="$kredit->pengajuanKredit->motor->primaryFotoUrl()"
                :alt="$kredit->pengajuanKredit->motor->nama_motor"
                label="Motor"
                class="mb-6 h-56 w-full rounded-[24px] object-cover"
            />
            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="text-sm uppercase tracking-[0.28em] text-slate-400">Kontrak Kredit</p>
                    <h2 class="mt-2 text-3xl font-semibold">{{ $kredit->no_kontrak }}</h2>
                </div>
                <x-status-badge :status="$kredit->status_kredit" />
            </div>
            <div class="mt-6 grid gap-4 sm:grid-cols-2 text-sm text-slate-600">
                <div>Motor: <span class="font-semibold text-slate-900">{{ $kredit->pengajuanKredit->motor->nama_motor }}</span></div>
                <div>Mulai: <span class="font-semibold text-slate-900">{{ $kredit->tgl_mulai_kredit->format('d M Y') }}</span></div>
                <div>Selesai: <span class="font-semibold text-slate-900">{{ $kredit->tgl_selesai_kredit->format('d M Y') }}</span></div>
                <div>Total: <span class="font-semibold text-slate-900">Rp {{ number_format($kredit->total_kredit, 0, ',', '.') }}</span></div>
                <div>Sisa: <span class="font-semibold text-slate-900">Rp {{ number_format($kredit->sisa_kredit, 0, ',', '.') }}</span></div>
                <div>Bank: <span class="font-semibold text-slate-900">{{ $kredit->metodeBayar?->nama_bank ?? 'Belum ditentukan' }}</span></div>
            </div>
            <div class="mt-6 flex items-center gap-3 rounded-3xl bg-slate-50 p-4 text-sm">
                <x-uploaded-image
                    :src="$kredit->metodeBayar?->logoUrl()"
                    :alt="$kredit->metodeBayar?->nama_bank ?? 'Metode bayar'"
                    label="MB"
                    class="h-14 w-16 shrink-0 rounded-2xl object-contain p-2"
                />
                <div>
                    <p class="font-semibold text-slate-900">{{ $kredit->metodeBayar?->nama_bank ?? 'Belum ditentukan' }}</p>
                    <p class="mt-1 text-slate-500">{{ $kredit->metodeBayar?->nomor_rekening ?? 'Nomor rekening belum tersedia' }}</p>
                    <p class="mt-1 text-slate-500">{{ $kredit->metodeBayar?->atas_nama ?? '-' }}</p>
                </div>
            </div>
        </section>

        <section class="shell-card p-8">
            <h3 class="section-title">Tracking pengiriman motor</h3>
            @if ($kredit->pengiriman)
                <div class="mt-4 space-y-3 text-sm text-slate-600">
                    <div>No. invoice: <span class="font-semibold text-slate-900">{{ $kredit->pengiriman->no_invoice }}</span></div>
                    <div>Status: <x-status-badge :status="$kredit->pengiriman->status_kirim" kirim /></div>
                    <div>Kurir: <span class="font-semibold text-slate-900">{{ $kredit->pengiriman->nama_kurir ?? 'Belum ditentukan' }}</span></div>
                    <div>Telpon kurir: <span class="font-semibold text-slate-900">{{ $kredit->pengiriman->telpon_kurir ?? '-' }}</span></div>
                    <div>Tanggal kirim: <span class="font-semibold text-slate-900">{{ $kredit->pengiriman->tgl_kirim?->format('d M Y H:i') ?? '-' }}</span></div>
                    <div>Tanggal tiba: <span class="font-semibold text-slate-900">{{ $kredit->pengiriman->tgl_tiba?->format('d M Y H:i') ?? '-' }}</span></div>
                </div>
            @else
                <p class="mt-3 text-sm text-slate-500">Data pengiriman belum dibuat admin.</p>
            @endif
        </section>
    </div>

    <section class="shell-card mt-6 overflow-hidden">
        <div class="border-b border-slate-200 px-6 py-5">
            <h3 class="section-title">Daftar angsuran</h3>
        </div>
        <table class="table-shell">
            <thead class="bg-slate-50">
                <tr>
                    <th>Ke</th>
                    <th>Jatuh Tempo</th>
                    <th>Nominal</th>
                    <th>Denda</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 bg-white">
                @foreach ($kredit->angsuran->sortBy('angsuran_ke') as $angsuran)
                    <tr>
                        <td>{{ $angsuran->angsuran_ke }}</td>
                        <td>{{ $angsuran->tanggal_jatuh_tempo->format('d M Y') }}</td>
                        <td>Rp {{ number_format($angsuran->nominal, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($angsuran->denda, 0, ',', '.') }}</td>
                        <td><x-status-badge :status="$angsuran->status" /></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection

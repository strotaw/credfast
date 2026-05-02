@extends('layouts.panel', ['panel' => 'admin'])
@section('page-title', 'Detail Kredit')
@section('content')
    <div class="grid gap-6 xl:grid-cols-[1fr_1fr]">
        <section class="shell-card p-8">
            <div class="flex items-center justify-between gap-3">
                <div><p class="text-sm uppercase tracking-[0.28em] text-slate-400">Kredit</p><h2 class="mt-2 text-3xl font-semibold">{{ $kredit->no_kontrak }}</h2></div>
                <x-status-badge :status="$kredit->status_kredit" />
            </div>
            <div class="mt-6 grid gap-4 sm:grid-cols-2 text-sm text-slate-600">
                <div>Pelanggan: <span class="font-semibold text-slate-900">{{ $kredit->pengajuanKredit->user->name }}</span></div>
                <div>Motor: <span class="font-semibold text-slate-900">{{ $kredit->pengajuanKredit->motor->nama_motor }}</span></div>
                <div>Total kredit: <span class="font-semibold text-slate-900">Rp {{ number_format($kredit->total_kredit, 0, ',', '.') }}</span></div>
                <div>Sisa kredit: <span class="font-semibold text-slate-900">Rp {{ number_format($kredit->sisa_kredit, 0, ',', '.') }}</span></div>
            </div>
        </section>
        <form method="POST" action="{{ route('admin.kredit.status', $kredit) }}" class="shell-card p-8">
            @csrf @method('PUT')
            <h3 class="section-title">Update status kredit</h3>
            <select name="status_kredit" class="shell-select mt-4">
                @foreach (\App\Models\Kredit::STATUS_OPTIONS as $status)
                    <option value="{{ $status }}" @selected($kredit->status_kredit === $status)>{{ str($status)->title() }}</option>
                @endforeach
            </select>
            <textarea name="keterangan_status_kredit" class="shell-textarea mt-4" placeholder="Keterangan status">{{ $kredit->keterangan_status_kredit }}</textarea>
            <button class="btn-primary mt-4">Simpan Status</button>
        </form>
    </div>

    <section class="shell-card mt-6 overflow-hidden">
        <div class="border-b border-slate-200 px-6 py-5"><h3 class="section-title">Jadwal angsuran</h3></div>
        <table class="table-shell">
            <thead class="bg-slate-50"><tr><th>Ke</th><th>Jatuh Tempo</th><th>Total</th><th>Status</th></tr></thead>
            <tbody class="divide-y divide-slate-200 bg-white">
                @foreach ($kredit->angsuran->sortBy('angsuran_ke') as $angsuran)
                    <tr><td>{{ $angsuran->angsuran_ke }}</td><td>{{ $angsuran->tanggal_jatuh_tempo->format('d M Y') }}</td><td>Rp {{ number_format($angsuran->total_bayar, 0, ',', '.') }}</td><td><x-status-badge :status="$angsuran->status" /></td></tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection

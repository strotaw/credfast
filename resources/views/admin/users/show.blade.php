@extends('layouts.panel', ['panel' => 'admin'])

@section('page-title', 'Detail User')

@section('content')
    <div class="grid gap-6 xl:grid-cols-[0.9fr_1.1fr]">
        <section class="shell-card p-8">
            <p class="text-sm uppercase tracking-[0.28em] text-slate-400">Identitas</p>
            <h2 class="mt-2 text-3xl font-semibold">{{ $user->name }}</h2>
            <div class="mt-6 space-y-3 text-sm text-slate-600">
                <div>Email: <span class="font-semibold text-slate-900">{{ $user->email }}</span></div>
                <div>Role: <span class="font-semibold text-slate-900">{{ strtoupper($user->role) }}</span></div>
                <div>No. HP: <span class="font-semibold text-slate-900">{{ $user->no_hp ?? '-' }}</span></div>
                <div>Alamat: <span class="font-semibold text-slate-900">{{ $user->alamat ?? '-' }}</span></div>
            </div>
        </section>
        <section class="shell-card overflow-hidden">
            <div class="border-b border-slate-200 px-6 py-5">
                <h3 class="section-title">Riwayat pengajuan</h3>
            </div>
            <table class="table-shell">
                <thead class="bg-slate-50">
                    <tr>
                        <th>Motor</th>
                        <th>Status</th>
                        <th>Kredit</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white">
                    @forelse ($user->pengajuanKredit as $item)
                        <tr>
                            <td>{{ $item->motor->nama_motor }}</td>
                            <td><x-status-badge :status="$item->status_pengajuan" /></td>
                            <td>{{ $item->kredit?->no_kontrak ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="3">Belum ada pengajuan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </section>
    </div>
@endsection

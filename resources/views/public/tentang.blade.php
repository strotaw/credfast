@extends('layouts.public')

@section('title', 'Tentang CredFast')

@section('content')
    <section class="shell-card p-8 sm:p-10">
        <p class="text-sm uppercase tracking-[0.28em] text-slate-400">Tentang kami</p>
        <h1 class="mt-2 text-4xl font-semibold">CredFast untuk pembiayaan motor yang rapi dan terukur.</h1>
        <div class="mt-8 grid gap-6 md:grid-cols-3">
            <x-stat-card title="Fokus" value="Kredit Motor" />
            <x-stat-card title="Pembayaran" value="Transfer Bank" />
            <x-stat-card title="Approval" value="Role Based" />
        </div>
    </section>
@endsection

@extends('layouts.panel', ['panel' => 'admin'])
@section('page-title', $item->exists ? 'Edit Jenis Cicilan' : 'Tambah Jenis Cicilan')
@section('content')
    <form method="POST" action="{{ $action }}" class="shell-card p-8">
        @csrf
        @if ($method !== 'POST') @method($method) @endif
        <div class="grid gap-4 md:grid-cols-2">
            <input type="number" name="lama_cicilan" value="{{ old('lama_cicilan', $item->lama_cicilan) }}" class="shell-input" placeholder="Lama cicilan (bulan)">
            <input type="number" step="0.01" name="margin_kredit" value="{{ old('margin_kredit', $item->margin_kredit) }}" class="shell-input" placeholder="Margin kredit (%)">
        </div>
        <button class="btn-primary mt-6">Simpan</button>
    </form>
@endsection

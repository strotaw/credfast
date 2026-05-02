@extends('layouts.panel', ['panel' => 'admin'])
@section('page-title', 'Detail Jenis Cicilan')
@section('content')
    <div class="shell-card p-8 text-sm text-slate-600">
        <p>Lama cicilan: <span class="font-semibold text-slate-900">{{ $item->lama_cicilan }} bulan</span></p>
        <p class="mt-3">Margin kredit: <span class="font-semibold text-slate-900">{{ $item->margin_kredit }}%</span></p>
    </div>
@endsection

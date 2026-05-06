@extends('layouts.panel', ['panel' => 'admin'])
@section('page-title', $item->exists ? 'Edit Pengiriman' : 'Tambah Pengiriman')
@section('content')
    <form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="shell-card p-8">
        @csrf
        @if ($method !== 'POST') @method($method) @endif
        <div class="grid gap-4 md:grid-cols-2">
            <select name="kredit_id" class="shell-select">
                @foreach ($kreditList as $kredit)
                    <option value="{{ $kredit->id }}" @selected(old('kredit_id', $item->kredit_id) == $kredit->id)>{{ $kredit->pengajuanKredit->user->name }} - {{ $kredit->pengajuanKredit->motor->nama_motor }}</option>
                @endforeach
            </select>
            <input type="text" name="no_invoice" value="{{ old('no_invoice', $item->no_invoice) }}" class="shell-input" placeholder="Masukkan nomor invoice pengiriman">
            <input type="datetime-local" name="tgl_kirim" value="{{ old('tgl_kirim', $item->tgl_kirim?->format('Y-m-d\TH:i')) }}" class="shell-input" placeholder="Masukkan tanggal dan jam kirim">
            <input type="datetime-local" name="tgl_tiba" value="{{ old('tgl_tiba', $item->tgl_tiba?->format('Y-m-d\TH:i')) }}" class="shell-input" placeholder="Masukkan tanggal dan jam tiba">
            <select name="status_kirim" class="shell-select">@foreach ($statuses as $status)<option value="{{ $status }}" @selected(old('status_kirim', $item->status_kirim) === $status)>{{ str($status)->title() }}</option>@endforeach</select>
            <input type="text" name="nama_kurir" value="{{ old('nama_kurir', $item->nama_kurir) }}" class="shell-input" placeholder="Masukkan nama kurir pengiriman">
            <input type="text" name="telpon_kurir" value="{{ old('telpon_kurir', $item->telpon_kurir) }}" class="shell-input" placeholder="Masukkan nomor telepon kurir">
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Foto bukti pengiriman</label>
                <input type="file" name="bukti_foto" class="shell-input">
            </div>
            <div class="md:col-span-2"><textarea name="keterangan" class="shell-textarea" placeholder="Masukkan keterangan pengiriman">{{ old('keterangan', $item->keterangan) }}</textarea></div>
        </div>
        <button class="btn-primary mt-6">Simpan Pengiriman</button>
    </form>
@endsection

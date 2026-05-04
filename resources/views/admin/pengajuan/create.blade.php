@extends('layouts.panel', ['panel' => 'admin'])
@section('page-title', 'Pengajuan Offline Admin')
@section('content')
    <form method="POST" action="{{ route('admin.pengajuan.offline.store') }}" enctype="multipart/form-data" class="shell-card p-8">
        @csrf
        <div class="grid gap-4 lg:grid-cols-2">
            <input type="text" name="name" value="{{ old('name') }}" class="shell-input" placeholder="Nama pelanggan">
            <input type="email" name="email" value="{{ old('email') }}" class="shell-input" placeholder="Email pelanggan">
            <input type="text" name="no_hp" value="{{ old('no_hp') }}" class="shell-input" placeholder="Nomor HP">
            <input type="text" name="kode_pos" value="{{ old('kode_pos') }}" class="shell-input" placeholder="Kode Pos">
            <input type="text" name="kota" value="{{ old('kota') }}" class="shell-input" placeholder="Kota">
            <input type="text" name="provinsi" value="{{ old('provinsi') }}" class="shell-input" placeholder="Provinsi">
            <div class="lg:col-span-2"><textarea name="alamat" class="shell-textarea" placeholder="Alamat">{{ old('alamat') }}</textarea></div>
            <select name="motor_id" class="shell-select">@foreach ($motors as $motor)<option value="{{ $motor->id }}">{{ $motor->nama_motor }} - Rp {{ number_format($motor->harga_jual, 0, ',', '.') }}</option>@endforeach</select>
            <select name="jenis_cicilan_id" class="shell-select">@foreach ($jenisCicilan as $item)<option value="{{ $item->id }}">{{ $item->lama_cicilan }} bulan</option>@endforeach</select>
            <select name="asuransi_id" class="shell-select"><option value="">Tanpa asuransi</option>@foreach ($asuransi as $item)<option value="{{ $item->id }}">{{ $item->nama_asuransi }}</option>@endforeach</select>
            <select name="metode_bayar_id" class="shell-select">
                <option value="">Pilih metode bayar</option>
                @foreach ($metodeBayar as $item)
                    <option value="{{ $item->id }}" @selected(old('metode_bayar_id') == $item->id)>{{ $item->nama_bank }} - {{ $item->nomor_rekening }}</option>
                @endforeach
            </select>
            <input type="number" name="dp" value="{{ old('dp') }}" class="shell-input" placeholder="Down payment">
        </div>
        <div class="mt-5 grid gap-4 md:grid-cols-2">
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Dokumen KK pelanggan</label>
                <input type="file" name="url_kk" class="shell-input">
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Dokumen KTP pelanggan</label>
                <input type="file" name="url_ktp" class="shell-input">
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Dokumen NPWP pelanggan</label>
                <input type="file" name="url_npwp" class="shell-input">
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Dokumen slip gaji pelanggan</label>
                <input type="file" name="url_slip_gaji" class="shell-input">
            </div>
            <div class="md:col-span-2">
                <label class="mb-2 block text-sm font-medium text-slate-700">Foto diri pelanggan</label>
                <input type="file" name="url_foto" class="shell-input">
            </div>
        </div>
        <button class="btn-primary mt-6">Simpan Pengajuan</button>
    </form>
@endsection

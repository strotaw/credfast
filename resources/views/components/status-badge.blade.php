@php
    $map = [
        'menunggu_konfirmasi' => 'bg-slate-100 text-slate-700 ring-slate-200',
        'diproses' => 'bg-sky-100 text-sky-700 ring-sky-200',
        'dibatalkan_pembeli' => 'bg-zinc-100 text-zinc-700 ring-zinc-200',
        'dibatalkan_penjual' => 'bg-rose-100 text-rose-700 ring-rose-200',
        'bermasalah' => 'bg-orange-100 text-orange-700 ring-orange-200',
        'diterima' => 'bg-emerald-100 text-emerald-700 ring-emerald-200',
        'menunggu' => 'bg-slate-100 text-slate-700 ring-slate-200',
        'ditolak' => 'bg-rose-100 text-rose-700 ring-rose-200',
        'aktif' => 'bg-sky-100 text-sky-700 ring-sky-200',
        'macet' => 'bg-rose-100 text-rose-700 ring-rose-200',
        'lunas' => 'bg-emerald-100 text-emerald-700 ring-emerald-200',
        'dibatalkan' => 'bg-zinc-100 text-zinc-700 ring-zinc-200',
        'dibayar' => 'bg-amber-100 text-amber-700 ring-amber-200',
        'valid' => 'bg-emerald-100 text-emerald-700 ring-emerald-200',
        'telat' => 'bg-rose-100 text-rose-700 ring-rose-200',
        'diproses-kirim' => 'bg-slate-100 text-slate-700 ring-slate-200',
        'dikirim' => 'bg-sky-100 text-sky-700 ring-sky-200',
        'diterima-kirim' => 'bg-emerald-100 text-emerald-700 ring-emerald-200',
        'tersedia' => 'bg-emerald-100 text-emerald-700 ring-emerald-200',
        'habis' => 'bg-amber-100 text-amber-700 ring-amber-200',
        'nonaktif' => 'bg-zinc-100 text-zinc-700 ring-zinc-200',
        'aktif-bank' => 'bg-emerald-100 text-emerald-700 ring-emerald-200',
        'nonaktif-bank' => 'bg-zinc-100 text-zinc-700 ring-zinc-200',
    ];
    $normalized = $status === 'diproses' && isset($kirim) ? 'diproses-kirim' : $status;
    $normalized = $status === 'diterima' && isset($kirim) ? 'diterima-kirim' : $normalized;
    $normalized = $status === 'aktif' && isset($bank) ? 'aktif-bank' : $normalized;
    $normalized = $status === 'nonaktif' && isset($bank) ? 'nonaktif-bank' : $normalized;
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex rounded-full px-3 py-1 text-xs font-semibold ring-1 ring-inset '.($map[$normalized] ?? 'bg-slate-100 text-slate-700 ring-slate-200')]) }}>
    {{ str($status)->replace('_', ' ')->title() }}
</span>

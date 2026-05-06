@props([
    'label',
    'path' => null,
])

@php
    $url = $path ? Illuminate\Support\Facades\Storage::url($path) : null;
    $extension = $path ? strtolower(pathinfo($path, PATHINFO_EXTENSION)) : null;
    $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'webp'], true);
    $isPdf = $extension === 'pdf';
@endphp

<div class="overflow-hidden rounded-2xl border border-slate-200 bg-white">
    <div class="border-b border-slate-200 px-4 py-3">
        <p class="font-semibold text-slate-900">{{ $label }}</p>
    </div>

    @if (! $url)
        <div class="flex h-44 items-center justify-center bg-slate-50 px-4 text-sm text-slate-500">
            Belum ada
        </div>
    @elseif ($isImage)
        <img src="{{ $url }}" alt="{{ $label }}" class="h-64 w-full bg-slate-50 object-contain">
    @elseif ($isPdf)
        <iframe src="{{ $url }}" title="{{ $label }}" class="h-80 w-full bg-slate-50"></iframe>
    @else
        <div class="flex h-44 items-center justify-center bg-slate-50 px-4 text-sm text-slate-500">
            File tersimpan: {{ basename($path) }}
        </div>
    @endif
</div>

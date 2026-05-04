@props([
    'src' => null,
    'alt' => '',
    'label' => 'CF',
])

@if ($src)
    <img src="{{ $src }}" alt="{{ $alt }}" {{ $attributes }}>
@else
    <div {{ $attributes->merge(['class' => 'flex items-center justify-center bg-slate-100 text-slate-400']) }}>
        <span class="text-xs font-bold uppercase tracking-[0.24em]">{{ $label }}</span>
    </div>
@endif

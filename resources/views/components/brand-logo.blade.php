@props([
    'subtitle' => null,
])

<span {{ $attributes->merge(['class' => 'inline-flex flex-col items-start gap-1']) }}>
    <img src="{{ asset('images/credfast-logo.svg') }}" alt="CredFast" class="h-12 w-auto">
    @if ($subtitle)
        <span class="text-xs uppercase tracking-[0.32em] text-slate-400">{{ $subtitle }}</span>
    @endif
</span>

@props(['title', 'value', 'hint' => null])

<div class="metric-card">
    <div class="flex items-start justify-between gap-4">
        <div>
            <p class="text-[11px] font-semibold uppercase tracking-[0.28em] text-slate-400">{{ $title }}</p>
            <p class="mt-4 text-3xl font-semibold tracking-tight text-slate-950">{{ $value }}</p>
            @if ($hint)
                <p class="mt-2 text-sm text-slate-500">{{ $hint }}</p>
            @endif
        </div>
        <span class="metric-card__accent"></span>
    </div>
</div>

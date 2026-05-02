@props(['title', 'description' => null])

<div class="shell-card p-8 text-center">
    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-500">
        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
            <path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h6m-8 9h14a2 2 0 0 0 2-2V7.5a2 2 0 0 0-.586-1.414l-3.5-3.5A2 2 0 0 0 15.5 2H5a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2Z" />
        </svg>
    </div>
    <p class="mt-5 text-lg font-semibold text-slate-900">{{ $title }}</p>
    @if ($description)
        <p class="mt-2 text-sm leading-7 text-slate-500">{{ $description }}</p>
    @endif
    {{ $slot }}
</div>

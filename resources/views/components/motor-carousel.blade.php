@props([
    'motors',
    'eyebrow' => 'Showroom',
    'title' => 'Pilihan motor tersedia',
    'subtitle' => null,
])

@php
    $carouselId = 'motor-carousel-'.uniqid();
    $items = collect($motors)->values();
@endphp

@if ($items->isNotEmpty())
    <section id="{{ $carouselId }}" class="shell-card overflow-hidden" data-carousel>
        <div class="relative">
            @foreach ($items as $motor)
                <article data-carousel-slide class="{{ $loop->first ? '' : 'hidden' }}">
                    <div class="grid gap-0 lg:grid-cols-[1.05fr_0.95fr]">
                        <x-uploaded-image
                            :src="$motor->primaryFotoUrl()"
                            :alt="$motor->nama_motor"
                            label="Motor"
                            class="h-72 w-full object-cover lg:h-full"
                        />
                        <div class="p-7 sm:p-9">
                            <p class="text-sm uppercase tracking-[0.28em] text-sky-600">{{ $eyebrow }}</p>
                            <h2 class="mt-3 text-3xl font-semibold">{{ $motor->nama_motor }}</h2>
                            <p class="mt-3 text-sm leading-7 text-slate-600">{{ \Illuminate\Support\Str::limit($motor->deskripsi_motor, 170) }}</p>
                            <div class="mt-6 grid gap-3 sm:grid-cols-2">
                                <div class="rounded-2xl bg-slate-50 p-4 text-sm text-slate-600">
                                    Harga <span class="block font-semibold text-slate-900">Rp {{ number_format($motor->harga_jual, 0, ',', '.') }}</span>
                                </div>
                                <div class="rounded-2xl bg-slate-50 p-4 text-sm text-slate-600">
                                    Stok <span class="block font-semibold text-slate-900">{{ $motor->stok }}</span>
                                </div>
                            </div>
                            <div class="mt-6 flex flex-wrap items-center gap-3">
                                <a href="{{ route('public.motor.show', $motor) }}" class="btn-primary">Detail Motor</a>
                                <a href="{{ route('public.simulasi', ['motor_id' => $motor->id]) }}" class="btn-secondary">Simulasi</a>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach

            @if ($items->count() > 1)
                <button type="button" data-carousel-prev class="absolute left-4 top-1/2 flex h-11 w-11 -translate-y-1/2 items-center justify-center rounded-2xl border border-white/80 bg-white/90 text-2xl font-semibold text-slate-900 shadow-lg shadow-slate-900/10" aria-label="Slide sebelumnya">&lsaquo;</button>
                <button type="button" data-carousel-next class="absolute right-4 top-1/2 flex h-11 w-11 -translate-y-1/2 items-center justify-center rounded-2xl border border-white/80 bg-white/90 text-2xl font-semibold text-slate-900 shadow-lg shadow-slate-900/10" aria-label="Slide berikutnya">&rsaquo;</button>
            @endif
        </div>

        @if ($items->count() > 1)
            <div class="flex items-center justify-between gap-4 border-t border-slate-200 px-6 py-4">
                <p class="text-sm font-semibold text-slate-500">{{ $subtitle ?? 'Geser untuk melihat rekomendasi lainnya' }}</p>
                <div class="flex gap-2">
                    @foreach ($items as $motor)
                        <button type="button" data-carousel-dot="{{ $loop->index }}" class="{{ $loop->first ? 'bg-slate-950' : 'bg-slate-300' }} h-2.5 w-8 rounded-full transition" aria-label="Pilih slide {{ $loop->iteration }}"></button>
                    @endforeach
                </div>
            </div>
        @endif
    </section>

    @if ($items->count() > 1)
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const root = document.getElementById(@json($carouselId));
                if (!root || root.dataset.carouselReady) return;
                root.dataset.carouselReady = 'true';

                const slides = Array.from(root.querySelectorAll('[data-carousel-slide]'));
                const dots = Array.from(root.querySelectorAll('[data-carousel-dot]'));
                const previous = root.querySelector('[data-carousel-prev]');
                const next = root.querySelector('[data-carousel-next]');
                let active = 0;
                let timer = null;

                const show = function (index) {
                    active = (index + slides.length) % slides.length;
                    slides.forEach(function (slide, slideIndex) {
                        slide.classList.toggle('hidden', slideIndex !== active);
                    });
                    dots.forEach(function (dot, dotIndex) {
                        dot.classList.toggle('bg-slate-950', dotIndex === active);
                        dot.classList.toggle('bg-slate-300', dotIndex !== active);
                    });
                };

                const start = function () {
                    timer = window.setInterval(function () {
                        show(active + 1);
                    }, 6500);
                };

                const restart = function () {
                    window.clearInterval(timer);
                    start();
                };

                previous?.addEventListener('click', function () {
                    show(active - 1);
                    restart();
                });

                next?.addEventListener('click', function () {
                    show(active + 1);
                    restart();
                });

                dots.forEach(function (dot) {
                    dot.addEventListener('click', function () {
                        show(Number(dot.dataset.carouselDot));
                        restart();
                    });
                });

                root.addEventListener('mouseenter', function () {
                    window.clearInterval(timer);
                });
                root.addEventListener('mouseleave', start);

                start();
            });
        </script>
    @endif
@endif

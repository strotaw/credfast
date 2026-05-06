@extends('layouts.public')

@section('title', 'CredFast - Kredit Motor')

@section('content')
    @php
        $carouselId = 'credfast-home-carousel';
        // Ganti URL image ini dengan asset('images/carousel/nama-file.jpg') atau URL gambar eksternal.
        $slides = [
            [
                'image' => 'https://images.unsplash.com/photo-1558981806-ec527fa84c39?auto=format&fit=crop&w=1600&q=85',
                'title' => 'Ajukan kredit motor dengan alur yang lebih jelas.',
                'description' => 'CredFast membantu pelanggan memilih motor, menghitung DP dan tenor, lalu mengirim pengajuan kredit secara online.',
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1609630875171-b1321377ee65?auto=format&fit=crop&w=1600&q=85',
                'title' => 'Status pengajuan, kontrak, dan angsuran tersusun rapi.',
                'description' => 'Setiap pengajuan masuk ke alur marketing dan admin sehingga pelanggan bisa mengikuti proses kredit dari satu portal.',
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1558981359-219d6364c9c8?auto=format&fit=crop&w=1600&q=85',
                'title' => 'Cari motor, cek harga, lalu ajukan kredit saat siap.',
                'description' => 'Katalog CredFast menampilkan motor tersedia lengkap dengan harga, stok, dan detail yang dibutuhkan sebelum mengambil keputusan.',
            ],
        ];
    @endphp

    <section id="{{ $carouselId }}" class="overflow-hidden rounded-[30px] bg-slate-950 text-white shadow-[0_24px_80px_rgba(15,23,42,0.18)]" data-static-carousel>
        <div class="relative">
            @foreach ($slides as $slide)
                <article data-carousel-slide class="{{ $loop->first ? '' : 'hidden' }}">
                    <div class="relative min-h-[460px]">
                        <img src="{{ $slide['image'] }}" alt="{{ $slide['title'] }}" class="absolute inset-0 h-full w-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-950/45 to-slate-950/10"></div>
                        <div class="relative flex min-h-[460px] flex-col justify-center px-7 py-12 sm:px-10 lg:px-14">
                            <p class="text-sm font-semibold uppercase tracking-[0.35em] text-cyan-100">CredFast</p>
                            <h1 class="mt-5 max-w-3xl text-4xl font-semibold leading-tight text-white sm:text-5xl">{{ $slide['title'] }}</h1>
                            <p class="mt-5 max-w-2xl text-base leading-8 text-slate-100">{{ $slide['description'] }}</p>
                            <div class="mt-8 flex flex-wrap gap-3">
                                <a href="{{ route('public.motor') }}" class="inline-flex items-center justify-center rounded-2xl bg-white px-5 py-3 text-sm font-semibold text-slate-950 transition hover:-translate-y-0.5 hover:bg-slate-100">Lihat Katalog</a>
                                <a href="{{ route('public.simulasi') }}" class="inline-flex items-center justify-center rounded-2xl border border-white/40 bg-white/10 px-5 py-3 text-sm font-semibold text-white transition hover:-translate-y-0.5 hover:bg-white/15">Simulasi Kredit</a>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach

            <button type="button" data-carousel-prev class="absolute left-4 top-1/2 flex h-11 w-11 -translate-y-1/2 items-center justify-center rounded-2xl border border-white/30 bg-white/15 text-2xl font-semibold text-white backdrop-blur transition hover:bg-white/25" aria-label="Slide sebelumnya">&lsaquo;</button>
            <button type="button" data-carousel-next class="absolute right-4 top-1/2 flex h-11 w-11 -translate-y-1/2 items-center justify-center rounded-2xl border border-white/30 bg-white/15 text-2xl font-semibold text-white backdrop-blur transition hover:bg-white/25" aria-label="Slide berikutnya">&rsaquo;</button>
        </div>

        <div class="flex flex-col gap-4 border-t border-white/10 bg-slate-950 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">
            <p class="text-sm font-semibold text-slate-300">CredFast untuk pengajuan kredit motor online</p>
            <div class="flex gap-2">
                @foreach ($slides as $slide)
                    <button type="button" data-carousel-dot="{{ $loop->index }}" class="{{ $loop->first ? 'bg-white' : 'bg-white/30' }} h-2.5 w-8 rounded-full transition" aria-label="Pilih slide {{ $loop->iteration }}"></button>
                @endforeach
            </div>
        </div>
    </section>

    <section class="mt-12 grid gap-8 lg:grid-cols-[0.9fr_1.1fr] lg:items-center">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.32em] text-sky-700">Apa itu CredFast?</p>
            <h2 class="mt-4 text-3xl font-semibold leading-tight sm:text-4xl">Platform kredit motor untuk memilih unit, simulasi cicilan, dan pengajuan online.</h2>
            <p class="mt-5 leading-8 text-slate-600">CredFast membantu calon pembeli motor memahami biaya kredit sejak awal. Pelanggan bisa melihat katalog, menghitung estimasi DP dan cicilan, mengunggah dokumen, lalu memantau pengajuan sampai kontrak kredit dibuat.</p>
            <div class="mt-7 flex flex-wrap gap-3">
                <a href="{{ route('public.motor') }}" class="btn-primary">Pilih Motor</a>
                <a href="{{ route('public.simulasi') }}" class="btn-secondary">Hitung Cicilan</a>
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-3">
            <x-stat-card title="Motor Tersedia" :value="$motorCount" />
            <x-stat-card title="Jenis Cicilan" :value="$tenorCount" />
            <x-stat-card title="Brand Aktif" :value="$brandCount" />
        </div>
    </section>

    <section class="mt-12">
        <div class="mb-5 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.28em] text-slate-400">Katalog motor</p>
                <h2 class="section-title mt-2">Motor yang tersedia</h2>
            </div>
            <a href="{{ route('public.motor') }}" class="btn-secondary">Lihat Semua</a>
        </div>

        @if ($availableMotors->isEmpty())
            <x-empty-state title="Belum ada motor tersedia" description="Katalog akan tampil di sini setelah admin menambahkan motor aktif." />
        @else
            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($availableMotors as $motor)
                    <article class="shell-card p-6">
                        <x-uploaded-image
                            :src="$motor->primaryFotoUrl()"
                            :alt="$motor->nama_motor"
                            label="Motor"
                            class="mb-5 h-52 w-full rounded-[24px] object-cover"
                        />
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-sm uppercase tracking-[0.25em] text-sky-700">{{ $motor->jenisMotor->merk }}</p>
                                <h3 class="mt-2 text-2xl font-semibold">{{ $motor->nama_motor }}</h3>
                            </div>
                            <x-status-badge :status="$motor->status" />
                        </div>
                        <p class="mt-4 text-sm leading-7 text-slate-600">{{ \Illuminate\Support\Str::limit($motor->deskripsi_motor, 120) }}</p>
                        <div class="mt-5 grid grid-cols-2 gap-3 text-sm text-slate-500">
                            <div><span class="font-semibold text-slate-700">Mesin:</span> {{ $motor->kapasitas_mesin ?? '-' }}</div>
                            <div><span class="font-semibold text-slate-700">Stok:</span> {{ $motor->stok }}</div>
                            <div><span class="font-semibold text-slate-700">Tahun:</span> {{ $motor->tahun ?? '-' }}</div>
                            <div><span class="font-semibold text-slate-700">Warna:</span> {{ $motor->warna ?? '-' }}</div>
                        </div>
                        <div class="mt-6 flex items-center justify-between gap-4">
                            <div>
                                <p class="text-sm text-slate-500">Harga</p>
                                <p class="text-xl font-semibold">Rp {{ number_format($motor->harga_jual, 0, ',', '.') }}</p>
                            </div>
                            <a href="{{ route('public.motor.show', $motor) }}" class="btn-primary">Ajukan Kredit</a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </section>

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
                    dot.classList.toggle('bg-white', dotIndex === active);
                    dot.classList.toggle('bg-white/30', dotIndex !== active);
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
@endsection

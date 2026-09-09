@extends('layouts.app')

@section('title', $service->name . ' - Sendangku')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
@endpush

@section('content')
@php
    $galleryImages = $service->serviceGalleries;

    if ($galleryImages->isEmpty()) {
        $galleryImages = collect([(object) ['image_url' => $service->thumbnail_url]]);
    }
@endphp

<section class="relative mt-10 bg-black">
    <div class="h-72 w-full sm:h-96">
        <img src="{{ $service->thumbnail_url }}" alt="{{ $service->name }}" class="h-full w-full object-cover" onerror="this.src='/img/sendang.png'">
    </div>
    <div class="absolute inset-0 bg-black/55"></div>
    <div class="absolute inset-0 flex flex-col justify-center px-5 sm:px-10">
        <p class="text-sm font-medium text-amber-400">Layanan Sendangku</p>
        <h1 class="mt-2 font-poppins text-3xl font-semibold text-white sm:text-4xl">{{ $service->name }}</h1>
        <div class="mt-4 flex items-center gap-3 text-sm text-white/85 sm:text-base">
            <span class="h-0.5 w-16 bg-amber-500"></span>
            <a href="{{ route('home') }}" class="hover:text-amber-300 text-2xl">Home</a>
            <span>-</span>
            <span class="text-2xl">Layanan {{ $service->name }}</span>
        </div>
    </div>
</section>

<section class="bg-white px-4 py-10 md:px-10 xl:px-20">
    <div class="mx-auto max-w-6xl">
        <div class="mb-6 flex items-end justify-between gap-4">
            <div>
                <h2 class="font-poppins text-2xl font-semibold text-stone-900">Galeri Layanan</h2>
                <p class="mt-1 text-sm text-stone-500">Lihat suasana dan fasilitas {{ $service->name }}.</p>
            </div>
        </div>

        <div class="block overflow-hidden lg:hidden">
            <div class="swiper swiper-detail-gallery">
                <div class="swiper-wrapper">
                    @foreach ($galleryImages as $gallery)
                        <div class="swiper-slide">
                            <img src="{{ 'storage/' . $gallery->image_url }}" alt="Galeri {{ $service->name }}" class="aspect-[4/3] w-full object-cover" draggable="false" onerror="this.src='/img/sendang.png'">
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>

        <div class="hidden grid-cols-4 gap-3 lg:grid">
            @foreach ($galleryImages->take(5) as $index => $gallery)
                <a href="{{ $gallery->image_url }}" class="glightbox overflow-hidden {{ $index === 0 ? 'col-span-2 row-span-2' : '' }}" data-gallery="service-gallery">
                    <img src="{{ $gallery->image_url }}" alt="Galeri {{ $service->name }}" class="h-full min-h-44 w-full object-cover transition-transform duration-300 hover:scale-105" onerror="this.src='/img/sendang.png'">
                </a>
            @endforeach
        </div>
    </div>
</section>

<section class="w-full bg-gray-50 px-4 py-4 md:px-10 md:py-20 xl:px-20">
    <div class="mx-auto grid max-w-6xl grid-cols-1 gap-10 lg:grid-cols-2 lg:gap-16">
        {{-- Tentang dan informasi layanan --}}
        <div data-aos="fade-right" data-aos-duration="800">
            <h2 class="mb-1 font-poppins text-2xl font-semibold text-black md:text-3xl">Tentang {{ $service->name }}</h2>
            <div class="mb-6 h-1 w-56 rounded-full bg-amber-500"></div>
            <p class="whitespace-pre-line font-dm text-sm leading-relaxed text-gray-600 md:text-base">{{ $service->description }}</p>

            <div class="mt-8 border-t border-gray-200 pt-5">
                <h3 class="font-poppins text-lg font-semibold text-black">Informasi Layanan</h3>
                <div class="mt-4 grid grid-cols-2 gap-4">
                    <div class="border-l-2 border-amber-500 pl-3">
                        <p class="text-xs font-medium uppercase tracking-wide text-gray-500">Mulai dari</p>
                        <p class="mt-1 font-poppins text-lg font-bold text-amber-600">Rp{{ number_format($service->price, 0, ',', '.') }}</p>
                    </div>
                    <div class="border-l-2 border-amber-500 pl-3">
                        <p class="text-xs font-medium uppercase tracking-wide text-gray-500">Durasi</p>
                        <p class="mt-1 font-poppins text-lg font-semibold text-gray-900">{{ $service->duration }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Fasilitas umum --}}
        <div data-aos="fade-left" data-aos-duration="800" data-aos-delay="200">
            <h2 class="mb-1 font-poppins text-2xl font-semibold text-black md:text-3xl">Fasilitas Umum</h2>
            <div class="mb-6 h-1 w-56 rounded-full bg-amber-500"></div>

            <div class="mt-6 flex items-start gap-3">
                <span class="mt-0.5 shrink-0 text-amber-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12h18M3 12V5.25A2.25 2.25 0 0 1 5.25 3h13.5A2.25 2.25 0 0 1 21 5.25V12M3 12v6.75A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V12"/><path stroke-linecap="round" stroke-linejoin="round" d="M9 16.5v.75m3-3v3m3-1.5v1.5"/></svg>
                </span>
                <div>
                    <h3 class="font-semibold leading-none text-black md:text-xl">Kamar Mandi</h3>
                    <p class="text-sm font-medium text-gray-500">Kamar mandi umum menyediakan fasilitas bersih dan nyaman.</p>
                </div>
            </div>

            <div class="mt-4 flex items-start gap-3">
                <span class="mt-0.5 shrink-0 text-amber-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75 9.75 9.75 0 0 1 8.25 6c0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 12c0 5.385 4.365 9.75 9.75 9.75 4.132 0 7.68-2.572 9.002-6.248Z"/></svg>
                </span>
                <div>
                    <h3 class="font-semibold leading-none text-black md:text-xl">Mushola</h3>
                    <p class="text-sm font-medium text-gray-500">Mushola menyediakan fasilitas ibadah bagi masyarakat.</p>
                </div>
            </div>

            <div class="mt-4 flex items-start gap-3">
                <span class="mt-0.5 shrink-0 text-amber-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75a6 6 0 0 0 6-6v-1.5m-6 7.5a6 6 0 0 1-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 0 1-3-3V4.5a3 3 0 1 1 6 0v8.25a3 3 0 0 1-3 3Z"/></svg>
                </span>
                <div>
                    <h3 class="font-semibold leading-none text-black md:text-xl">Karaoke</h3>
                    <p class="text-sm font-medium text-gray-500">Nikmati pengalaman bernyanyi yang seru di fasilitas karaoke kami.</p>
                </div>
            </div>

            <div class="mt-4 flex items-start gap-3">
                <span class="mt-0.5 shrink-0 text-amber-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8 4h8a2 2 0 0 1 2 2v2h1a2 2 0 0 1 2 2v6a2 2 0 0 1-2 2h-1v2a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2v-2H5a2 2 0 0 1-2-2v-6a2 2 0 0 1 2-2h1V6a2 2 0 0 1 2-2Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v8M8 12h8"/></svg>
                </span>
                <div>
                    <h3 class="font-semibold leading-none text-black md:text-xl">P3K</h3>
                    <p class="text-sm font-medium text-gray-500">Tersedia perlengkapan P3K untuk memberikan bantuan medis awal saat diperlukan.</p>
                </div>
            </div>
        </div>
    </div>
</section>

@if ($service->servicePackages->isNotEmpty())
<section class="w-full bg-white px-4 py-12 md:px-10 md:py-20 xl:px-20">
    <div class="mx-auto max-w-6xl">
        <div class="text-center">
            <h2 class="font-poppins text-2xl font-semibold text-black sm:text-3xl">Pilih Paket Layanan</h2>
            <p class="mt-2 text-sm text-gray-500 sm:text-base">Temukan paket {{ $service->name }} yang sesuai dengan kebutuhan liburanmu.</p>
            <div class="mx-auto mt-4 h-1 w-56 bg-amber-500"></div>
        </div>

        <div class="mt-10 grid grid-cols-1 items-stretch gap-6 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($service->servicePackages as $package)
                @php
                    $benefits = preg_split('/[\r\n,]+/', $package->benefit, -1, PREG_SPLIT_NO_EMPTY);
                    $whatsappNumber = preg_replace('/\D+/', '', $package->whatsapp_number);
                @endphp
                <article class="relative flex h-full flex-col rounded-2xl border-2 {{ $package->populer ? 'border-amber-500 shadow-lg shadow-amber-100' : 'border-gray-200 shadow-sm' }} bg-white p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl md:p-8">
                    @if ($package->populer)
                        <span class="absolute -top-3.5 left-1/2 inline-flex -translate-x-1/2 items-center gap-1 rounded-full bg-amber-500 px-4 py-1 text-xs font-bold uppercase tracking-wider text-white shadow-md">
                            <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14l-5-4.87 6.91-1.01L12 2Z" /></svg>
                            Terpopuler
                        </span>
                    @endif
                    <h3 class="mt-2 font-poppins text-lg font-bold text-black md:text-xl">{{ $package->title }}</h3>
                    <p class="mt-2 font-poppins text-2xl font-bold text-amber-500 md:text-3xl">Rp {{ number_format($package->price, 0, ',', '.') }}<span class="text-sm font-normal text-gray-400">/orang</span></p>

                    <ul class="mt-6 space-y-3">
                        @foreach ($benefits as $benefit)
                            <li class="flex items-start gap-2">
                                <svg class="mt-0.5 h-5 w-5 shrink-0 text-amber-500" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                                <span class="text-sm text-gray-600 font-dm">{{ trim($benefit) }}</span>
                            </li>
                        @endforeach
                    </ul>
                    @if ($whatsappNumber)
                        <a href="https://wa.me/{{ $whatsappNumber }}?text={{ rawurlencode($package->whatsapp_message) }}" target="_blank" rel="noopener" class="mt-8 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-amber-500 px-5 py-3 text-sm font-semibold text-white shadow-md shadow-amber-200 transition-all duration-200 hover:bg-amber-600">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.198.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347ZM12.05 21.785h-.01a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.981.999-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884h-.004ZM20.52 3.449A11.8 11.8 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c-.001 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.88 11.88 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.397l.056-.055Z" /></svg>
                            Pesan via WhatsApp
                        </a>
                    @endif
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
    <script>
        GLightbox({ selector: '.glightbox' });
    </script>
@endpush

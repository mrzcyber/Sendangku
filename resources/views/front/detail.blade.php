@extends('layouts.app')

@section('title', 'Detail — Wisata Sendang Kun Gerit')

@section('content')
    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    @endpush

    {{-- ═══════════════════════════════════════════════════════════════════════════
         1. HERO BANNER
         ═══════════════════════════════════════════════════════════════════════════ --}}
    <section
        class="w-full mt-10 relative bg-black">
        <div class="h-96 w-full">
            <img src="/img/sendang.png" alt="Background" class="w-full h-full object-cover object-bottom mb-52">
        </div>
        <div class="w-full h-full absolute flash top-0"></div>
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div 
            data-aos="fade-zoom-in"
            data-aos-easing="linear"
            data-aos-delay="500"
            data-aos-duration="1000"
            data-aos-offset="0"
            class="absolute w-full h-full flex flex-col justify-center top-0 px-10">
            <h1 class="text-4xl font-md font-semibold text-white uppercase text-shadow-2xs leading-relaxed">Layanan Berkuda</h1>
            <div class="flex flex-row gap-3">
                <div class="border-b-[3px] border-amber-500 z-10 w-20 mb-3"></div>
                <p class="text-xl font-md text-white capitalize text-shadow-2xs">home - layanan Berkuda</p>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════════════════════════════
         2. GALERI
         ═══════════════════════════════════════════════════════════════════════════ --}}
    <section class="w-full bg-white px-4 md:px-10 xl:px-20 flex flex-col py-10">

        {{-- ── Mobile / iPad: Swiper slider (hidden on lg+) ── --}}
        <div
            data-aos="fade-zoom-in"
            data-aos-easing="linear"
            data-aos-delay="500"
            data-aos-duration="1000"
            data-aos-offset="0"
            class="block lg:hidden detail-gallery-swiper-wrap rounded-xl overflow-hidden"
        >
            <div class="swiper swiper-detail-gallery">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="/img/sendang.png" alt="Galeri 1" draggable="false">
                    </div>
                    <div class="swiper-slide">
                        <img src="/img/sendang.png" alt="Galeri 2" draggable="false">
                    </div>
                    <div class="swiper-slide">
                        <img src="/img/sendang.png" alt="Galeri 3" draggable="false">
                    </div>
                    <div class="swiper-slide">
                        <img src="/img/sendang.png" alt="Galeri 4" draggable="false">
                    </div>
                    <div class="swiper-slide">
                        <img src="/img/sendang.png" alt="Galeri 5" draggable="false">
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>

        {{-- ── Desktop: original grid (hidden below lg) ── --}}
        <div class="w-full rounded-lg overflow-hidden hidden lg:flex flex-row gap-2">
            <a
                data-aos="fade-zoom-in"
                data-aos-easing="linear"
                data-aos-delay="0"
                data-aos-duration="1000"
                data-aos-offset="0"
                href="/img/sendang.png"
                class="w-xl glightbox h-[28rem] overflow-hidden"
            >
                <img src="/img/sendang.png" alt="galeri" class="w-full h-full object-center object-cover">
            </a>
              <div class="flex flex-col gap-2">
                    <a
                    data-aos="fade-zoom-in"
                    data-aos-easing="linear"
                    data-aos-delay="200"
                    data-aos-duration="1000"
                    data-aos-offset="0"
                    href="/img/sendang.png"
                    class="w-72 xl:w-[22rem] glightbox h-full overflow-hidden"
                >
                <img src="/img/sendang.png" alt="galeri" class="w-full h-full object-center object-cover">
                </a>
                <a
                    data-aos="fade-zoom-in"
                    data-aos-easing="linear"
                    data-aos-delay="400"
                    data-aos-duration="1000"
                    data-aos-offset="0"
                    href="/img/sendang.png"
                    class="w-72 xl:w-[22rem] glightbox h-full overflow-hidden"
                >
                    <img src="/img/sendang.png" alt="galeri" class="w-full h-full object-center object-cover">
                </a>
            </div>
            <div class="flex flex-col gap-2">
                <a
                data-aos="fade-zoom-in"
                data-aos-easing="linear"
                data-aos-delay="600"
                data-aos-duration="1000"
                data-aos-offset="0"
                href="/img/sendang.png"
                    class="w-72 xl:w-[22rem] glightbox h-full overflow-hidden"
                    >
                    <img src="/img/sendang.png" alt="galeri" class="w-full h-full object-center object-cover">
                </a>
                <a
                data-aos="fade-zoom-in"
                data-aos-easing="linear"
                data-aos-delay="800"
                data-aos-duration="1000"
                    data-aos-offset="0"
                    href="/img/sendang.png"
                    class="w-72 xl:w-[22rem] glightbox h-full overflow-hidden"
                >
                    <img src="/img/sendang.png" alt="galeri" class="w-full h-full object-center object-cover">
                </a>
            </div>

        </div>

    </section>

    {{-- ═══════════════════════════════════════════════════════════════════════════
         3. TENTANG & FASILITAS
         ═══════════════════════════════════════════════════════════════════════════ --}}
    <section class="w-full bg-gray-50 px-4 md:px-10 xl:px-20 py-4 md:py-20">
        <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16">

            {{-- Tentang --}}
            <div data-aos="fade-right" data-aos-duration="800">
                <h2 class="text-2xl md:text-3xl font-semibold font-poppins text-black mb-1">Tentang Layanan Berkuda</h2>
                <div class="w-56 h-1 rounded-full bg-amber-500 mb-6"></div>
                <p class="text-gray-600 font-dm leading-relaxed text-sm md:text-base">
                    Wisata Sendang Kun Gerit merupakan destinasi wisata alam terpadu yang berlokasi di Kabupaten
                    Tulungagung, Jawa Timur. Dengan mengusung konsep wisata keluarga, tempat ini menawarkan
                    pengalaman pemandian alami dengan air sumber yang jernih dan segar, dilengkapi fasilitas
                    waterboom yang seru untuk segala usia.
                </p>
                <p class="mt-4 text-gray-600 font-dm leading-relaxed text-sm md:text-base">
                    Selain berenang, pengunjung dapat menikmati beragam kuliner khas Nusantara di area resto dan
                    angkringan yang beroperasi hingga malam hari. Suasana alam yang asri dengan pepohonan rindang
                    menjadikan Sendang Kun Gerit tempat yang sempurna untuk bersantai bersama keluarga maupun teman.
                </p>
            </div>

            {{-- Fasilitas --}}
            <div data-aos="fade-left" data-aos-duration="800" data-aos-delay="200">
                <h2 class="text-2xl md:text-3xl font-semibold font-poppins text-black mb-1">Fasilitas Umum</h2>
                <div class="w-56 h-1 rounded-full bg-amber-500 mb-6"></div>

                {{-- Kamar Mandi --}}
                <div class="flex items-start gap-3 mt-6">
                    <span class="mt-0.5 shrink-0 text-amber-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 12h18M3 12V5.25A2.25 2.25 0 0 1 5.25 3h13.5A2.25 2.25 0 0 1 21 5.25V12M3 12v6.75A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V12"/>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 16.5v.75m3-3v3m3-1.5v1.5"/>
                        </svg>
                    </span>
                    <div>
                        <h3 class="font-semibold text-md md:text-xl text-black leading-none">Kamar Mandi</h3>
                        <p class="font-medium text-gray-500 text-sm">
                            Kamar mandi umum menyediakan fasilitas bersih dan nyaman
                        </p>
                    </div>
                </div>

                {{-- Mushola --}}
                <div class="flex items-start gap-3 mt-4">
                    <span class="mt-0.5 shrink-0 text-amber-500">
                        {{-- Moon / crescent --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75 9.75 9.75 0 0 1 8.25 6c0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 12c0 5.385 4.365 9.75 9.75 9.75 4.132 0 7.68-2.572 9.002-6.248Z"/>
                        </svg>
                    </span>
                    <div>
                        <h3 class="font-semibold text-md md:text-xl text-black leading-none">Mushola</h3>
                        <p class="font-medium text-gray-500 text-sm">
                            Mushola menyediakan fasilitas ibadah bagi masyarakat,
                        </p>
                    </div>
                </div>

                {{-- Karaoke --}}
                <div class="flex items-start gap-3 mt-4">
                    <span class="mt-0.5 shrink-0 text-amber-500">
                        {{-- Microphone --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 18.75a6 6 0 0 0 6-6v-1.5m-6 7.5a6 6 0 0 1-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 0 1-3-3V4.5a3 3 0 1 1 6 0v8.25a3 3 0 0 1-3 3Z"/>
                        </svg>
                    </span>
                    <div>
                        <h3 class="font-semibold text-md md:text-xl text-black leading-none">Karaoke</h3>
                        <p class="font-medium text-gray-500 text-sm">
                            Nikmati pengalaman bernyanyi yang seru di fasilitas karaoke kami.
                        </p>
                    </div>
                </div>
                {{-- p3k --}}
                <div class="flex items-start gap-3 mt-4">
                    <span class="mt-0.5 shrink-0 text-amber-500">
                        {{-- medis --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 4h8a2 2 0 0 1 2 2v2h1a2 2 0 0 1 2 2v6a2 2 0 0 1-2 2h-1v2a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2v-2H5a2 2 0 0 1-2-2v-6a2 2 0 0 1 2-2h1V6a2 2 0 0 1 2-2Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8v8M8 12h8" />
                        </svg>
                    </span>
                    <div>
                        <h3 class="font-semibold text-md md:text-xl text-black leading-none">P3K</h3>
                        <p class="font-medium text-gray-500 text-sm">
                            Tersedia perlengkapan P3K untuk memberikan bantuan medis awal saat diperlukan.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════════════════════════════
         4. PACKAGES
         ═══════════════════════════════════════════════════════════════════════════ --}}
    <section class="w-full bg-white px-4 md:px-10 xl:px-20 py-12 md:py-20" x-data="{ hoveredCard: null }">
        <div class="max-w-6xl mx-auto">

            {{-- Section heading --}}
            <div
                data-aos="fade-zoom-in"
                data-aos-easing="linear"
                data-aos-delay="0"
                data-aos-duration="1000"
                data-aos-offset="0"
            class="text-center mb-10 md:mb-14">
                <h2 class="text-2xl md:text-3xl font-semibold font-poppins text-black">Pilih Paket Wisata</h2>
                <p class="mt-2 text-sm md:text-base text-gray-500 font-dm">Temukan paket yang sesuai dengan kebutuhan liburanmu</p>
                <div class="mx-auto mt-4 w-56 h-1 bg-amber-500"></div>
            </div>

            {{-- Cards grid --}}
            <div
                data-aos="fade-zoom-in"
                data-aos-easing="linear"
                data-aos-delay="500"
                data-aos-duration="1000"
                data-aos-offset="0"
                class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 items-start"
            >

                {{-- ─── Card 1: Paket Hemat ─── --}}
                <div class="relative rounded-2xl border-2 border-gray-200 bg-white p-6 md:p-8 transition-all duration-300 shadow-sm hover:shadow-xl hover:-translate-y-1">
                    <h3 class="text-lg md:text-xl font-bold font-poppins text-black">Paket Hemat</h3>
                    <p class="mt-2 text-2xl md:text-3xl font-bold text-amber-500 font-poppins">Rp 15.000<span class="text-sm font-normal text-gray-400">/orang</span></p>

                    <ul class="mt-6 space-y-3">
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            <span class="text-sm text-gray-600 font-dm">Akses kolam pemandian</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            <span class="text-sm text-gray-600 font-dm">Fasilitas kamar mandi</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            <span class="text-sm text-gray-600 font-dm">Area parkir gratis</span>
                        </li>
                    </ul>

                    <a
                        href="https://wa.me/628XXXXXXXXXX?text=Halo%2C%20saya%20ingin%20memesan%20Paket%20Hemat%20Wisata%20Sendang%20Kun%20Gerit"
                        target="_blank"
                        rel="noopener"
                        class="mt-8 w-full inline-flex items-center justify-center gap-2 rounded-xl border-2 border-amber-500 bg-white px-5 py-3 text-sm font-semibold text-amber-600 font-dm transition-all duration-200 hover:bg-amber-500 hover:text-white"
                    >
                        {{-- WhatsApp icon --}}
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347ZM12.05 21.785h-.01a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.981.999-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884h-.004ZM20.52 3.449A11.8 11.8 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c-.001 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.88 11.88 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.397l.056-.055Z"/></svg>
                        Pesan via WhatsApp
                    </a>
                </div>

                {{-- ─── Card 2: Paket Seru (POPULAR) ─── --}}
                <div
                    class="relative rounded-2xl border-2 border-amber-500 bg-white p-6 md:p-8 shadow-lg shadow-amber-100 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1"
                >
                    {{-- Popular badge --}}
                    <span class="absolute -top-3.5 left-1/2 -translate-x-1/2 inline-flex items-center gap-1 rounded-full bg-amber-500 px-4 py-1 text-xs font-bold text-white font-poppins uppercase tracking-wider shadow-md">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14l-5-4.87 6.91-1.01L12 2Z"/></svg>
                        Terpopuler
                    </span>

                    <h3 class="mt-2 text-lg md:text-xl font-bold font-poppins text-black">Paket Seru</h3>
                    <p class="mt-2 text-2xl md:text-3xl font-bold text-amber-500 font-poppins">Rp 25.000<span class="text-sm font-normal text-gray-400">/orang</span></p>

                    <ul class="mt-6 space-y-3">
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            <span class="text-sm text-gray-600 font-dm">Akses kolam + waterboom</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            <span class="text-sm text-gray-600 font-dm">Makan siang 1 porsi</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            <span class="text-sm text-gray-600 font-dm">Fasilitas kamar mandi</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            <span class="text-sm text-gray-600 font-dm">Area parkir gratis</span>
                        </li>
                    </ul>

                    <a
                        href="https://wa.me/628XXXXXXXXXX?text=Halo%2C%20saya%20ingin%20memesan%20Paket%20Seru%20Wisata%20Sendang%20Kun%20Gerit"
                        target="_blank"
                        rel="noopener"
                        class="mt-8 w-full inline-flex items-center justify-center gap-2 rounded-xl bg-amber-500 px-5 py-3 text-sm font-semibold text-white font-dm transition-all duration-200 hover:bg-amber-600 shadow-md shadow-amber-200"
                    >
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347ZM12.05 21.785h-.01a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.981.999-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884h-.004ZM20.52 3.449A11.8 11.8 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c-.001 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.88 11.88 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.397l.056-.055Z"/></svg>
                        Pesan via WhatsApp
                    </a>
                </div>

                {{-- ─── Card 3: Paket Lengkap ─── --}}
                <div
                    class="relative rounded-2xl border-2 border-gray-200 bg-white p-6 md:p-8 hover:shadow-xl hover:-translate-y-1 transition-all duration-300"
                >
                    <h3 class="text-lg md:text-xl font-bold font-poppins text-black">Paket Lengkap</h3>
                    <p class="mt-2 text-2xl md:text-3xl font-bold text-amber-500 font-poppins">Rp 40.000<span class="text-sm font-normal text-gray-400">/orang</span></p>

                    <ul class="mt-6 space-y-3">
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            <span class="text-sm text-gray-600 font-dm">Akses kolam + waterboom</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            <span class="text-sm text-gray-600 font-dm">Makan siang + snack</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            <span class="text-sm text-gray-600 font-dm">Karaoke 1 jam</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            <span class="text-sm text-gray-600 font-dm">Area parkir gratis</span>
                        </li>
                    </ul>

                    <a
                        href="https://wa.me/628XXXXXXXXXX?text=Halo%2C%20saya%20ingin%20memesan%20Paket%20Lengkap%20Wisata%20Sendang%20Kun%20Gerit"
                        target="_blank"
                        rel="noopener"
                        class="mt-8 w-full inline-flex items-center justify-center gap-2 rounded-xl border-2 border-amber-500 bg-white px-5 py-3 text-sm font-semibold text-amber-600 font-dm transition-all duration-200 hover:bg-amber-500 hover:text-white"
                    >
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347ZM12.05 21.785h-.01a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.981.999-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884h-.004ZM20.52 3.449A11.8 11.8 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c-.001 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.88 11.88 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.397l.056-.055Z"/></svg>
                        Pesan via WhatsApp
                    </a>
                </div>

            </div>
        </div>
    </section>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
        <script>GLightbox();</script>
        <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
    @endpush

@endsection
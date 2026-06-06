<footer class="w-full bg-stone-900 relative overflow-hidden">

    {{-- Decorative top border --}}
    <div class="w-full h-1 bg-gradient-to-r from-amber-400 via-amber-500 to-amber-600"></div>

    {{-- Background texture circles --}}
    <div class="absolute -top-20 -left-20 w-72 h-72 rounded-full bg-amber-500/5 pointer-events-none"></div>
    <div class="absolute top-10 right-10 w-48 h-48 rounded-full bg-amber-500/5 pointer-events-none"></div>
    <div class="absolute -bottom-10 left-1/2 w-64 h-64 rounded-full bg-amber-500/3 pointer-events-none"></div>

    {{-- Main footer content --}}
    <div class="relative z-10 px-8 md:px-16 lg:px-20 pt-14 pb-8">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">

            {{-- ── Kolom 1: Brand & Sosmed ── --}}
            <div class="flex flex-col gap-5">
                <img src="/img/logo-2.png" alt="Logo Sendang Kun Gerit" class="w-36 object-contain">

                <p class="text-gray-400 text-sm leading-relaxed">
                    Wisata alam pemandian &amp; waterpark keluarga di jantung Sragen. Hadir untuk memberikan pengalaman liburan yang menyenangkan dan tak terlupakan.
                </p>

                {{-- Alamat --}}
                <div class="flex items-start gap-2.5">
                    <span class="text-amber-500 mt-0.5 shrink-0">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
                        </svg>
                    </span>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Jl. Raya Gemolong - Plupuh KM 3.5 Sidorejo, Kukun Gerit, Jatibatur, Gemolong, Sragen 57274
                    </p>
                </div>

                {{-- Jam Operasional --}}
                <div class="flex items-start gap-2.5">
                    <span class="text-amber-500 mt-0.5 shrink-0">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                    </span>
                    <div class="text-sm text-gray-400 leading-relaxed">
                        <p>Pemandian &amp; Waterboom: <span class="text-white font-medium">08.00 – 17.00</span></p>
                        <p>Resto &amp; Angkringan: <span class="text-white font-medium">17.00 – 23.00</span></p>
                        <p class="text-red-400/80 text-xs mt-1">Libur setiap Jumat Pahing</p>
                    </div>
                </div>

                {{-- Sosmed Icons --}}
                <div>
                    <p class="text-gray-500 text-xs uppercase tracking-widest mb-3">Ikuti Kami</p>
                    <div class="flex items-center gap-3">

                        {{-- WhatsApp --}}
                        <a href="https://wa.me/628XXXXXXXXXX"
                           target="_blank" rel="noopener"
                           class="w-9 h-9 rounded-full bg-stone-800 border border-stone-700 flex items-center justify-center text-gray-400 hover:text-white hover:bg-green-600 hover:border-green-600 transition-all duration-200"
                           aria-label="WhatsApp">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/>
                            </svg>
                        </a>

                        {{-- Instagram --}}
                        <a href="https://instagram.com/sendangkungerit"
                           target="_blank" rel="noopener"
                           class="w-9 h-9 rounded-full bg-stone-800 border border-stone-700 flex items-center justify-center text-gray-400 hover:text-white hover:bg-gradient-to-br hover:from-purple-600 hover:to-pink-500 hover:border-pink-500 transition-all duration-200"
                           aria-label="Instagram">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/>
                            </svg>
                        </a>

                        {{-- Facebook --}}
                        <a href="https://facebook.com/sendangkungerit"
                           target="_blank" rel="noopener"
                           class="w-9 h-9 rounded-full bg-stone-800 border border-stone-700 flex items-center justify-center text-gray-400 hover:text-white hover:bg-blue-600 hover:border-blue-600 transition-all duration-200"
                           aria-label="Facebook">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>

                        {{-- TikTok --}}
                        <a href="https://tiktok.com/@sendangkungerit"
                           target="_blank" rel="noopener"
                           class="w-9 h-9 rounded-full bg-stone-800 border border-stone-700 flex items-center justify-center text-gray-400 hover:text-white hover:bg-stone-600 hover:border-stone-500 transition-all duration-200"
                           aria-label="TikTok">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.5 2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 0 0-.79-.05 6.34 6.34 0 0 0-6.34 6.34 6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.33-6.34V8.69a8.18 8.18 0 0 0 4.78 1.52V6.75a4.85 4.85 0 0 1-1.01-.06z"/>
                            </svg>
                        </a>

                        {{-- Email --}}
                        <a href="mailto:info@sendangkungerit.com"
                           class="w-9 h-9 rounded-full bg-stone-800 border border-stone-700 flex items-center justify-center text-gray-400 hover:text-white hover:bg-amber-500 hover:border-amber-500 transition-all duration-200"
                           aria-label="Email">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/>
                            </svg>
                        </a>

                    </div>
                </div>
            </div>

            {{-- ── Kolom 2: Navigasi ── --}}
            <div class="flex flex-col gap-4">
                <h3 class="text-white font-semibold text-sm uppercase tracking-widest">
                    Halaman Lainnya
                </h3>
                <ul class="flex flex-col gap-2">
                    @foreach([
                        ['/', 'Home'],
                        ['/fasilitas', 'Fasilitas'],
                        ['/paket', 'Paket Wisata'],
                        ['/event', 'Event'],
                        ['/layanan', 'Layanan'],
                        ['/resto', 'Menu Resto'],
                        ['/blog', 'Blog'],
                        ['/tiket', 'Beli Tiket'],
                    ] as [$href, $label])
                    <li>
                        <a href="{{ $href }}"
                           class="flex items-center gap-2 text-gray-400 text-sm hover:text-amber-400 transition-colors duration-150 group">
                            <span class="w-1 h-1 rounded-full bg-amber-500/40 group-hover:bg-amber-400 transition-colors"></span>
                            {{ $label }}
                        </a>
                    </li>
                    @endforeach
                </ul>

                {{-- Divider + Kontak --}}
                <div class="mt-2 pt-4 border-t border-stone-800 flex flex-col gap-3">
                    <h3 class="text-white font-semibold text-sm uppercase tracking-widest">Kontak</h3>

                    <a href="https://wa.me/628XXXXXXXXXX"
                       class="flex items-center gap-2 text-gray-400 text-sm hover:text-amber-400 transition-colors">
                        <svg class="w-4 h-4 text-amber-500 shrink-0" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/>
                        </svg>
                        +62 8XX XXXX XXXX
                    </a>

                    <a href="mailto:info@sendangkungerit.com"
                       class="flex items-center gap-2 text-gray-400 text-sm hover:text-amber-400 transition-colors">
                        <svg class="w-4 h-4 text-amber-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/>
                        </svg>
                        info@sendangkungerit.com
                    </a>
                </div>
            </div>

            {{-- ── Kolom 3: Peta ── --}}
            <div class="flex flex-col gap-4">
                <h3 class="text-white font-semibold text-sm uppercase tracking-widest">Peta Lokasi</h3>

                <div class="w-full rounded-xl overflow-hidden ring-1 ring-stone-700">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.4473745474565!2d110.85170677518413!3d-7.415637592594746!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a0f0e4de2c921%3A0xb3e808e6b680b3a!2sWisata%20Sendang%20Kun%20Gerit!5e0!3m2!1sid!2sid!4v1780739232083!5m2!1sid!2sid"
                        width="100%" height="220"
                        style="border:0; display:block;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Peta lokasi Wisata Sendang Kun Gerit">
                    </iframe>
                </div>

                <a href="https://maps.google.com/?q=Wisata+Sendang+Kun+Gerit"
                   target="_blank" rel="noopener"
                   class="flex items-center justify-center gap-2 w-full py-2.5 rounded-lg border border-amber-500/40 text-amber-400 text-sm font-medium hover:bg-amber-500/10 transition-colors duration-150">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
                    </svg>
                    Buka di Google Maps
                </a>
            </div>

        </div>

        {{-- ── Bottom Bar ── --}}
        <div class="border-t border-stone-800 pt-6 flex flex-col md:flex-row items-center justify-between gap-3">
            <p class="text-gray-600 text-xs text-center md:text-left">
                &copy; {{ date('Y') }} Wisata Sendang Kun Gerit. Hak cipta dilindungi.
            </p>
            <p class="text-gray-700 text-xs">
                Dibuat dengan ❤️ untuk wisata lokal Indonesia
            </p>
        </div>

    </div>
</footer>
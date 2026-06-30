<section
id="tiket"
class="w-full  flex flex-col {{request()->is('/') ? 'bg-white' :'bg-white' }} items-center relative xl:px-20 px-4 py-8 md:py-16 ">
@if (request()->is('/'))
    
{{-- <div class="absolute opacity-40 inset-0">
    <div class="absolute inset-0 "></div>
    
    <div class="absolute inset-0 bg-black opacity-25"></div>
</div > --}}
@endif
        <div
    data-aos="fade-zoom-in"
     data-aos-easing="linear"
     data-aos-duration="700"
     data-aos-offset="0"
        class="flex flex-col items-center">

            <h1 class="text-lg md:text-3xl font-semibold font-poppins  text-amber-600 mb-1 z-10 uppercase">Ayo Pilih Tiketmu </h1>
            <p class="text-[13px] md:text-lg text-center  font-medium font-md  text-gray-500 capitalize z-10 mb-2"> kami memiliki 2 opsi tiket yang menarik dengan harga yang terjangkau</p>
            <div class="border-b-2 border-amber-500 w-64 z-10 "></div>
        </div>


    <div class="w-full flex flex-col md:flex-row gap-4 lg:gap-10 justify-center z-10">
        
<div
    data-aos="fade-zoom-in"
     data-aos-easing="linear"
     data-aos-delay="0"
     data-aos-duration="1000"
     data-aos-offset="0"
class="w-full max-w-lg flex flex-col mt-14 md:mt-24 z-10">

    {{-- ── Jam Operasional ── --}}
    <h2 class="text-xl md:text-3xl font-semibold text-amber-500 mb-4">Jam Operasional Kami</h2>

    <div class="flex flex-col gap-2">

        {{-- Pemandian & Waterboom --}}
        <div class="flex items-start gap-3">
            <span class="mt-0.5 shrink-0 text-amber-500">
                {{-- Waves / water --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 15c1.5 0 1.5-1.5 3-1.5S8.5 15 10 15s1.5-1.5 3-1.5S14.5 15 16 15s1.5-1.5 3-1.5S20.5 15 21 15"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 19c1.5 0 1.5-1.5 3-1.5S8.5 19 10 19s1.5-1.5 3-1.5S14.5 19 16 19s1.5-1.5 3-1.5S20.5 19 21 19"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 3v1m0 0a4 4 0 0 1 4 4H8a4 4 0 0 1 4-4Z"/>
                </svg>
            </span>
            <div>
                <p class="font-semibold text-md md:text-xl text-black leading-none">Pemandian &amp; Waterboom</p>
                <p class="text-gray-500 text-sm font-medium">08:00 – 17:00 WIB</p>
            </div>
        </div>

        {{-- Resto & Angkringan --}}
        <div class="flex items-start gap-3">
            <span class="mt-0.5 shrink-0 text-amber-500">
                {{-- Utensils / fork-knife --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 3v7a4 4 0 0 0 4 4h0a4 4 0 0 0 4-4V3"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M7 14v7M16 3v18M16 3a4 4 0 0 1 4 4v1h-4"/>
                </svg>
            </span>
            <div>
                <p class="font-semibold text-md md:text-xl text-black leading-none">
                    Resto &amp; Angkringan
                    <span class="text-sm font-medium text-amber-600 ml-1">(Free Tiket)</span>
                </p>
                <p class="text-gray-500 text-sm font-medium">17:00 – 23:00 WIB</p>
            </div>
        </div>

        {{-- Libur Operasional --}}
        <div class="flex items-start gap-3">
            <span class="mt-0.5 shrink-0 text-red-400">
                {{-- Calendar X --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.75 3v2.25M17.25 3v2.25M3 7.5h18M3 18.75A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V7.5H3v11.25Z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="m10 13 4 4m0-4-4 4"/>
                </svg>
            </span>
            <div>
                <p class="font-semibold text-md md:text-xl text-black leading-none">Libur Operasional</p>
                <p class="text-gray-500 text-sm font-medium">Setiap Jumat Pahing</p>
            </div>
        </div>

    </div>

    {{-- ── Fasilitas Umum ── --}}
    <div class="w-full flex flex-col mt-3 border-t border-gray-300 pt-3 gap-2">

        <h2 class="text-xl md:text-3xl font-semibold text-amber-500 mb-1">Fasilitas Umum</h2>

        {{-- Kamar Mandi --}}
        <div class="flex items-start gap-3">
            <span class="mt-0.5 shrink-0 text-amber-500">
                {{-- Door / shower --}}
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
        <div class="flex items-start gap-3">
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
        <div class="flex items-start gap-3">
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

    </div>

</div>


    <div
    data-aos="fade-zoom-in"
     data-aos-easing="linear"
     data-aos-delay="500"
     data-aos-duration="1000"
     data-aos-offset="0"
    class="w-full max-w-xl justify-center md:gap-2 lg:gap-5 flex flex-col md:flex-row  md:mt-20 z-10">


                {{-- ────────────────────────────────────────────
             TIKET NORMAL
        ──────────────────────────────────────────── --}}
        <div class="rounded-[20px] overflow-hidden border border-gray-300 bg-gray-50 relative scale-90 md:scale-100" >
 
            {{-- Header --}}
            <div class="ticket-header-deco relative overflow-hidden px-7 pt-7 pb-6
                        bg-gradient-to-br from-gray-500 to-gray-700">
                <p class="text-[11px] font-semibold tracking-[2px] uppercase text-white/70 mb-1">
                    Tiket
                </p>
                <p class="text-2xl font-bold text-white mb-1">Normal</p>
                <p class="text-xs text-white/60">Akses wahana pilihan</p>
            </div>
 
            {{-- Tear line --}}
            <div class="flex items-center px-2.5 bg-gray-50 mt-2">
                <div class="w-5 h-5 rounded-full bg-white border border-gray-300 shrink-0"></div>
                <div class="tear-dashes-gray flex-1 mx-1"></div>
                <div class="w-5 h-5 rounded-full bg-white border border-gray-300 shrink-0"></div>
            </div>
 
            {{-- Body --}}
            <div class="px-7 pt-5 pb-7 bg-gray-50">
 
                {{-- Harga --}}
                <p class="text-[11px] font-medium text-gray-500 mb-1">Mulai dari</p>
                <div class="flex items-baseline gap-1 mb-5">
                    <span class="text-3xl font-bold text-gray-700 leading-none">Rp 25.000</span>
                    <span class="text-xs text-stone-400">/ orang</span>
                </div>
 
                {{-- Feature list --}}
                <ul class="flex flex-col gap-2.5 mb-6">
                    @foreach([
                         'Kolam Pemandian',
                    ] as $feat)
                    <li class="flex items-center gap-2.5 text-[13px] text-stone-700">
                        <span class="w-[18px] h-[18px] rounded-full bg-gray-200 text-gray-700
                                     flex items-center justify-center text-[10px] shrink-0">
                            ✓
                        </span>
                        {{ $feat }}
                    </li>
                    @endforeach
                </ul>
 
                {{-- CTA --}}

                    <a href="/"
                       class="cta-lift block w-full py-3.5 rounded-xl text-sm font-semibold
                              text-center bg-gray-500 text-white transition duration-150">
                        Beli Tiket Normal
                    </a>

            </div>
        </div>
 
        {{-- ────────────────────────────────────────────
             TIKET TERUSAN
        ──────────────────────────────────────────── --}}
        <div class="rounded-[20px] overflow-hidden border-2 border-amber-500 scale-90 md:scale-100
                    bg-[#FFF8E1] relative ring-4 ring-amber-500/20">
 
            {{-- Badge --}}
            <span class="absolute top-4 right-4 z-10 bg-[#FFF8E1] text-amber-800
                         text-[10px] font-bold tracking-[1px] uppercase
                         px-2.5 py-1 rounded-full">
                Terpopuler ✦
            </span>
 
            {{-- Header --}}
            <div class="ticket-header-deco relative overflow-hidden px-7 pt-7 pb-6
                        bg-gradient-to-br from-amber-500 to-amber-700">
                <p class="text-[11px] font-semibold tracking-[2px] uppercase text-white/70 mb-1">
                    Tiket
                </p>
                <p class="text-2xl font-bold text-white mb-1">Terusan</p>
                <p class="text-xs text-white/60">Akses semua wahana &amp; fasilitas</p>
            </div>
 
            {{-- Tear line --}}
            <div class="flex items-center mt-2 px-2.5 bg-[#FFF8E1]">
                <div class="w-5 h-5 rounded-full bg-[#EBEBEB] border border-amber-400 shrink-0"></div>
                <div class="tear-dashes-amber flex-1 mx-1"></div>
                <div class="w-5 h-5 rounded-full bg-[#EBEBEB] border border-amber-400 shrink-0"></div>
            </div>
 
            {{-- Body --}}
            <div class="px-7 pt-5 pb-7 bg-[#FFF8E1]">
 
                {{-- Harga --}}
                <p class="text-[11px] font-medium text-amber-800 mb-1">Mulai dari</p>
                <div class="flex items-baseline gap-1 mb-5">
                    <span class="text-3xl font-bold text-amber-800 leading-none">Rp 50.000</span>
                    <span class="text-xs text-stone-400">/ orang</span>
                </div>
 
                {{-- Feature list --}}
                <ul class="flex flex-col gap-2.5 mb-6">
                    @foreach([
                        
                        'Kolam Pemandian',
                        'Wahana Waterboom',
                        'Terapi Ikan'

                    ] as $feat)
                    <li class="flex items-center gap-2.5 text-[13px] text-stone-700">
                        <span class="w-[18px] h-[18px] rounded-full bg-amber-200 text-amber-800
                                     flex items-center justify-center text-[10px] shrink-0">
                            ✓
                        </span>
                        {{ $feat }}
                    </li>
                    @endforeach
                </ul>
 
                {{-- CTA --}}

                    <a href="/"
                       class="cta-lift block w-full py-3.5 rounded-xl text-sm font-semibold
                              text-center bg-amber-600 text-amber-900 transition duration-150">
                        Beli Tiket Terusan
                    </a>


 

            </div>
        </div>
 
    </div>

    </div>

</section>
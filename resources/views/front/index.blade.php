@extends('layouts.app')

@section('title', 'Test Page')

@section('content')
<section class=" relative h-[800px] flex items-end ">
    <div class="absolute  inset-0">
        <img src="img/sendang.png" alt="Background Image" class="w-full h-full object-cover bg-center bg-no-repeat">
         <div class="absolute inset-0 bg-black opacity-30"></div>
    <div class="absolute bottom-0 py-28 bg-gradient-to-t  w-full from-white to-transparent opacity-35 -mb-16 "></div>
    <div class="absolute left-0 top-0 w-full opacity-35 -ml-80  h-full bg-gradient-to-r    from-amber-600 to-transparent justify-end flex pt-28  "></div>
    </div>

   


    <div class=" mx-30 z-10 text-white mb-50">
        <h2 class="text-2xl font-md font-semibold  text-amber-600 ">Selamat Datang </h2>
        <h1 class="text-[38px] font-semibold font-poppins mb-4 leading-none">Wisata Sendang Kun Gerit</h1>
        <p class="text-lg font-dm w-[650px] mb-10 text-white/95 ">kelezatan kuliner dan kesegaran pemandian dalam satu destinasi wisata yang nyaman Perpaduan sempurna antara cita rasa istimewa dan pengalaman pemandian yang menyegarkan.</p>
                <a href="/tiket" class="font-dm text-[14px]  font-medium tracking-[0.07em] uppercase border border-amber-500/70 text-white px-4 py-2.5 bg-amber-600 hover:border-amber-600 hover:bg-amber-700 hover:text-white transition-all duration-200">
                Beli Tiket Sekarang
            </a>
    </div>

</section>

<section class="w-full pb-36  relative flex pt-40 justify-center bg-[#FFF8E1]">

        <div class="absolute opacity-40 inset-0">
        <img src="img/icon-bg.png" alt="Background Image" class="w-full h-full object-cover bg-center bg-no-repeat">
         <div class="absolute inset-0 bg-black opacity-15"></div>
        <div class="absolute bottom-0 py-28 bg-gradient-to-t  w-full from-amber-500/80  to-transparent  -mb-28 "></div>

    </div >


<div class="w-full justify-center flex flex-row gap-16 2xl:gap-20  z-10 ">


<div class="w-[520px] 2xl:w-[600px]  ml-20 relative ">
<div class="w-full h-[430px] rotate-[4deg] border-[10px] shadow-md shadow-black border-white ">
    <img src="img/sendang.png" alt="Icon 1" class="w-full h-full object-cover bg-center bg-no-repeat">
</div>

<div class="w-64 -rotate-[4deg] h-44  absolute -top-16 -right-10 overflow-hidden border-8 border-white shadow-md shadow-black ">
 <img src="img/sendang.png" alt="Icon 1" class="w-full h-full object-cover bg-center bg-no-repeat">
</div>    

<div class="w-64 -rotate-[4deg] h-44  absolute -bottom-16 -left-16 overflow-hidden border-8 border-white shadow-md shadow-black ">
 <img src="img/sendang.png" alt="Icon 1" class="w-full h-full object-cover bg-center bg-no-repeat">
</div>    

</div>


<div class=" flex flex-col justify-start pt-16   ">
<h2 class="text-xl font-normal font-poppins text-amber-500">Tentang </h2>
<h1 class="text-3xl font-normal font-poppins mb-4 leading-none">Wisata Sendang Kun Gerit</h1>
<p class="text-lg font-poppins max-w-xl mb-2">Wisata Sendang Kun Gerit adalah destinasi wisata yang menawarkan keindahan alam, kuliner lezat, dan pengalaman pemandian yang menyegarkan. Terletak di tengah pesona alam bumdes yang memukau, tempat ini menjadi pilihan ideal untuk bersantai, menikmati hidangan pilihan, dan merasakan kesegaran pemandian alami. <a href="/tentang" class="font-dm hover:text-black/80 text-xl text-gray-500 transition-colors">
                Selengkapnya Tentang Wisata Sendang Kun Gerit...
</a> </p>

<div class=" w-full mt-5 border-t border-gray-300  py-5  ">
    {{-- <h3 class="text-3xl font-medium font-poppins semibold mb-5">Kami Memiliki</h3> --}}
    <ul class="flex flex-row gap-5 list-none ">
    <li class="flex flex-col justify-center items-center text-amber-500"> <h3 class="text-3xl font-extrabold ">1000+</h3> <p class="text-lg font-medium text-gray-500  font-poppins"> Pengunjung Setiap Minggu </p> </li>
    <li class="flex flex-col justify-center items-center text-amber-500"> <h3 class="text-3xl font-extrabold ">7+</h3> <p class="text-lg font-medium text-gray-500  font-poppins"> Layanan Menarik </p> </li>
    <li class="flex flex-col justify-center items-center text-amber-500"> <h3 class="text-3xl font-extrabold ">5+</h3> <p class="text-lg font-medium text-gray-500  font-poppins"> Paket Wisata </p> </li>
    </ul>

</div>

</div>




</div>

    

</section>


<section class="w-full relative py-36 flex items-center justify-center flex-row  ">
    <div class="absolute  inset-0">
        <img src="img/sendang.png" alt="Background Image" class="w-full h-full object-cover bg-center bg-no-repeat">
         <div class="absolute inset-0 bg-amber-500 opacity-40"></div>
        <div class="absolute inset-0 bg-black opacity-75"></div>
    </div>

    <div class="z-10 max-w-2xl   text-white pl-20">
        <h1 class="text-3xl font-semibold font-poppins  text-amber-500 mb-3">Layanan Berkuda </h1>
        <h2 class="text-lg font-normal font-poppins mb-7 leading-">Latihan berkuda bermanfaat meningkatkan kekuatan otot, keseimbangan,membantu memperbaiki postur tubuh dan mengurangi stress</h2>
                        <a href="/tiket" class="font-dm text-[16px]  font-semibold shadow-md shadow-black  uppercase border border-amber-500/70 text-white px-4 py-2.5 bg-amber-600 hover:border-amber-600 hover:text-white transition-all duration-200">
               Selengkapnya
            </a>

    </div>

    <div class=" lg:max-w-3xl xl:max-w-4xl w-full z-10 relative flex flex-row gap-5 2xl:gap-10 pr-5 justify-end ">
        <div class="w-[200px] 2xl:w-[250px] h-[300px] 2xl:h-[350px] rounded-2xl overflow-hidden shadow-md scale-[115%] ">
                <img src="img/sendang.png" alt="Icon 1" class="w-full h-full object-cover bg-center bg-no-repeat ">
        </div>
        <div class="w-[200px] 2xl:w-[250px] h-[300px] 2xl:h-[350px] rounded-2xl overflow-hidden shadow-md ml-2 ">
                <img src="img/sendang.png" alt="Icon 1" class="w-full h-full object-cover bg-center bg-no-repeat">
        </div>
        <div class="w-[200px] 2xl:w-[250px] h-[300px] 2xl:h-[350px] rounded-2xl overflow-hidden shadow-md ">
                <img src="img/sendang.png" alt="Icon 1" class="w-full h-full object-cover bg-center bg-no-repeat">
        </div>

        <div class="absolute -bottom-24 pl-16 2xl:pl-36 w-full flex flex-row gap-4">
            <p class="w-5 h-5 px-5 py-5 border border-amber-500 flex justify-center items-center flex-row text-amber-500 font-semibold rounded-full"><</p>
            <p class="w-5 h-5 px-5 py-5 border border-amber-500 flex justify-center items-center flex-row text-amber-500 font-semibold rounded-full">></p>

        
        </div>

    </div>

</section>

<section class="w-full  flex flex-col py-24 items-center relative bg-[#FFF8E1]">

        <div class="absolute opacity-40 inset-0">
            <div class="absolute inset-0 bg-black opacity-15"></div>
            <img src="img/overlay-food.png" alt="Background Image" class="w-full h-full opacity-50 object-cover bg-center bg-no-repeat">
        </div >

    <h1 class="text-3xl font-semibold font-md  text-amber-500 mb-1 uppercase z-10">Menu Resto Sendang Kun Gerit</h1>
    <p class="text-lg font-medium font-md  text-gray-500 capitalize z-10">Kami menyajikan berbagai hidangan kuliner yang lezat dan menarik di resto kami</p>

    <div class="w-full flex flex-row gap-10 justify-center mt-16 z-10">
        <div class="flex flex-col justify-center items-center">
            <div class="w-64  ">
                <img src="img/food2.png" alt="Menu 1" class="w-full h-full object-cover object-center bg-no-repeat">
            </div>
            <h3 class="text-lg font-semibold font-poppins ">Ayam Goreng </h3>
            <p class="text-gray-500 font-medium font-poppins text-sm w-56 text-center">Ayam goreng dengan bumbu rahasia yang gurih dan renyah.</p>

        </div>
        <div class="flex flex-col justify-center items-center">
            <div class="w-64  ">
                <img src="img/food2.png" alt="Menu 1" class="w-full h-full object-cover object-center bg-no-repeat">
            </div>
            <h3 class="text-lg font-semibold font-poppins ">Ayam Goreng </h3>
            <p class="text-gray-500 font-medium font-poppins text-sm w-56 text-center">Ayam goreng dengan bumbu rahasia yang gurih dan renyah.</p>

        </div>
        <div class="flex flex-col justify-center items-center">
            <div class="w-64  ">
                <img src="img/food2.png" alt="Menu 1" class="w-full h-full object-cover object-center bg-no-repeat">
            </div>
            <h3 class="text-lg font-semibold font-poppins ">Ayam Goreng </h3>
            <p class="text-gray-500 font-medium font-poppins text-sm w-56 text-center">Ayam goreng dengan bumbu rahasia yang gurih dan renyah.</p>

        </div>

    </div>

    <a href="/" class="mt-16 z-10 bg-amber-500 shadow-md  hover:bg-amber-600 text-white font-bold py-2 px-4 font-poppins rounded-full">
        Lihat Menu Lainnya
    </a>

</section>

<section class="w-full  flex flex-col bg-[#FFF8E1]/80 items-center relative px-20 py-16 ">
        <div class="absolute opacity-40 inset-0">
            <div class="absolute inset-0 "></div>
            
                <div class="absolute inset-0 bg-black opacity-25"></div>
        </div >

    <h1 class="text-3xl font-semibold font-poppins  text-amber-500 mb-1 z-10">Ayo Pilih Tiketmu </h1>
    <p class="text-xl text-md font-normal text-gray-500  capitalize z-10"> kami memiliki 2 opsi tiket yang menarik dengan harga yang terjangkau  </p>
    <div class="w-full flex flex-row gap-10 justify-center z-10">
        
<div class="w-full max-w-lg flex flex-col  mt-24 z-10">

    {{-- ── Jam Operasional ── --}}
    <h2 class="text-3xl font-semibold text-amber-500 mb-4">Jam Operasional Kami</h2>

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
                <p class="font-semibold text-xl text-black leading-none">Pemandian &amp; Waterboom</p>
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
                <p class="font-semibold text-xl text-black leading-none">
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
                <p class="font-semibold text-xl text-black leading-none">Libur Operasional</p>
                <p class="text-gray-500 text-sm font-medium">Setiap Jumat Pahing</p>
            </div>
        </div>

    </div>

    {{-- ── Fasilitas Umum ── --}}
    <div class="w-full flex flex-col mt-3 border-t border-gray-300 pt-3 gap-2">

        <h2 class="text-3xl font-semibold text-amber-500 mb-1">Fasilitas Umum</h2>

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
                <h3 class="font-semibold text-xl text-black leading-none">Kamar Mandi</h3>
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
                <h3 class="font-semibold text-xl text-black leading-none">Mushola</h3>
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
                <h3 class="font-semibold text-xl text-black leading-none">Karaoke</h3>
                <p class="font-medium text-gray-500 text-sm">
                    Nikmati pengalaman bernyanyi yang seru di fasilitas karaoke kami.
                </p>
            </div>
        </div>

    </div>

</div>


    <div class="w-full max-w-xl justify-center  gap-5 flex flex-row mt-20 z-10">


                {{-- ────────────────────────────────────────────
             TIKET NORMAL
        ──────────────────────────────────────────── --}}
        <div class="rounded-[20px] overflow-hidden border border-gray-300 bg-gray-50 relative">
 
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
        <div class="rounded-[20px] overflow-hidden border-2 border-amber-500
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

    </div>


</section>


@endsection
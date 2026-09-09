@extends('layouts.app')

@section('title', 'Sendangku')

@section('content')
<section 
class=" relative xl:h-[800px] h-[800px] md:h-screen w-full flex xl:items-end items-center justify-center xl:justify-start  ">
    <div class="absolute  inset-0">
        <img src="img/sendang.png" alt="Background Image" class="w-full h-full object-cover bg-center bg-no-repeat">
         <div class="absolute inset-0 bg-black opacity-30"></div>
    <div class="absolute bottom-0 py-28 bg-gradient-to-t  w-full from-white to-transparent opacity-35 -mb-16 "></div>
    <div class="absolute left-0 top-0 w-full opacity-35 -ml-80  h-full bg-gradient-to-r    from-amber-600 to-transparent justify-end flex pt-28  "></div>
    </div>

        <div class="w-full h-full absolute flash"></div>
   


    <div
   data-aos="fade-zoom-in"
     data-aos-easing="linear"
     data-aos-delay="500"
     data-aos-duration="1000"
     data-aos-offset="0"
    class=" xl:px-30 w-full md:px-8 px-4 z-10 text-white xl:mb-36 mb-8 flex flex-col xl:items-start xl:justify-start items-center justify-center">
        <h2 class="md:text-2xl text-xl font-md font-semibold  text-amber-600 ">Selamat Datang </h2>
        <h1 class="md:text-[38px] text-[20px] font-semibold font-poppins md:mb-4 mb-2 leading-none">Wisata Sendang Kun Gerit</h1>
        <p class="md:text-lg text-sm font-dm xl:w-[650px] xl:mb-10 text-white/95 mb-3 text-center xl:text-start ">kelezatan kuliner dan kesegaran pemandian dalam satu destinasi wisata yang nyaman <span class="md:inline hidden ">Perpaduan sempurna antara cita rasa istimewa dan pengalaman pemandian yang menyegarkan.</span> </p>
                <a href="{{ route('checkout.ticket') }}" class="font-dm md:text-[14px]  text-[12px] scale-[80%] md:scale-100 font-medium tracking-[0.07em] uppercase border border-amber-500/70 text-white px-4 py-2.5 bg-amber-600 hover:border-amber-600 hover:bg-amber-700 hover:text-white transition-all duration-200">
                Beli Tiket Sekarang
            </a>
    </div>

</section>

<section 
id="tentang"
class="w-full md:pb-36 pb-10 pt-10  relative flex md:pt-40 justify-center bg-[#FFF8E1]/80">

        <div class="absolute inset-0">
        <img src="img/icon-bg.png" alt="Background Image" class="w-full h-full object-cover opacity-40 bg-center bg-no-repeat">
         {{-- <div class="absolute inset-0 bg-black opacity-"></div> --}}
        <div class="absolute bottom-0 py-28 bg-gradient-to-t  w-full from-amber-500/80  to-transparent  -mb-36 "></div>

    </div >


<div class="w-full justify-center flex flex-row gap-12 xl:gap-20  z-10 ">


<div
   data-aos="fade-zoom-in"
     data-aos-easing="ease-in-out"
     data-aos-delay="200"
     data-aos-duration="1000"
     data-aos-offset="0"
class="w-[520px] 2xl:w-[600px]  ml-20 relative hidden md:block">
<div class="w-full h-[430px] rotate-[4deg] border-[10px] shadow-md shadow-black border-white ">
    <img src="img/sendang.png" alt="Icon 1" class="w-full h-full object-cover bg-center bg-no-repeat">
</div>

<div 
   data-aos="fade-zoom-in"
     data-aos-easing="ease-in-out"
     data-aos-delay="1000"
     data-aos-duration="1500"
     data-aos-offset="0"
class="xl:w-64 w-44 -rotate-[4deg] h-44  absolute -top-16 -right-10 overflow-hidden border-8 border-white shadow-md shadow-black ">
 <img src="img/sendang.png" alt="Icon 1" class="w-full h-full object-cover bg-center bg-no-repeat">
</div>    

<div
   data-aos="fade-zoom-in"
     data-aos-easing="ease-in-out"
     data-aos-delay="1000"
     data-aos-duration="1500"
     data-aos-offset="0"
class="xl:w-64 w-44 -rotate-[4deg] h-44  absolute -bottom-16 -left-16 overflow-hidden border-8 border-white shadow-md shadow-black ">
 <img src="img/sendang.png" alt="Icon 1" class="w-full h-full object-cover bg-center bg-no-repeat">
</div>    

</div>


<div 
   data-aos="fade-zoom-in"
     data-aos-easing="ease-in-out"
     data-aos-delay="1000"
     data-aos-duration="1500"
     data-aos-offset="0"
class=" flex flex-col justify-start xl:pt-16 md:items-start items-center px-3 md:px-1  ">
<h2 class="text-xl md:font-normal font-semibold font-poppins text-amber-500 ">Tentang </h2>
<h1 class="xl:text-3xl md:text-2xl text-xl md:font-normal font-semibold font-poppins md:mb-3 leading-none">Wisata Sendang Kun Gerit</h1>
<div class="border-b-2 border-amber-500 w-52 md:w-64 mx-auto md:mx-0  mb-6 md:mb-4 mt-2 md:mt-1"></div>
<p class="xl:text-lg md:text-md text-sm font-poppins max-w-xl mb-2 md:text-start text-center leading-relaxed text-gray-600 ">Wisata Sendang Kun Gerit adalah destinasi wisata yang menawarkan keindahan alam, kuliner lezat, dan pengalaman pemandian yang menyegarkan. <span class="hidden md:inline">Terletak di tengah pesona alam bumdes yang memukau,</span>  tempat ini menjadi pilihan ideal untuk bersantai, menikmati hidangan pilihan, dan merasakan kesegaran pemandian alami.  <a href="/tentang" class="font-dm hover:text-black/80 md:text-xl text-md text-gray-800 transition-colors">
                Selengkapnya...
</a> </p>

<div class=" w-full mt-5 xl:border-t border-t-2 border-gray-300  py-5  ">
    <ul class="flex flex-row gap-5 list-none ">
    <li class="flex flex-col justify-center items-center text-amber-500"> <h3 class="md:text-3xl text-xl font-extrabold ">1000+</h3> <p class="md:text-lg font-medium text-gray-500  font-poppins text-center "> Pengunjung Setiap Minggu </p> </li>
    <li class="flex flex-col justify-center items-center text-amber-500"> <h3 class="md:text-3xl text-xl font-extrabold ">7+</h3> <p class="md:text-lg font-medium text-gray-500  font-poppins text-center"> Layanan Menarik </p> </li>
    <li class="flex flex-col justify-center items-center text-amber-500"> <h3 class="md:text-3xl text-xl font-extrabold ">5+</h3> <p class="md:text-lg font-medium text-gray-500  font-poppins text-center"> Paket Wisata </p> </li>
    </ul>

</div>

</div>




</div>

    

</section>

{{-- section layanan --}}

@if ($services->isNotEmpty())
<section
id="layanan"
    class="w-full relative py-12 sm:py-30 flex flex-col sm:flex-row items-center justify-center overflow-hidden gap-4 sm:gap-5"
    x-data="layananSection(@js($services))"
>
       

    {{-- Background --}}
    <div class="absolute inset-0">
            <div class="absolute inset-0 bg-cover bg-center bg-no-repeat bg-fixed" style="background-image: url('img/sendang.png');"></div>
        <div class="absolute inset-0 bg-amber-500 opacity-40"></div>
        <div class="absolute inset-0 bg-black opacity-75"></div>
    </div>

    {{-- Mobile --}}
    <div
    data-aos="fade-up"
    data-aos-easing="ease-in-out"
     data-aos-duration="1000"
    class="sm:hidden z-10 w-full px-6 text-center order-1 mb-6">
        <h1 class="text-xl font-semibold font-poppins text-amber-500 mb-1 uppercase transition-all duration-300"
            x-text="layanan[active].title"></h1>
        <div class="border-b-2 border-amber-500 w-32 mx-auto"></div>
    </div>

    {{--Desktop --}}
    <div 
    data-aos="fade-up"
    data-aos-easing="ease-in-out"
     data-aos-duration="1000"
    class="hidden sm:block z-10 w-full max-w-sm xl:max-w-lg text-white sm:ml-3  lg:ml-8 shrink-0 sm:order-1" style="min-height:220px; position:relative;">

        <template x-for="(item, i) in layanan" :key="i">
            <div
                x-show="active === i"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 translate-y-6 blur-sm"
                x-transition:enter-end="opacity-100 translate-y-0 blur-none"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 translate-y-0 blur-none"
                x-transition:leave-end="opacity-0 -translate-y-5 blur-sm"
                style="position:absolute; inset:0; display:none;"
                class="flex flex-col justify-center items-start"
            >
                <h1 class="xl:text-3xl text-2xl font-semibold font-poppins text-amber-500 mb-1 uppercase" x-text="item.title"></h1>
                <div class="border-b-2 border-amber-500 w-48 mb-4"></div>
                <p class="text-base font-normal mb-7 leading-relaxed text-gray-200" x-text="item.description"></p>
                <a
                    :href="item.href"
                    class="inline-block w-fit font-dm text-[14px] font-semibold shadow-md shadow-black uppercase
                           border border-amber-500/70 text-white px-4 py-2.5 bg-amber-600
                           hover:bg-amber-700 hover:border-amber-700 transition-all duration-200"
                >
                    Selengkapnya
                </a>
            </div>
        </template>

    </div>

    {{-- Swiper --}}
    <div 
        data-aos="fade-up"
    data-aos-easing="ease-in-out"
    data-aos-delay="300"
     data-aos-duration="1000"
    class="lg:max-w-2xl xl:max-w-3xl w-full z-10 px-2 sm:px-5 flex flex-col gap-4 sm:gap-8 overflow-x-hidden pt-2 sm:pt-5 order-2 sm:order-2">

        <div class="relative">
            {{-- Mobile --}}
            <button
                class="sm:hidden absolute left-1 top-1/2 -translate-y-1/2 z-20
                       w-8 h-8 rounded-full bg-black/40 backdrop-blur-sm
                       flex items-center justify-center text-white
                       active:scale-90 transition-all duration-200"
                @click="swiper?.slidePrev()"
            >
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"/>
                </svg>
            </button>

            <div class="swiper swiper-layanan w-full" x-ref="swiperLayanan">
                <div class="swiper-wrapper items-center">

                    <template x-for="(item, i) in layanan" :key="i">
                        <div
                            class="swiper-slide cursor-pointer"
                            :data-index="i"
                        >
                            <img :src="item.image" :alt="item.title" draggable="false">
                        </div>
                    </template>

                </div>
            </div>

            {{-- Mobile --}}
            <button
                class="sm:hidden absolute right-1 top-1/2 -translate-y-1/2 z-20
                       w-8 h-8 rounded-full bg-black/40 backdrop-blur-sm
                       flex items-center justify-center text-white
                       active:scale-90 transition-all duration-200"
                @click="swiper?.slideNext()"
            >
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                </svg>
            </button>
        </div>

        {{-- Desktop --}}
        <div class="hidden sm:flex flex-row gap-4 pl-2">
            <button
                x-ref="btnPrev"
                class="w-10 h-10 border border-amber-500 rounded-full flex items-center justify-center
                       text-amber-500 hover:bg-amber-500 hover:text-white transition-all duration-200 active:scale-90"
            >
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"/>
                </svg>
            </button>
            <button
                x-ref="btnNext"
                class="w-10 h-10 border border-amber-500 rounded-full flex items-center justify-center
                       text-amber-500 hover:bg-amber-500 hover:text-white transition-all duration-200 active:scale-90"
            >
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                </svg>
            </button>
        </div>

    </div>

    {{--  Mobile --}}
    <div 
            data-aos="fade-up"
    data-aos-easing="ease-in-out"
    data-aos-delay="600"
     data-aos-duration="1000"
    class="sm:hidden z-10 w-full px-6 text-center order-3">
        <p class="text-sm font-normal mb-4 leading-relaxed text-gray-200 transition-all duration-300"
           x-text="layanan[active].description"></p>
        <a :href="layanan[active].href"
           class="inline-block w-fit font-dm text-[13px] font-semibold shadow-md shadow-black uppercase
                  border border-amber-500/70 text-white px-4 py-2.5 bg-amber-600
                  hover:bg-amber-700 hover:border-amber-700 transition-all duration-200">
            Selengkapnya
        </a>
    </div>

</section>
@endif


{{-- section resto --}}

<section
id="resto"
class="w-full relative overflow-hidden bg-[#FFF8E1]/80 py-10 md:py-16 xl:px-20 md:px-10 px-3">

    <div class="absolute inset-0 opacity-35">
        <img src="img/icon-bg.png" alt="Background Image" class="w-full h-full object-cover bg-center bg-no-repeat">
        <div class="absolute inset-0 bg-white/50"></div>
        <div class="absolute top-0 py-24 bg-gradient-to-b w-full from-amber-500/40 to-transparent -mt-24"></div>
    </div>

    <div class="relative z-10 max-w-6xl mx-auto flex flex-col md:flex-row gap-8 xl:gap-14 items-center justify-center">
        <div
        data-aos="fade-right"
        data-aos-easing="ease-in-out"
        data-aos-duration="1000"
        class="flex flex-col md:items-start items-center md:text-start text-center md:w-1/2 lg:pl-2">
            <h2 class="text-xl md:font-normal font-semibold font-poppins text-amber-500">Resto &amp; Angkringan</h2>
            <h1 class="xl:text-3xl md:text-2xl text-xl md:font-normal font-semibold font-poppins md:mb-3 leading-tight">Kuliner Hangat Sendang Kun Gerit</h1>
            <div class="border-b-2 border-amber-500 w-56 md:mx-0 mx-auto mb-5 mt-2 md:mt-0"></div>
            <p class="xl:text-lg md:text-md text-sm font-poppins text-gray-600 leading-relaxed max-w-xl">
                Nikmati pilihan hidangan rumahan, camilan, dan minuman segar di area resto Sendang Kun Gerit. Setiap menu disiapkan untuk menemani waktu santai setelah berenang, berkumpul bersama keluarga, atau menikmati suasana malam di area angkringan. Dengan tempat yang nyaman dan pilihan rasa yang familiar.
            </p>

            <div id="tambahan" class="w-full max-w-xl mt-6 xl:border-t border-t-2 border-gray-300 py-5">
                <div class="flex flex-row flex-wrap md:flex-nowrap gap-4 justify-center md:justify-start items-center">
                    <div class="flex flex-col items-center md:items-start text-amber-500">
                        <h3 class="md:text-2xl text-xl font-extrabold leading-none ">30+</h3>
                        <p class="md:text-[16px] font-medium text-gray-500 font-poppins text-center md:text-start mt-1">Menu Lezat</p>
                    </div>
                    <div class="flex flex-col items-center md:items-start text-amber-500">
                        <h3 class="md:text-2xl text-xl font-extrabold leading-none ">10+</h3>
                        <p class="md:text-[16px] font-medium text-gray-500 font-poppins text-center md:text-start mt-1">Minuman</p>
                    </div>
                    <div class="flex flex-col items-center md:items-start text-amber-500">
                        <h3 class="md:text-2xl text-xl font-extrabold leading-none ">5+</h3>
                        <p class="md:text-[16px] font-medium text-gray-500 font-poppins text-center md:text-start mt-1">Paket Menarik</p>
                    </div>
                    <div class="w-full md:w-auto hidden lg:flex justify-center md:justify-start md:ml-2">
                        <a href="https://wa.me/628XXXXXXXXXX?text=Halo%2C%20saya%20ingin%20pesan%20menu%20Resto%20Sendang%20Kun%20Gerit" class="w-fit font-dm text-[12px] lg:text-[13px] font-semibold tracking-[0.07em] uppercase border border-amber-500/70 text-white px-4 py-2.5 bg-amber-600 hover:border-amber-600 hover:bg-amber-700 hover:text-white transition-all duration-200">
                            Pesan Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div
        data-aos="fade-left"
        data-aos-easing="ease-in-out"
        data-aos-delay="200"
        data-aos-duration="1000"
        class="relative w-full md:w-1/2 max-w-[460px] mx-auto md:block hidden">
            <div class="w-full h-[330px] xl:h-[360px] -rotate-[3deg] border-[10px] shadow-md shadow-black border-white overflow-hidden bg-white">
                <img src="img/food2.png" alt="Menu Resto Sendang Kun Gerit" class="w-full h-full object-cover object-center">
            </div>

            <div
            data-aos="fade-zoom-in"
            data-aos-easing="ease-in-out"
            data-aos-delay="800"
            data-aos-duration="1200"
            class="xl:w-52 w-40 rotate-[5deg] xl:h-40 h-36 absolute -top-10 -right-6 overflow-hidden border-8 border-white shadow-md shadow-black bg-white">
                <img src="img/overlay-food.png" alt="Hidangan Resto Sendang Kun Gerit" class="w-full h-full object-cover object-center">
            </div>

            <div
            data-aos="fade-zoom-in"
            data-aos-easing="ease-in-out"
            data-aos-delay="900"
            data-aos-duration="1200"
            class="xl:w-52 w-40 rotate-[4deg] xl:h-40 h-36 absolute -bottom-12 -left-8 overflow-hidden border-8 border-white shadow-md shadow-black bg-white">
                <img src="img/food2.png" alt="Galeri Makanan Sendang Kun Gerit" class="w-full h-full object-cover object-right">
            </div>
        </div>

        <div
        data-aos="fade-up"
        data-aos-easing="ease-in-out"
        data-aos-delay="200"
        data-aos-duration="1000"
        class="md:hidden grid grid-cols-2 gap-3">
            <div class="col-span-2 h-56 overflow-hidden border-8 border-white shadow-md shadow-black bg-white">
                <img src="img/food2.png" alt="Menu Resto Sendang Kun Gerit" class="w-full h-full object-cover object-center">
            </div>
            <div class="h-36 overflow-hidden border-8 border-white shadow-md shadow-black bg-white">
                <img src="img/overlay-food.png" alt="Hidangan Resto Sendang Kun Gerit" class="w-full h-full object-cover object-center">
            </div>
            <div class="h-36 overflow-hidden border-8 border-white shadow-md shadow-black bg-white">
                <img src="img/food2.png" alt="Galeri Makanan Sendang Kun Gerit" class="w-full h-full object-cover object-right">
            </div>
        </div>
    </div>
</section>

{{-- section facilitas --}}


<section
id="fasilitas"
class="w-full relative overflow-hidden bg-[#FFF8E1]/80 py-10 md:py-16 xl:px-20 md:px-10 px-3">

    <div class="absolute inset-0 opacity-30">
        <img src="img/icon-bg.png" alt="Background Image" class="w-full h-full object-cover bg-center bg-no-repeat">
        <div class="absolute inset-0 bg-white/70"></div>
        <div class="absolute bottom-0 py-24 bg-gradient-to-t w-full from-amber-500/40 to-transparent -mb-24"></div>
    </div>

    <div class="relative z-10 max-w-6xl mx-auto">
        <div
        data-aos="fade-zoom-in"
        data-aos-easing="linear"
        data-aos-duration="1000"
        data-aos-offset="0"
        class="text-center mb-8 md:mb-10">
            <h1 class="text-xl md:text-3xl text-amber-600 font-poppins font-semibold uppercase mb-1">Fasilitas Sendang Kun Gerit</h1>
            <p class="text-[13px] md:text-lg font-medium font-md text-gray-500 capitalize max-w-2xl mx-auto">Fasilitas pendukung yang tersedia untuk membuat kunjunganmu lebih nyaman.</p>
            <div class="border-b-2 border-amber-500 w-64 mx-auto mt-3"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-[0.9fr_1.25fr] gap-5 md:gap-8 items-stretch">
            <div
            data-aos="fade-right"
            data-aos-easing="ease-in-out"
            data-aos-duration="1000"
            class="relative min-h-[330px] overflow-hidden shadow-md shadow-black/20">
                <img src="img/sendang.png" alt="Jam Operasional Sendang Kun Gerit" class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-black/70"></div>
                <div class="absolute inset-0 bg-amber-600/20"></div>

                <div class="relative z-10 h-full flex flex-col justify-end p-6 md:p-7 text-white">
                    <p class="text-amber-500 font-poppins font-semibold uppercase text-sm tracking-[0.08em] mb-1">Jam Operasional</p>
                    <h2 class="text-2xl md:text-3xl font-poppins font-semibold leading-tight mb-5">Waktu kunjungan</h2>

                    <div class="space-y-4">
                        <div class="border-t border-white/20 pt-4">
                            <h3 class="font-poppins font-semibold text-lg leading-tight">Pemandian &amp; Waterboom</h3>
                            <p class="text-gray-200 text-sm font-medium">08:00 - 17:00 WIB</p>
                        </div>

                        <div class="border-t border-white/20 pt-4">
                            <h3 class="font-poppins font-semibold text-lg leading-tight">Resto &amp; Angkringan <span class="text-amber-500 text-sm">(Free Tiket)</span></h3>
                            <p class="text-gray-200 text-sm font-medium">17:00 - 23:00 WIB</p>
                        </div>

                        <div class="border-t border-white/20 pt-4">
                            <h3 class="font-poppins font-semibold text-lg leading-tight">Libur Operasional</h3>
                            <p class="text-gray-200 text-sm font-medium">Setiap Jumat Pahing</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white/90 border border-amber-100 shadow-sm p-5 md:p-7">
                <div
                data-aos="fade-up"
                data-aos-easing="ease-in-out"
                data-aos-duration="1000"
                class="mb-5">
                    <h2 class="text-lg md:text-2xl font-poppins font-semibold text-black uppercase">Fasilitas Umum</h2>
                    <p class="text-sm md:text-base text-gray-500 font-medium mt-1">Empat fasilitas utama tersedia untuk kebutuhan dasar pengunjung selama berada di area wisata.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-5">
                    <div
                    data-aos="fade-up"
                    data-aos-easing="ease-in-out"
                    data-aos-delay="100"
                    data-aos-duration="900"
                    class="flex items-start gap-3 border-t border-gray-200 pt-4">
                        <span class="mt-0.5 w-10 h-10 shrink-0 flex items-center justify-center bg-amber-500 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75 9.75 9.75 0 0 1 8.25 6c0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 12c0 5.385 4.365 9.75 9.75 9.75 4.132 0 7.68-2.572 9.002-6.248Z"/>
                            </svg>
                        </span>
                        <div>
                            <h3 class="font-poppins font-semibold text-black text-md md:text-xl leading-tight">Mushola</h3>
                            <p class="font-medium text-gray-500 text-sm mt-1">Tempat ibadah yang mudah dijangkau oleh pengunjung.</p>
                        </div>
                    </div>

                    <div
                    data-aos="fade-up"
                    data-aos-easing="ease-in-out"
                    data-aos-delay="200"
                    data-aos-duration="900"
                    class="flex items-start gap-3 border-t border-gray-200 pt-4">
                        <span class="mt-0.5 w-10 h-10 shrink-0 flex items-center justify-center bg-amber-500 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75a6 6 0 0 0 6-6v-1.5m-6 7.5a6 6 0 0 1-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 0 1-3-3V4.5a3 3 0 1 1 6 0v8.25a3 3 0 0 1-3 3Z"/>
                            </svg>
                        </span>
                        <div>
                            <h3 class="font-poppins font-semibold text-black text-md md:text-xl leading-tight">Karaoke</h3>
                            <p class="font-medium text-gray-500 text-sm mt-1">Hiburan bernyanyi untuk momen santai bersama.</p>
                        </div>
                    </div>

                    <div
                    data-aos="fade-up"
                    data-aos-easing="ease-in-out"
                    data-aos-delay="300"
                    data-aos-duration="900"
                    class="flex items-start gap-3 border-t border-gray-200 pt-4">
                        <span class="mt-0.5 w-10 h-10 shrink-0 flex items-center justify-center bg-amber-500 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 4h8a2 2 0 0 1 2 2v2h1a2 2 0 0 1 2 2v6a2 2 0 0 1-2 2h-1v2a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2v-2H5a2 2 0 0 1-2-2v-6a2 2 0 0 1 2-2h1V6a2 2 0 0 1 2-2Z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v8M8 12h8"/>
                            </svg>
                        </span>
                        <div>
                            <h3 class="font-poppins font-semibold text-black text-md md:text-xl leading-tight">P3K</h3>
                            <p class="font-medium text-gray-500 text-sm mt-1">Perlengkapan bantuan awal untuk kondisi darurat ringan.</p>
                        </div>
                    </div>

                    <div
                    data-aos="fade-up"
                    data-aos-easing="ease-in-out"
                    data-aos-delay="400"
                    data-aos-duration="900"
                    class="flex items-start gap-3 border-t border-gray-200 pt-4">
                        <span class="mt-0.5 w-10 h-10 shrink-0 flex items-center justify-center bg-amber-500 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12h18M3 12V5.25A2.25 2.25 0 0 1 5.25 3h13.5A2.25 2.25 0 0 1 21 5.25V12M3 12v6.75A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V12"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 16.5v.75m3-3v3m3-1.5v1.5"/>
                            </svg>
                        </span>
                        <div>
                            <h3 class="font-poppins font-semibold text-black text-md md:text-xl leading-tight">Kamar Mandi</h3>
                            <p class="font-medium text-gray-500 text-sm mt-1">Fasilitas bilas dan kamar mandi umum yang nyaman.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- section villa --}}

<section
id="villa"
class="w-full relative flex flex-col items-center justify-center py-8 md:py-16 h-[550px] xl:px-20 md:px-10 px-3 overflow-hidden">

    <div class="absolute  inset-0">
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat bg-fixed" style="background-image: url('img/sendang.png');"></div>
         <div class="absolute inset-0 bg-amber-500 opacity-40"></div>
        <div class="absolute inset-0 bg-black opacity-85"></div>
    </div>
    
    <div 
    data-aos="fade-zoom-in"
     data-aos-easing="linear"
     data-aos-duration="1000"
     data-aos-offset="0"
    class="flex flex-col items-center text-center max-w-3xl mx-auto relative z-10" >
        <p class="text-sm md:text-lg font-poppins font-semibold uppercase tracking-[0.08em] text-amber-500 mb-1">Jelajahi Wisata</p>
        <h1 class="text-2xl md:text-4xl text-white font-poppins font-semibold mb-3 uppercase leading-tight"> Sendang Kun Gerit</h1>
        <div class="border-b-2 border-amber-500 w-64 mb-5"></div>
        <p class="text-[13px] md:text-lg font-medium font-md text-white/90 leading-relaxed mb-7 max-w-3xl">
            Nikmati suasana liburan yang tenang dan dekat dengan area wisata. Cocok untuk keluarga, rombongan kecil, atau pengunjung yang ingin bersantai di Sendang Kun Gerit.
        </p>
        <a href="{{ route('checkout.ticket') }}" class="font-dm text-[13px] md:text-[14px] font-semibold tracking-[0.07em] uppercase border border-amber-500/70 text-white px-5 py-2.5 bg-amber-600 hover:border-amber-600 hover:bg-amber-700 hover:text-white transition-all duration-200">
            Pesan Tiket
        </a>
    </div>




</section>


{{-- berita --}}

<section
id="berita"
class="w-full  flex flex-col py-10 items-center bg-[#FFF8E1]/70 relative px-3 lg:px-20">

        <div class="absolute  inset-0">
        <img src="img/icon-bg.png" alt="Background Image" class="w-full h-full object-cover opacity-40 bg-center bg-no-repeat">
         {{-- <div class="absolute inset-0 bg-black opacity-15"></div> --}}
        {{-- <div class="absolute bottom-0 py-28 bg-linear-to-t  w-full from-amber-500/80  to-transparent  -mb-28 "></div> --}}

    </div >
<div
    data-aos="fade-zoom-in"
     data-aos-easing="linear"
     data-aos-duration="1000"
     data-aos-offset="0"
class="flex flex-col items-center">
    <h1 class="text-xl md:text-2xl font-poppins font-semibold text-amber-600 uppercase z-10 ">Berita Dan Informasi</h1>
    <p class="text-[13px] text-center md:text-lg font-medium font-md  text-gray-500 capitalize z-10 mb-3">Kami memiliki berbagai macam acara dan promo yang menarik dan menyenangkan</p>
    <div class="border-b-2 border-amber-500 w-64 z-10 mb-10"></div>
</div>


<div
    data-aos="fade-zoom-in"
     data-aos-easing="linear"
     data-aos-duration="1000"
     data-aos-offset="0"
class="w-full max-w-6xl grid z-10 justify-center lg:gap-8 gap-5 grid-rows-1 md:grid-cols-3 items-stretch ">
    <div class="group flex flex-col overflow-hidden rounded-lg bg-transparent lg:w-full w-80 md:w-auto shrink-0">
        <div class="w-full h-56 overflow-hidden">
            <img src="img/sendang.png" alt="Berita wisata Sendang Kun Gerit" class="w-full h-full object-cover object-center transition-transform duration-500 group-hover:scale-105">
        </div>
        <div class="flex flex-col flex-1 p-5">
            <div class="flex items-center justify-between gap-3 text-[12px] font-poppins font-semibold uppercase tracking-[0.06em] text-amber-600 mb-3">
                <span>Berita &amp; Informasi</span>
                <span class="text-gray-400">12 Jan 2026</span>
            </div>
            <h2 class="text-lg md:text-xl font-semibold font-poppins text-black leading-snug mb-4">Sendang Kun Gerit Jadi Pilihan Wisata Keluarga</h2>
            <div class="border-b border-gray-200 mt-auto mb-4"></div>
            <a href="/tiket" class="w-fit font-dm text-[13px] font-semibold tracking-[0.07em] uppercase border border-amber-500 text-black px-4 py-2 hover:bg-amber-600 hover:text-white transition-all duration-200">
                Baca Selengkapnya
            </a>
        </div>
    </div>
    <div
    data-aos="fade-zoom-in"
     data-aos-easing="linear"
     data-aos-delay="500"
     data-aos-duration="1000"
     data-aos-offset="0"
     class="group flex flex-col overflow-hidden rounded-lg bg-transparent lg:w-full w-80 md:w-auto shrink-0">
        <div class="w-full h-56 overflow-hidden">
            <img src="img/food2.png" alt="Berita resto Sendang Kun Gerit" class="w-full h-full object-cover object-center transition-transform duration-500 group-hover:scale-105">
        </div>
        <div class="flex flex-col flex-1 p-5">
            <div class="flex items-center justify-between gap-3 text-[12px] font-poppins font-semibold uppercase tracking-[0.06em] text-amber-600 mb-3">
                <span>Kuliner</span>
                <span class="text-gray-400">18 Jan 2026</span>
            </div>
            <h2 class="text-lg md:text-xl font-semibold font-poppins text-black leading-snug mb-4">Menikmati Resto dan Angkringan di Area Sendang</h2>
            <div class="border-b border-gray-200 mt-auto mb-4"></div>
            <a href="/tiket" class="w-fit font-dm text-[13px] font-semibold tracking-[0.07em] uppercase border border-amber-500 text-black px-4 py-2 hover:bg-amber-600 hover:text-white transition-all duration-200">
                Baca Selengkapnya
            </a>
        </div>
    </div>
    <div
    data-aos="fade-zoom-in"
     data-aos-easing="linear"
     data-aos-delay="1000"
     data-aos-duration="1000"
     data-aos-offset="0"
    class="group flex flex-col overflow-hidden rounded-lg bg-transparent lg:w-full w-80 md:w-auto shrink-0 ">
        <div class="w-full h-56 overflow-hidden">
            <img src="img/sendang.png" alt="Berita fasilitas Sendang Kun Gerit" class="w-full h-full object-cover object-center transition-transform duration-500 group-hover:scale-105">
        </div>
        <div class="flex flex-col flex-1 p-5">
            <div class="flex items-center justify-between gap-3 text-[12px] font-poppins font-semibold uppercase tracking-[0.06em] text-amber-600 mb-3">
                <span>Fasilitas</span>
                <span class="text-gray-400">25 Jan 2026</span>
            </div>
            <h2 class="text-lg md:text-xl font-semibold font-poppins text-black leading-snug mb-4">Fasilitas Pendukung untuk Liburan Lebih Nyaman</h2>
            <div class="border-b border-gray-200 mt-auto mb-4"></div>
            <a href="/tiket" class="w-fit font-dm text-[13px] font-semibold tracking-[0.07em] uppercase border border-amber-500 text-black px-4 py-2 hover:bg-amber-600 hover:text-white transition-all duration-200">
                Baca Selengkapnya
            </a>
        </div>
    </div>
</div>
                   <a href="/tiket" class=" border-t border-amber-500 z-10  mx-2  font-dm text-[16px] mt-8  font-semibold tracking-[0.07em] uppercase text-black px-4 py-2 hover:text-amber-600 transition-all duration-200">
                Berita Lainnya
            </a>
</section>

@push('scripts')
{{-- ── Swiper JS ── --}}
<script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
 {{-- @vite('resources/js/swiper.js') --}}
    
@endpush

@push('styles')
    {{-- ── Swiper CSS ── --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
 @vite('resources/css/swiper.css')
@endpush



@endsection

@extends('layouts.app')

@section('title', 'layanan')

@section('content')
<section class="w-full mt-10 relative">
        <div class="h-64 md:h-96 w-full">
        <img src="/img/sendang.avif" alt="Background" class="w-full h-full object-cover object-bottom mb-52">
    </div>
       <div class="absolute inset-0 top-0 bg-black opacity-40"></div>
            <div class="w-full h-full top-0 absolute flash"></div>

    <div 
       data-aos="fade-zoom-in"
     data-aos-easing="linear"
     data-aos-delay="500"
     data-aos-duration="1000"
     data-aos-offset="0"
    class="absolute w-full h-full flex flex-col justify-center top-0 px-5 md:px-10 ">
        <h1 class="text-xl md:text-4xl font-md font-semibold text-white uppercase text-shadow-2xs leading-relaxed">Layanan sendang kun gerit</h1>
        <div class="flex flex-row gap-3">
            <div class="border-b-[3px] border-amber-500 z-10 w-10 md:w-20 mb-3"> </div>
            <p class=" text-md md:text-xl font-md text-white capitalize text-shadow-2xs ">home - layanan sendang kun gerit</p>
        </div>
    </div>
</section>

{{-- section content --}}

<section class="w-full  pt-10 pb-20 flex justify-center items-center ">
<div
            data-aos="fade-zoom-in"
                data-aos-easing="linear"
                data-aos-delay="0"
                data-aos-duration="1000"
                data-aos-offset="0"
class="w-full max-w-6xl px-5 xl:px-0 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-10">

@forelse ($services as $service)
<a href="{{ route('service.detail', $service) }}" class="h-[30rem] w-full overflow-hidden border-x border-b shadow-md hover:shadow-2xl rounded-2xl border-gray-300 transition-all duration-400 hover:-translate-y-1">
    <div class="w-full overflow-hidden h-60">
    <img src="{{ $service->thumbnail_url }}" alt="{{ $service->name }}" class="w-full h-full object-center object-cover" onerror="this.src='/img/sendang.avif'">
</div>


<div class="w-full h-full flex flex-col px-7 py-4  ">
<h1 class="font-poppins font-semibold text-amber-600 text-lg capitalize ">{{ $service->name }}</h1>
<div
class="flex flex-row gap-2 mt-2 -ml-2">
    @for ($i = 0; $i < 5; $i++)
        <x-star-icon />
    @endfor
</div>

<p class="line-clamp-2 mt-2 text-poppins font-normal text-md text-gray-600">{{ $service->description }}</p>

<div class="w-full border-t border-gray-300 mt-2 bg-gray-100 py-2 px-2 flex flex-row justify-between">
<div >
    <p class="text-gray-400 font-poppins ">Mulai dari</p>
    <p class="text-lg text-amber-600 font-semibold font-poppins pl-2">Rp{{ number_format($service->price, 0, ',', '.') }}</p>
</div>
<div class="flex flex-row items-center gap-2">

    <svg class="text-amber-600" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
  <line x1="12" y1="12" x2="12" y2="6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
  <line x1="12" y1="12" x2="17" y2="12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
</svg>
<p class="font-poppins text-gray-500 text-md font-normal ">{{ $service->duration }}</p>

</div>

</div>
</div>
</a>
@empty
<p class="col-span-full py-10 text-center text-gray-500">Belum ada layanan tersedia.</p>
@endforelse


</div>
</section>

{{-- section add --}}

<section
id="add"
class="w-full relative flex flex-col items-center justify-center py-8 md:py-16 h-[550px] xl:px-20 md:px-10 px-3 overflow-hidden">

    <div class="absolute  inset-0">
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat bg-fixed" style="background-image: url('img/sendang.avif');"></div>
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

{{-- section facilitas --}}


<section
id="fasilitas"
class="w-full relative overflow-hidden bg-[#FFF8E1]/80 py-10 md:py-16 xl:px-20 md:px-10 px-3">

    <div class="absolute inset-0 opacity-30">
        <img src="img/icon-bg.avif" alt="Background Image" class="w-full h-full object-cover bg-center bg-no-repeat">
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
                <img src="img/sendang.avif" alt="Jam Operasional Sendang Kun Gerit" class="absolute inset-0 w-full h-full object-cover">
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





@endsection

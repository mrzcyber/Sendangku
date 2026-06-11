@extends('layouts.app')

@section('title', 'layanan')

@section('content')
<section class="w-full mt-10 relative">
        <div class="h-96 w-full">
        <img src="img/sendang.png" alt="Background" class="w-full h-full object-cover object-bottom mb-52">
    </div>
       <div class="absolute inset-0 bg-black opacity-40"></div>

    <div class="absolute w-full h-full flex flex-col justify-center top-0 px-10 ">
        <h1 class="text-4xl font-md font-semibold text-white uppercase text-shadow-2xs leading-relaxed">Layanan sendang kun gerit</h1>
        <div class="flex flex-row gap-3">
            <div class="border-b-[3px] border-amber-500 z-10 w-20 mb-3"> </div>
            <p class="text-xl font-md text-white capitalize text-shadow-2xs ">home - layanan sendang kun gerit</p>
        </div>
    </div>


{{-- section content --}}
</section>
<section class="w-full  pt-10 pb-20 flex justify-center items-center ">
<div class=" xl:px-20  grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-10">

<a href="/" class="h-[30rem] w-[22rem] overflow-hidden border-x border-b  shadow-md hover:shadow-2xl rounded-2xl border-gray-300 transition-all duration-400 hover:-translate-y-1 ">
<div class="w-full overflow-hidden h-60">
    <img src="/img/sendang.png" alt="thumbnail" class="w-full h-full object-center object-cover">
</div>


<div class="w-full h-full flex flex-col px-7 py-4  ">
<h1 class="font-poppins font-semibold text-amber-600 text-lg capitalize ">layanan berkuda</h1>
<div class="flex flex-row gap-2 mt-2 -ml-2">
    @for ($i = 0; $i < 5; $i++)
        <x-star-icon />
    @endfor
</div>

<p class="line-clamp-2 mt-2 text-poppins font-normal text-md text-gray-600">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Lorem, ipsum. Necessitatibus, eligendi.</p>

<div class="w-full border-t border-gray-300 mt-2 bg-gray-100 py-2 px-2 flex flex-row justify-between">
<div >
    <p class="text-gray-400 font-poppins ">Mulai dari</p>
    <p class="text-lg text-amber-600 font-semibold font-poppins pl-2">Rp50.000</p>
</div>
<div class="flex flex-row items-center gap-2">

    <svg class="text-amber-600" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
  <line x1="12" y1="12" x2="12" y2="6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
  <line x1="12" y1="12" x2="17" y2="12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
</svg>
<p class="font-poppins text-gray-500 text-md font-normal ">4-5 Jam</p>

</div>

</div>
</div>
</a>
<a href="/" class="h-[30rem] w-[22rem] overflow-hidden border-x border-b  shadow-md hover:shadow-2xl rounded-2xl border-gray-300 transition-all duration-400 hover:-translate-y-1 ">
<div class="w-full overflow-hidden h-60">
    <img src="/img/sendang.png" alt="thumbnail" class="w-full h-full object-center object-cover">
</div>


<div class="w-full h-full flex flex-col px-7 py-4  ">
<h1 class="font-poppins font-semibold text-amber-600 text-lg capitalize ">layanan berkuda</h1>
<div class="flex flex-row gap-2 mt-2 -ml-2">
    @for ($i = 0; $i < 5; $i++)
        <x-star-icon />
    @endfor
</div>

<p class="line-clamp-2 mt-2 text-poppins font-normal text-md text-gray-600">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Lorem, ipsum. Necessitatibus, eligendi.</p>

<div class="w-full border-t border-gray-300 mt-2 bg-gray-100 py-2 px-2 flex flex-row justify-between">
<div >
    <p class="text-gray-400 font-poppins ">Mulai dari</p>
    <p class="text-lg text-amber-600 font-semibold font-poppins pl-2">Rp50.000</p>
</div>
<div class="flex flex-row items-center gap-2">

    <svg class="text-amber-600" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
  <line x1="12" y1="12" x2="12" y2="6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
  <line x1="12" y1="12" x2="17" y2="12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
</svg>
<p class="font-poppins text-gray-500 text-md font-normal ">4-5 Jam</p>

</div>

</div>
</div>
</a>
<a href="/" class="h-[30rem] w-[22rem] overflow-hidden border-x border-b  shadow-md hover:shadow-2xl rounded-2xl border-gray-300 transition-all duration-400 hover:-translate-y-1 ">
<div class="w-full overflow-hidden h-60">
    <img src="/img/sendang.png" alt="thumbnail" class="w-full h-full object-center object-cover">
</div>


<div class="w-full h-full flex flex-col px-7 py-4  ">
<h1 class="font-poppins font-semibold text-amber-600 text-lg capitalize ">layanan berkuda</h1>
<div class="flex flex-row gap-2 mt-2 -ml-2">
    @for ($i = 0; $i < 5; $i++)
        <x-star-icon />
    @endfor
</div>

<p class="line-clamp-2 mt-2 text-poppins font-normal text-md text-gray-600">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Lorem, ipsum. Necessitatibus, eligendi.</p>

<div class="w-full border-t border-gray-300 mt-2 bg-gray-100 py-2 px-2 flex flex-row justify-between">
<div >
    <p class="text-gray-400 font-poppins ">Mulai dari</p>
    <p class="text-lg text-amber-600 font-semibold font-poppins pl-2">Rp50.000</p>
</div>
<div class="flex flex-row items-center gap-2">

    <svg class="text-amber-600" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
  <line x1="12" y1="12" x2="12" y2="6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
  <line x1="12" y1="12" x2="17" y2="12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
</svg>
<p class="font-poppins text-gray-500 text-md font-normal ">4-5 Jam</p>

</div>

</div>
</div>
</a>


</div>
</section>

<x-ticket/>


@endsection
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

</section>

<section class="w-full h-screen">

</section>

@endsection
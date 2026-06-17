@extends('layouts.app')

@section('title', 'Checkout Ticket')

@section('content')
    <section class="w-full py-12 pt-28 md:py-20 md:pt-48 flex flex-col justify-center items-center px-4 sm:px-6 md:px-0">
        <h1 class="text-2xl sm:text-3xl md:text-4xl font-semibold font-poppins text-amber-600 uppercase mb-4 md:mb-8 text-center">beli tiket sekarang</h1>
        <form method="POST" action=""
                    x-data="{
    qtybiasa: 0,
    qtyterusan: 0,

    get total() {
        return (this.qtybiasa * 5000) + (this.qtyterusan * 12000)
        }}"
         class="shadow-md shadow-gray-500 rounded-2xl pt-4 sm:pt-6 pb-8 sm:pb-12 w-full max-w-3xl flex flex-col">
         @csrf
            <h2 class="text-poppins font-medium text-xl sm:text-2xl px-3 sm:px-4 mb-2 capitalize">sendangku</h2>
            <div class="w-full h-36 sm:h-60 overflow-hidden border-b border-gray-400 px-3 sm:px-4 pb-4">
                <img src="/img/sendang.png" alt="thumbnail" class="w-full h-full object-cover object-center ">
            </div>
            <h2 class="text-lg sm:text-2xl font-semibold text-amber-500 uppercase px-4 sm:px-6 py-2">ringkasan pembelian</h2>

            <div class="flex flex-col">
                
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center px-3 sm:px-4 border py-3 sm:py-2 mx-3 sm:mx-6 border-gray-400 gap-3 sm:gap-0">
                    
                    
                <div class="flex flex-col gap-1">
                    <h3 class="text-base sm:text-lg font-poppins font-semibold uppercase leading-none">tiket pemandian</h3>
                    <ul class="text-sm sm:text-mg text-gray-500 font-poppins list-disc pl-5 leading-none">
                        <li>Kolam Pemandian</li>
                    </ul>
                    <p class="text-base sm:text-lg text-amber-500 font-poppins font-bold leading-none">Rp5.000 <span class="text-gray-500 font-normal text-sm sm:text-md">/orang</span> </p>
                </div>
                
                
     <div class="flex items-center gap-0 w-fit self-end sm:self-auto" x-data="{ qty: 0 }">

    {{-- Minus --}}
    <button
        type="button"
        @click=" if(qty > 0){qty--; qtybiasa--; }"
        class="w-9 h-9 sm:w-10 sm:h-10 flex items-center justify-center border border-gray-300
               text-gray-600 hover:bg-amber-500 hover:text-white hover:border-amber-500
               transition-all duration-200 active:scale-95 rounded-l-lg"
    >
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14"/>
        </svg>
    </button>

    {{-- Input --}}
    <input
        type="number"
        x-model="qty"
        min="0"
        max="10"
        readonly
        class="w-12 sm:w-14 h-9 sm:h-10 text-center border-y border-gray-300 text-sm font-semibold
               text-stone-800 focus:outline-none focus:border-amber-500
               [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none
               [&::-webkit-inner-spin-button]:appearance-none"
               >
               
               {{-- Plus --}}
    <button
        type="button"
        @click=" if(qty < 10){qty++; qtybiasa++;}"
        class="w-9 h-9 sm:w-10 sm:h-10 flex items-center justify-center border border-gray-300
               text-gray-600 hover:bg-amber-500 hover:text-white hover:border-amber-500
               transition-all duration-200 active:scale-95 rounded-r-lg"
               >
               <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                   <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/>
                </svg>
    </button>
    

</div>
</div>


        
            <div class="flex flex-col sm:flex-row sm:justify-between px-3 sm:px-4 border mt-4 py-3 sm:py-2 mx-3 sm:mx-6 border-gray-400 gap-3 sm:gap-0">
                <div class="flex flex-col gap-1">
                    <h3 class="text-base sm:text-lg font-poppins font-semibold uppercase leading-none">tiket pemandian</h3> 
                    <ul class="text-sm sm:text-mg text-gray-500 font-dm list-disc flex flex-row flex-wrap gap-1 sm:gap-4 list-inside leading-tight sm:leading-none">
                        <li>Kolam Pemandian</li>
                        <li>Kolam Pemandian</li>
                        <li>Kolam Pemandian</li>
                    </ul>
                    <p class="text-base sm:text-lg text-amber-500 font-dm font-bold leading-none">Rp12.000 <span class="text-gray-500 font-normal text-sm sm:text-md">/orang</span> </p>
                </div>
                
    <div class="flex items-center gap-0 w-fit self-end sm:self-auto" x-data="{ qty: 0 }">

    {{-- Minus --}}
    <button
        type="button"
               @click=" if(qty > 0){qty--; qtyterusan-- ;}"
        class="w-9 h-9 sm:w-10 sm:h-10 flex items-center justify-center border border-gray-300
        text-gray-600 hover:bg-amber-500 hover:text-white hover:border-amber-500
        transition-all duration-200 active:scale-95 rounded-l-lg"
        >
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14"/>
        </svg>
    </button>
    
    {{-- Input --}}
    <input
    type="number"
        x-model="qty"
        min="0"
        max="10"
        readonly
        class="w-12 sm:w-14 h-9 sm:h-10 text-center border-y border-gray-300 text-sm font-semibold
        text-stone-800 focus:outline-none focus:border-amber-500
        [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none
        [&::-webkit-inner-spin-button]:appearance-none"
        >
        
        {{-- Plus --}}
        <button
        type="button"
               @click=" if(qty < 10){qty++; qtyterusan++;}"
        class="w-9 h-9 sm:w-10 sm:h-10 flex items-center justify-center border border-gray-300
        text-gray-600 hover:bg-amber-500 hover:text-white hover:border-amber-500
        transition-all duration-200 active:scale-95 rounded-r-lg"
        >
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/>
        </svg>
    </button>
    

</div>
</div>

<div class="flex flex-row gap-1 mx-3 sm:mx-6 mt-2">
<p class="text-sm sm:text-md font-poppins font-normal capitalize text-gray-600">total harga:</p>
<span x-text="total.toLocaleString('id-ID')" class="text-amber-500 font-poppins font-medium text-sm sm:text-base"></span>
</div>

</div>
    <div class="border-b-2 border-gray-500 mx-3 sm:mx-6 mt-4 sm:mt-6 mb-2"></div>
    
<label for="name" class="mx-3 sm:mx-6 font-medium font-poppins text-base sm:text-lg">Nama </label>
<input type="text" name="name" id="" placeholder="Nama Lengkap" required class="mx-3 sm:mx-6 text-sm font-poppins font-medium placeholder:text-gray-600 w-[calc(100%-1.5rem)] sm:w-[calc(100%-3rem)] max-w-96 border-2 border-gray-500 py-2 px-2 focus:outline-amber-500">

<label for="number" class="mx-3 sm:mx-6 font-medium font-poppins text-base sm:text-lg mt-2">Nomor  </label>
<input type="number"
@keydown="['e','E','+','-','.'].includes($event.key) && $event.preventDefault()"
name="number" id="" placeholder="Nomor Telepon" required class="mx-3 sm:mx-6 text-sm font-poppins font-medium no-spinner placeholder:text-gray-600 w-[calc(100%-1.5rem)] sm:w-[calc(100%-3rem)] max-w-96 border-2 border-gray-500 py-2 px-2 focus:outline-amber-500">

<label for="email" class="mx-3 sm:mx-6 font-medium font-poppins text-base sm:text-lg mt-2 -mb-1">Email  </label>
<input type="email" name="email" id="" placeholder="Email" required class="mx-3 sm:mx-6 text-sm font-poppins font-medium placeholder:text-gray-600 w-[calc(100%-1.5rem)] sm:w-[calc(100%-3rem)] max-w-96 border-2 border-gray-500 py-2 px-2 focus:outline-amber-500">
<p class="text-xs sm:text-sm text-gray-400 font-normal capitalize leading-none mx-3 sm:mx-6 italic mt-1">tiket akan dikirimkan ke email</p>

<label for="gender" class="mx-3 sm:mx-6 font-medium font-poppins text-base sm:text-lg mt-2">Gender</label>
<select name="gender" id="" class="w-[calc(100%-1.5rem)] sm:w-[calc(100%-3rem)] max-w-96 border-2 border-gray-500 py-2 px-2 mx-3 sm:mx-6 text-sm font-poppins font-medium text-gray-600">
    <option value="pria">Pria</option>
    <option value="wanita">Wanita</option>
</select>


<button  type="submit" :disabled="total === 0" class="disabled:opacity-50 disabled:cursor-not-allowed mx-3 sm:mx-6 py-2.5 sm:py-2 text-center items-center bg-amber-600 hover:bg-amber-700 text-white font-semibold font-poppins text-base sm:text-lg mt-6 sm:mt-8 rounded-lg sm:rounded-none transition-all duration-300"> Beli Sekarang </button>

</form>
    </section>
@endsection
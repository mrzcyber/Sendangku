@extends('layouts.app')

@section('title', 'Ticket Succes')

@section('content')
<section class="min-h-screen bg-[#FFFF] flex items-center justify-center px-4 py-20">

    <div class="w-full max-w-md flex flex-col items-center text-center">

        {{-- Animated checkmark --}}
        <div class="w-24 h-24 rounded-full bg-amber-100 border-4 border-amber-400 flex items-center justify-center mb-6 animate-bounce-once">
            <svg class="w-12 h-12 text-amber-500" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
            </svg>
        </div>

        {{-- Title --}}
        <h1 class="text-3xl font-bold font-poppins text-stone-800 mb-2">
            Pembayaran Berhasil!
        </h1>
        <p class="text-amber-600 font-semibold text-sm tracking-widest uppercase mb-6">
            Tiket telah aktif
        </p>

        {{-- Divider --}}
        <div class="w-16 h-1 rounded-full bg-amber-400 mb-6"></div>

        {{-- Info card --}}
        <div class="w-full bg-white border border-amber-200 rounded-2xl px-6 py-5 mb-6 text-left shadow-sm">

            <div class="flex items-start gap-3 mb-4">
                <span class="mt-0.5 shrink-0 text-amber-500">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/>
                    </svg>
                </span>
                <div>
                    <p class="text-sm font-semibold text-stone-800">Tiket dikirim ke email kamu</p>
                    <p class="text-sm text-gray-500 mt-0.5">Silakan cek email Anda, termasuk folder <span class="font-medium text-stone-600">Spam / Promosi</span> jika tidak ditemukan di inbox.</p>
                </div>
            </div>

            <div class="flex items-start gap-3">
                <span class="mt-0.5 shrink-0 text-amber-500">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h.75v.75h-.75v-.75ZM6.75 16.5h.75v.75h-.75v-.75ZM16.5 6.75h.75v.75h-.75v-.75ZM13.5 13.5h.75v.75h-.75v-.75ZM13.5 19.5h.75v.75h-.75v-.75ZM19.5 13.5h.75v.75h-.75v-.75ZM19.5 19.5h.75v.75h-.75v-.75ZM16.5 16.5h.75v.75h-.75v-.75Z"/>
                    </svg>
                </span>
                <div>
                    <p class="text-sm font-semibold text-stone-800">QR Code siap digunakan</p>
                    <p class="text-sm text-gray-500 mt-0.5">Tunjukkan QR Code di halaman <span class="font-medium text-stone-600">Email</span> kepada petugas saat masuk.</p>
                </div>
            </div>

        </div>

        {{-- CTA buttons --}}
        <div class="w-full flex flex-col gap-3">
            <a
                href="/"
                class="w-full py-3.5 rounded-xl bg-amber-500 hover:bg-amber-600 text-white
                       font-semibold text-sm text-center transition-all duration-200
                       hover:shadow-lg hover:-translate-y-0.5 active:scale-95"
            >
                Laporkan Kendala
            </a>
            <a
                href="/"
                class="w-full py-3.5 rounded-xl border border-gray-300 text-gray-600
                       hover:border-amber-400 hover:text-amber-600 font-semibold text-sm
                       text-center transition-all duration-200 active:scale-95"
            >
                Kembali ke Beranda
            </a>
        </div>

    </div>

</section>
@endsection
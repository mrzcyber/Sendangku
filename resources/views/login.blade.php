@extends('layouts.auth')
@section('title', 'Login')
@section('content')
    <section class="relative min-h-screen w-full overflow-hidden bg-stone-950 font-poppins">
        <div class="absolute inset-0">
            <img src="{{ asset('img/sendang.png') }}" alt="Wisata Sendang Kun Gerit" class="h-full w-full object-cover">
            <div class="absolute inset-0 bg-black/60"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-amber-900/70 via-stone-950/60 to-black/70"></div>
            <div class="absolute bottom-0 h-56 w-full bg-gradient-to-t from-stone-950 to-transparent"></div>
        </div>

        <div class="relative z-10 flex min-h-screen w-full items-center justify-center px-4 py-10 sm:px-6 lg:px-8">
            <div class="grid w-full max-w-5xl overflow-hidden bg-white/95 shadow-2xl shadow-black/40 backdrop-blur md:grid-cols-[1.05fr_0.95fr]">
                <div class="relative hidden min-h-[560px] overflow-hidden md:block">
                    <img src="{{ asset('img/sendang.png') }}" alt="Sendangku" class="h-full w-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/25 to-transparent"></div>
                    <div class="absolute left-8 right-8 bottom-8 text-white">
                        <p class="mb-2 text-sm font-semibold uppercase tracking-[0.2em] text-amber-400">Sendangku</p>
                        <h1 class="mb-3 text-3xl font-semibold leading-tight">Wisata, resto, dan layanan dalam satu sistem.</h1>
                        <p class="max-w-md font-dm text-sm leading-relaxed text-white/80">
                            Masuk untuk mengelola operasional Sendang Kun Gerit dengan akses yang sesuai peran.
                        </p>
                    </div>
                </div>

                <div class="flex min-h-[560px] flex-col justify-center px-6 py-8 sm:px-10">
                    <a href="/" class="mb-10 inline-flex w-fit items-center">
                        <img src="{{ asset('img/logo.png') }}" alt="Sendang Kun Gerit" class="h-16 w-auto object-contain">
                    </a>

                    <div class="mb-8">
                        <p class="mb-2 text-sm font-semibold uppercase tracking-[0.18em] text-amber-600">Dashboard</p>
                        <h2 class="text-3xl font-semibold leading-tight text-stone-900">Masuk ke akun</h2>
                        <p class="mt-3 font-dm text-sm leading-relaxed text-stone-500">
                            Gunakan email dan password yang sudah terdaftar untuk melanjutkan.
                        </p>
                    </div>

                    @if ($errors->any())
                        <div class="mb-5 border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form action="{{ route('login.auth') }}" method="post" class="space-y-5">
                        @csrf

                        <div>
                            <label for="email" class="mb-2 block text-sm font-semibold text-stone-700">Email</label>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                value="{{ old('email') }}"
                                autocomplete="email"
                                class="w-full border border-stone-200 bg-white px-4 py-3 font-poppins text-sm text-stone-800 outline-none transition focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20"
                                placeholder="admin@example.com"
                                required
                            >
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="mb-2 block text-sm font-semibold text-stone-700">Password</label>
                            <input
                                type="password"
                                name="password"
                                id="password"
                                autocomplete="current-password"
                                class="w-full border border-stone-200 bg-white px-4 py-3 font-poppins text-sm text-stone-800 outline-none transition focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20"
                                placeholder="Masukkan password"
                                required
                            >
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between gap-4">
                            <label for="remember" class="flex items-center gap-2 text-sm text-stone-600">
                                <input
                                    type="checkbox"
                                    name="remember"
                                    id="remember"
                                    class="h-4 w-4 border-stone-300 text-amber-600 focus:ring-amber-500"
                                >
                                Ingat saya
                            </label>
                        </div>

                        <button
                            type="submit"
                            class="w-full bg-amber-600 px-5 py-3.5 text-sm font-semibold uppercase tracking-[0.14em] text-white transition hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 active:scale-[0.99]"
                        >
                            Masuk
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

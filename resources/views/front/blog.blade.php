@extends('layouts.app')

@section('title', 'Blog dan Informasi - Sendangku')

@section('content')
<section class="relative mt-10 bg-black">
    <div class="h-64 w-full sm:h-80">
        <img src="{{ asset('img/sendang.png') }}" alt="Blog Sendangku" class="h-full w-full object-cover">
    </div>
    <div class="absolute inset-0 bg-black/55"></div>
    <div class="absolute inset-0 flex flex-col items-center justify-center px-5 text-center">
        <p class="text-sm font-medium uppercase tracking-wider text-amber-400">Sendangku</p>
        <h1 class="mt-2 font-poppins text-3xl font-semibold text-white sm:text-5xl">Blog dan Informasi</h1>
        <p class="mt-4 max-w-2xl text-sm text-white/85 sm:text-base">Temukan berita, informasi, dan cerita terbaru dari Sendang Kun Gerit.</p>
    </div>
</section>

<section class="bg-[#FFF8E1]/50 px-5 py-12 md:px-10 md:py-16 xl:px-20">
    <div class="mx-auto max-w-6xl">
        <div class="mb-8 flex items-end justify-between gap-4">
            <div>
                <h2 class="font-poppins text-2xl font-semibold text-gray-900 sm:text-3xl">Semua Artikel</h2>
                <div class="mt-3 h-1 w-24 bg-amber-500"></div>
            </div>
            <a href="{{ route('home') }}" class="hidden text-sm font-semibold text-amber-600 hover:text-amber-700 sm:inline">Kembali ke beranda</a>
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($blogs as $blog)
                <article class="group flex flex-col overflow-hidden rounded-lg bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <a href="{{ route('blog.detail', $blog) }}" class="h-56 overflow-hidden">
                        <img src="{{ $blog->thumbnail_url }}" alt="{{ $blog->name }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" onerror="this.src='/img/sendang.png'">
                    </a>
                    <div class="flex flex-1 flex-col p-5">
                        <p class="text-xs font-semibold uppercase tracking-wider text-amber-600">{{ $blog->created_at?->translatedFormat('d M Y') ?? '-' }}</p>
                        <h3 class="mt-2 font-poppins text-xl font-semibold leading-snug text-gray-900">{{ $blog->name }}</h3>
                        <p class="mt-3 line-clamp-3 text-sm leading-6 text-gray-600">{{ \Illuminate\Support\Str::limit(strip_tags($blog->content), 140) }}</p>
                        <a href="{{ route('blog.detail', $blog) }}" class="mt-5 inline-flex w-fit border border-amber-500 px-4 py-2 text-xs font-semibold uppercase tracking-wider text-black transition hover:bg-amber-500 hover:text-white">Baca Selengkapnya</a>
                    </div>
                </article>
            @empty
                <div class="col-span-full py-16 text-center text-gray-500">Belum ada artikel.</div>
            @endforelse
        </div>

        @if ($blogs->hasPages())
            <div class="mt-10">{{ $blogs->links() }}</div>
        @endif
    </div>
</section>
@endsection

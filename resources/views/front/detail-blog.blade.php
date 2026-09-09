@extends('layouts.app')

@section('title', $blog->name . ' - Sendangku')

@section('content')
<article>
    <section class="relative mt-10 bg-black">
        <div class="h-72 w-full sm:h-[440px]"><img src="{{ $blog->thumbnail_url }}" alt="{{ $blog->name }}" class="h-full w-full object-cover" onerror="this.src='/img/sendang.png'"></div>
        <div class="absolute inset-0 bg-black/55"></div>
        <div class="absolute inset-0 flex flex-col justify-center px-5 sm:px-10 lg:px-20">
            <p class="text-sm font-medium uppercase tracking-wider text-amber-400">Berita dan Informasi</p>
            <h1 class="mt-3 max-w-4xl font-poppins text-3xl font-semibold leading-tight text-white sm:text-5xl">{{ $blog->name }}</h1>
            <div class="mt-5 flex items-center gap-3 text-sm text-white/85"><a href="{{ route('home') }}" class="hover:text-amber-300">Home</a><span>-</span><span>{{ $blog->created_at?->translatedFormat('d M Y') ?? '-' }}</span></div>
        </div>
    </section>
    <section class="bg-white px-5 py-10 md:px-10 md:py-16 xl:px-20"><div class="mx-auto max-w-4xl"><div class="mb-8 h-1 w-24 bg-amber-500"></div><div class="whitespace-pre-line font-dm text-base leading-8 text-gray-600 md:text-lg">{{ $blog->content }}</div><a href="{{ route('home') }}" class="mt-10 inline-flex border border-amber-500 px-5 py-2.5 text-sm font-semibold uppercase tracking-wider text-black transition hover:bg-amber-500 hover:text-white">Kembali ke Beranda</a></div></section>
</article>
@if ($relatedBlogs->isNotEmpty())
<section class="bg-gray-50 px-5 py-12 md:px-10 md:py-16 xl:px-20"><div class="mx-auto max-w-6xl"><h2 class="font-poppins text-2xl font-semibold text-gray-900">Artikel Lainnya</h2><div class="mt-6 grid grid-cols-1 gap-6 md:grid-cols-3">@foreach ($relatedBlogs as $relatedBlog)<a href="{{ route('blog.detail', $relatedBlog) }}" class="group overflow-hidden rounded-lg bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg"><img src="{{ $relatedBlog->thumbnail_url }}" alt="{{ $relatedBlog->name }}" class="h-44 w-full object-cover transition duration-300 group-hover:scale-105" onerror="this.src='/img/sendang.png'"><div class="p-5"><p class="text-xs font-semibold uppercase tracking-wider text-amber-600">{{ $relatedBlog->created_at?->translatedFormat('d M Y') ?? '-' }}</p><h3 class="mt-2 font-poppins text-lg font-semibold text-gray-900">{{ $relatedBlog->name }}</h3></div></a>@endforeach</div></div></section>
@endif
@endsection

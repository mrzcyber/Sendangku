@extends('layouts.dashboard')

@section('title', 'Blog & News')
@section('meta_description', 'Manage Sendangku blog and news articles.')
@section('body_class', 'font-sans bg-muted min-h-screen overflow-x-hidden text-foreground')

@section('content')
@php
    $blogItems = isset($blogs)
        ? collect($blogs instanceof \Illuminate\Pagination\AbstractPaginator ? $blogs->items() : $blogs)
        : collect();

    $totalBlogs = isset($blogs) && method_exists($blogs, 'total') ? $blogs->total() : $blogItems->count();
    $updatedThisMonth = $blogItems->filter(fn ($blog) => optional($blog->updated_at)->isCurrentMonth())->count();
    $latestPost = $blogItems->sortByDesc('created_at')->first();
@endphp

<div class="flex h-screen max-h-screen flex-1 overflow-hidden">
  <main class="flex-1 lg:ml-[280px] flex flex-col bg-white min-h-screen overflow-x-hidden">
    <div class="flex items-center justify-between w-full h-[90px] shrink-0 border-b border-border bg-white px-5 md:px-8">
      <div class="flex items-center gap-4">
        <button onclick="toggleSidebar()" aria-label="Open menu" class="lg:hidden size-11 flex items-center justify-center rounded-xl ring-1 ring-border hover:ring-primary transition-all duration-300 cursor-pointer">
          <i data-lucide="menu" class="size-6 text-foreground"></i>
        </button>
        <h2 class="font-bold text-xl md:text-2xl text-foreground">Blog & News</h2>
      </div>

      <button onclick="openNotificationModal()" class="size-11 flex items-center justify-center rounded-xl ring-1 ring-border hover:ring-primary transition-all duration-300 cursor-pointer relative" aria-label="Notifications">
        <i data-lucide="bell" class="size-6 text-secondary"></i>
        <span class="absolute -top-1 -right-1 h-5 px-[6px] rounded-full bg-error text-white text-xs font-bold flex items-center justify-center border-2 border-white">2</span>
      </button>
    </div>

    <div class="flex-1 overflow-y-auto p-5 md:p-8">
      <div class="mb-8">
        <h1 class="text-foreground text-2xl font-bold mb-1">Daftar Blog</h1>
        <p class="text-secondary text-sm">Kelola konten artikel dan berita yang tampil untuk pengunjung.</p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-8">
        <div class="flex flex-col rounded-2xl border border-border p-6 gap-3 bg-white shadow-sm">
          <div class="flex items-center gap-[6px]">
            <div class="size-11 bg-primary/10 rounded-xl flex items-center justify-center shrink-0">
              <i data-lucide="newspaper" class="size-6 text-primary"></i>
            </div>
            <p class="font-medium text-secondary">Total Artikel</p>
          </div>
          <p class="font-bold text-[28px] leading-10 text-foreground">{{ $totalBlogs }}</p>
        </div>

        <div class="flex flex-col rounded-2xl border border-border p-6 gap-3 bg-white shadow-sm">
          <div class="flex items-center gap-[6px]">
            <div class="size-11 bg-success/10 rounded-xl flex items-center justify-center shrink-0">
              <i data-lucide="refresh-cw" class="size-6 text-success"></i>
            </div>
            <p class="font-medium text-secondary">Update Bulan Ini</p>
          </div>
          <p class="font-bold text-[28px] leading-10 text-foreground">{{ $updatedThisMonth }}</p>
        </div>

        <div class="flex flex-col rounded-2xl border border-border p-6 gap-3 bg-white shadow-sm">
          <div class="flex items-center gap-[6px]">
            <div class="size-11 bg-warning/10 rounded-xl flex items-center justify-center shrink-0">
              <i data-lucide="calendar-days" class="size-6 text-warning-dark"></i>
            </div>
            <p class="font-medium text-secondary">Artikel Terbaru</p>
          </div>
          <p class="font-bold text-[28px] leading-10 text-foreground">
            {{ $latestPost?->created_at?->format('d M Y') ?? '-' }}
          </p>
        </div>
      </div>

      <div class="flex flex-col rounded-3xl border border-border bg-white shadow-sm overflow-hidden">
        <div class="flex items-center justify-between gap-4 p-6 border-b border-border">
          <h3 class="font-bold text-lg text-foreground">Konten Blog</h3>
        <a href="{{ route('admin.blog.create') }}" class="flex items-center justify-center gap-2 px-6 py-3 bg-primary text-white rounded-full font-bold hover:bg-primary-hover transition-all duration-300 cursor-pointer w-full md:w-auto shadow-sm">
          <i data-lucide="notebook-pen" class="size-5"></i>
          <span>Tambah Artikel</span>
        </a>
        </div>

        <div class="overflow-x-auto">
          <table class="w-full min-w-[920px] text-left border-collapse">
            <thead>
              <tr class="bg-muted/50 border-b border-border">
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider w-[12%]">Thumbnail</th>
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider w-[15%]">Title</th>
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider w-[15%]">Describe</th>
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider w-[12%]">Updated</th>
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider w-[8%]">Action</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-border">
              @forelse ($blogItems as $blog)
                <tr class="hover:bg-muted/30 transition-colors group">
                  <td class="px-6 py-4">
                    <div class="w-28 h-16 overflow-hidden rounded-xl bg-muted ring-1 ring-border">
                      <img
                        src="{{ asset($blog->thumbnail) }}"
                        alt="{{ $blog->name }}"
                        class="h-full w-full object-cover object-center"
                      >
                    </div>
                  </td>
                  <td class="px-6 py-4">
                    <p class="text-sm font-bold text-foreground truncate max-w-[150px]">{{ $blog->name }}</p>
                    <p class="text-xs font-medium text-secondary truncate max-w-[150px]">{{ $blog->slug }}</p>
                  </td>
                  <td class="px-6 py-4">
                    <p class="text-sm font-medium leading-6 text-secondary max-w-[220px] truncate">
                      {{ \Illuminate\Support\Str::limit(strip_tags($blog->content), 140) }}
                    </p>
                  </td>
                  <td class="px-6 py-4">
                    <span class="text-sm font-medium text-secondary">{{ optional($blog->updated_at)->format('d M Y') ?? '-' }}</span>
                  </td>
                  <td class="px-6 py-4">
                    <div class="flex items-center gap-2">
                      <a href="{{ route('admin.blog.edit', $blog) }}" class="size-9 flex items-center justify-center rounded-xl bg-info/10 text-info-dark hover:bg-info/20 transition-all duration-300" aria-label="Edit blog">
                        <i data-lucide="pencil" class="size-4"></i>
                      </a>
                      <x-delete-confirm :action="route('admin.blog.destroy', $blog)" message="Hapus artikel ini?">
                        <x-slot:trigger>
                          <button type="button" class="size-9 flex items-center justify-center rounded-xl bg-error/10 text-error hover:bg-error/20 transition-all duration-300 cursor-pointer" aria-label="Delete blog">
                            <i data-lucide="trash-2" class="size-4"></i>
                          </button>
                        </x-slot:trigger>
                      </x-delete-confirm>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="px-6 py-12 text-center">
                    <div class="mx-auto mb-4 size-14 rounded-2xl bg-muted flex items-center justify-center">
                      <i data-lucide="newspaper" class="size-7 text-secondary"></i>
                    </div>
                    <p class="font-semibold text-foreground">Belum ada artikel</p>
                    <p class="text-sm text-secondary mt-1">Artikel yang dibuat akan muncul di tabel ini.</p>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        @if (isset($blogs) && method_exists($blogs, 'links'))
          <div class="p-6 border-t border-border">
            {{ $blogs->links() }}
          </div>
        @endif
      </div>
    </div>
  </main>
</div>
@endsection

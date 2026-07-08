@extends('layouts.dashboard')

@section('title', 'Restaurant Menu')
@section('meta_description', 'Manage Sendangku restaurant menu items.')
@section('body_class', 'font-sans bg-muted min-h-screen overflow-x-hidden text-foreground')

@section('content')

<div class="flex h-screen max-h-screen flex-1 overflow-hidden">
  <main class="flex-1 lg:ml-[280px] flex flex-col bg-white min-h-screen overflow-x-hidden">
    <div class="flex items-center justify-between w-full h-[90px] shrink-0 border-b border-border bg-white px-5 md:px-8">
      <div class="flex items-center gap-4">
        <button onclick="toggleSidebar()" aria-label="Open menu" class="lg:hidden size-11 flex items-center justify-center rounded-xl ring-1 ring-border hover:ring-primary transition-all duration-300 cursor-pointer">
          <i data-lucide="menu" class="size-6 text-foreground"></i>
        </button>
        <h2 class="font-bold text-xl md:text-2xl text-foreground">Restaurant Menu</h2>
      </div>

      <button onclick="openNotificationModal()" class="size-11 flex items-center justify-center rounded-xl ring-1 ring-border hover:ring-primary transition-all duration-300 cursor-pointer relative" aria-label="Notifications">
        <i data-lucide="bell" class="size-6 text-secondary"></i>
        <span class="absolute -top-1 -right-1 h-5 px-[6px] rounded-full bg-error text-white text-xs font-bold flex items-center justify-center border-2 border-white">2</span>
      </button>
    </div>

    <div class="flex-1 overflow-y-auto p-5 md:p-8">
      <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
          <h1 class="text-foreground text-2xl font-bold mb-1">Daftar Menu Restaurant</h1>
          <p class="text-secondary text-sm">Kelola menu makanan, minuman, dan item lainnya.</p>
        </div>

      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 md:gap-6 mb-8">
        <div class="flex flex-col rounded-2xl border border-border p-6 gap-3 bg-white shadow-sm">
          <div class="flex items-center gap-[6px]">
            <div class="size-11 bg-primary/10 rounded-xl flex items-center justify-center shrink-0">
              <i data-lucide="salad" class="size-6 text-primary"></i>
            </div>
            <p class="font-medium text-secondary">Makanan</p>
          </div>
          <p class="font-bold text-[28px] leading-10 text-foreground">{{ $foodCount }}</p>
        </div>

        <div class="flex flex-col rounded-2xl border border-border p-6 gap-3 bg-white shadow-sm">
          <div class="flex items-center gap-[6px]">
            <div class="size-11 bg-info/10 rounded-xl flex items-center justify-center shrink-0">
              <i data-lucide="cup-soda" class="size-6 text-info"></i>
            </div>
            <p class="font-medium text-secondary">Minuman</p>
          </div>
          <p class="font-bold text-[28px] leading-10 text-foreground">{{ $drinkCount }}</p>
        </div>

        <div class="flex flex-col rounded-2xl border border-border p-6 gap-3 bg-white shadow-sm">
          <div class="flex items-center gap-[6px]">
            <div class="size-11 bg-warning/10 rounded-xl flex items-center justify-center shrink-0">
              <i data-lucide="popcorn" class="size-6 text-warning-dark"></i>
            </div>
            <p class="font-medium text-secondary">Lainnya</p>
          </div>
          <p class="font-bold text-[28px] leading-10 text-foreground">{{ $otherCount }}</p>
        </div>

        <div class="flex flex-col rounded-2xl border border-border p-6 gap-3 bg-white shadow-sm">
          <div class="flex items-center gap-[6px]">
            <div class="size-11 bg-success/10 rounded-xl flex items-center justify-center shrink-0">
              <i data-lucide="clipboard-list" class="size-6 text-success"></i>
            </div>
            <p class="font-medium text-secondary">Total Menu</p>
          </div>
          <p class="font-bold text-[28px] leading-10 text-foreground">{{ $totalMenus }}</p>
        </div>
      </div>

      <div class="flex flex-col rounded-3xl border border-border bg-white shadow-sm overflow-hidden">
        <div class="flex items-center justify-between gap-4 p-6 border-b border-border">
          <h3 class="font-bold text-lg text-foreground">Menu Restaurant</h3>
          <div class="flex flex-row items-center gap-3">

            <form action="" method="get">
                @csrf
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari menu..." class="px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
            </form>

            <a href="{{ route('admin.restaurant-menu.create') }}" class="flex items-center justify-center gap-2 px-6 py-3 bg-primary text-white rounded-full font-bold hover:bg-primary-hover transition-all duration-300 cursor-pointer w-full md:w-auto shadow-sm">
          <i data-lucide="utensils" class="size-5"></i>
          <span>Tambah Menu</span>
        </a>

          </div>
        </div>

        <div class="overflow-x-auto">
          <table class="w-full min-w-[920px] text-left border-collapse">
            <thead>
              <tr class="bg-muted/50 border-b border-border">
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider w-[14%]">Thumbnail</th>
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider w-[24%]">Nama</th>
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider w-[16%]">Kategori</th>
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider w-[16%]">Harga</th>
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider w-[14%]">Status</th>
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider w-[16%]">Action</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-border">
              @forelse ($menuItems as $menu)
                @php
                    $categoryClass = match ($menu->category) {
                        'makanan' => 'bg-primary/10 text-primary',
                        'minuman' => 'bg-info/10 text-info-dark',
                        default => 'bg-warning/10 text-warning-dark',
                    };
                @endphp
                <tr class="hover:bg-muted/30 transition-colors group">
                  <td class="px-6 py-4">
                    <div class="w-24 h-14 overflow-hidden rounded-xl bg-muted ring-1 ring-border">
                      <img
                        src="{{ asset($menu->thumbnail) }}"
                        alt="{{ $menu->name }}"
                        class="h-full w-full object-cover object-center"
                      >
                    </div>
                  </td>
                  <td class="px-6 py-4">
                    <p class="text-sm font-bold text-foreground truncate max-w-[220px]">{{ $menu->name }}</p>
                  </td>
                  <td class="px-6 py-4">
                    <span class="inline-flex items-center justify-center rounded-full px-3 py-1 text-xs font-bold capitalize {{ $categoryClass }}">
                      {{ $menu->category }}
                    </span>
                  </td>
                  <td class="px-6 py-4">
                    <span class="text-sm font-bold text-success">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
                  </td>
                  <td class="px-6 py-4">
                    @if ($menu->status)
                      <span class="inline-flex items-center justify-center px-3 py-1 rounded-full bg-success-light text-success-dark text-xs font-bold">Aktif</span>
                    @else
                      <span class="inline-flex items-center justify-center px-3 py-1 rounded-full bg-error/10 text-error text-xs font-bold">Nonaktif</span>
                    @endif
                  </td>
                  <td class="px-6 py-4">
                    <div class="flex items-center gap-2">
                      <a href="{{ route('admin.restaurant-menu.edit', $menu) }}" class="size-9 flex items-center justify-center rounded-xl bg-info/10 text-info-dark hover:bg-info/20 transition-all duration-300" aria-label="Edit menu">
                        <i data-lucide="pencil" class="size-4"></i>
                      </a>
                      <form action="{{ route('admin.restaurant-menu.destroy', $menu) }}" method="POST" onsubmit="return confirm('Hapus menu ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="size-9 flex items-center justify-center rounded-xl bg-error/10 text-error hover:bg-error/20 transition-all duration-300 cursor-pointer" aria-label="Delete menu">
                          <i data-lucide="trash-2" class="size-4"></i>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="px-6 py-12 text-center">
                    <div class="mx-auto mb-4 size-14 rounded-2xl bg-muted flex items-center justify-center">
                      <i data-lucide="utensils" class="size-7 text-secondary"></i>
                    </div>
                    <p class="font-semibold text-foreground">Belum ada menu</p>
                    <p class="text-sm text-secondary mt-1">Menu yang dibuat akan muncul di tabel ini.</p>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        @if ($menuItems )
          <div class="p-6 border-t border-border">
            {{ $menuItems->links() }}
          </div>
        @endif
      </div>
    </div>
  </main>
</div>
@endsection

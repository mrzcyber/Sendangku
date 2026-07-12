@extends('layouts.dashboard')

@section('title', 'Edit Ticket - Sendangku')
@section('meta_description', 'Edit tipe tiket Sendangku.')
@section('body_class', 'font-sans bg-muted min-h-screen overflow-x-hidden text-foreground')

@section('content')
<div class="flex h-screen max-h-screen flex-1 overflow-hidden">
  <main class="flex-1 lg:ml-[280px] flex flex-col bg-muted min-h-screen overflow-x-hidden">
    <div class="flex items-center justify-between w-full h-[90px] shrink-0 border-b border-border bg-white px-5 md:px-8">
      <div class="flex items-center gap-4">
        <button onclick="toggleSidebar()" aria-label="Open menu" class="lg:hidden size-11 flex items-center justify-center rounded-xl ring-1 ring-border hover:ring-primary transition-all duration-300 cursor-pointer">
          <i data-lucide="menu" class="size-6 text-foreground"></i>
        </button>
        <h2 class="font-bold text-xl md:text-2xl text-foreground">Manajemen Ticket</h2>
      </div>

      <button onclick="openNotificationModal()" class="size-11 flex items-center justify-center rounded-xl ring-1 ring-border hover:ring-primary transition-all duration-300 cursor-pointer relative" aria-label="Notifications">
        <i data-lucide="bell" class="size-6 text-secondary"></i>
        <span class="absolute -top-1 -right-1 h-5 px-[6px] rounded-full bg-error text-white text-xs font-bold flex items-center justify-center border-2 border-white">2</span>
      </button>
    </div>

    <div class="flex-1 overflow-y-auto p-5 md:p-8">
      <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
          <h1 class="text-foreground text-2xl font-bold mb-1">Edit Ticket</h1>
          <p class="text-secondary text-sm">Perbarui tipe tiket yang tampil untuk pengunjung.</p>
        </div>
        <a href="{{ route('admin.ticket-type.index') }}" class="inline-flex items-center justify-center gap-2 px-5 py-3 ring-1 ring-border hover:ring-primary rounded-full text-foreground font-semibold transition-all duration-300 bg-white">
          <i data-lucide="arrow-left" class="size-5 text-secondary"></i>
          <span>Kembali</span>
        </a>
      </div>

      <form action="{{ route('admin.ticket-type.update', $ticketType) }}" method="POST" class="grid grid-cols-1 xl:grid-cols-[minmax(0,1fr)_360px] gap-6">
        @csrf
        @method('PUT')

        <div class="flex flex-col rounded-3xl border border-border bg-white shadow-sm overflow-hidden">
          <div class="p-6 border-b border-border">
            <h3 class="font-bold text-lg text-foreground">Informasi Ticket</h3>
          </div>

          <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div class="flex flex-col gap-2">
                <label for="name" class="text-sm font-semibold text-foreground">Nama Ticket</label>
                <input
                  id="name"
                  name="name"
                  type="text"
                  value="{{ old('name', $ticketType->name) }}"
                  placeholder="Contoh: Tiket Normal"
                  class="w-full h-12 px-4 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary bg-muted outline-none text-sm font-medium text-foreground transition-all"
                  autocomplete="off"
                  required
                >
                @error('name')
                  <p class="text-sm font-medium text-error">{{ $message }}</p>
                @enderror
              </div>

              <div class="flex flex-col gap-2">
                <label for="price" class="text-sm font-semibold text-foreground">Harga</label>
                <input
                  id="price"
                  name="price"
                  type="number"
                  min="0"
                  value="{{ old('price', $ticketType->price) }}"
                  placeholder="Contoh: 10000"
                  class="w-full h-12 px-4 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary bg-muted outline-none text-sm font-medium text-foreground transition-all"
                  required
                >
                @error('price')
                  <p class="text-sm font-medium text-error">{{ $message }}</p>
                @enderror
              </div>
            </div>

            <div class="flex flex-col gap-2">
              <label for="benefit" class="text-sm font-semibold text-foreground">Benefit</label>
              <textarea
                id="benefit"
                name="benefit"
                rows="6"
                placeholder="Contoh: kolam pemandian,waterboom,terapi ikan"
                class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary bg-muted outline-none text-sm font-medium leading-6 text-foreground transition-all resize-y min-h-[140px]"
                required
              >{{ old('benefit', $ticketType->benefit) }}</textarea>
              <p class="text-sm font-semibold text-gray-600 italic">*pisahkan setiap benefit menggunakan koma</p>
              @error('benefit')
                <p class="text-sm font-medium text-error">{{ $message }}</p>
              @enderror
            </div>
          </div>
        </div>

        <aside class="flex flex-col gap-6">
          <div class="flex flex-col rounded-3xl border border-border bg-white shadow-sm overflow-hidden">
            <div class="p-6 border-b border-border">
              <h3 class="font-bold text-lg text-foreground">Preview</h3>
            </div>

            <div class="p-6">
              <div class="rounded-2xl bg-muted ring-1 ring-border p-5">
                <div class="mb-4 size-12 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
                  <i data-lucide="ticket" class="size-6"></i>
                </div>
                <p class="font-bold text-foreground">{{ $ticketType->name }}</p>
                <p class="text-sm text-secondary mt-1">Rp {{ number_format($ticketType->price, 0, ',', '.') }}</p>
              </div>
            </div>
          </div>

          <div class="flex flex-col rounded-3xl border border-border bg-white shadow-sm p-6 gap-3">
            <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-primary text-white rounded-full font-bold hover:bg-primary-hover transition-all duration-300 shadow-sm">
              <i data-lucide="save" class="size-5"></i>
              <span>Simpan Perubahan</span>
            </button>
          </div>
        </aside>
      </form>
    </div>
  </main>
</div>
@endsection

@extends('layouts.dashboard')

@section('title', 'Create Ticket - Sendangku')
@section('meta_description', 'Tambah tipe tiket Sendangku.')
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
      <div class="flex flex-col md:flex-row md:items-center justify-center gap-4 mb-8">
        <div class="flex flex-col items-center text-center">
          <h1 class="text-foreground text-3xl font-bold mb-1">Beli Ticket</h1>
          <p class="text-secondary text-xl">Beli tiket untuk pengunjung offline.</p>
        </div>

      </div>

      <form
      x-data="{totalPrice:0}"
      action="{{ route('admin.order-ticket.store') }}" method="POST" class="flex flex-col gap-6 justify-center items-center ">
        @csrf

      <div class="flex flex-col rounded-3xl border border-border bg-white shadow-sm overflow-hidden w-full max-w-2xl">
          <div class="p-6 border-b border-border">
            <h3 class="font-bold text-lg text-foreground">Informasi Ticket</h3>
            @error('items')
          <p class="text-sm font-medium text-error">{{ $message }}</p>
        @enderror
          </div>

          <input type="hidden" name="purchase" value="offline">

        <div class="w-full">
          <table class="w-full text-left border-collapse">
            <tbody class="divide-y divide-border">
              @forelse ($data as $ticketType)
                <tr class="hover:bg-muted/30 transition-colors">
                  <td class="md:px-6 px-2 py-4">
                    <div class="flex items-center gap-3">
                      <div class="size-11 rounded-xl bg-primary/10 text-primary flex items-center justify-center shrink-0">
                        <i data-lucide="ticket" class="size-5"></i>
                      </div>
                      <div class="min-w-0">
                        <p class="font-semibold text-sm text-foreground truncate max-w-[220px]">{{ $ticketType->name }}</p>
                        <p class="text-xs text-secondary">Rp {{ number_format($ticketType->price, 0, ',', '.') }}</p>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4">
                    <div 
                    x-data="{qty:0 , price: {{ $ticketType->price }} }"
                    class="flex items-center justify-end gap-2">
                      <input type="hidden" name="items[{{$loop->index }}][ticket_type_id]" value="{{ $ticketType->id }}">
                      <input type="hidden"name="items[{{ $loop->index}}][qty]":value="qty">

                          <button
                          @click="if(qty>0){qty-- ;totalPrice -= price;}  "
                          type="button" class="size-10 inline-flex items-center justify-center rounded-xl ring-1 ring-border text-error bg-error/10 hover:ring-error transition-all duration-300 cursor-pointer" aria-label="Hapus {{ $ticketType->name }}">
                            <i data-lucide="minus" class="size-5"></i>
                          </button>
                          <span x-text="qty" class=" font-bold border-b-2 px-4 "></span>
                          <button
                          @click="qty++  ;totalPrice += price;"
                          type="button" class="size-10 inline-flex items-center justify-center rounded-xl ring-1 ring-border text-success bg-success/10 hover:ring-success transition-all duration-300 cursor-pointer" aria-label="Hapus {{ $ticketType->name }}">
                            <i data-lucide="plus" class="size-5"></i>
                          </button>

                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="4" class="px-6 py-12 text-center text-secondary">
                    Belum ada ticket yang terdaftar.
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>


        <div class="flex flex-row  border border-border bg-white shadow-sm p-4 gap-3 px-8 justify-between items-center">
          <P class="font-semibold">Total Harga</P>
          <span class="font-semibold md:pr-12 pr-8">Rp <span  x-text="totalPrice"></span></span>
        </div>
         

    </div>

        <aside class="flex flex-col gap-6 w-full max-w-2xl">
          <div class="flex flex-col rounded-3xl border border-border bg-white shadow-sm p-6 gap-3">
            <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-primary text-white rounded-full font-bold hover:bg-primary-hover transition-all duration-300 shadow-sm">
              <i data-lucide="save" class="size-5"></i>
              Beli Tiket
            </button>
          </div>

        <a href="{{ route('admin.ticket-type.index') }}" class="inline-flex items-center justify-center gap-2 px-5 py-3 ring-1 ring-border hover:ring-primary rounded-full text-foreground font-semibold transition-all duration-300 bg-white shadow-sm shadow-gray-600">
          <i data-lucide="arrow-left" class="size-5 text-secondary"></i>
          <span>Kembali</span>
        </a>

        </aside>
      </form>
    </div>
  </main>
</div>
@endsection
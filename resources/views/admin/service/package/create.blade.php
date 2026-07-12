@extends('layouts.dashboard')

@section('title', 'Create Service Package - Sendangku')
@section('meta_description', 'Tambah package layanan Sendangku.')
@section('body_class', 'font-sans bg-muted min-h-screen overflow-x-hidden text-foreground')

@section('content')
@php
    $selectedService = $selectedService ?? null;
@endphp

<div class="flex h-screen max-h-screen flex-1 overflow-hidden">
  <main class="flex-1 lg:ml-[280px] flex flex-col bg-muted min-h-screen overflow-x-hidden">
    <div class="flex-1 overflow-y-auto p-5 md:p-8">
      <form action="{{ route('admin.service-package.store') }}" method="POST" class="grid grid-cols-1 xl:grid-cols-[minmax(0,1fr)_360px] gap-6">
        @csrf

        <div class="flex flex-col rounded-3xl border border-border bg-white shadow-sm overflow-hidden">
          <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 p-6 border-b border-border">
            <div>
              <h3 class="font-bold text-lg text-foreground">Tambah Package</h3>
              <p class="text-sm text-secondary mt-1">
                {{ $selectedService ? 'Buat package baru untuk service ' . $selectedService->name . '.' : 'Buat package baru untuk salah satu service.' }}
              </p>
            </div>
            <a href="{{ $selectedService ? route('admin.service.show', $selectedService) : route('admin.service.index') }}" class="inline-flex items-center justify-center gap-2 px-5 py-3 ring-1 ring-border hover:ring-primary rounded-full text-foreground font-semibold transition-all duration-300 bg-white">
              <i data-lucide="arrow-left" class="size-5 text-secondary"></i>
              <span>Kembali</span>
            </a>
          </div>

          <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div class="flex flex-col gap-2">
                @if ($selectedService)
                  <span class="text-sm font-semibold text-foreground">Service</span>
                  <input type="hidden" name="service_id" value="{{ old('service_id', $selectedService->id) }}">
                  <div class="flex h-12 items-center rounded-2xl ring-1 ring-border bg-muted px-4 text-sm font-semibold text-foreground">
                    {{ $selectedService->name }}
                  </div>
                @else
                  <label for="service_id" class="text-sm font-semibold text-foreground">Service</label>
                  <select
                    id="service_id"
                    name="service_id"
                    class="w-full h-12 px-4 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary bg-muted outline-none text-sm font-medium text-foreground transition-all"
                    required
                  >
                    <option value="">Pilih service</option>
                    @foreach ($services as $service)
                      <option value="{{ $service->id }}" @selected((string) old('service_id') === (string) $service->id)>{{ $service->name }}</option>
                    @endforeach
                  </select>
                @endif
                @error('service_id')
                  <p class="text-sm font-medium text-error">{{ $message }}</p>
                @enderror
              </div>

              <div class="flex flex-col gap-2">
                <label for="title" class="text-sm font-semibold text-foreground">Nama Package</label>
                <input
                  id="title"
                  name="title"
                  type="text"
                  value="{{ old('title') }}"
                  placeholder="Contoh: Paket Family"
                  class="w-full h-12 px-4 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary bg-muted outline-none text-sm font-medium text-foreground transition-all"
                  autocomplete="off"
                  required
                >
                @error('title')
                  <p class="text-sm font-medium text-error">{{ $message }}</p>
                @enderror
              </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div class="flex flex-col gap-2">
                <label for="price" class="text-sm font-semibold text-foreground">Harga</label>
                <input
                  id="price"
                  name="price"
                  type="number"
                  min="0"
                  value="{{ old('price') }}"
                  placeholder="Contoh: 150000"
                  class="w-full h-12 px-4 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary bg-muted outline-none text-sm font-medium text-foreground transition-all"
                  required
                >
                @error('price')
                  <p class="text-sm font-medium text-error">{{ $message }}</p>
                @enderror
              </div>

              <div class="flex flex-col gap-2">
                <label for="whatsapp_number" class="text-sm font-semibold text-foreground">Nomor WhatsApp</label>
                <input
                  id="whatsapp_number"
                  name="whatsapp_number"
                  type="text"
                  value="{{ old('whatsapp_number') }}"
                  placeholder="Contoh: 6281234567890"
                  class="w-full h-12 px-4 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary bg-muted outline-none text-sm font-medium text-foreground transition-all"
                  autocomplete="off"
                  required
                >
                @error('whatsapp_number')
                  <p class="text-sm font-medium text-error">{{ $message }}</p>
                @enderror
              </div>
            </div>

            <div class="flex flex-col gap-2">
              <label for="benefit" class="text-sm font-semibold text-foreground">Benefit</label>
              <textarea
                id="benefit"
                name="benefit"
                placeholder="Contoh:kolam pemandian,tenda,barberque"
                rows="5"
                class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary bg-muted outline-none text-sm font-medium leading-6 text-foreground transition-all resize-y min-h-[120px]"
                required
              >{{ old('benefit') }}</textarea>
              <p class="text-sm font-semibold text-gray-600 italic">*pisahkan setiap benefit menggunkan koma</p>
              @error('benefit')
                <p class="text-sm font-medium text-error">{{ $message }}</p>
              @enderror
            </div>

            <div class="flex flex-col gap-2">
              <label for="whatsapp_message" class="text-sm font-semibold text-foreground">Pesan WhatsApp</label>
              <textarea
                id="whatsapp_message"
                name="whatsapp_message"
                rows="4"
                class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary bg-muted outline-none text-sm font-medium leading-6 text-foreground transition-all resize-y min-h-[100px]"
                required
              >{{ old('whatsapp_message') }}</textarea>
              @error('whatsapp_message')
                <p class="text-sm font-medium text-error">{{ $message }}</p>
              @enderror
            </div>
          </div>
        </div>

        <aside class="flex flex-col gap-6">
          <div class="flex flex-col rounded-3xl border border-border bg-white shadow-sm overflow-hidden">
            <div class="p-6 border-b border-border">
              <h3 class="font-bold text-lg text-foreground">Status</h3>
            </div>

            <div class="p-6 space-y-4">
              <input type="hidden" name="populer" value="0">
              <label class="flex cursor-pointer items-center justify-between gap-4 rounded-2xl ring-1 ring-border bg-muted px-4 py-4 text-sm font-bold text-foreground has-[:checked]:ring-primary has-[:checked]:bg-primary/10 has-[:checked]:text-primary transition-all">
                <span class="inline-flex items-center gap-2">
                  <i data-lucide="star" class="size-5"></i>
                  <span>Package Populer</span>
                </span>
                <input type="checkbox" name="populer" value="1" class="size-5 accent-primary" @checked((string) old('populer', '0') === '1')>
              </label>
              @error('populer')
                <p class="text-sm font-medium text-error">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <div class="flex flex-col rounded-3xl border border-border bg-white shadow-sm p-6 gap-3">
            <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-primary text-white rounded-full font-bold hover:bg-primary-hover transition-all duration-300 shadow-sm">
              <i data-lucide="save" class="size-5"></i>
              <span>Simpan Package</span>
            </button>
          </div>
        </aside>
      </form>
    </div>
  </main>
</div>
@endsection

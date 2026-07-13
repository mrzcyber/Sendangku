@extends('layouts.dashboard')

@section('title', 'Package Service - Sendangku')
@section('meta_description', 'Daftar package layanan Sendangku.')
@section('body_class', 'font-sans bg-muted min-h-screen overflow-x-hidden text-foreground')

@section('content')
@php
    $packageItems = isset($packages)
        ? collect($packages instanceof \Illuminate\Pagination\AbstractPaginator ? $packages->items() : $packages)
        : collect();

    $serviceName = $service->name ?? null;
@endphp

<div class="flex h-screen max-h-screen flex-1 overflow-hidden">
  <main class="flex-1 lg:ml-[280px] flex flex-col bg-muted min-h-screen overflow-x-hidden">
    <div class="flex-1 overflow-y-auto p-5 md:p-8">
      <div class="flex flex-col rounded-3xl border border-border bg-white shadow-sm overflow-hidden">
        <div class="flex items-center justify-between gap-3 p-6 border-b border-border">
        <div>
            <h3 class="font-bold text-lg text-foreground"> Service Package</h3>
            <p class="text-sm text-secondary mt-1">Seluruh Package yang tampil dari service.</p>
        </div>
        <div class="flex flex-row justify-center items-center gap-4">
          <a href="{{ route('admin.service-package.create', isset($service) ? ['service' => $service->slug] : []) }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-primary text-white rounded-full font-bold hover:bg-primary-hover transition-all duration-300 shadow-sm">
            <i data-lucide="plus" class="size-5"></i>
            <span>Tambah Package</span>
          </a>
          <a href=" {{ route('admin.service.index')}}" class="inline-flex items-center justify-center gap-2 px-5 py-3 ring-2 ring-border hover:ring-primary rounded-full text-foreground font-semibold transition-all duration-300 bg-white">
            <i data-lucide="arrow-left" class="size-5 text-secondary"></i>
            <span>Kembali</span>
          </a>
        </div>
        </div>

        <div class="overflow-x-auto">
          <table class="w-full min-w-[1120px] text-left border-collapse">
            <thead>
              <tr class="bg-muted/50 border-b border-border">
                <th class="px-4 py-4 text-xs font-semibold text-secondary uppercase tracking-wider">Package</th>
                <th class="px-4 py-4 text-xs font-semibold text-secondary uppercase tracking-wider">Service</th>
                <th class="px-4 py-4 text-xs font-semibold text-secondary uppercase tracking-wider">Benefit</th>
                <th class="px-4 py-4 text-xs font-semibold text-secondary uppercase tracking-wider">Harga</th>
                <th class="px-4 py-4 text-xs font-semibold text-secondary uppercase tracking-wider">WhatsApp</th>
                <th class="px-4 py-4 text-xs font-semibold text-secondary uppercase tracking-wider text-center">Status</th>
                <th class="px-4 py-4 text-xs font-semibold text-secondary uppercase tracking-wider text-center">Action</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-border">
              @forelse ($packageItems as $package)
                <tr class="hover:bg-muted/30 transition-colors">
                  <td class="px-6 py-4">
                    <div class="flex items-center gap-3">

                      <div class="min-w-0">
                        <p class="font-semibold text-sm text-foreground truncate max-w-[150px]">{{ $package->title }}</p>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4">
                    <span class="text-sm font-medium text-foreground">
                      {{ $package->service->name ?? $serviceName ?? '-' }}
                    </span>
                  </td>
                  <td class="px-6 py-4">
                    <p class="text-sm text-secondary truncate max-w-[150px]" title="{{ $package->benefit }}">
                      {{ $package->benefit }}
                    </p>
                  </td>
                  <td class="px-6 py-4">
                    <span class="text-sm font-semibold text-foreground">Rp {{ number_format($package->price, 0, ',', '.') }}</span>
                  </td>
                  <td class="px-6 py-4">
                    <div class="min-w-0">
                      <p class="text-sm font-medium text-foreground truncate max-w-[150px]">{{ $package->whatsapp_number }}</p>
                      <p class="text-xs text-secondary truncate max-w-[150px]" title="{{ $package->whatsapp_message }}">{{ $package->whatsapp_message }}</p>
                    </div>
                  </td>
                  <td class="px-6 py-4 text-center">
                    @if ($package->populer)
                      <span class="inline-flex items-center rounded-full bg-success/10 px-3 py-1 text-xs font-bold text-success-dark">Populer</span>
                    @else
                      <span class="inline-flex items-center rounded-full bg-muted px-3 py-1 text-xs font-bold text-secondary">Regular</span>
                    @endif
                  </td>
                  <td class="px-6 py-4">
                    <div class="flex items-center justify-end gap-2">
                      <a href="{{ route('admin.service-package.edit', $package) }}" class="size-10 inline-flex items-center justify-center rounded-xl ring-1 ring-border text-primary bg-primary/10 hover:ring-primary transition-all duration-300" aria-label="Edit {{ $package->title }}">
                        <i data-lucide="pencil" class="size-5"></i>
                      </a>
                      <x-delete-confirm :action="route('admin.service-package.destroy', $package)" message="Yakin ingin menghapus package ini?">
                        <x-slot:trigger>
                          <button type="button" class="size-10 inline-flex items-center justify-center rounded-xl ring-1 ring-border text-error bg-error/10 hover:ring-error transition-all duration-300 cursor-pointer" aria-label="Hapus {{ $package->title }}">
                            <i data-lucide="trash-2" class="size-5"></i>
                          </button>
                        </x-slot:trigger>
                      </x-delete-confirm>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="7" class="px-6 py-12 text-center">
                    <div class="mx-auto mb-4 size-14 rounded-2xl bg-muted flex items-center justify-center">
                      <i data-lucide="package-open" class="size-7 text-secondary"></i>
                    </div>
                    <p class="font-semibold text-foreground">Belum ada package</p>
                    <p class="text-sm text-secondary mt-1">Package service yang dibuat akan muncul di tabel ini.</p>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        @if (isset($packages) && method_exists($packages, 'links') && $packages->hasPages())
          <div class="p-6 border-t border-border">
            {{ $packages->links() }}
          </div>
        @endif
      </div>
    </div>
  </main>
</div>
@endsection

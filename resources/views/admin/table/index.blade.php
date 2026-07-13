@extends('layouts.dashboard')

@section('title', 'Manage Table - Sendangku')
@section('meta_description', 'Manajemen meja restaurant Sendangku.')
@section('body_class', 'font-sans bg-muted min-h-screen overflow-x-hidden text-foreground')

@section('content')
<div class="flex h-screen max-h-screen flex-1 overflow-hidden">
  <main class="flex-1 lg:ml-[280px] flex flex-col bg-white min-h-screen overflow-x-hidden">
    <div class="flex items-center justify-between w-full h-[90px] shrink-0 border-b border-border bg-white px-5 md:px-8">
      <div class="flex items-center gap-4">
        <button onclick="toggleSidebar()" aria-label="Open menu" class="lg:hidden size-11 flex items-center justify-center rounded-xl ring-1 ring-border hover:ring-primary transition-all duration-300 cursor-pointer">
          <i data-lucide="menu" class="size-6 text-foreground"></i>
        </button>
        <h2 class="font-bold text-xl md:text-2xl text-foreground">Manajemen Table</h2>
      </div>

      <div class="flex items-center gap-3">
        <button onclick="openNotificationModal()" class="size-11 flex items-center justify-center rounded-xl ring-1 ring-border hover:ring-primary transition-all duration-300 cursor-pointer relative" aria-label="Notifications">
          <i data-lucide="bell" class="size-6 text-secondary"></i>
          <span class="absolute -top-1 -right-1 h-5 px-[6px] rounded-full bg-error text-white text-xs font-bold flex items-center justify-center border-2 border-white">2</span>
        </button>
      </div>
    </div>

    <div class="flex-1 overflow-y-auto p-5 md:p-8">
      <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
          <h1 class="text-foreground text-2xl font-bold mb-1">Data Table</h1>
          <p class="text-secondary text-sm">Daftar meja yang tersedia untuk order restaurant.</p>
        </div>
      </div>

      <div class="flex flex-col rounded-3xl border border-border bg-white shadow-sm overflow-hidden">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 p-6 border-b border-border">
          <div>
            <h3 class="font-bold text-lg text-foreground">Daftar Table</h3>
            <p class="text-sm text-secondary mt-1">Seluruh meja yang dapat digunakan untuk restaurant.</p>
          </div>
          <a href="{{ route('admin.table.create') }}" class="flex items-center justify-center gap-2 px-6 py-3 bg-primary text-white rounded-full font-bold hover:bg-primary-hover transition-all duration-300 cursor-pointer w-full md:w-auto shadow-sm">
            <i data-lucide="plus" class="size-5"></i>
            <span>Tambah Table</span>
          </a>
        </div>

        <div class="overflow-x-auto">
          <table class="w-full min-w-[880px] text-left border-collapse">
            <thead>
              <tr class="bg-muted/50 border-b border-border">
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider">Table</th>
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider">Kode</th>
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider">Dibuat</th>
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider text-center">Action</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-border">
              @forelse ($tables as $table)
                <tr class="hover:bg-muted/30 transition-colors">
                  <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                      <div class="size-11 rounded-xl bg-primary/10 text-primary flex items-center justify-center shrink-0">
                        <i data-lucide="utensils" class="size-5"></i>
                      </div>
                      <div class="min-w-0">
                        <p class="font-semibold text-sm text-foreground truncate max-w-[220px]">Meja {{ $table->number }}</p>
                        <p class="text-xs text-secondary">Nomor meja</p>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4">
                    <span class="inline-flex items-center rounded-full bg-muted px-3 py-1 text-xs font-bold text-secondary">
                      {{ $table->table_code }}
                    </span>
                  </td>
                  <td class="px-6 py-4">
                    <span class="text-sm text-secondary">{{ optional($table->created_at)->format('d M Y') ?? '-' }}</span>
                  </td>
                  <td class="px-6 py-4">
                    <div class="flex items-center justify-end gap-2">
                      <a href="{{ route('admin.table.edit', $table) }}" class="size-10 inline-flex items-center justify-center rounded-xl ring-1 ring-border text-primary bg-primary/10 hover:ring-primary transition-all duration-300" aria-label="Edit meja {{ $table->number }}">
                        <i data-lucide="pencil" class="size-5"></i>
                      </a>

                    <x-delete-confirm :action="route('admin.table.destroy', $table)" message="Yakin ingin menghapus table ini">
                        <x-slot:trigger>
                      <button type="button" class="size-10 inline-flex items-center justify-center rounded-xl ring-1 ring-border text-error bg-error/10 hover:ring-error transition-all duration-300 cursor-pointer" aria-label="Hapus meja {{ $table->number }}">

                         <i data-lucide="trash-2" class="size-5"></i>
                      </button>
                        </x-slot:trigger>
                    </x-delete-confirm>

                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="4" class="px-6 py-12 text-center text-secondary">
                    Belum ada table yang terdaftar.
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        @if (isset($tables) && method_exists($tables, 'links') && $tables->hasPages())
          <div class="p-6 border-t border-border">
            {{ $tables->links() }}
          </div>
        @endif
      </div>
    </div>
  </main>
</div>
@endsection

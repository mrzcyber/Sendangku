@extends('layouts.dashboard')

@section('title', 'User - Sendangku')
@section('meta_description', 'Manajemen anggota, kasir, dan petugas tiket Sendangku.')
@section('body_class', 'font-sans bg-muted min-h-screen overflow-x-hidden text-foreground')

@section('content')
<div class="flex h-screen max-h-screen flex-1 overflow-hidden">
  <main class="flex-1 lg:ml-[280px] flex flex-col bg-white min-h-screen overflow-x-hidden">
    <div class="flex items-center justify-between w-full h-[90px] shrink-0 border-b border-border bg-white px-5 md:px-8">
      <div class="flex items-center gap-4">
        <button onclick="toggleSidebar()" aria-label="Open menu" class="lg:hidden size-11 flex items-center justify-center rounded-xl ring-1 ring-border hover:ring-primary transition-all duration-300 cursor-pointer">
          <i data-lucide="menu" class="size-6 text-foreground"></i>
        </button>
        <h2 class="font-bold text-xl md:text-2xl text-foreground">Manajemen User</h2>
      </div>

      <div class="flex items-center gap-3">
        <button onclick="openNotificationModal()" class="size-11 flex items-center justify-center rounded-xl ring-1 ring-border hover:ring-primary transition-all duration-300 cursor-pointer relative" aria-label="Notifications">
          <i data-lucide="bell" class="size-6 text-secondary"></i>
          <span class="absolute -top-1 -right-1 h-5 px-[6px] rounded-full bg-error text-white text-xs font-bold flex items-center justify-center border-2 border-white">2</span>
        </button>
      </div>
    </div>

    <div class="flex-1 overflow-y-auto p-5 md:p-8">
      <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
          <h1 class="text-foreground text-2xl font-bold mb-1">Data Anggota</h1>
          <p class="text-secondary text-sm">Pantau jumlah anggota, kasir, dan petugas tiket.</p>
        </div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-8">
        <div class="flex flex-col rounded-2xl border border-border p-6 gap-3 bg-white shadow-sm">
          <div class="flex items-center justify-between gap-4">
            <div class="flex items-center gap-3">
              <div class="size-11 bg-primary/10 rounded-xl flex items-center justify-center shrink-0">
                <i data-lucide="users" class="size-6 text-primary"></i>
              </div>
              <p class="font-medium text-secondary">Jumlah Anggota</p>
            </div>
          </div>
          <p class="font-bold text-[32px] leading-10 text-foreground">{{ $totalAnggota }}</p>
        </div>

        <div class="flex flex-col rounded-2xl border border-border p-6 gap-3 bg-white shadow-sm">
          <div class="flex items-center justify-between gap-4">
            <div class="flex items-center gap-3">
              <div class="size-11 bg-success/10 rounded-xl flex items-center justify-center shrink-0">
                <i data-lucide="badge-dollar-sign" class="size-6 text-success"></i>
              </div>
              <p class="font-medium text-secondary">Jumlah Kasir</p>
            </div>
          </div>
          <p class="font-bold text-[32px] leading-10 text-foreground">{{ $totalKasir }}</p>
        </div>

        <div class="flex flex-col rounded-2xl border border-border p-6 gap-3 bg-white shadow-sm sm:col-span-2 lg:col-span-1">
          <div class="flex items-center justify-between gap-4">
            <div class="flex items-center gap-3">
              <div class="size-11 bg-warning/10 rounded-xl flex items-center justify-center shrink-0">
                <i data-lucide="tickets" class="size-6 text-warning-dark"></i>
              </div>
              <p class="font-medium text-secondary">Jumlah Tiket</p>
            </div>
          </div>
          <p class="font-bold text-[32px] leading-10 text-foreground">{{ $totalTiket }}</p>
        </div>
      </div>

      <div class="flex flex-col rounded-3xl border border-border bg-white shadow-sm overflow-hidden">
        <div class="flex items-center justify-between gap-4 p-6 border-b border-border">
          <div>
            <h3 class="font-bold text-lg text-foreground">Daftar User</h3>
            <p class="text-sm text-secondary mt-1">Seluruh akun yang terdaftar di sistem.</p>
          </div>
            <a href="{{ route('admin.user.create') }}" class="flex items-center justify-center gap-2 px-6 py-3 bg-primary text-white rounded-full font-bold hover:bg-primary-hover transition-all duration-300 cursor-pointer w-full md:w-auto shadow-sm">
          <i data-lucide="user-round-plus" class="size-5"></i>
          <span>Tambah Karyawan</span>
        </a>
        </div>

        <div class="overflow-x-auto">
          <table class="w-full min-w-[760px] text-left border-collapse">
            <thead>
              <tr class="bg-muted/50 border-b border-border">
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider">Nama</th>
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider">Email</th>
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider">Role</th>
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider">Dibuat</th>
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider text-right">Action</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-border">
              @forelse ($data as $user)
                <tr class="hover:bg-muted/30 transition-colors">
                  <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                      <div class="size-10 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
                        <i data-lucide="user" class="size-5 text-primary"></i>
                      </div>
                      <span class="font-semibold text-sm text-foreground">{{ $user->name }}</span>
                    </div>
                  </td>
                  <td class="px-6 py-4">
                    <span class="text-sm text-secondary">{{ $user->email }}</span>
                  </td>
                  <td class="px-6 py-4">
                    <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-bold
                      @if ($user->role === 'kasir') bg-success/10 text-success-dark
                      @elseif ($user->role === 'tiket') bg-warning/20 text-warning-dark
                      @else bg-primary/10 text-primary
                      @endif">
                      {{ ucfirst($user->role) }}
                    </span>
                  </td>
                  <td class="px-6 py-4">
                    <span class="text-sm text-secondary">{{ $user->created_at?->format('d M Y') ?? '-' }}</span>
                  </td>
                  <td class="px-6 py-4">
                    <div class="flex items-center justify-end gap-2">
                      <a href="{{ route('admin.user.edit', $user->id) }}" class="size-10 inline-flex items-center justify-center bg-primary/10  rounded-xl ring-1 ring-border text-primary hover:ring-primary hover:bg-primary/10 transition-all duration-300" aria-label="Edit {{ $user->name }}">
                        <i data-lucide="pencil" class="size-5"></i>
                      </a>
                      <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="size-10 inline-flex items-center justify-center rounded-xl ring-1 ring-border text-error hover:ring-error bg-error/10 hover:bg-error/10 transition-all duration-300 cursor-pointer" aria-label="Hapus {{ $user->name }}">
                          <i data-lucide="trash-2" class="size-5"></i>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="px-6 py-12 text-center text-secondary">
                    Belum ada user yang terdaftar.
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
                @if ($data )
          <div class="p-6 border-t border-border">
            {{ $data->links() }}
          </div>
        @endif
      </div>
    </div>
  </main>
</div>
@endsection

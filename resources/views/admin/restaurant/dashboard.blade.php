@extends('layouts.dashboard')

@section('title', 'Restaurant - Financial Reports')
@section('meta_description', 'Restaurant financial management and reporting dashboard.')
@section('body_class', 'font-sans bg-muted min-h-screen overflow-x-hidden text-foreground')

@section('content')

<div class="flex h-screen max-h-screen flex-1 overflow-hidden">
  
  <!-- MAIN CONTENT -->
  <main class="flex-1 lg:ml-[280px] flex flex-col bg-white min-h-screen overflow-x-hidden">


    <!-- Date Range Picker Modal -->
<div id="date-modal" class="fixed inset-0 bg-black/50 z-[100] hidden items-center justify-center p-4">
  <div class="bg-white rounded-3xl w-full max-w-md shadow-2xl overflow-hidden">
    <div class="p-6 border-b border-border">
      <div class="flex items-center justify-between mb-4">
        <h3 class="text-xl font-bold text-foreground">Select Date Range</h3>
        <button onclick="closeDateModal()" class="p-2 hover:bg-muted rounded-full transition-colors cursor-pointer">
          <i data-lucide="x" class="size-5 text-secondary"></i>
        </button>
      </div>
      
      <!-- Presets -->
      <div class="flex flex-wrap gap-2 mb-6">
        <button type="button" onclick="selectDatePreset(this, 'Hari Ini'); window.selectedRestaurantRange = 'today';" class="date-preset px-4 py-2 rounded-xl {{ $range === 'today' ? 'bg-primary/10 text-primary font-semibold border-primary/20' : 'bg-white text-secondary font-medium border-border hover:border-primary hover:text-primary' }} text-sm border transition-all cursor-pointer">Hari Ini</button>
        <button type="button" onclick="selectDatePreset(this, 'Minggu Ini'); window.selectedRestaurantRange = 'week';" class="date-preset px-4 py-2 rounded-xl {{ $range === 'week' ? 'bg-primary/10 text-primary font-semibold border-primary/20' : 'bg-white text-secondary font-medium border-border hover:border-primary hover:text-primary' }} text-sm border transition-all cursor-pointer">Minggu Ini</button>
        <button type="button" onclick="selectDatePreset(this, 'Bulan Ini'); window.selectedRestaurantRange = 'month';" class="date-preset px-4 py-2 rounded-xl {{ $range === 'month' ? 'bg-primary/10 text-primary font-semibold border-primary/20' : 'bg-white text-secondary font-medium border-border hover:border-primary hover:text-primary' }} text-sm border transition-all cursor-pointer">Bulan Ini</button>
        <button type="button" onclick="selectDatePreset(this, 'Semua Waktu'); window.selectedRestaurantRange = 'all';" class="date-preset px-4 py-2 rounded-xl {{ $range === 'all' ? 'bg-primary/10 text-primary font-semibold border-primary/20' : 'bg-white text-secondary font-medium border-border hover:border-primary hover:text-primary' }} text-sm border transition-all cursor-pointer">Semua Waktu</button>
      </div>
    </div>
    <div class="p-6 bg-gray-50 flex justify-end gap-3">
      <button onclick="closeDateModal()" class="px-6 py-3 rounded-full border border-border bg-white text-foreground font-semibold hover:bg-gray-100 transition-all cursor-pointer">Cancel</button>
      <button onclick="applyRestaurantDateRange()" class="px-6 py-3 rounded-full bg-primary text-white font-bold hover:bg-primary-hover transition-all cursor-pointer shadow-lg shadow-primary/20">Apply Range</button>
    </div>
  </div>
</div>
    
    <!-- Top Header Bar -->
    <div class="flex items-center justify-between w-full h-[90px] shrink-0 border-b border-border bg-white px-5 md:px-8">
      <div class="flex items-center gap-4">
        <button onclick="toggleSidebar()" aria-label="Open menu" class="lg:hidden size-11 flex items-center justify-center rounded-xl ring-1 ring-border hover:ring-primary transition-all duration-300 cursor-pointer">
          <i data-lucide="menu" class="size-6 text-foreground"></i>
        </button>
        <h2 class="font-bold text-xl md:text-2xl text-foreground">Laporan Keuangan</h2>
      </div>
      
      <div class="flex items-center gap-3">
        <!-- Notifikasi Pesanan Belum Dikonfirmasi -->
        <button
          onclick="openUnconfirmedModal()"
          class="size-11 flex items-center justify-center rounded-xl ring-1 ring-border hover:ring-primary transition-all duration-300 cursor-pointer relative"
          aria-label="Pesanan belum dikonfirmasi"
          title="Pesanan belum dikonfirmasi"
        >
          <i data-lucide="bell" class="size-6 text-secondary"></i>
          @if ($unconfirmedCount > 0)
            <span class="absolute -top-1 -right-1 h-5 min-w-[20px] px-[5px] w-5  rounded-full bg-error text-white text-xs font-bold flex items-center justify-center border-2 border-white">
              {{ $unconfirmedCount }}
            </span>
          @endif
        </button>
      </div>
    </div>

    <!-- Page Content Area -->
    <div class="flex-1 overflow-y-auto p-5 md:p-8">
      
      <!-- Page Header & Actions -->
      <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
          <h1 class="text-foreground text-2xl font-bold mb-1">Laporan Restaurant</h1>
          <p class="text-secondary text-sm">Lacak dan kelola pendapatan restaurant, pengeluaran, and dana.</p>
        </div>
                <div class="grid grid-cols-2 gap-2 w-full md:w-auto md:flex md:items-center md:gap-3">
          <button onclick="openDateModal()" class="flex items-center justify-center gap-2 px-4 md:px-6 py-3 ring-1 ring-border hover:ring-primary rounded-full text-foreground font-semibold transition-all duration-300 cursor-pointer bg-white">
            <i data-lucide="calendar" class="w-5 h-5 text-secondary"></i>
            <span id="dateRangeLabel">{{ $dateRangeLabel }}</span>
            <i data-lucide="chevron-down" class="w-4 h-4 text-secondary ml-1"></i>
          </button>
        </div>
      </div>

      <!-- Stats Grid 1: Main Financials -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-4 md:mb-6">
        <!-- Income -->
        <div class="flex flex-col rounded-2xl border border-border p-6 gap-3 bg-white shadow-sm">
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-[6px]">
              <div class="size-11 bg-success/10 rounded-xl flex items-center justify-center shrink-0">
                <i data-lucide="wallet" class="size-6 text-success"></i>
              </div>
              <p class="font-medium text-secondary">Total Pendapatan</p>
            </div>
          </div>
          <p class="font-bold text-[28px] leading-10 text-foreground">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
        </div>

        <!-- Packages -->
        <div class="flex flex-col rounded-2xl border border-border p-6 gap-3 bg-white shadow-sm">
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-[6px]">
              <div class="size-11 bg-error/10 rounded-xl flex items-center justify-center shrink-0">
                <i data-lucide="paper-bag" class="size-6 text-error"></i>
              </div>
              <p class="font-medium text-secondary">Pembelian Paket</p>
            </div>
          </div>
          <p class="font-bold text-[28px] leading-10 text-foreground">{{ number_format($packageCount, 0, ',', '.') }} paket</p>
        </div>

        <!-- Food -->
        <div class="flex flex-col rounded-2xl border border-border p-6 gap-3 bg-white shadow-sm">
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-[6px]">
              <div class="size-11 bg-primary/10 rounded-xl flex items-center justify-center shrink-0">
                <i data-lucide="salad" class="size-6 text-primary"></i>
              </div>
              <p class="font-medium text-secondary">Pembelian Makanan</p>
            </div>
          </div>
          <p class="font-bold text-[28px] leading-10 text-foreground">{{ number_format($foodCount, 0, ',', '.') }} Makanan</p>
        </div>
      </div>

      <!-- Stats Grid 2: Fund Types -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-8">
        <!-- total transaksi -->
        <div class="flex flex-col rounded-2xl border border-border p-6 gap-3 bg-white shadow-sm">
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-[6px]">
              <div class="size-11 bg-warning/10 rounded-xl flex items-center justify-center shrink-0">
                <i data-lucide="banknote-arrow-up" class="size-6 text-warning-dark"></i>
              </div>
              <p class="font-medium text-secondary">Total Pembelian</p>
            </div>
          </div>
          <p class="font-bold text-[28px] leading-10 text-foreground">{{ number_format($totalOrders, 0, ',', '.') }} Pembelian</p>
        </div>

        <!-- drink -->
        <div class="flex flex-col rounded-2xl border border-border p-6 gap-3 bg-white shadow-sm">
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-[6px]">
              <div class="size-11 bg-info/10 rounded-xl flex items-center justify-center shrink-0">
                <i data-lucide="cup-soda" class="size-6 text-info"></i>
              </div>
              <p class="font-medium text-secondary">Pembelian Minuman</p>
            </div>
          </div>
          <p class="font-bold text-[28px] leading-10 text-foreground">{{ number_format($drinkCount, 0, ',', '.') }} Minuman</p>
        </div>

        <!-- lainya -->
        <div class="flex flex-col rounded-2xl border border-border p-6 gap-3 bg-white shadow-sm">
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-[6px]">
              <div class="size-11 bg-success/10 rounded-xl flex items-center justify-center shrink-0">
                <i data-lucide="popcorn" class="size-6 text-success-dark"></i>
              </div>
              <p class="font-medium text-secondary">Pembelian Lainnya</p>
            </div>
          </div>
          <p class="font-bold text-[28px] leading-10 text-foreground">{{ number_format($otherCount, 0, ',', '.') }} Pembelian</p>
        </div>
      </div>

      <!-- Transactions Section -->
      <div class="flex flex-col rounded-3xl border border-border bg-white shadow-sm overflow-hidden">
        
        <!-- Section Header & Filters -->
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 p-6 border-b border-border">
          <h3 class="font-bold text-lg text-foreground">Transaksi Pembelian</h3>
          
          <div class="flex flex-col sm:flex-row items-center gap-3 w-full lg:w-auto">
            
            <!-- Type Filter -->
            <div class="relative w-full sm:w-auto">
              <select id="selectTypeFilter" onchange="filterRestaurantStatus(this.value)" class="w-full sm:w-[160px] h-12 pl-4 pr-10 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary bg-white outline-none text-sm font-medium text-foreground transition-all">
                <option value="all" {{ $statusFilter === 'all' || !$statusFilter ? 'selected' : '' }}>Semua Status</option>
                <option value="success" {{ $statusFilter === 'success' ? 'selected' : '' }}>Success</option>
                <option value="pending" {{ $statusFilter === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="failed" {{ $statusFilter === 'failed' ? 'selected' : '' }}>Failed</option>
              </select>
            </div>
          </div>
        </div>

        <!-- Table Wrapper for Mobile Scroll -->
        <div class="overflow-x-auto">
          <table class="w-full min-w-[1100px] text-left border-collapse">
            <thead>
              <tr class="bg-muted/50 border-b border-border">
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider w-[12%]">Code</th>
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider w-[6%]">Meja</th>
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider w-[12%]">Nama</th>
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider w-[12%]">Harga</th>
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider w-[10%]">Pembayaran</th>
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider w-[14%]">Waktu</th>
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider w-[10%]">Status</th>
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider w-[12%]">Konfirmasi</th>
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider w-[10%]">Aksi</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-border">
              @forelse ($orders as $order)
                <tr class="hover:bg-muted/30 transition-colors group">
                  <td class="px-6 py-4">
                    <span class="font-semibold text-sm text-foreground font-mono">{{ $order->order_code }}</span>
                  </td>
                  <td class="px-6 py-4">
                    <span class="text-xs bg-amber-100 text-amber-900 rounded-full px-2.5 py-1 font-bold">
                      {{ $order->table ? $order->table->number : ($order->table_id ?? '-') }}
                    </span>
                  </td>
                  <td class="px-6 py-4">
                    <p class="text-sm font-medium text-foreground truncate max-w-[150px]" title="{{ $order->name }}">
                      {{ $order->name }}
                    </p>
                  </td>
                  <td class="px-6 py-4">
                    <span class="text-sm font-bold {{ $order->status === 'success' ? 'text-success' : ($order->status === 'pending' ? 'text-warning-dark' : 'text-error') }}">
                      Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </span>
                  </td>
                  <td class="px-6 py-4">
                    <div class="flex items-center gap-2">
                      @if ($order->payment === 'online')
                        <i data-lucide="smartphone" class="size-4 text-secondary"></i>
                        <span class="text-sm font-medium text-secondary">Online</span>
                      @else
                        <i data-lucide="banknote" class="size-4 text-secondary"></i>
                        <span class="text-sm font-medium text-secondary">Offline</span>
                      @endif
                    </div>
                  </td>
                  <td class="px-6 py-4">
                    <span class="text-sm font-medium text-secondary">
                      {{ $order->created_at ? $order->created_at->translatedFormat('d M Y, H:i') : '-' }}
                    </span>
                  </td>
                  <td class="px-6 py-4">
                    @if ($order->status === 'success')
                      <span class="inline-flex items-center justify-center px-3 py-1 rounded-full bg-success-light text-success-dark text-xs font-bold">
                        Success
                      </span>
                    @elseif ($order->status === 'pending')
                      <span class="inline-flex items-center justify-center px-3 py-1 rounded-full bg-warning-light text-warning-dark text-xs font-bold">
                        Pending
                      </span>
                    @else
                      <span class="inline-flex items-center justify-center px-3 py-1 rounded-full bg-error/10 text-error text-xs font-bold">
                        {{ ucfirst($order->status) }}
                      </span>
                    @endif
                  </td>
                  <td class="px-6 py-4">
                    @if ($order->confirmed)
                      <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-success/10 text-success-dark text-xs font-bold">
                        <i data-lucide="check-circle" class="size-3.5"></i>
                        Dikonfirmasi
                      </span>
                    @else
                      <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-muted text-secondary text-xs font-bold">
                        <i data-lucide="clock" class="size-3.5"></i>
                        Belum
                      </span>
                    @endif
                  </td>
                  <td class="px-6 py-4">
                    <button 
                      type="button"
                      onclick="openRestaurantOrderDetail(@js([
                        'order_code' => $order->order_code,
                        'name' => $order->name,
                        'table' => $order->table ? 'Meja ' . $order->table->number : 'Meja ' . ($order->table_id ?? '-'),
                        'note' => $order->note ?: '-',
                        'total_price' => 'Rp ' . number_format($order->total_price, 0, ',', '.'),
                        'status' => ucfirst($order->status),
                        'payment' => ucfirst($order->payment),
                        'time' => $order->created_at ? $order->created_at->translatedFormat('d M Y, H:i') : '-',
                        'items' => $order->restaurantOrderItems->map(fn($item) => [
                          'name' => $item->restaurantMenu?->name ?? 'Menu',
                          'qty' => $item->qty,
                          'price' => 'Rp ' . number_format($item->price, 0, ',', '.'),
                          'subtotal' => 'Rp ' . number_format($item->subtotal, 0, ',', '.'),
                        ])->values()
                      ]))" 
                      class="py-1.5 px-4 rounded-full bg-info/10 text-info-dark text-xs font-bold hover:bg-info/20 transition-all duration-300 cursor-pointer"
                    >
                      Detail
                    </button>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="9" class="px-6 py-12 text-center text-secondary">
                    <div class="mx-auto mb-3 size-12 rounded-2xl bg-muted flex items-center justify-center">
                      <i data-lucide="receipt" class="size-6 text-secondary"></i>
                    </div>
                    <p class="font-semibold text-foreground">Belum ada transaksi</p>
                    <p class="text-xs text-secondary mt-1">Transaksi pesanan restoran akan muncul di sini.</p>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
        
        <!-- Pagination -->
        <div class="flex flex-col sm:flex-row items-center justify-between p-6 border-t border-border gap-4">
          <p class="text-sm text-secondary font-medium">Showing <span class="text-foreground font-bold">{{ $orders->firstItem() ?? 0 }}-{{ $orders->lastItem() ?? 0 }}</span> of <span class="text-foreground font-bold">{{ $orders->total() }}</span> transactions</p>
          <div class="w-full sm:w-auto">
            {{ $orders->links() }}
          </div>
        </div>

      </div>

    </div>
  </main>
</div>

<!-- Toast Notification Container -->
<div id="toast-container" class="fixed bottom-6 right-6 z-[100] flex flex-col gap-3 pointer-events-none"></div>

<!-- Page Not Found Modal -->
<div id="page-not-found-modal" class="fixed inset-0 bg-black/50 z-[100] hidden flex items-center justify-center p-4">
  <div class="bg-white rounded-3xl p-6 max-w-sm w-full text-center shadow-2xl">
    <div class="w-16 h-16 bg-warning/10 rounded-full flex items-center justify-center mx-auto mb-4">
      <i data-lucide="alert-triangle" class="w-8 h-8 text-warning-dark"></i>
    </div>
    <h3 class="text-foreground text-xl font-bold mb-2">Page Not Available</h3>
    <p class="text-secondary text-sm mb-6">This page hasn't been created yet. Generate it using the chat!</p>
    <button onclick="closePageNotFoundModal()" class="w-full px-4 py-3 bg-primary text-white rounded-full font-bold hover:bg-primary-hover transition-all duration-200 cursor-pointer">
      Got it
    </button>
  </div>
</div>

<!-- Modal Pesanan Belum Dikonfirmasi -->
<div id="unconfirmed-orders-modal" class="fixed inset-0 bg-black/50 z-[100] hidden items-center justify-center p-4">
  <div class="bg-white rounded-3xl w-full max-w-lg shadow-2xl overflow-hidden">
    <div class="p-6 border-b border-border flex items-center justify-between">
      <div>
        <h3 class="text-xl font-bold text-foreground">Pesanan Belum Dikonfirmasi</h3>
        <p class="text-xs text-secondary mt-0.5">Konfirmasi pesanan yang sudah masuk</p>
      </div>
      <button type="button" onclick="closeUnconfirmedModal()" class="p-2 hover:bg-muted rounded-full transition-colors cursor-pointer">
        <i data-lucide="x" class="size-5 text-secondary"></i>
      </button>
    </div>

    <div class="max-h-[65vh] overflow-y-auto divide-y divide-border">
      @forelse ($unconfirmedOrders as $uOrder)
        <div class="flex items-center justify-between p-4 gap-4 hover:bg-muted/30 transition-colors" id="unconfirmed-row-{{ $uOrder->id }}">
          <div class="flex items-center gap-3 min-w-0">
            <div class="size-10 rounded-xl bg-warning/10 flex items-center justify-center shrink-0">
              <i data-lucide="utensils" class="size-5 text-warning-dark"></i>
            </div>
            <div class="min-w-0">
              <p class="font-semibold text-sm text-foreground truncate">{{ $uOrder->name }}</p>
              <p class="text-xs text-secondary font-mono">{{ $uOrder->order_code }}</p>
              <p class="text-xs text-secondary mt-0.5">
                Meja <span class="font-bold text-foreground">{{ $uOrder->table ? $uOrder->table->number : ($uOrder->table_id ?? '-') }}</span>
                &bull;
                {{ $uOrder->created_at?->translatedFormat('d M Y, H:i') }}
              </p>
              <p class="text-xs font-bold text-primary mt-0.5">Rp {{ number_format($uOrder->total_price, 0, ',', '.') }}</p>
            </div>
          </div>

          <!-- Toggle Konfirmasi -->
          <button
            type="button"
            onclick="confirmOrder({{ $uOrder->id }}, '{{ url('admin/restaurant-order/' . $uOrder->id . '/confirm') }}')"
            id="confirm-btn-{{ $uOrder->id }}"
            class="shrink-0 flex items-center gap-2 px-4 py-2 rounded-full bg-success/10 text-success-dark text-xs font-bold hover:bg-success/20 transition-all duration-300 cursor-pointer"
          >
            <i data-lucide="check-circle" class="size-4"></i>
            Konfirmasi
          </button>
        </div>
      @empty
        <div class="p-10 flex flex-col items-center justify-center text-center">
          <div class="size-14 bg-success/10 rounded-2xl flex items-center justify-center mb-3">
            <i data-lucide="check-circle-2" class="size-7 text-success"></i>
          </div>
          <p class="font-semibold text-foreground">Semua Pesanan Sudah Dikonfirmasi</p>
          <p class="text-xs text-secondary mt-1">Tidak ada pesanan yang menunggu konfirmasi.</p>
        </div>
      @endforelse
    </div>

    <div class="p-4 bg-gray-50 border-t border-border flex justify-end">
      <button type="button" onclick="closeUnconfirmedModal()" class="px-6 py-2.5 rounded-full border border-border bg-white text-foreground font-semibold hover:bg-gray-100 transition-all cursor-pointer">
        Tutup
      </button>
    </div>
  </div>
</div>

<!-- Modal Detail Transaksi Restoran -->
<div id="restaurant-order-detail-modal" class="fixed inset-0 bg-black/50 z-[100] hidden items-center justify-center p-4">
  <div class="bg-white rounded-3xl w-full max-w-lg shadow-2xl overflow-hidden">
    <div class="p-6 border-b border-border flex items-center justify-between">
      <div>
        <h3 class="text-xl font-bold text-foreground">Detail Pesanan</h3>
        <p id="modal-order-code" class="text-xs text-secondary font-mono mt-0.5"></p>
      </div>
      <button type="button" onclick="closeRestaurantOrderDetail()" class="p-2 hover:bg-muted rounded-full transition-colors cursor-pointer">
        <i data-lucide="x" class="size-5 text-secondary"></i>
      </button>
    </div>
    
    <div class="p-6 max-h-[65vh] overflow-y-auto space-y-4">
      <!-- Info Header -->
      <div class="grid grid-cols-2 gap-3 p-4 rounded-2xl bg-muted/40 border border-border text-sm">
        <div>
          <span class="text-xs text-secondary font-medium block">Nama Pemesan</span>
          <span id="modal-customer-name" class="font-semibold text-foreground"></span>
        </div>
        <div>
          <span class="text-xs text-secondary font-medium block">Nomor Meja</span>
          <span id="modal-table-number" class="font-semibold text-foreground"></span>
        </div>
        <div>
          <span class="text-xs text-secondary font-medium block">Waktu Pesan</span>
          <span id="modal-order-time" class="font-medium text-foreground text-xs"></span>
        </div>
        <div>
          <span class="text-xs text-secondary font-medium block">Status & Pembayaran</span>
          <span id="modal-status-badge" class="font-semibold text-xs"></span>
        </div>
        <div class="col-span-2 pt-2 border-t border-border/60">
          <span class="text-xs text-secondary font-medium block">Catatan</span>
          <span id="modal-order-note" class="text-xs text-foreground italic"></span>
        </div>
      </div>

      <!-- Items List -->
      <div>
        <h4 class="text-xs font-semibold text-secondary uppercase tracking-wider mb-2">Item Menu Dipesan</h4>
        <div id="modal-items-container" class="divide-y divide-border border border-border rounded-2xl overflow-hidden bg-white">
          <!-- Populated by JS -->
        </div>
      </div>

      <!-- Total Price -->
      <div class="flex items-center justify-between p-4 rounded-2xl bg-primary/5 border border-primary/20">
        <span class="font-semibold text-foreground">Total Pembayaran</span>
        <span id="modal-total-price" class="text-lg font-bold text-primary"></span>
      </div>
    </div>

    <div class="p-4 bg-gray-50 border-t border-border flex justify-end">
      <button type="button" onclick="closeRestaurantOrderDetail()" class="px-6 py-2.5 rounded-full border border-border bg-white text-foreground font-semibold hover:bg-gray-100 transition-all cursor-pointer">
        Tutup
      </button>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
    function filterRestaurantStatus(status) {
        const url = new URL(window.location.href);
        if (status && status !== 'all') {
            url.searchParams.set('status', status);
        } else {
            url.searchParams.delete('status');
        }
        url.searchParams.delete('page');
        window.location.href = url.toString();
    }

    function applyRestaurantDateRange() {
        const url = new URL(window.location.href);
        if (window.selectedRestaurantRange && window.selectedRestaurantRange !== 'all') {
            url.searchParams.set('range', window.selectedRestaurantRange);
        } else {
            url.searchParams.delete('range');
        }
        url.searchParams.delete('page');
        window.location.href = url.toString();
    }

    function openRestaurantOrderDetail(data) {
        document.getElementById('modal-order-code').textContent = data.order_code;
        document.getElementById('modal-customer-name').textContent = data.name;
        document.getElementById('modal-table-number').textContent = data.table;
        document.getElementById('modal-order-time').textContent = data.time;
        document.getElementById('modal-order-note').textContent = data.note || '-';
        document.getElementById('modal-total-price').textContent = data.total_price;

        const statusBadge = document.getElementById('modal-status-badge');
        statusBadge.innerHTML = `<span class="inline-flex items-center gap-1.5">${data.status} • ${data.payment}</span>`;

        const container = document.getElementById('modal-items-container');
        container.innerHTML = '';
        if (data.items && data.items.length > 0) {
            data.items.forEach(item => {
                const row = document.createElement('div');
                row.className = 'flex items-center justify-between p-3 text-sm';
                row.innerHTML = `
                    <div>
                        <p class="font-medium text-foreground">${item.name}</p>
                        <p class="text-xs text-secondary">${item.qty} × ${item.price}</p>
                    </div>
                    <p class="font-semibold text-foreground">${item.subtotal}</p>
                `;
                container.appendChild(row);
            });
        } else {
            container.innerHTML = '<div class="p-4 text-center text-xs text-secondary">Tidak ada item menu</div>';
        }

        const modal = document.getElementById('restaurant-order-detail-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        if (window.lucide) window.lucide.createIcons();
    }

    function closeRestaurantOrderDetail() {
        const modal = document.getElementById('restaurant-order-detail-modal');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }

    // ── Unconfirmed Orders Modal ──────────────────────────────────────────────
    function openUnconfirmedModal() {
        const modal = document.getElementById('unconfirmed-orders-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        if (window.lucide) window.lucide.createIcons();
    }

    function closeUnconfirmedModal() {
        const modal = document.getElementById('unconfirmed-orders-modal');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }

    function confirmOrder(orderId, url) {
        const btn = document.getElementById('confirm-btn-' + orderId);
        if (!btn) return;

        const originalHtml = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = `<svg class="animate-spin size-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg> Mengkonfirmasi...`;

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}';

        fetch(url, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
        })
        .then(async res => {
            const data = await res.json().catch(() => ({}));
            if (!res.ok || !data.success) {
                throw new Error(data.message || 'Gagal mengkonfirmasi pesanan.');
            }
            return data;
        })
        .then(data => {
            // Hapus baris dari modal notifikasi
            const row = document.getElementById('unconfirmed-row-' + orderId);
            if (row) {
                row.remove();
            }

            // Update badge count di bell icon
            const badge = document.querySelector('[aria-label="Pesanan belum dikonfirmasi"] span');
            if (badge) {
                const current = parseInt(badge.textContent.trim()) || 0;
                if (current - 1 <= 0) {
                    badge.remove();
                } else {
                    badge.textContent = current - 1;
                }
            }

            // Tampilkan toast sukses lalu reload
            showToast('Pesanan berhasil dikonfirmasi!', 'success');
            setTimeout(() => window.location.reload(), 400);
        })
        .catch(err => {
            console.error('Confirm order error:', err);
            btn.disabled = false;
            btn.innerHTML = originalHtml;
            showToast(err.message || 'Terjadi kesalahan saat memproses pesanan.', 'error');
        });
    }

    function showToast(message, type = 'success') {
        const container = document.getElementById('toast-container');
        if (!container) return;
        const colors = type === 'success'
            ? 'bg-success text-white'
            : 'bg-error text-white';
        const toast = document.createElement('div');
        toast.className = `pointer-events-auto flex items-center gap-3 px-5 py-3.5 rounded-2xl shadow-lg text-sm font-semibold ${colors} transition-all duration-300 opacity-0 translate-y-2`;
        toast.textContent = message;
        container.appendChild(toast);
        requestAnimationFrame(() => {
            toast.classList.remove('opacity-0', 'translate-y-2');
        });
        setTimeout(() => {
            toast.classList.add('opacity-0', 'translate-y-2');
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }
</script>
@endpush

@extends('layouts.dashboard')

@section('title', 'Ticket - Financial Reports')
@section('meta_description', 'Ticket financial management and reporting dashboard.')
@section('body_class', 'font-sans bg-muted min-h-screen overflow-x-hidden text-foreground')

@section('content')

<div class="flex h-screen max-h-screen flex-1 overflow-hidden">
  
  <!-- MAIN CONTENT -->
  <main class="flex-1 lg:ml-[280px] flex flex-col bg-white min-h-screen overflow-x-hidden">
    
    <!-- Top Header Bar -->
    <div class="flex items-center justify-between w-full h-[90px] shrink-0 border-b border-border bg-white px-5 md:px-8">
      <div class="flex items-center gap-4">
        <button onclick="toggleSidebar()" aria-label="Open menu" class="lg:hidden size-11 flex items-center justify-center rounded-xl ring-1 ring-border hover:ring-primary transition-all duration-300 cursor-pointer">
          <i data-lucide="menu" class="size-6 text-foreground"></i>
        </button>
        <h2 class="font-bold text-xl md:text-2xl text-foreground">Laporan Keuangan Tiket</h2>
      </div>
      
      <div class="flex items-center gap-3">
      </div>
    </div>

    <!-- Date Range Picker Modal -->
    <div id="date-modal" class="fixed inset-0 bg-black/50 z-[100] hidden items-center justify-center p-4">
      <div class="bg-white rounded-3xl w-full max-w-md shadow-2xl overflow-hidden">
        <div class="p-6 border-b border-border">
          <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold text-foreground">Pilih Rentang Waktu</h3>
            <button onclick="closeDateModal()" class="p-2 hover:bg-muted rounded-full transition-colors cursor-pointer">
              <i data-lucide="x" class="size-5 text-secondary"></i>
            </button>
          </div>
          
          <!-- Presets -->
          <div class="flex flex-wrap gap-2 mb-2">
            <button type="button" onclick="selectDatePreset(this, 'Hari Ini'); window.selectedTicketRange = 'today';" class="date-preset px-4 py-2 rounded-xl {{ $range === 'today' ? 'bg-primary/10 text-primary font-semibold border-primary/20' : 'bg-white text-secondary font-medium border-border hover:border-primary hover:text-primary' }} text-sm border transition-all cursor-pointer">Hari Ini</button>
            <button type="button" onclick="selectDatePreset(this, 'Minggu Ini'); window.selectedTicketRange = 'week';" class="date-preset px-4 py-2 rounded-xl {{ $range === 'week' ? 'bg-primary/10 text-primary font-semibold border-primary/20' : 'bg-white text-secondary font-medium border-border hover:border-primary hover:text-primary' }} text-sm border transition-all cursor-pointer">Minggu Ini</button>
            <button type="button" onclick="selectDatePreset(this, 'Bulan Ini'); window.selectedTicketRange = 'month';" class="date-preset px-4 py-2 rounded-xl {{ $range === 'month' ? 'bg-primary/10 text-primary font-semibold border-primary/20' : 'bg-white text-secondary font-medium border-border hover:border-primary hover:text-primary' }} text-sm border transition-all cursor-pointer">Bulan Ini</button>
            <button type="button" onclick="selectDatePreset(this, 'Semua Waktu'); window.selectedTicketRange = 'all';" class="date-preset px-4 py-2 rounded-xl {{ $range === 'all' ? 'bg-primary/10 text-primary font-semibold border-primary/20' : 'bg-white text-secondary font-medium border-border hover:border-primary hover:text-primary' }} text-sm border transition-all cursor-pointer">Semua Waktu</button>
          </div>
        </div>
        <div class="p-6 bg-gray-50 flex justify-end gap-3">
          <button onclick="closeDateModal()" class="px-6 py-3 rounded-full border border-border bg-white text-foreground font-semibold hover:bg-gray-100 transition-all cursor-pointer">Cancel</button>
          <button onclick="applyTicketDateRange()" class="px-6 py-3 rounded-full bg-primary text-white font-bold hover:bg-primary-hover transition-all cursor-pointer shadow-lg shadow-primary/20">Apply Range</button>
        </div>
      </div>
    </div>

    <!-- Page Content Area -->
    <div class="flex-1 overflow-y-auto p-5 md:p-8">
      
      <!-- Page Header & Actions -->
      <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
          <h1 class="text-foreground text-2xl font-bold mb-1">Laporan Ticket</h1>
          <p class="text-secondary text-sm">Telusuri laporan penjualan ticket, jumlah pengunjung, dan jenis ticket.</p>
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

        <!-- Scanned Tickets -->
        <div class="flex flex-col rounded-2xl border border-border p-6 gap-3 bg-white shadow-sm">
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-[6px]">
              <div class="size-11 bg-error/10 rounded-xl flex items-center justify-center shrink-0">
                <i data-lucide="user-check" class="size-6 text-error"></i>
              </div>
              <p class="font-medium text-secondary">Tiket Terscan</p>
            </div>
          </div>
          <p class="font-bold text-[28px] leading-10 text-foreground">{{ number_format($scannedTicketsCount, 0, ',', '.') }} <span class="text-base font-medium text-secondary">Tiket</span></p>
        </div>

        <!-- Terusan Ticket -->
        <div class="flex flex-col rounded-2xl border border-border p-6 gap-3 bg-white shadow-sm">
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-[6px]">
              <div class="size-11 bg-primary/10 rounded-xl flex items-center justify-center shrink-0">
                <i data-lucide="tickets" class="size-6 text-primary"></i>
              </div>
              <p class="font-medium text-secondary">Ticket Terusan</p>
            </div>
          </div>
          <p class="font-bold text-[28px] leading-10 text-foreground">{{ number_format($terusanCount, 0, ',', '.') }} <span class="text-base font-medium text-secondary">Tiket</span></p>
        </div>
      </div>

      <!-- Stats Grid 2: Fund Types -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-8">
        <!-- Visitors -->
        <div class="flex flex-col rounded-2xl border border-border p-6 gap-3 bg-white shadow-sm">
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-[6px]">
              <div class="size-11 bg-warning/10 rounded-xl flex items-center justify-center shrink-0">
                <i data-lucide="users" class="size-6 text-warning-dark"></i>
              </div>
              <p class="font-medium text-secondary">Jumlah Pengunjung</p>
            </div>
          </div>
          <p class="font-bold text-[28px] leading-10 text-foreground">{{ number_format($totalVisitors, 0, ',', '.') }} <span class="text-base font-medium text-secondary">Orang</span></p>
        </div>

        <!-- Unscanned Tickets -->
        <div class="flex flex-col rounded-2xl border border-border p-6 gap-3 bg-white shadow-sm">
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-[6px]">
              <div class="size-11 bg-info/10 rounded-xl flex items-center justify-center shrink-0">
                <i data-lucide="clock" class="size-6 text-info"></i>
              </div>
              <p class="font-medium text-secondary">Tiket Belum Terscan</p>
            </div>
          </div>
          <p class="font-bold text-[28px] leading-10 text-foreground">{{ number_format($unscannedTicketsCount, 0, ',', '.') }} <span class="text-base font-medium text-secondary">Tiket</span></p>
        </div>

        <!-- Normal Ticket -->
        <div class="flex flex-col rounded-2xl border border-border p-6 gap-3 bg-white shadow-sm">
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-[6px]">
              <div class="size-11 bg-success/10 rounded-xl flex items-center justify-center shrink-0">
                <i data-lucide="ticket" class="size-6 text-success-dark"></i>
              </div>
              <p class="font-medium text-secondary">Ticket Normal</p>
            </div>
          </div>
          <p class="font-bold text-[28px] leading-10 text-foreground">{{ number_format($normalCount, 0, ',', '.') }} <span class="text-base font-medium text-secondary">Tiket</span></p>
        </div>
      </div>

      <!-- Transactions Section -->
      <div class="flex flex-col rounded-3xl border border-border bg-white shadow-sm overflow-hidden">
        
        <!-- Section Header & Filters -->
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 p-6 border-b border-border">
          <h3 class="font-bold text-lg text-foreground">Transaksi Penjualan</h3>
          
          <div class="flex flex-col sm:flex-row items-center gap-3 w-full lg:w-auto">
            <!-- Method Filter -->
            <div class="relative w-full sm:w-auto">
              <select id="selectMethodFilter" onchange="filterTicketMethod(this.value)" class="w-full sm:w-[160px] h-12 pl-4 pr-10 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary bg-white outline-none text-sm font-medium text-foreground transition-all">
                <option value="all" {{ $methodFilter === 'all' || !$methodFilter ? 'selected' : '' }}>Semua Metode</option>
                <option value="online" {{ $methodFilter === 'online' ? 'selected' : '' }}>Online</option>
                <option value="offline" {{ $methodFilter === 'offline' ? 'selected' : '' }}>Offline</option>
              </select>
            </div>

            <!-- Status Filter -->
            <div class="relative w-full sm:w-auto">
              <select id="selectTypeFilter" onchange="filterTicketStatus(this.value)" class="w-full sm:w-[160px] h-12 pl-4 pr-10 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary bg-white outline-none text-sm font-medium text-foreground transition-all">
                <option value="all" {{ $statusFilter === 'all' || !$statusFilter ? 'selected' : '' }}>Semua Status</option>
                <option value="active" {{ $statusFilter === 'active' ? 'selected' : '' }}>Active (Belum Scan)</option>
                <option value="used" {{ $statusFilter === 'used' ? 'selected' : '' }}>Used (Terscan)</option>
              </select>
            </div>
          </div>
        </div>

        <!-- Table Wrapper for Mobile Scroll -->
        <div class="overflow-x-auto">
          <table class="w-full min-w-[1000px] text-left border-collapse">
            <thead>
              <tr class="bg-muted/50 border-b border-border">
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider w-[12%]">Code</th>
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider w-[14%]">Ticket Normal</th>
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider w-[14%]">Ticket Terusan</th>
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider w-[14%]">Price</th>
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider w-[12%]">Method</th>
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider w-[14%]">Date</th>
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider w-[10%]">Status</th>
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider w-[10%]">Aksi</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-border">
              @forelse ($orders as $order)
                @php
                  $normalItem = $order->orderItems->first(fn($item) => str_contains(strtolower($item->ticketType?->name ?? ''), 'normal'));
                  $terusanItem = $order->orderItems->first(fn($item) => str_contains(strtolower($item->ticketType?->name ?? ''), 'terusan'));
                  $normalQty = $normalItem ? $normalItem->qty : 0;
                  $terusanQty = $terusanItem ? $terusanItem->qty : 0;
                @endphp
                <tr class="hover:bg-muted/30 transition-colors group">
                  <td class="px-6 py-4">
                    <span class="font-semibold text-sm text-foreground font-mono">{{ $order->order_code ?? 'TKT-' . str_pad($order->id, 8, '0', STR_PAD_LEFT) }}</span>
                  </td>

                  <td class="px-6 py-4">
                    @if ($normalQty > 0)
                      <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-success/15 text-success-dark">
                        {{ $normalQty }} Tiket
                      </span>
                    @else
                      <span class="text-xs text-secondary font-medium">-</span>
                    @endif
                  </td>

                  <td class="px-6 py-4">
                    @if ($terusanQty > 0)
                      <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-primary/15 text-primary">
                        {{ $terusanQty }} Tiket
                      </span>
                    @else
                      <span class="text-xs text-secondary font-medium">-</span>
                    @endif
                  </td>

                  <td class="px-6 py-4">
                    <span class="text-sm font-bold text-foreground">
                      Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </span>
                  </td>

                  <!-- Method: Online atau Offline -->
                  <td class="px-6 py-4">
                    <div class="flex items-center gap-2">
                      @if ($order->purchase === 'online')
                        <i data-lucide="smartphone" class="size-4 text-secondary"></i>
                        <span class="text-sm font-medium text-secondary">Online</span>
                      @else
                        <i data-lucide="store" class="size-4 text-secondary"></i>
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
                    @if ($order->status === 'used')
                      <span class="inline-flex items-center justify-center px-3 py-1 rounded-full bg-success-light text-success-dark text-xs font-bold">
                        Used
                      </span>
                    @else
                      <span class="inline-flex items-center justify-center px-3 py-1 rounded-full bg-warning-light text-warning-dark text-xs font-bold">
                        Active
                      </span>
                    @endif
                  </td>

                  <!-- Action: Detail Tiket -->
                  <td class="px-6 py-4">
                    <button 
                      type="button"
                      onclick="openTicketOrderDetail(@js([
                        'order_code' => $order->order_code ?? 'TKT-' . str_pad($order->id, 8, '0', STR_PAD_LEFT),
                        'buyer_name' => $order->buyer_name ?: ($order->purchase === 'offline' ? 'Pembelian Kasir (Offline)' : '-'),
                        'buyer_phone' => $order->buyer_phone ?: '-',
                        'buyer_email' => $order->buyer_email ?: '-',
                        'purchase' => ucfirst($order->purchase),
                        'status' => $order->status === 'used' ? 'Sudah Digunakan (Used)' : 'Aktif / Belum Scan (Active)',
                        'pay_status' => ucfirst($order->pay_status ?? 'Paid'),
                        'created_at' => $order->created_at ? $order->created_at->translatedFormat('d M Y, H:i') : '-',
                        'scanned_at' => $order->scanned_at ? \Carbon\Carbon::parse($order->scanned_at)->translatedFormat('d M Y, H:i') : 'Belum di-scan',
                        'scanned_by' => $order->user?->name ?: '-',
                        'total_price' => 'Rp ' . number_format($order->total_price, 0, ',', '.'),
                        'items' => $order->orderItems->map(fn($item) => [
                          'name' => $item->ticketType?->name ?? 'Tiket',
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
                  <td colspan="8" class="px-6 py-12 text-center text-secondary">
                    <div class="mx-auto mb-3 size-12 rounded-2xl bg-muted flex items-center justify-center">
                      <i data-lucide="receipt" class="size-6 text-secondary"></i>
                    </div>
                    <p class="font-semibold text-foreground">Belum ada transaksi</p>
                    <p class="text-xs text-secondary mt-1">Transaksi penjualan tiket akan muncul di sini.</p>
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

<!-- Modal Detail Transaksi Tiket -->
<div id="ticket-order-detail-modal" class="fixed inset-0 bg-black/50 z-[100] hidden items-center justify-center p-4">
  <div class="bg-white rounded-3xl w-full max-w-lg shadow-2xl overflow-hidden">
    <div class="p-6 border-b border-border flex items-center justify-between">
      <div>
        <h3 class="text-xl font-bold text-foreground">Detail Tiket</h3>
        <p id="modal-ticket-order-code" class="text-xs text-secondary font-mono mt-0.5"></p>
      </div>
      <button type="button" onclick="closeTicketOrderDetail()" class="p-2 hover:bg-muted rounded-full transition-colors cursor-pointer">
        <i data-lucide="x" class="size-5 text-secondary"></i>
      </button>
    </div>
    
    <div class="p-6 max-h-[65vh] overflow-y-auto space-y-4">
      <!-- Info Header -->
      <div class="grid grid-cols-2 gap-3 p-4 rounded-2xl bg-muted/40 border border-border text-sm">
        <div>
          <span class="text-xs text-secondary font-medium block">Nama Pembeli</span>
          <span id="modal-ticket-buyer-name" class="font-semibold text-foreground"></span>
        </div>
        <div>
          <span class="text-xs text-secondary font-medium block">Metode Pembelian</span>
          <span id="modal-ticket-purchase-badge" class="font-semibold text-foreground"></span>
        </div>
        <div>
          <span class="text-xs text-secondary font-medium block">No. Handphone</span>
          <span id="modal-ticket-buyer-phone" class="font-medium text-foreground text-xs"></span>
        </div>
        <div>
          <span class="text-xs text-secondary font-medium block">Email</span>
          <span id="modal-ticket-buyer-email" class="font-medium text-foreground text-xs truncate block"></span>
        </div>
        <div>
          <span class="text-xs text-secondary font-medium block">Status Tiket</span>
          <span id="modal-ticket-status" class="font-semibold text-xs"></span>
        </div>
        <div>
          <span class="text-xs text-secondary font-medium block">Status Pembayaran</span>
          <span id="modal-ticket-pay-status" class="font-semibold text-xs"></span>
        </div>
        <div>
          <span class="text-xs text-secondary font-medium block">Waktu Transaksi</span>
          <span id="modal-ticket-created-at" class="font-medium text-foreground text-xs"></span>
        </div>
        <div>
          <span class="text-xs text-secondary font-medium block">Waktu Scan</span>
          <span id="modal-ticket-scanned-at" class="font-medium text-foreground text-xs"></span>
        </div>
        <div class="col-span-2 pt-2 border-t border-border/60">
          <span class="text-xs text-secondary font-medium block">Operator Scan</span>
          <span id="modal-ticket-scanned-by" class="text-xs font-semibold text-foreground"></span>
        </div>
      </div>

      <!-- Items List -->
      <div>
        <h4 class="text-xs font-semibold text-secondary uppercase tracking-wider mb-2">Item Tiket Dipesan</h4>
        <div id="modal-ticket-items-container" class="divide-y divide-border border border-border rounded-2xl overflow-hidden bg-white">
          <!-- Populated by JS -->
        </div>
      </div>

      <!-- Total Price -->
      <div class="flex items-center justify-between p-4 rounded-2xl bg-primary/5 border border-primary/20">
        <span class="font-semibold text-foreground">Total Pembayaran</span>
        <span id="modal-ticket-total-price" class="text-lg font-bold text-primary"></span>
      </div>
    </div>

    <div class="p-4 bg-gray-50 border-t border-border flex justify-end">
      <button type="button" onclick="closeTicketOrderDetail()" class="px-6 py-2.5 rounded-full border border-border bg-white text-foreground font-semibold hover:bg-gray-100 transition-all cursor-pointer">
        Tutup
      </button>
    </div>
  </div>
</div>

<!-- Toast Notification Container -->
<div id="toast-container" class="fixed bottom-6 right-6 z-[100] flex flex-col gap-3 pointer-events-none"></div>

@endsection

@push('scripts')
<script>
    function filterTicketStatus(status) {
        const url = new URL(window.location.href);
        if (status && status !== 'all') {
            url.searchParams.set('status', status);
        } else {
            url.searchParams.delete('status');
        }
        url.searchParams.delete('page');
        window.location.href = url.toString();
    }

    function filterTicketMethod(method) {
        const url = new URL(window.location.href);
        if (method && method !== 'all') {
            url.searchParams.set('method', method);
        } else {
            url.searchParams.delete('method');
        }
        url.searchParams.delete('page');
        window.location.href = url.toString();
    }

    function openDateModal() {
        const modal = document.getElementById('date-modal');
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
    }

    function closeDateModal() {
        const modal = document.getElementById('date-modal');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }

    function selectDatePreset(button, preset) {
        document.querySelectorAll('.date-preset').forEach(btn => {
            btn.className = 'date-preset px-4 py-2 rounded-xl bg-white text-secondary font-medium border-border hover:border-primary hover:text-primary text-sm border transition-all cursor-pointer';
        });
        button.className = 'date-preset px-4 py-2 rounded-xl bg-primary/10 text-primary font-semibold border-primary/20 text-sm border transition-all cursor-pointer';
    }

    function applyTicketDateRange() {
        const url = new URL(window.location.href);
        if (window.selectedTicketRange && window.selectedTicketRange !== 'all') {
            url.searchParams.set('range', window.selectedTicketRange);
        } else {
            url.searchParams.delete('range');
        }
        url.searchParams.delete('page');
        window.location.href = url.toString();
    }

    function openTicketOrderDetail(data) {
        document.getElementById('modal-ticket-order-code').textContent = data.order_code;
        document.getElementById('modal-ticket-buyer-name').textContent = data.buyer_name;
        document.getElementById('modal-ticket-purchase-badge').textContent = data.purchase;
        document.getElementById('modal-ticket-buyer-phone').textContent = data.buyer_phone;
        document.getElementById('modal-ticket-buyer-email').textContent = data.buyer_email;
        document.getElementById('modal-ticket-status').textContent = data.status;
        document.getElementById('modal-ticket-pay-status').textContent = data.pay_status;
        document.getElementById('modal-ticket-created-at').textContent = data.created_at;
        document.getElementById('modal-ticket-scanned-at').textContent = data.scanned_at;
        document.getElementById('modal-ticket-scanned-by').textContent = data.scanned_by;
        document.getElementById('modal-ticket-total-price').textContent = data.total_price;

        const container = document.getElementById('modal-ticket-items-container');
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
            container.innerHTML = '<div class="p-4 text-center text-xs text-secondary">Tidak ada item tiket</div>';
        }

        const modal = document.getElementById('ticket-order-detail-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        if (window.lucide) window.lucide.createIcons();
    }

    function closeTicketOrderDetail() {
        const modal = document.getElementById('ticket-order-detail-modal');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }
</script>
@endpush
@extends('layouts.dashboard')

@section('title', 'Restaurant - Financial Reports')
@section('meta_description', 'Restaurant financial management and reporting dashboard.')
@section('body_class', 'font-sans bg-muted min-h-screen overflow-x-hidden text-foreground')

@section('content')

<div class="flex h-screen max-h-screen flex-1 overflow-hidden ">
  
  <!-- MAIN CONTENT -->
  <main class="flex-1 lg:ml-[280px] flex flex-col bg-white min-h-screen overflow-x-hidden">
    
    <!-- Top Header Bar -->
    <div class="flex items-center justify-between w-full h-[90px] shrink-0 border-b border-border bg-white px-5 md:px-8">
      <div class="flex items-center gap-4">
        <button onclick="toggleSidebar()" aria-label="Open menu" class="lg:hidden size-11 flex items-center justify-center rounded-xl ring-1 ring-border hover:ring-primary transition-all duration-300 cursor-pointer">
          <i data-lucide="menu" class="size-6 text-foreground"></i>
        </button>
        <h2 class="font-bold text-xl md:text-2xl text-foreground">Laporan Keuangan</h2>
      </div>
      
      <div class="flex items-center gap-3">
        <button onclick="openNotificationModal()" class="size-11 flex items-center justify-center rounded-xl ring-1 ring-border hover:ring-primary transition-all duration-300 cursor-pointer relative" aria-label="Notifications">
          <i data-lucide="bell" class="size-6 text-secondary"></i>
          <span class="absolute -top-1 -right-1 h-5 px-[6px] rounded-full bg-error text-white text-xs font-bold flex items-center justify-center border-2 border-white">2</span>
        </button>
      </div>
    </div>


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
        <button onclick="selectDatePreset(this, 'Last 7 Days')" class="date-preset px-4 py-2 rounded-xl bg-primary/10 text-primary font-semibold text-sm border border-primary/20 cursor-pointer">Hari Ini</button>
        <button onclick="selectDatePreset(this, 'Last 30 Days')" class="date-preset px-4 py-2 rounded-xl bg-white text-secondary font-medium text-sm border border-border hover:border-primary hover:text-primary transition-all cursor-pointer">Minggu Ini</button>
        <button onclick="selectDatePreset(this, 'This Month')" class="date-preset px-4 py-2 rounded-xl bg-white text-secondary font-medium text-sm border border-border hover:border-primary hover:text-primary transition-all cursor-pointer">Bulan Ini</button>
        {{-- <button onclick="selectDatePreset(this, 'Last Quarter')" class="date-preset px-4 py-2 rounded-xl bg-white text-secondary font-medium text-sm border border-border hover:border-primary hover:text-primary transition-all cursor-pointer">Last Quarter</button> --}}
      </div>

      <!-- Custom Inputs -->
      {{-- <div class="grid grid-cols-2 gap-4">
        <div class="flex flex-col gap-2">
          <label class="text-sm font-medium text-secondary">Start Date</label>
          <div class="relative">
            <input type="date" class="w-full p-3 rounded-xl border border-border bg-gray-50 text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white transition-all">
          </div>
        </div>
        <div class="flex flex-col gap-2">
          <label class="text-sm font-medium text-secondary">End Date</label>
          <div class="relative">
            <input type="date" class="w-full p-3 rounded-xl border border-border bg-gray-50 text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white transition-all">
          </div>
        </div>
      </div> --}}
    </div>
    <div class="p-6 bg-gray-50 flex justify-end gap-3">
      <button onclick="closeDateModal()" class="px-6 py-3 rounded-full border border-border bg-white text-foreground font-semibold hover:bg-gray-100 transition-all cursor-pointer">Cancel</button>
      <button onclick="applyDateRange()" class="px-6 py-3 rounded-full bg-primary text-white font-bold hover:bg-primary-hover transition-all cursor-pointer shadow-lg shadow-primary/20">Apply Range</button>
    </div>
  </div>
</div>

    <!-- Page Content Area -->
    <div class="flex-1 overflow-y-auto p-5 md:p-8">
      
      <!-- Page Header & Actions -->
      <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
          <h1 class="text-foreground text-2xl font-bold mb-1">Laporan Ticket</h1>
          <p class="text-secondary text-sm">Telusuri laporan ticket,Jumlah pembelian, gender dan jenis ticket.</p>
        </div>
                <div class="grid grid-cols-2 gap-2 w-full md:w-auto md:flex md:items-center md:gap-3">
          <button  onclick="openDateModal()" class="flex items-center justify-center gap-2 px-4 md:px-6 py-3 ring-1 ring-border hover:ring-primary rounded-full text-foreground font-semibold transition-all duration-300 cursor-pointer bg-white">
            <i data-lucide="calendar" class="w-5 h-5 text-secondary"></i>
            <span id="dateRangeLabel">Last 30 Days</span>
            <i data-lucide="chevron-down" class="w-4 h-4 text-secondary ml-1"></i>
          </button>
        <button id="exportBtn" onclick="handleExport()" class="flex items-center justify-center gap-2 px-6 py-3 bg-primary text-white rounded-full font-bold hover:bg-primary-hover transition-all duration-300 cursor-pointer w-full md:w-auto shadow-sm">
          <i data-lucide="download" class="size-5"></i>
          <span>Export Report</span>
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
            <span class="text-success text-sm font-bold bg-success/10 px-2 py-1 rounded-lg">+12%</span>
          </div>
          <p class="font-bold text-[28px] leading-10 text-foreground">Rp 12.500.000</p>
        </div>

        <!-- Expenses -->
        <div class="flex flex-col rounded-2xl border border-border p-6 gap-3 bg-white shadow-sm">
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-[6px]">
              <div class="size-11 bg-error/10 rounded-xl flex items-center justify-center shrink-0">
                <i data-lucide="user" class="size-6 text-error"></i>
              </div>
              <p class="font-medium text-secondary">Tiket Terscan</p>
            </div>
            {{-- <span class="text-error text-sm font-bold bg-error/10 px-2 py-1 rounded-lg">-5%</span> --}}
          </div>
          <p class="font-bold text-[28px] leading-10 text-foreground">3000</p>
        </div>

        <!-- Balance -->
        <div class="flex flex-col rounded-2xl border border-border p-6 gap-3 bg-white shadow-sm">
            <div>
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-[6px]">
              <div class="size-11 bg-primary/10 rounded-xl flex items-center justify-center shrink-0">
                <i data-lucide="tickets" class="size-6 text-primary"></i>
              </div>
              <p class="font-medium text-secondary"> Ticket Terusan</p>
            </div>
            <span class="text-success text-sm font-bold bg-success/10 px-2 py-1 rounded-lg">+5%</span>
          </div>

          </div>
          <p class="font-bold text-[28px] leading-10 text-foreground">1000</p>
        </div>
      </div>

      <!-- Stats Grid 2: Fund Types -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-8">
        <!-- Zakat -->
        <div class="flex flex-col rounded-2xl border border-border p-6 gap-3 bg-white shadow-sm">
          <div class="flex items-center justify-between">
          <div class="flex items-center gap-[6px]">
            <div class="size-11 bg-warning/10 rounded-xl flex items-center justify-center shrink-0">
              <i data-lucide="users" class="size-6 text-warning-dark"></i>
            </div>
            <p class="font-medium text-secondary">Jumlah pengunjung</p>
          </div>
             <span class="text-success text-sm font-bold bg-success/10 px-2 py-1 rounded-lg">+5%</span>
        </div>
          
          <p class="font-bold text-[28px] leading-10 text-foreground">5000</p>
        </div>

        <!-- Sadaqah -->
        <div class="flex flex-col rounded-2xl border border-border p-6 gap-3 bg-white shadow-sm">
          <div class="flex items-center justify-between">
          <div class="flex items-center gap-[6px]">
            <div class="size-11 bg-info/10 rounded-xl flex items-center justify-center shrink-0">
              <i data-lucide="user-round" class="size-6 text-info"></i>
            </div>
            <p class="font-medium text-secondary">Tiket Belum Terscan</p>
          </div>
          {{-- <span class="text-error text-sm font-bold bg-error/10 px-2 py-1 rounded-lg">-5%</span> --}}
          </div>
          <p class="font-bold text-[32px] leading-10 text-foreground">2000</p>
        </div>

        <!-- Waqf -->
        <div class="flex flex-col rounded-2xl border border-border p-6 gap-3 bg-white shadow-sm">
          <div class="flex items-center justify-between">
          <div class="flex items-center gap-[6px]">
            <div class="size-11 bg-success/10 rounded-xl flex items-center justify-center shrink-0">
              <i data-lucide="ticket" class="size-6 text-success-dark"></i>
            </div>
            <p class="font-medium text-secondary">Ticket Normal</p>
          </div>
          <span class="text-success text-sm font-bold bg-success/10 px-2 py-1 rounded-lg">+5%</span>
          </div>
          <p class="font-bold text-[28px] leading-10 text-foreground">4000</p>
        </div>
      </div>

      <!-- Transactions Section -->
      <div class="flex flex-col rounded-3xl border border-border bg-white shadow-sm overflow-hidden">
        
        <!-- Section Header & Filters -->
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 p-6 border-b border-border">
          <h3 class="font-bold text-lg text-foreground">Transaksi Penjualan</h3>
          
          <div class="flex flex-col sm:flex-row items-center gap-3 w-full lg:w-auto">
            <!-- Date Range Filter -->
            <div class="relative w-full sm:w-auto">
              <div class="flex items-center h-12 px-4 rounded-2xl ring-1 ring-border focus-within:ring-2 focus-within:ring-primary bg-white transition-all">
                <i data-lucide="calendar" class="size-5 text-secondary shrink-0 mr-2"></i>
                <input type="text" placeholder="Oct 1 - Oct 31, 2023" class="w-full sm:w-[180px] bg-transparent outline-none text-sm font-medium text-foreground placeholder:text-secondary" readonly onclick="this.type='date'; this.showPicker();" onblur="this.type='text'">
              </div>
            </div>
            
            <!-- Type Filter -->
            <div class="relative w-full sm:w-auto">
              <select id="selectTypeFilter" class="w-full sm:w-[160px] h-12 pl-4 pr-10 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary bg-white outline-none text-sm font-medium text-foreground transition-all">
                <option value="all">All Types</option>
                <option value="income">Active</option>
                <option value="expense">Used</option>

              </select>
            </div>
          </div>
        </div>

        <!-- Table Wrapper for Mobile Scroll -->
        <div class="overflow-x-auto">
          <table class="w-full min-w-[1000px] text-left border-collapse">
            <thead>
              <tr class="bg-muted/50 border-b border-border">
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider w-[10%]">Code</th>
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider w-[15%]">Ticket Normal</th>
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider w-[15%]">Ticket Terusan</th>
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider w-[12%]">Price</th>
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider w-[10%]">Method</th>
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider w-[10%]">Date</th>
                <th class="px-6 py-4 text-xs font-semibold text-secondary uppercase tracking-wider w-[11%]">Status</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-border">
              <!-- Row 1 -->
              <tr class="hover:bg-muted/30 transition-colors group">
                <td class="px-6 py-4">
                  <span class="font-semibold text-sm text-foreground">TRX-1042</span>
                </td>

                <td class="px-6 py-4">
                  <p class="text-sm font-semibold text-foreground truncate max-w-[100px] bg-success/40 text-success-dark text-center p-1 rounded-full"> 10 Ticket</p>
                </td>
                <td class="px-6 py-4">
                  <p class="text-sm font-semibold text-foreground truncate max-w-[100px] bg-error/40 text-error-dark text-center p-1 rounded-full">5 Ticket</p>
                </td>
                <td class="px-6 py-4">
                  <span class="text-sm font-bold text-success">Rp 160.000</span>
                </td>
                <td class="px-6 py-4">
                  <div class="flex items-center gap-2">
                    <i data-lucide="smartphone" class="size-4 text-secondary"></i>
                    <span class="text-sm font-medium text-secondary">QRIS</span>
                  </div>
                </td>
                <td class="px-6 py-4">
                  <span class="text-sm font-medium text-secondary">24 Oct 2023</span>
                </td>
                <td class="px-6 py-4">
                  <span class="inline-flex items-center justify-center px-3 py-1 rounded-full bg-success-light text-success-dark text-xs font-bold">
                    Completed
                  </span>
                </td>
              </tr>

              <!-- Row 2 -->
              <tr class="hover:bg-muted/30 transition-colors group">
                <td class="px-6 py-4">
                  <span class="font-semibold text-sm text-foreground">TRX-1041</span>
                </td>

                <td class="px-6 py-4">
                  <p class="text-sm font-semibold text-foreground truncate max-w-[100px] bg-success/40 text-success-dark text-center p-1 rounded-full">5 Ticket</p>
                </td>
                <td class="px-6 py-4">
                  <p class="text-sm font-semibold text-foreground truncate max-w-[100px] bg-error/40 text-error-dark text-center p-1 rounded-full">5 Ticket</p>
                </td>
                <td class="px-6 py-4">
                  <span class="text-sm font-bold text-success">Rp 2.450.000</span>
                </td>
                <td class="px-6 py-4">
                  <div class="flex items-center gap-2">
                    <i data-lucide="building" class="size-4 text-secondary"></i>
                    <span class="text-sm font-medium text-secondary">Bank Trf</span>
                  </div>
                </td>
                <td class="px-6 py-4">
                  <span class="text-sm font-medium text-secondary">23 Oct 2023</span>
                </td>
                <td class="px-6 py-4">
                  <span class="inline-flex items-center justify-center px-3 py-1 rounded-full bg-success-light text-success-dark text-xs font-bold">
                    Completed
                  </span>
                </td>
              </tr>

              <!-- Row 3 -->
              <tr class="hover:bg-muted/30 transition-colors group">
                <td class="px-6 py-4">
                  <span class="font-semibold text-sm text-foreground">TRX-1040</span>
                </td>

                <td class="px-6 py-4">
                  <p class="text-sm font-semibold text-foreground truncate max-w-[100px] bg-success/40 text-success-dark text-center p-1 rounded-full">3 Ticket</p>
                </td>
                <td class="px-6 py-4">
                  <p class="text-sm font-semibold text-foreground truncate max-w-[100px] bg-error/40 text-error-dark text-center p-1 rounded-full">3 Ticket</p>
                </td>
                <td class="px-6 py-4">
                  <span class="text-sm font-bold text-error">Rp 4.200.000</span>
                </td>
                <td class="px-6 py-4">
                  <div class="flex items-center gap-2">
                    <i data-lucide="banknote" class="size-4 text-secondary"></i>
                    <span class="text-sm font-medium text-secondary">Cash</span>
                  </div>
                </td>
                <td class="px-6 py-4">
                  <span class="text-sm font-medium text-secondary">20 Oct 2023</span>
                </td>
                <td class="px-6 py-4">
                  <span class="inline-flex items-center justify-center px-3 py-1 rounded-full bg-warning-light text-warning-dark text-xs font-bold">
                    Pending Dep.
                  </span>
                </td>
              </tr>

              <!-- Row 4 -->
              <tr class="hover:bg-muted/30 transition-colors group">
                <td class="px-6 py-4">
                  <span class="font-semibold text-sm text-foreground">TRX-1039</span>
                </td>

                <td class="px-6 py-4">
                  <p class="text-sm font-semibold text-foreground truncate max-w-[100px] bg-success/40 text-success-dark text-center p-1 rounded-full">2 Ticket</p>
                </td>
                <td class="px-6 py-4">
                  <p class="text-sm font-semibold text-foreground truncate max-w-[100px] bg-error/40 text-error-dark text-center p-1 rounded-full">2 Ticket</p>
                </td>
                <td class="px-6 py-4">
                  <span class="text-sm font-bold text-success">Rp 10.000.000</span>
                </td>
                <td class="px-6 py-4">
                  <div class="flex items-center gap-2">
                    <i data-lucide="building" class="size-4 text-secondary"></i>
                    <span class="text-sm font-medium text-secondary">Bank Trf</span>
                  </div>
                </td>
                <td class="px-6 py-4">
                  <span class="text-sm font-medium text-secondary">18 Oct 2023</span>
                </td>
                <td class="px-6 py-4">
                  <span class="inline-flex items-center justify-center px-3 py-1 rounded-full bg-success-light text-success-dark text-xs font-bold">
                    Completed
                  </span>
                </td>
              </tr>

              <!-- Row 5 -->
              <tr class="hover:bg-muted/30 transition-colors group">
                <td class="px-6 py-4">
                  <span class="font-semibold text-sm text-foreground">TRX-1038</span>
                </td>

                <td class="px-6 py-4">
                  <p class="text-sm font-semibold text-foreground truncate max-w-[100px] bg-success/40 text-success-dark text-center p-1 rounded-full">3 Ticket</p>
                </td>
                <td class="px-6 py-4">
                  <p class="text-sm font-semibold text-foreground truncate max-w-[100px] bg-error/40 text-error-dark text-center p-1 rounded-full">3 Ticket</p>
                </td>
                <td class="px-6 py-4">
                  <span class="text-sm font-bold text-success">Rp 850.000</span>
                </td>
                <td class="px-6 py-4">
                  <div class="flex items-center gap-2">
                    <i data-lucide="banknote" class="size-4 text-secondary"></i>
                    <span class="text-sm font-medium text-secondary">Cash</span>
                  </div>
                </td>
                <td class="px-6 py-4">
                  <span class="text-sm font-medium text-secondary">15 Oct 2023</span>
                </td>
                <td class="px-6 py-4">
                  <span class="inline-flex items-center justify-center px-3 py-1 rounded-full bg-success-light text-success-dark text-xs font-bold">
                    Completed
                  </span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        
        <!-- Pagination -->
        <div class="flex flex-col sm:flex-row items-center justify-between p-6 border-t border-border gap-4">
          <p class="text-sm text-secondary font-medium">Showing <span class="text-foreground font-bold">1-5</span> of <span class="text-foreground font-bold">124</span> transactions</p>
          <div class="flex items-center gap-2">
            <button class="p-[10px] rounded-xl border border-border bg-white hover:ring-1 hover:ring-primary transition-all duration-300 cursor-pointer disabled:opacity-50" aria-label="Previous" disabled>
              <i data-lucide="chevron-left" class="size-5 text-secondary"></i>
            </button>
            <div class="hidden sm:flex items-center gap-2">
              <button class="size-10 flex items-center justify-center rounded-xl bg-primary/10 border border-primary/20 font-bold text-primary cursor-pointer">1</button>
              <button class="size-10 flex items-center justify-center rounded-xl border border-border bg-white hover:bg-primary/10 hover:text-primary font-semibold transition-all duration-300 cursor-pointer">2</button>
              <button class="size-10 flex items-center justify-center rounded-xl border border-border bg-white hover:bg-primary/10 hover:text-primary font-semibold transition-all duration-300 cursor-pointer">3</button>
            </div>
            <button class="p-[10px] rounded-xl border border-border bg-white hover:ring-1 hover:ring-primary transition-all duration-300 cursor-pointer" aria-label="Next">
              <i data-lucide="chevron-right" class="size-5 text-secondary"></i>
            </button>
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

@endsection
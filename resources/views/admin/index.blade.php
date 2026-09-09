@extends('layouts.dashboard')

@section('title', 'Analytics Dashboard - AppName')
@section('meta_description', 'Comprehensive analytics dashboard with traffic trends, device usage, and exportable reports.')
@section('body_class', 'font-sans bg-white min-h-screen overflow-x-hidden')

@section('content')

<div class="flex h-screen max-h-screen flex-1 bg-muted overflow-hidden">
  <!-- SIDEBAR -->

  


  <!-- MAIN CONTENT -->
  <main class="flex-1 lg:ml-[280px] flex flex-col bg-white min-h-screen overflow-x-hidden">
    <!-- Top Header -->
    <div class="flex items-center justify-between w-full h-[90px] shrink-0 border-b border-border bg-white px-5 md:px-8">
      <button onclick="toggleSidebar()" aria-label="Open menu" class="lg:hidden size-11 flex items-center justify-center rounded-xl ring-1 ring-border hover:ring-primary transition-all duration-300 cursor-pointer">
        <i data-lucide="menu" class="size-6 text-foreground"></i>
      </button>
      <h2 class="hidden lg:block font-bold text-2xl text-foreground">Dashboard Sendangku</h2>
      <div class="flex items-center gap-3">
        {{-- <button onclick="openNotificationModal()" class="size-11 flex items-center justify-center rounded-xl ring-1 ring-border hover:ring-primary transition-all duration-300 cursor-pointer relative" aria-label="Notifications">
          <i data-lucide="bell" class="size-6 text-secondary"></i>
          <span class="absolute -top-1 -right-1 h-5 px-1.5 rounded-full bg-error text-white text-xs font-medium flex items-center justify-center">2</span>
        </button> --}}
      </div>
    </div>

    <!-- Page Content -->
    <div class="flex-1 overflow-y-auto p-5 md:p-8">
      
      <!-- Page Header with Filters -->
      <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6 md:mb-8">
        <div>
          <h1 class="text-foreground text-2xl md:text-3xl font-bold mb-1">Informasi Dashboard</h1>
          <p class="text-secondary text-sm md:text-base">Lacak metrik utama dan status laporan </p>
        </div>
        <div class="grid grid-cols-2 gap-2 w-full md:w-auto md:flex md:items-center md:gap-3">
          <button onclick="openDateModal()" class="flex items-center justify-center gap-2 px-4 md:px-6 py-3 ring-1 ring-border hover:ring-primary rounded-full text-foreground font-semibold transition-all duration-300 cursor-pointer bg-white">
            <i data-lucide="calendar" class="w-5 h-5 text-secondary"></i>
            <span id="dateRangeLabel">{{ $dateRangeLabel }}</span>
            <i data-lucide="chevron-down" class="w-4 h-4 text-secondary ml-1"></i>
          </button>
          {{-- <button onclick="openExportModal()" class="flex items-center justify-center gap-2 px-4 md:px-6 py-3 bg-primary text-white rounded-full font-bold hover:bg-primary-hover transition-all duration-300 cursor-pointer shadow-lg shadow-primary/20">
            <i data-lucide="download" class="w-5 h-5"></i>
            <span>Export Report</span>
          </button> --}}
        </div>
      </div>

      <!-- Stats Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-6">
        <!-- Revenue -->
        <div class="flex flex-col rounded-2xl border border-border p-6 gap-3 bg-white">
          <div class="flex items-center gap-[6px]">
            <div class="size-11 bg-success/10 rounded-xl flex items-center justify-center shrink-0">
              <i data-lucide="wallet" class="size-6 text-success"></i>
            </div>
            <p class="font-medium text-secondary">Total Pendapatan</p>
          </div>
          <div class="flex items-center gap-3">
            <p class="font-bold text-[28px] leading-10">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            {{-- <span class="flex items-center gap-1 text-success text-sm font-semibold bg-success/10 px-2 py-0.5 rounded-full">
              <i data-lucide="trending-up" class="w-3 h-3"></i> 12%
            </span> --}}
          </div>
        </div>

        <!-- Users -->
        <div class="flex flex-col rounded-2xl border border-border p-6 gap-3 bg-white">
          <div class="flex items-center gap-[6px]">
            <div class="size-11 bg-primary/10 rounded-xl flex items-center justify-center shrink-0">
              <i data-lucide="users" class="size-6 text-primary"></i>
            </div>
            <p class="font-medium text-secondary">Total Pengunjung</p>
          </div>
          <div class="flex items-center gap-3">
            <p class="font-bold text-[28px] leading-10">{{ number_format($totalVisitors, 0, ',', '.') }}</p>
            {{-- <span class="flex items-center gap-1 text-success text-sm font-semibold bg-success/10 px-2 py-0.5 rounded-full">
              <i data-lucide="trending-up" class="w-3 h-3"></i> 8.5%
            </span> --}}
          </div>
        </div>

        <!-- Pendapatan Tiket -->
        <div class="flex flex-col rounded-2xl border border-border p-6 gap-3 bg-white">
          <div class="flex items-center gap-[6px]">
            <div class="size-11 bg-warning/10 rounded-xl flex items-center justify-center shrink-0">
              <i data-lucide="ticket" class="size-6 text-warning-dark"></i>
            </div>
            <p class="font-medium text-secondary">Pendapatan Tiket</p>
          </div>
          <div class="flex items-center gap-3">
            <p class="font-bold text-[28px] leading-10">Rp {{ number_format($ticketRevenue, 0, ',', '.') }}</p>
          </div>
        </div>

        <!-- Pendapatan Restourant -->
        <div class="flex flex-col rounded-2xl border border-border p-6 gap-3 bg-white">
          <div class="flex items-center gap-[6px]">
            <div class="size-11 bg-card-message rounded-xl flex items-center justify-center shrink-0">
              <i data-lucide="utensils" class="size-6 text-primary"></i>
            </div>
            <p class="font-medium text-secondary">Pendapatan Restourant</p>
          </div>
          <div class="flex items-center gap-3">
            <p class="font-bold text-[28px] leading-10">Rp {{ number_format($restaurantRevenue, 0, ',', '.') }}</p>
          </div>
        </div>
      </div>

      <!-- Charts Section Row 1 -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Line Chart (Traffic) -->
        <div class="lg:col-span-2 flex flex-col rounded-2xl border border-border p-6 gap-6 bg-white">
          <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
              <h3 class="font-bold text-lg text-foreground">Trafik pengunjung</h3>
              <p class="text-sm text-secondary">Trafik Pengunjung wisata mingguan</p>
            </div>
            {{-- <div class="flex items-center bg-muted rounded-xl p-1">
              <button class="px-3 py-1.5 bg-white shadow-sm rounded-lg text-xs font-semibold text-foreground transition-all">Daily</button>
              <button class="px-3 py-1.5 text-xs font-medium text-secondary hover:text-foreground transition-all">Weekly</button>
              <button class="px-3 py-1.5 text-xs font-medium text-secondary hover:text-foreground transition-all">Monthly</button>
            </div> --}}
          </div>
          <div class="w-full relative h-[300px]">
            <canvas id="trafficChart" data-labels='@json($trafficLabels)' data-values='@json($trafficValues)'></canvas>
          </div>
        </div>

        <!-- Doughnut Chart (Devices) -->
        <div class="flex flex-col rounded-2xl border border-border p-6 gap-6 bg-white">
          <div>
            <h3 class="font-bold text-lg text-foreground">Presentase Pembelian Tiket</h3>
            <p class="text-sm text-secondary">Presentase pembelian tiket berdasarkan Kategori</p>
          </div>
          <div class="relative h-[220px] w-full flex items-center justify-center">
            <canvas id="deviceChart" data-online="{{ $onlinePercentage }}" data-offline="{{ $offlinePercentage }}"></canvas>
            <!-- Center Text Overlay -->
            <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
              <span class="text-3xl font-bold text-foreground">{{ $onlinePercentage }}%</span>
              <span class="text-xs text-secondary font-medium">online</span>
            </div>
          </div>
          <div class="flex flex-col gap-3 mt-auto">
            <div class="flex items-center justify-between text-sm">
              <div class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-primary"></span>
                <span class="text-secondary">online</span>
              </div>
              <span class="font-semibold text-foreground">{{ $onlinePercentage }}%</span>
            </div>
            <div class="flex items-center justify-between text-sm">
              <div class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-card-message"></span>
                <span class="text-secondary">offline</span>
              </div>
              <span class="font-semibold text-foreground">{{ $offlinePercentage }}%</span>
            </div>
            {{-- <div class="flex items-center justify-between text-sm">
              <div class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-gray-200"></span>
                <span class="text-secondary">Tablet</span>
              </div>
              <span class="font-semibold text-foreground">15%</span>
            </div> --}}
          </div>
        </div>
      </div>

      {{-- Row 2: Bar Chart & Reports (Diabaikan sementara sesuai permintaan) --}}
      {{--
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Bar Chart (Acquisition) -->
        <div class="flex flex-col rounded-2xl border border-border p-6 gap-6 bg-white">
          <div class="flex items-center justify-between">
            <h3 class="font-bold text-lg text-foreground">User Acquisition</h3>
            <button class="p-2 hover:bg-muted rounded-xl transition-colors">
              <i data-lucide="more-horizontal" class="w-5 h-5 text-secondary"></i>
            </button>
          </div>
          <div class="w-full h-[250px]">
            <canvas id="acquisitionChart"></canvas>
          </div>
        </div>

        <!-- Exportable Reports Section -->
        <div class="flex flex-col rounded-2xl border border-border p-6 gap-4 bg-white">
          <div class="flex items-center justify-between mb-2">
            <div>
              <h3 class="font-bold text-lg text-foreground">Recent Reports</h3>
              <p class="text-sm text-secondary">Generated analytics reports</p>
            </div>
            <a href="#" class="text-sm text-primary font-semibold hover:underline cursor-pointer">View All</a>
          </div>

          <!-- Report List -->
          <div class="flex flex-col gap-3">
            <!-- Item 1 -->
            <div class="flex items-center gap-4 p-3 rounded-xl border border-border hover:border-primary/50 hover:bg-muted/30 transition-all group">
              <div class="size-10 bg-error/10 rounded-lg flex items-center justify-center shrink-0">
                <i data-lucide="file-text" class="size-5 text-error"></i>
              </div>
              <div class="flex-1 min-w-0">
                <h4 class="font-semibold text-sm text-foreground truncate">Q3_Financial_Overview.pdf</h4>
                <div class="flex items-center gap-2 text-xs text-secondary mt-0.5">
                  <span>2.4 MB</span>
                  <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                  <span>Generated 2 hrs ago</span>
                </div>
              </div>
              <button onclick="showToast('Downloading report...', 'success')" class="p-2 text-secondary hover:text-primary hover:bg-primary/10 rounded-lg transition-colors cursor-pointer" title="Download">
                <i data-lucide="download" class="size-5"></i>
              </button>
            </div>

            <!-- Item 2 -->
            <div class="flex items-center gap-4 p-3 rounded-xl border border-border hover:border-primary/50 hover:bg-muted/30 transition-all group">
              <div class="size-10 bg-success/10 rounded-lg flex items-center justify-center shrink-0">
                <i data-lucide="file-spreadsheet" class="size-5 text-success"></i>
              </div>
              <div class="flex-1 min-w-0">
                <h4 class="font-semibold text-sm text-foreground truncate">User_Data_Export_Nov.xlsx</h4>
                <div class="flex items-center gap-2 text-xs text-secondary mt-0.5">
                  <span>1.8 MB</span>
                  <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                  <span>Generated yesterday</span>
                </div>
              </div>
              <button onclick="showToast('Downloading report...', 'success')" class="p-2 text-secondary hover:text-primary hover:bg-primary/10 rounded-lg transition-colors cursor-pointer" title="Download">
                <i data-lucide="download" class="size-5"></i>
              </button>
            </div>

            <!-- Item 3 -->
            <div class="flex items-center gap-4 p-3 rounded-xl border border-border hover:border-primary/50 hover:bg-muted/30 transition-all group">
              <div class="size-10 bg-warning/10 rounded-lg flex items-center justify-center shrink-0">
                <i data-lucide="file-pie-chart" class="size-5 text-warning-dark"></i>
              </div>
              <div class="flex-1 min-w-0">
                <h4 class="font-semibold text-sm text-foreground truncate">Marketing_Campaign_Results.csv</h4>
                <div class="flex items-center gap-2 text-xs text-secondary mt-0.5">
                  <span>540 KB</span>
                  <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                  <span>Generated 3 days ago</span>
                </div>
              </div>
              <button onclick="showToast('Downloading report...', 'success')" class="p-2 text-secondary hover:text-primary hover:bg-primary/10 rounded-lg transition-colors cursor-pointer" title="Download">
                <i data-lucide="download" class="size-5"></i>
              </button>
            </div>
            
            <!-- Item 4 -->
             <div class="flex items-center gap-4 p-3 rounded-xl border border-border hover:border-primary/50 hover:bg-muted/30 transition-all group">
              <div class="size-10 bg-primary/10 rounded-lg flex items-center justify-center shrink-0">
                <i data-lucide="presentation" class="size-5 text-primary"></i>
              </div>
              <div class="flex-1 min-w-0">
                <h4 class="font-semibold text-sm text-foreground truncate">Annual_Strategy_Deck.pptx</h4>
                <div class="flex items-center gap-2 text-xs text-secondary mt-0.5">
                  <span>12.5 MB</span>
                  <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                  <span>Generated last week</span>
                </div>
              </div>
              <button onclick="showToast('Downloading report...', 'success')" class="p-2 text-secondary hover:text-primary hover:bg-primary/10 rounded-lg transition-colors cursor-pointer" title="Download">
                <i data-lucide="download" class="size-5"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      --}}
      
    </div>
  </main>
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
      
      <!-- Presets (Hari Ini, Minggu Ini, Bulan Ini, Semua Waktu) -->
      <div class="flex flex-wrap gap-2.5">
        <button type="button" onclick="selectDatePreset(this, 'Hari Ini'); window.selectedDashboardRange = 'today';" class="date-preset px-4 py-2.5 rounded-xl {{ $range === 'today' ? 'bg-primary/10 text-primary font-semibold border-primary/20' : 'bg-white text-secondary font-medium border-border hover:border-primary hover:text-primary' }} text-sm border transition-all cursor-pointer">Hari Ini</button>
        <button type="button" onclick="selectDatePreset(this, 'Minggu Ini'); window.selectedDashboardRange = 'week';" class="date-preset px-4 py-2.5 rounded-xl {{ $range === 'week' ? 'bg-primary/10 text-primary font-semibold border-primary/20' : 'bg-white text-secondary font-medium border-border hover:border-primary hover:text-primary' }} text-sm border transition-all cursor-pointer">Minggu Ini</button>
        <button type="button" onclick="selectDatePreset(this, 'Bulan Ini'); window.selectedDashboardRange = 'month';" class="date-preset px-4 py-2.5 rounded-xl {{ $range === 'month' ? 'bg-primary/10 text-primary font-semibold border-primary/20' : 'bg-white text-secondary font-medium border-border hover:border-primary hover:text-primary' }} text-sm border transition-all cursor-pointer">Bulan Ini</button>
        <button type="button" onclick="selectDatePreset(this, 'Semua Waktu'); window.selectedDashboardRange = 'all';" class="date-preset px-4 py-2.5 rounded-xl {{ $range === 'all' || !$range ? 'bg-primary/10 text-primary font-semibold border-primary/20' : 'bg-white text-secondary font-medium border-border hover:border-primary hover:text-primary' }} text-sm border transition-all cursor-pointer">Semua Waktu</button>
      </div>
    </div>
    <div class="p-6 bg-gray-50 flex justify-end gap-3">
      <button onclick="closeDateModal()" class="px-5 py-2.5 rounded-full border border-border bg-white text-foreground font-semibold hover:bg-gray-100 transition-all cursor-pointer text-sm">Batal</button>
      <button onclick="applyDateRange()" class="px-6 py-2.5 rounded-full bg-primary text-white font-bold hover:bg-primary-hover transition-all cursor-pointer shadow-lg shadow-primary/20 text-sm">Terapkan</button>
    </div>
  </div>
</div>

<!-- Export Modal -->
<div id="export-modal" class="fixed inset-0 bg-black/50 z-[100] hidden items-center justify-center p-4">
  <div class="bg-white rounded-3xl w-full max-w-sm shadow-2xl text-center p-8">
    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6">
      <i data-lucide="download-cloud" class="w-8 h-8 text-primary"></i>
    </div>
    <h3 class="text-xl font-bold text-foreground mb-2">Export Data</h3>
    <p class="text-secondary text-sm mb-6">Choose format to download your analytics report.</p>
    
    <div class="flex flex-col gap-3 mb-6">
      <button onclick="confirmExport('PDF')" class="flex items-center gap-4 p-4 rounded-xl border border-border hover:border-primary hover:bg-primary/5 transition-all cursor-pointer group text-left">
        <div class="size-10 bg-error/10 rounded-lg flex items-center justify-center">
          <i data-lucide="file-text" class="size-5 text-error"></i>
        </div>
        <div>
          <p class="font-semibold text-foreground group-hover:text-primary">Export as PDF</p>
          <p class="text-xs text-secondary">Best for presentations</p>
        </div>
      </button>
      <button onclick="confirmExport('CSV')" class="flex items-center gap-4 p-4 rounded-xl border border-border hover:border-primary hover:bg-primary/5 transition-all cursor-pointer group text-left">
        <div class="size-10 bg-success/10 rounded-lg flex items-center justify-center">
          <i data-lucide="file-spreadsheet" class="size-5 text-success"></i>
        </div>
        <div>
          <p class="font-semibold text-foreground group-hover:text-primary">Export as CSV</p>
          <p class="text-xs text-secondary">Raw data for analysis</p>
        </div>
      </button>
    </div>
    
    <button onclick="closeExportModal()" class="text-secondary font-semibold hover:text-foreground transition-colors cursor-pointer">Cancel</button>
  </div>
</div>

<!-- Toast Notification -->
<div id="toast" class="fixed bottom-5 right-5 bg-foreground text-white px-6 py-4 rounded-xl shadow-2xl transform translate-y-24 transition-transform duration-300 flex items-center gap-3 z-[200]">
  <div id="toast-icon" class="w-6 h-6 rounded-full bg-success flex items-center justify-center shrink-0">
    <i data-lucide="check" class="w-4 h-4 text-white"></i>
  </div>
  <p id="toast-message" class="font-medium">Operation successful</p>
</div>

<!-- Page Not Found Modal (Required) -->
<div id="page-not-found-modal" class="fixed inset-0 bg-black/50 z-[100] hidden flex items-center justify-center p-4">
  <div class="bg-white rounded-card p-6 max-w-sm w-full text-center">
    <div class="w-16 h-16 bg-warning-light rounded-full flex items-center justify-center mx-auto mb-4">
      <i data-lucide="alert-triangle" class="w-8 h-8 text-warning-dark"></i>
    </div>
    <h3 class="text-foreground text-xl font-bold mb-2">Page Not Available</h3>
    <p class="text-gray-500 text-sm mb-6">This page hasn't been created yet. Generate it using the chat!</p>
    <button onclick="closePageNotFoundModal()" class="w-full px-4 py-2.5 bg-primary text-white rounded-button font-medium hover:bg-primary-hover transition-all duration-200 cursor-pointer">
      Got it
    </button>
  </div>
</div>

@endsection

@push('scripts')
<script>
    window.selectedDashboardRange = '{{ $range }}';

    function selectDatePreset(button, preset) {
        document.querySelectorAll('.date-preset').forEach(btn => {
            btn.className = 'date-preset px-4 py-2.5 rounded-xl bg-white text-secondary font-medium text-sm border border-border hover:border-primary hover:text-primary transition-all cursor-pointer';
        });
        button.className = 'date-preset px-4 py-2.5 rounded-xl bg-primary/10 text-primary font-semibold text-sm border border-primary/20 cursor-pointer transition-all';
    }

    function applyDateRange() {
        const url = new URL(window.location.href);
        if (window.selectedDashboardRange && window.selectedDashboardRange !== 'all') {
            url.searchParams.set('range', window.selectedDashboardRange);
        } else {
            url.searchParams.delete('range');
        }
        window.location.href = url.toString();
    }

    // Memastikan sumbu Y Chart Pengunjung Row 1 memiliki range 0 - 5000
    document.addEventListener('DOMContentLoaded', function() {
        const canvas = document.getElementById('trafficChart');
        if (!canvas) return;

        const setTrafficChartRange = () => {
            const chart = window.Chart && window.Chart.getChart ? window.Chart.getChart(canvas) : null;
            if (chart && chart.options && chart.options.scales && chart.options.scales.y) {
                chart.options.scales.y.min = 0;
                chart.options.scales.y.max = 5000;
                chart.options.scales.y.ticks.stepSize = 1000;
                chart.options.scales.y.ticks.autoSkip = false;
                chart.options.scales.y.ticks.maxTicksLimit = 6;
                chart.options.scales.y.ticks.callback = function(value) {
                    return value.toLocaleString('id-ID');
                };
                chart.update();
            }
        };

        setTrafficChartRange();
        setTimeout(setTrafficChartRange, 350);
    });
</script>
@endpush

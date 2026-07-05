@extends('layouts.dashboard')

@section('title', 'Analytics Dashboard - AppName')
@section('meta_description', 'Comprehensive analytics dashboard with traffic trends, device usage, and exportable reports.')
@section('body_class', 'font-sans bg-white min-h-screen overflow-x-hidden')

@section('content')

<!-- Mobile Overlay -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black/80 z-40 lg:hidden hidden" onclick="toggleSidebar()"></div>

<div class="flex h-screen max-h-screen flex-1 bg-muted overflow-hidden">
  <!-- SIDEBAR -->
  <x-sidebar />

  <!-- MAIN CONTENT -->
  <main class="flex-1 lg:ml-[280px] flex flex-col bg-white min-h-screen overflow-x-hidden">
    <!-- Top Header -->
    <div class="flex items-center justify-between w-full h-[90px] shrink-0 border-b border-border bg-white px-5 md:px-8">
      <button onclick="toggleSidebar()" aria-label="Open menu" class="lg:hidden size-11 flex items-center justify-center rounded-xl ring-1 ring-border hover:ring-primary transition-all duration-300 cursor-pointer">
        <i data-lucide="menu" class="size-6 text-foreground"></i>
      </button>
      <h2 class="hidden lg:block font-bold text-2xl text-foreground">Analytics</h2>
      <div class="flex items-center gap-3">
        <button onclick="openSearchModal()" class="size-11 flex items-center justify-center rounded-xl ring-1 ring-border hover:ring-primary transition-all duration-300 cursor-pointer" aria-label="Search">
          <i data-lucide="search" class="size-6 text-secondary"></i>
        </button>
        <button class="size-11 flex items-center justify-center rounded-xl ring-1 ring-border hover:ring-primary transition-all duration-300 cursor-pointer relative" aria-label="Notifications">
          <i data-lucide="bell" class="size-6 text-secondary"></i>
          <span class="absolute -top-1 -right-1 h-5 px-1.5 rounded-full bg-error text-white text-xs font-medium flex items-center justify-center">2</span>
        </button>
        <div class="hidden md:flex items-center gap-3 pl-3 border-l border-border">
          <div class="text-right">
            <p class="font-semibold text-foreground text-sm">Alex Morgan</p>
            <p class="text-secondary text-xs">Data Analyst</p>
          </div>
          <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=100&h=100&fit=crop" alt="Profile" class="size-11 rounded-full object-cover ring-2 ring-border">
        </div>
      </div>
    </div>

    <!-- Page Content -->
    <div class="flex-1 overflow-y-auto p-5 md:p-8">
      
      <!-- Page Header with Filters -->
      <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6 md:mb-8">
        <div>
          <h1 class="text-foreground text-2xl md:text-3xl font-bold mb-1">Performance Overview</h1>
          <p class="text-secondary text-sm md:text-base">Track your key metrics and report status</p>
        </div>
        <div class="grid grid-cols-2 gap-2 w-full md:w-auto md:flex md:items-center md:gap-3">
          <button onclick="openDateModal()" class="flex items-center justify-center gap-2 px-4 md:px-6 py-3 ring-1 ring-border hover:ring-primary rounded-full text-foreground font-semibold transition-all duration-300 cursor-pointer bg-white">
            <i data-lucide="calendar" class="w-5 h-5 text-secondary"></i>
            <span id="dateRangeLabel">Last 30 Days</span>
            <i data-lucide="chevron-down" class="w-4 h-4 text-secondary ml-1"></i>
          </button>
          <button onclick="openExportModal()" class="flex items-center justify-center gap-2 px-4 md:px-6 py-3 bg-primary text-white rounded-full font-bold hover:bg-primary-hover transition-all duration-300 cursor-pointer shadow-lg shadow-primary/20">
            <i data-lucide="download" class="w-5 h-5"></i>
            <span>Export Report</span>
          </button>
        </div>
      </div>

      <!-- Stats Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-6">
        <!-- Revenue -->
        <div class="flex flex-col rounded-2xl border border-border p-6 gap-3 bg-white">
          <div class="flex items-center gap-[6px]">
            <div class="size-11 bg-success/10 rounded-xl flex items-center justify-center shrink-0">
              <i data-lucide="dollar-sign" class="size-6 text-success"></i>
            </div>
            <p class="font-medium text-secondary">Total Revenue</p>
          </div>
          <div class="flex items-center gap-3">
            <p class="font-bold text-[32px] leading-10">$124K</p>
            <span class="flex items-center gap-1 text-success text-sm font-semibold bg-success/10 px-2 py-0.5 rounded-full">
              <i data-lucide="trending-up" class="w-3 h-3"></i> 12%
            </span>
          </div>
        </div>

        <!-- Users -->
        <div class="flex flex-col rounded-2xl border border-border p-6 gap-3 bg-white">
          <div class="flex items-center gap-[6px]">
            <div class="size-11 bg-primary/10 rounded-xl flex items-center justify-center shrink-0">
              <i data-lucide="users" class="size-6 text-primary"></i>
            </div>
            <p class="font-medium text-secondary">Active Users</p>
          </div>
          <div class="flex items-center gap-3">
            <p class="font-bold text-[32px] leading-10">45.2K</p>
            <span class="flex items-center gap-1 text-success text-sm font-semibold bg-success/10 px-2 py-0.5 rounded-full">
              <i data-lucide="trending-up" class="w-3 h-3"></i> 8.5%
            </span>
          </div>
        </div>

        <!-- Bounce Rate -->
        <div class="flex flex-col rounded-2xl border border-border p-6 gap-3 bg-white">
          <div class="flex items-center gap-[6px]">
            <div class="size-11 bg-warning/10 rounded-xl flex items-center justify-center shrink-0">
              <i data-lucide="activity" class="size-6 text-warning-dark"></i>
            </div>
            <p class="font-medium text-secondary">Bounce Rate</p>
          </div>
          <div class="flex items-center gap-3">
            <p class="font-bold text-[32px] leading-10">42.5%</p>
            <span class="flex items-center gap-1 text-error text-sm font-semibold bg-error/10 px-2 py-0.5 rounded-full">
              <i data-lucide="trending-down" class="w-3 h-3"></i> 2.1%
            </span>
          </div>
        </div>

        <!-- Sessions -->
        <div class="flex flex-col rounded-2xl border border-border p-6 gap-3 bg-white">
          <div class="flex items-center gap-[6px]">
            <div class="size-11 bg-card-message rounded-xl flex items-center justify-center shrink-0">
              <i data-lucide="clock" class="size-6 text-primary"></i>
            </div>
            <p class="font-medium text-secondary">Avg. Session</p>
          </div>
          <div class="flex items-center gap-3">
            <p class="font-bold text-[32px] leading-10">4m 32s</p>
            <span class="flex items-center gap-1 text-success text-sm font-semibold bg-success/10 px-2 py-0.5 rounded-full">
              <i data-lucide="trending-up" class="w-3 h-3"></i> 5%
            </span>
          </div>
        </div>
      </div>

      <!-- Charts Section Row 1 -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Line Chart (Traffic) -->
        <div class="lg:col-span-2 flex flex-col rounded-2xl border border-border p-6 gap-6 bg-white">
          <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
              <h3 class="font-bold text-lg text-foreground">Traffic Overview</h3>
              <p class="text-sm text-secondary">Daily unique visitors vs page views</p>
            </div>
            <div class="flex items-center bg-muted rounded-xl p-1">
              <button class="px-3 py-1.5 bg-white shadow-sm rounded-lg text-xs font-semibold text-foreground transition-all">Daily</button>
              <button class="px-3 py-1.5 text-xs font-medium text-secondary hover:text-foreground transition-all">Weekly</button>
              <button class="px-3 py-1.5 text-xs font-medium text-secondary hover:text-foreground transition-all">Monthly</button>
            </div>
          </div>
          <div class="w-full relative h-[300px]">
            <canvas id="trafficChart"></canvas>
          </div>
        </div>

        <!-- Doughnut Chart (Devices) -->
        <div class="flex flex-col rounded-2xl border border-border p-6 gap-6 bg-white">
          <div>
            <h3 class="font-bold text-lg text-foreground">Device Distribution</h3>
            <p class="text-sm text-secondary">Traffic source by device type</p>
          </div>
          <div class="relative h-[220px] w-full flex items-center justify-center">
            <canvas id="deviceChart"></canvas>
            <!-- Center Text Overlay -->
            <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
              <span class="text-3xl font-bold text-foreground">85%</span>
              <span class="text-xs text-secondary font-medium">Mobile</span>
            </div>
          </div>
          <div class="flex flex-col gap-3 mt-auto">
            <div class="flex items-center justify-between text-sm">
              <div class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-primary"></span>
                <span class="text-secondary">Mobile</span>
              </div>
              <span class="font-semibold text-foreground">55%</span>
            </div>
            <div class="flex items-center justify-between text-sm">
              <div class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-card-message"></span>
                <span class="text-secondary">Desktop</span>
              </div>
              <span class="font-semibold text-foreground">30%</span>
            </div>
            <div class="flex items-center justify-between text-sm">
              <div class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-gray-200"></span>
                <span class="text-secondary">Tablet</span>
              </div>
              <span class="font-semibold text-foreground">15%</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Row 2: Bar Chart & Reports -->
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
      
    </div>
  </main>
</div>

<!-- Search Modal -->
<div id="search-modal" class="fixed inset-0 bg-black/50 z-[100] hidden items-center justify-center p-4">
  <div class="bg-white rounded-3xl w-full max-w-2xl max-h-[80vh] overflow-hidden shadow-2xl">
    <div class="p-4 border-b border-border">
      <div class="flex items-center gap-3 bg-muted rounded-xl px-4">
        <i data-lucide="search" class="size-5 text-secondary"></i>
        <input type="text" id="search-input" placeholder="Search reports, metrics, or users..." class="flex-1 py-3 bg-transparent outline-none text-foreground placeholder:text-secondary">
        <kbd class="hidden sm:inline-flex items-center gap-1 px-2 py-1 bg-white rounded-lg text-xs text-secondary border border-border">ESC</kbd>
      </div>
    </div>
    <div class="p-4 overflow-y-auto max-h-[60vh]">
      <p class="text-sm text-secondary mb-3">Suggested Results</p>
      <div class="flex flex-col gap-2">
        <a href="#" class="flex items-center gap-3 p-3 rounded-xl hover:bg-muted transition-all cursor-pointer">
          <div class="size-10 bg-primary/10 rounded-xl flex items-center justify-center">
            <i data-lucide="file-text" class="size-5 text-primary"></i>
          </div>
          <div class="flex-1 min-w-0">
            <p class="font-medium text-foreground">Q3 Financial Report</p>
            <p class="text-sm text-secondary">PDF Document • 2.4 MB</p>
          </div>
        </a>
        <a href="#" class="flex items-center gap-3 p-3 rounded-xl hover:bg-muted transition-all cursor-pointer">
          <div class="size-10 bg-success/10 rounded-xl flex items-center justify-center">
            <i data-lucide="users" class="size-5 text-success"></i>
          </div>
          <div class="flex-1 min-w-0">
            <p class="font-medium text-foreground">Active Users Analysis</p>
            <p class="text-sm text-secondary">Dashboard View</p>
          </div>
        </a>
      </div>
    </div>
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
        <button onclick="selectDatePreset(this, 'Last 7 Days')" class="date-preset px-4 py-2 rounded-xl bg-primary/10 text-primary font-semibold text-sm border border-primary/20 cursor-pointer">Last 7 Days</button>
        <button onclick="selectDatePreset(this, 'Last 30 Days')" class="date-preset px-4 py-2 rounded-xl bg-white text-secondary font-medium text-sm border border-border hover:border-primary hover:text-primary transition-all cursor-pointer">Last 30 Days</button>
        <button onclick="selectDatePreset(this, 'This Month')" class="date-preset px-4 py-2 rounded-xl bg-white text-secondary font-medium text-sm border border-border hover:border-primary hover:text-primary transition-all cursor-pointer">This Month</button>
        <button onclick="selectDatePreset(this, 'Last Quarter')" class="date-preset px-4 py-2 rounded-xl bg-white text-secondary font-medium text-sm border border-border hover:border-primary hover:text-primary transition-all cursor-pointer">Last Quarter</button>
      </div>

      <!-- Custom Inputs -->
      <div class="grid grid-cols-2 gap-4">
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
      </div>
    </div>
    <div class="p-6 bg-gray-50 flex justify-end gap-3">
      <button onclick="closeDateModal()" class="px-6 py-3 rounded-full border border-border bg-white text-foreground font-semibold hover:bg-gray-100 transition-all cursor-pointer">Cancel</button>
      <button onclick="applyDateRange()" class="px-6 py-3 rounded-full bg-primary text-white font-bold hover:bg-primary-hover transition-all cursor-pointer shadow-lg shadow-primary/20">Apply Range</button>
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

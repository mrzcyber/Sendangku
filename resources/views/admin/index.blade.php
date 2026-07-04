<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Analytics Dashboard - AppName</title>
<meta name="description" content="Comprehensive analytics dashboard with traffic trends, device usage, and exportable reports.">
<link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100..900&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style type="text/tailwindcss">
  :root {
    --primary: #165DFF;
    --primary-hover: #0E4BD9;
    --foreground: #080C1A;
    --secondary: #6A7686;
    --muted: #EFF2F7;
    --border: #F3F4F3;
    --card-grey: #F1F3F6;
    --success: #30B22D;
    --success-light: #DCFCE7;
    --error: #ED6B60;
    --error-light: #FEE2E2;
    --warning: #FED71F;
    --warning-light: #FEF9C3;
    --font-sans: 'Lexend Deca', sans-serif;
  }
  @theme inline {
    --color-primary: var(--primary);
    --color-primary-hover: var(--primary-hover);
    --color-foreground: var(--foreground);
    --color-secondary: var(--secondary);
    --color-muted: var(--muted);
    --color-border: var(--border);
    --color-card-grey: var(--card-grey);
    --color-success: var(--success);
    --color-success-light: var(--success-light);
    --color-error: var(--error);
    --color-error-light: var(--error-light);
    --color-warning: var(--warning);
    --color-warning-light: var(--warning-light);
    --font-sans: var(--font-sans);
    --radius-card: 24px;
    --radius-button: 50px;
  }
  .scrollbar-hide::-webkit-scrollbar { display: none; }
  .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
</style>
</head>
<body class="font-sans bg-white min-h-screen overflow-x-hidden">

<!-- Mobile Overlay -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black/80 z-40 lg:hidden hidden" onclick="toggleSidebar()"></div>

<div class="flex h-screen max-h-screen flex-1 bg-muted overflow-hidden">
  <!-- SIDEBAR -->
  <aside id="sidebar" class="flex flex-col w-[280px] shrink-0 h-screen fixed inset-y-0 left-0 z-50 bg-white border-r border-border transform -translate-x-full lg:translate-x-0 transition-transform duration-300 overflow-hidden">
    <!-- Top Bar -->
    <div class="flex items-center justify-between border-b border-border h-[90px] px-5 gap-3">
      <div class="flex items-center gap-3">
        <div class="w-11 h-9 bg-primary rounded-xl flex items-center justify-center">
          <i data-lucide="bar-chart-2" class="w-5 h-5 text-white"></i>
        </div>
        <h1 class="font-semibold text-xl">DataView</h1>
      </div>
      <button onclick="toggleSidebar()" aria-label="Close sidebar" class="lg:hidden size-11 flex shrink-0 bg-white rounded-xl p-[10px] items-center justify-center ring-1 ring-border hover:ring-primary transition-all duration-300 cursor-pointer">
        <i data-lucide="x" class="size-6 text-secondary"></i>
      </button>
    </div>

    <!-- Navigation -->
    <div class="flex flex-col p-5 pb-28 gap-6 overflow-y-auto flex-1">
      <div class="flex flex-col gap-4">
        <h3 class="font-medium text-sm text-secondary">Overview</h3>
        <div class="flex flex-col gap-1">
          <a href="#" class="group active cursor-pointer">
            <div class="flex items-center rounded-xl p-4 gap-3 bg-white group-[.active]:bg-muted group-hover:bg-muted transition-all duration-300">
              <i data-lucide="layout-dashboard" class="size-6 text-secondary group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300"></i>
              <span class="font-medium text-secondary group-[.active]:font-semibold group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300">Dashboard</span>
            </div>
          </a>
          <a href="#" class="group cursor-pointer">
            <div class="flex items-center rounded-xl p-4 gap-3 bg-white group-[.active]:bg-muted group-hover:bg-muted transition-all duration-300">
              <i data-lucide="pie-chart" class="size-6 text-secondary group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300"></i>
              <span class="font-medium text-secondary group-[.active]:font-semibold group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300">Reports</span>
            </div>
          </a>
          <a href="#" class="group cursor-pointer">
            <div class="flex items-center rounded-xl p-4 gap-3 bg-white group-[.active]:bg-muted group-hover:bg-muted transition-all duration-300">
              <i data-lucide="users" class="size-6 text-secondary group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300"></i>
              <span class="font-medium text-secondary group-[.active]:font-semibold group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300">Audience</span>
            </div>
          </a>
        </div>
      </div>
      
      <div class="flex flex-col gap-4">
        <h3 class="font-medium text-sm text-secondary">Settings</h3>
        <div class="flex flex-col gap-1">
          <a href="#" class="group cursor-pointer">
            <div class="flex items-center rounded-xl p-4 gap-3 bg-white group-[.active]:bg-muted group-hover:bg-muted transition-all duration-300">
              <i data-lucide="settings" class="size-6 text-secondary group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300"></i>
              <span class="font-medium text-secondary group-[.active]:font-semibold group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300">Configuration</span>
            </div>
          </a>
        </div>
      </div>
    </div>

    <!-- Bottom Card -->
    <div class="absolute bottom-0 left-0 w-[280px]">
      <div class="flex items-center justify-between border-t bg-white border-border p-5 gap-3">
        <form class="min-w-0" method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="cursor-pointer"><span class="text-sm text-secondary hover:text-primary hover:underline transition-all duration-300">Logout</span></button>
        </form>
        <div class="size-11 bg-primary/10 rounded-xl flex items-center justify-center flex-shrink-0">
          <i data-lucide="help-circle" class="size-6 text-primary"></i>
        </div>
      </div>
    </div>
  </aside>

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

<script>
document.addEventListener('DOMContentLoaded', function() {
  lucide.createIcons();
  initCharts();

  // Links handler
  document.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', function(e) {
      e.preventDefault();
      document.getElementById('page-not-found-modal').classList.remove('hidden');
    });
  });
});

function toggleSidebar() {
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('sidebar-overlay');
  sidebar.classList.toggle('-translate-x-full');
  overlay.classList.toggle('hidden');
  document.body.classList.toggle('overflow-hidden');
}

function closePageNotFoundModal() {
  document.getElementById('page-not-found-modal').classList.add('hidden');
}

// Search Modal Functions
function openSearchModal() {
  const modal = document.getElementById('search-modal');
  modal.classList.remove('hidden');
  modal.classList.add('flex');
  document.getElementById('search-input').focus();
}

document.getElementById('search-modal').addEventListener('click', function(e) {
  if (e.target === this) {
    this.classList.add('hidden');
    this.classList.remove('flex');
  }
});

document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    document.getElementById('search-modal').classList.add('hidden');
    document.getElementById('search-modal').classList.remove('flex');
    closeDateModal();
    closeExportModal();
    closePageNotFoundModal();
  }
});

// Date Picker Functions
function openDateModal() {
  const modal = document.getElementById('date-modal');
  modal.classList.remove('hidden');
  modal.classList.add('flex');
}

function closeDateModal() {
  const modal = document.getElementById('date-modal');
  modal.classList.add('hidden');
  modal.classList.remove('flex');
}

function selectDatePreset(btn, text) {
  // Reset all buttons
  document.querySelectorAll('.date-preset').forEach(b => {
    b.className = 'date-preset px-4 py-2 rounded-xl bg-white text-secondary font-medium text-sm border border-border hover:border-primary hover:text-primary transition-all cursor-pointer';
  });
  // Activate clicked
  btn.className = 'date-preset px-4 py-2 rounded-xl bg-primary/10 text-primary font-semibold text-sm border border-primary/20 cursor-pointer';
  
  // Store selection temporarily (in real app)
  btn.dataset.selected = "true";
}

function applyDateRange() {
  // Find selected preset
  const activePreset = document.querySelector('.date-preset[class*="bg-primary/10"]');
  if(activePreset) {
    document.getElementById('dateRangeLabel').textContent = activePreset.textContent;
  } else {
    document.getElementById('dateRangeLabel').textContent = "Custom Range";
  }
  closeDateModal();
  showToast('Date range updated', 'success');
  // Trigger chart update simulation here if needed
}

// Export Modal Functions
function openExportModal() {
  const modal = document.getElementById('export-modal');
  modal.classList.remove('hidden');
  modal.classList.add('flex');
}

function closeExportModal() {
  const modal = document.getElementById('export-modal');
  modal.classList.add('hidden');
  modal.classList.remove('flex');
}

function confirmExport(type) {
  closeExportModal();
  showToast(`Exporting ${type} report...`, 'success');
  setTimeout(() => {
    showToast('Download started', 'success');
  }, 1500);
}

// Toast Function
function showToast(message, type = 'success') {
  const toast = document.getElementById('toast');
  const msgEl = document.getElementById('toast-message');
  const iconContainer = document.getElementById('toast-icon');
  
  msgEl.textContent = message;
  
  if (type === 'success') {
    iconContainer.className = 'w-6 h-6 rounded-full bg-success flex items-center justify-center shrink-0';
    iconContainer.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-white"><polyline points="20 6 9 17 4 12"></polyline></svg>';
  } else {
    iconContainer.className = 'w-6 h-6 rounded-full bg-error flex items-center justify-center shrink-0';
    iconContainer.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-white"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>';
  }
  
  toast.classList.remove('translate-y-24');
  setTimeout(() => {
    toast.classList.add('translate-y-24');
  }, 3000);
}

// Charts Initialization
function initCharts() {
  // Common Options
  const commonOptions = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: { display: false },
      tooltip: {
        backgroundColor: '#080C1A',
        titleColor: '#fff',
        bodyColor: '#fff',
        padding: 10,
        cornerRadius: 8,
        displayColors: false,
      }
    },
    scales: {
      x: { grid: { display: false }, ticks: { font: { family: "'Lexend Deca', sans-serif" }, color: '#6A7686' } },
      y: { border: { display: false }, grid: { color: '#F3F4F3', borderDash: [5, 5] }, ticks: { font: { family: "'Lexend Deca', sans-serif" }, color: '#6A7686', maxTicksLimit: 5 } }
    }
  };

  // 1. Traffic Line Chart
  const ctxTraffic = document.getElementById('trafficChart').getContext('2d');
  
  // Gradient Fill
  const gradient = ctxTraffic.createLinearGradient(0, 0, 0, 300);
  gradient.addColorStop(0, 'rgba(22, 93, 255, 0.2)');
  gradient.addColorStop(1, 'rgba(22, 93, 255, 0)');

  new Chart(ctxTraffic, {
    type: 'line',
    data: {
      labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
      datasets: [{
        label: 'Visitors',
        data: [1250, 1900, 1500, 2200, 1800, 2800, 2400],
        borderColor: '#165DFF',
        backgroundColor: gradient,
        borderWidth: 3,
        pointBackgroundColor: '#fff',
        pointBorderColor: '#165DFF',
        pointBorderWidth: 2,
        pointRadius: 4,
        pointHoverRadius: 6,
        fill: true,
        tension: 0.4
      }]
    },
    options: commonOptions
  });

  // 2. Device Doughnut Chart
  const ctxDevice = document.getElementById('deviceChart').getContext('2d');
  new Chart(ctxDevice, {
    type: 'doughnut',
    data: {
      labels: ['Mobile', 'Desktop', 'Tablet'],
      datasets: [{
        data: [55, 30, 15], // Balanced data
        backgroundColor: ['#165DFF', '#C9E6FC', '#E5E7EB'],
        borderWidth: 0,
        hoverOffset: 4
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      cutout: '75%',
      plugins: {
        legend: { display: false },
        tooltip: {
          backgroundColor: '#080C1A',
          callbacks: {
            label: function(context) {
              return ' ' + context.label + ': ' + context.raw + '%';
            }
          }
        }
      }
    }
  });

  // 3. Acquisition Bar Chart
  const ctxAcq = document.getElementById('acquisitionChart').getContext('2d');
  new Chart(ctxAcq, {
    type: 'bar',
    data: {
      labels: ['Direct', 'Social', 'Organic', 'Referral', 'Email'],
      datasets: [{
        label: 'Users',
        data: [4500, 3200, 5100, 1800, 2400],
        backgroundColor: '#165DFF',
        borderRadius: 6,
        barThickness: 24,
      }]
    },
    options: {
      ...commonOptions,
      scales: {
        x: { 
          grid: { display: false }, 
          ticks: { font: { family: "'Lexend Deca', sans-serif" }, color: '#6A7686' } 
        },
        y: { 
          display: false // Hide Y axis for cleaner look on small bar chart
        }
      }
    }
  });
}
</script>
</body>
</html>
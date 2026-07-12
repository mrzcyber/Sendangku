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
    <div class="flex flex-col p-5 pb-28 gap-2 overflow-y-auto flex-1">
      <div class="flex flex-col gap-1">
        <h3 class="font-medium text-sm text-secondary">Overview</h3>
        <div class="flex flex-col ">
          <a href="{{ route('admin.dashboard.index') }}" class="group {{ request()->routeIs('admin.dashboard.index') ? 'active' : '' }} cursor-pointer">
            <div class="flex items-center rounded-xl p-4 gap-3 bg-white group-[.active]:bg-muted group-hover:bg-muted transition-all duration-300">
              <i data-lucide="layout-dashboard" class="size-6 text-secondary group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300"></i>
              <span class="font-medium text-secondary group-[.active]:font-semibold group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300">Dashboard</span>
            </div>
          </a>
          <a href="{{ route('admin.restaurant-order.index') }}" class="group {{ request()->routeIs('admin.restaurant-order.index') ? 'active' : '' }}  cursor-pointer">
            <div class="flex items-center rounded-xl p-4 gap-3 bg-white group-[.active]:bg-muted group-hover:bg-muted transition-all duration-300">
              <i data-lucide="pie-chart" class="size-6 text-secondary group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300"></i>
              <span class="font-medium text-secondary group-[.active]:font-semibold group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300">Restaurant</span>
            </div>
          </a>
          <a href="{{ route('admin.order-ticket.index') }}" class="group  {{ request()->routeIs('admin.order-ticket.index') ? 'active' : '' }}  cursor-pointer">
            <div class="flex items-center rounded-xl p-4 gap-3 bg-white group-[.active]:bg-muted group-hover:bg-muted transition-all duration-300">
              <i data-lucide="tickets" class="size-6 text-secondary group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300"></i>
              <span class="font-medium text-secondary group-[.active]:font-semibold group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300">Ticket</span>
            </div>
          </a>
        </div>
      </div>
      
      <div class="flex flex-col gap-1">
        <h3 class="font-medium text-sm text-secondary">Settings</h3>
        <div class="flex flex-col ">
          <a href="{{ route('admin.user.index') }}" class="group {{ request()->routeIs('admin.user.index') ? 'active' : '' }} cursor-pointer">
            <div class="flex items-center rounded-xl p-4 gap-3 bg-white group-[.active]:bg-muted group-hover:bg-muted transition-all duration-300">
              <i data-lucide="id-card-lanyard" class="size-6 text-secondary group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300"></i>
              <span class="font-medium text-secondary group-[.active]:font-semibold group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300">Employee</span>
            </div>
          </a>
          <a href="{{ route('admin.service.index') }}" class="group cursor-pointer {{ request()->routeIs('admin.service.index') ? 'active' : '' }}">
            <div class="flex items-center rounded-xl p-4 gap-3 bg-white group-[.active]:bg-muted group-hover:bg-muted transition-all duration-300">
              <i data-lucide="backpack" class="size-6 text-secondary group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300"></i>
              <span class="font-medium text-secondary group-[.active]:font-semibold group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300">Service</span>
            </div>
          </a>
          <a href="{{ route('admin.blog.index') }}" class="group cursor-pointer {{ request()->routeIs('admin.blog.index') ? 'active' : '' }}  ">
            <div class="flex items-center rounded-xl p-4 gap-3 bg-white group-[.active]:bg-muted group-hover:bg-muted transition-all duration-300">
              <i data-lucide="newspaper" class="size-6 text-secondary group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300"></i>
              <span class="font-medium text-secondary group-[.active]:font-semibold group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300">Blog & News</span>
            </div>
          </a>
        </div>
      </div>

      <div class="flex flex-col gap-1">
        <h3 class="font-medium text-sm text-secondary">Ticket</h3>
        <div class="flex flex-col ">
          <a href="{{ route('admin.ticket-type.index') }}" class="group cursor-pointer {{ request()->routeIs('admin.ticket-type.index') ? 'active' : '' }}">
            <div class="flex items-center rounded-xl p-4 gap-3 bg-white group-[.active]:bg-muted group-hover:bg-muted transition-all duration-300">
              <i data-lucide="ticket" class="size-6 text-secondary group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300"></i>
              <span class="font-medium text-secondary group-[.active]:font-semibold group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300">Manage Ticket</span>
            </div>
          </a>
        </div>
      </div>
      <div class="flex flex-col gap-1 ">
        <h3 class="font-medium text-sm text-secondary">Restaurant</h3>
        <div class="flex flex-col ">
          <a href="{{ route('admin.restaurant-menu.index') }}" class="group cursor-pointer {{ request()->routeIs('admin.restaurant-menu.index') ? 'active' : '' }}">
            <div class="flex items-center rounded-xl p-4 gap-3 bg-white group-[.active]:bg-muted group-hover:bg-muted transition-all duration-300">
              <i data-lucide="hamburger" class="size-6 text-secondary group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300"></i>
              <span class="font-medium text-secondary group-[.active]:font-semibold group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300">Manage Menu</span>
            </div>
          </a>
          <a href="{{ route('admin.table.index') }}" class="group cursor-pointer {{ request()->routeIs('admin.table.index') ? 'active' : '' }}">
            <div class="flex items-center rounded-xl p-4 gap-3 bg-white group-[.active]:bg-muted group-hover:bg-muted transition-all duration-300">
              <i data-lucide="utensils" class="size-6 text-secondary group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300"></i>
              <span class="font-medium text-secondary group-[.active]:font-semibold group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300">Manage Table</span>
            </div>
          </a>
        </div>
      </div>
    </div>

    <!-- Bottom Card -->
    <div class="absolute bottom-0 left-0 w-[280px] bg-white border-t border-border p-4">
      <div class="flex items-center justify-between p-3 rounded-2xl ring-1 ring-border hover:ring-primary transition-all duration-300 bg-white">
        <div class="flex items-center gap-3 min-w-0">
          <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&h=100&fit=crop" alt="Admin Profile" class="size-10 rounded-full object-cover shrink-0">
          <div class="min-w-0">
            <p class="font-semibold text-sm text-foreground truncate">Ahmad Fauzi</p>
            <p class="text-xs text-secondary truncate">Head Administrator</p>
          </div>
        </div>
        <button onclick="showLogoutModal()" class="size-10 flex items-center justify-center rounded-xl hover:bg-error/10 text-secondary hover:text-error transition-all duration-300 cursor-pointer shrink-0" aria-label="Logout">
          <i data-lucide="log-out" class="size-5"></i>
        </button>
      </div>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST">
    @csrf
</form>


    
  </aside>

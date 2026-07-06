<div id="logout-modal" class="fixed inset-0 bg-black/50 z-[100] hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl p-6 max-w-sm w-full text-center shadow-2xl">
        <div class="w-16 h-16 bg-error/10 rounded-full flex items-center justify-center mx-auto mb-4">
            <i data-lucide="log-out" class="w-8 h-8 text-error"></i>
        </div>
        <h3 class="text-foreground text-xl font-bold mb-2">Sign Out</h3>
        <p class="text-secondary text-sm mb-6">Are you sure you want to sign out?</p>
        <div class="flex gap-3">
            <button onclick="closeLogoutModal()" class="flex-1 px-4 py-3 ring-1 ring-border hover:ring-primary text-foreground rounded-full font-semibold transition-all duration-200 cursor-pointer">
                Cancel
            </button>
            <button onclick="confirmLogout()" class="flex-1 px-4 py-3 bg-error text-white rounded-full font-bold hover:bg-error-dark transition-all duration-200 cursor-pointer">
                Sign Out
            </button>
        </div>
    </div>
</div>

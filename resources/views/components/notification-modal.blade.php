<div id="notification-modal" class="fixed inset-0 bg-black/50 z-[100] hidden items-center justify-center p-4">
    <div class="bg-white rounded-3xl w-full max-w-md shadow-2xl overflow-hidden">
        <div class="flex items-center justify-between border-b border-border p-5">
            <div>
                <h3 class="text-lg font-bold text-foreground">Notifications</h3>
                <p class="text-sm text-secondary">Latest dashboard activity</p>
            </div>
            <button onclick="closeNotificationModal()" class="size-10 flex items-center justify-center rounded-xl hover:bg-muted transition-colors cursor-pointer" aria-label="Close notifications">
                <i data-lucide="x" class="size-5 text-secondary"></i>
            </button>
        </div>
        <div class="flex flex-col gap-2 p-4">
            <div class="flex items-start gap-3 rounded-2xl bg-muted/60 p-4">
                <div class="size-10 bg-primary/10 rounded-xl flex items-center justify-center shrink-0">
                    <i data-lucide="bell" class="size-5 text-primary"></i>
                </div>
                <div class="min-w-0">
                    <p class="font-semibold text-sm text-foreground">New report is ready</p>
                    <p class="text-sm text-secondary">Your latest dashboard report can be reviewed now.</p>
                </div>
            </div>
            <div class="flex items-start gap-3 rounded-2xl bg-muted/60 p-4">
                <div class="size-10 bg-success/10 rounded-xl flex items-center justify-center shrink-0">
                    <i data-lucide="check-circle" class="size-5 text-success"></i>
                </div>
                <div class="min-w-0">
                    <p class="font-semibold text-sm text-foreground">Data synchronized</p>
                    <p class="text-sm text-secondary">Recent dashboard data has been updated successfully.</p>
                </div>
            </div>
        </div>
    </div>
</div>

@if (session('success'))
<div id="flash-message" class="fixed inset-0 z-[110] flex items-center justify-center bg-black/50 p-4 backdrop-blur-sm" role="dialog" aria-modal="true" aria-labelledby="flash-message-title">
    <div class="w-full max-w-md overflow-hidden rounded-3xl border border-border bg-white shadow-2xl">
        <div class="flex items-start gap-4 border-b border-border p-6">
            <div class="flex size-12 shrink-0 items-center justify-center rounded-2xl bg-success/10 text-success">
                <i data-lucide="circle-check-big" class="size-6"></i>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-xs font-semibold uppercase tracking-[0.16em] text-success-dark">Berhasil</p>
                <h2 id="flash-message-title" class="mt-1 text-lg font-bold text-foreground">Perubahan disimpan</h2>
                <p class="mt-2 text-sm leading-6 text-secondary">{{ session('success') }}</p>
            </div>
            <button type="button" onclick="document.getElementById('flash-message').remove()" class="-mr-2 -mt-2 flex size-10 shrink-0 items-center justify-center rounded-xl text-secondary transition-all hover:bg-muted hover:text-foreground" aria-label="Tutup notifikasi">
                <i data-lucide="x" class="size-5"></i>
            </button>
        </div>
        <div class="flex justify-end bg-muted/40 p-4">
            <button type="button" onclick="document.getElementById('flash-message').remove()" class="inline-flex items-center justify-center gap-2 rounded-full bg-primary px-5 py-3 text-sm font-bold text-white shadow-sm shadow-primary/20 transition-all duration-300 hover:bg-primary-hover">
                <i data-lucide="check" class="size-4"></i>
                <span>Mengerti</span>
            </button>
        </div>
    </div>
</div>
@endif

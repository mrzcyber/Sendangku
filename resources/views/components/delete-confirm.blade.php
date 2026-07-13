@props([
    'action',
    'message' => 'Yakin ingin menghapus data ini?',
    'title' => 'Hapus Data',
])

<div x-data="{ open: false }" x-init="$watch('open', () => $nextTick(() => window.lucide?.createIcons()))" class="inline-block">
    @isset($trigger)
        <span class="contents" @click.prevent="open = true">
            {{ $trigger }}
        </span>
    @else
        <button type="button" @click="open = true">
            Hapus
        </button>
    @endisset

    <div
        x-cloak
        x-show="open"
        x-transition.opacity
        @keydown.escape.window="open = false"
        class="fixed inset-0 z-[100] bg-black/60 flex items-center justify-center p-4"
    >
        <div
            x-show="open"
            x-transition.scale.origin.center
            @click.outside="open = false"
            class="w-full max-w-md overflow-hidden rounded-3xl border border-border bg-white shadow-2xl"
        >
            <div class="p-6 border-b border-border">
                <div class="flex items-start gap-4">
                    <div class="size-12 rounded-2xl bg-error/10 text-error flex items-center justify-center shrink-0">
                        <i data-lucide="trash-2" class="size-6"></i>
                    </div>
                    <div class="min-w-0">
                        <h3 class="text-lg font-bold text-foreground">{{ $title }}</h3>
                        <p class="mt-1 text-sm leading-6 text-secondary">{{ $message }}</p>
                    </div>
                </div>
            </div>

            <div class="flex flex-col-reverse sm:flex-row sm:items-center sm:justify-end gap-3 p-6 bg-muted/40">
                <button type="button" @click="open = false" class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-full ring-1 ring-border bg-white text-foreground font-bold hover:ring-primary transition-all duration-300 cursor-pointer">
                    <i data-lucide="x" class="size-5 text-secondary"></i>
                    <span>Batal</span>
                </button>

                <form action="{{ $action }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex w-full sm:w-auto items-center justify-center gap-2 px-5 py-3 rounded-full bg-error text-white font-bold hover:bg-error-dark transition-all duration-300 cursor-pointer shadow-sm">
                        <i data-lucide="trash-2" class="size-5"></i>
                        <span>Ya, Hapus</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

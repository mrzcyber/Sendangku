@props([
    'message' => null,
])

<div
    x-cloak
    x-init="if (@js($message)) $nextTick(() => error = @js($message))"
    x-show="error"
    x-transition.opacity
    x-on:keydown.escape.window="error = ''"
    class="fixed inset-0 z-[60] flex items-center justify-center p-4 sm:p-6"
    role="dialog"
    aria-modal="true"
    aria-labelledby="error-popup-title"
>
    <div class="absolute inset-0 bg-stone-900/70 backdrop-blur-sm" x-on:click="error = ''"></div>

    <div
        x-show="error"
        x-transition:enter="ease-out duration-200"
        x-transition:enter-start="translate-y-3 opacity-0 sm:scale-95"
        x-transition:enter-end="translate-y-0 opacity-100 sm:scale-100"
        x-transition:leave="ease-in duration-150"
        x-transition:leave-start="translate-y-0 opacity-100 sm:scale-100"
        x-transition:leave-end="translate-y-3 opacity-0 sm:scale-95"
        class="relative w-full max-w-md overflow-hidden border border-stone-200 bg-white shadow-2xl"
    >
        <div class="h-1.5 w-full bg-amber-600"></div>

        <div class="p-6 sm:p-8">

            <p class="mt-5 text-lg font-semibold uppercase tracking-[0.16em] text-red-600">Informasi</p>
            <h3 id="error-popup-title" class="mt-1 font-poppins text-xl font-semibold leading-snug text-stone-900 sm:text-2xl" x-text="error" role="alert"></h3>

            <button
                type="button"
                x-on:click="error = ''"
                class="mt-6 w-full bg-amber-600 px-4 py-3 font-poppins text-sm font-semibold text-white transition-colors hover:bg-amber-700"
            >
                Kembali
            </button>
        </div>
    </div>
</div>

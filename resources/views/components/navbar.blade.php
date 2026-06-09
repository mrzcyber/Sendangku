<nav
data-aos="fade-down"
     data-aos-easing="ease-in-out"
     data-aos-duration="1300"
     data-aos-delay="1000"
    class="fixed top-0 w-full z-50 flex items-center justify-between xl:px-14 px-4 xl:pl-28 py-[22px]
           transition-all duration-300"
    x-data="{
        open: false,
        lastY: 0,
        hidden: false,
        scrolled: false,
        isHome: {{ request()->is('/') ? 'true' : 'false' }},

        init() {
            this.lastY = window.scrollY;
            window.addEventListener('scroll', () => this.onScroll());
        },

        onScroll() {
            const y = window.scrollY;

            // Sembunyikan saat scroll ke bawah, tampilkan saat ke atas
            if (y > this.lastY && y > 60) {
                this.hidden = true;
                this.open = false;   // tutup drawer juga saat scroll turun
            } else {
                this.hidden = false;
            }

            // Tandai sudah scroll (untuk background)
            this.scrolled = y > 20;

            this.lastY = y;
        }
    }"
    :class="{
        '-translate-y-full': hidden,
        'translate-y-0': !hidden,

        {{-- Halaman home: transparan di atas, frosted saat scroll --}}
        'bg-transparent': isHome && !scrolled,
        'bg-gray-600 backdrop-blur-md shadow-lg shadow-black/20': isHome && scrolled,

        {{-- Halaman lain: selalu putih --}}
        'bg-white shadow-md': !isHome,
    }"
    @keydown.escape.window="open = false"
>

    {{-- Logo --}}
    <a href="/" class="flex items-center z-50 relative">
        <img src="/img/logo.png" alt="Sendang Kun Gerit" class="w-28 object-contain">
    </a>

    {{-- ── Desktop & iPad links ── --}}
    <ul class="hidden md:flex items-center gap-5 xl:gap-10 list-none">

        @foreach([
            ['/', 'Home'],
            ['/fasilitas', 'Fasilitas'],
            ['/paket', 'Paket'],
            ['/event', 'Event'],
            ['/blog', 'Blog'],
            ['/layanan', 'Layanan'],
            ['/resto', 'Resto'],
        ] as [$href, $label])
        <li>
            <a href="{{ $href }}"
               class="font-dm text-[17.5px] transition-colors"
               :class="isHome
                   ? 'text-white/70 hover:text-white'
                   : 'text-stone-600 hover:text-amber-600'"
            >
                {{ $label }}
            </a>
        </li>
        @endforeach

        <li class="w-px h-3.5 mx-1" :class="isHome ? 'bg-white/15' : 'bg-stone-200'"></li>
        <li>
            <a href="/tiket"
               class="font-dm text-[12px] font-medium tracking-[0.07em] uppercase px-5 py-2
                      transition-all duration-200 border"
               :class="isHome
                   ? 'border-amber-500/70 text-amber-400 hover:bg-amber-600 hover:border-amber-600 hover:text-white'
                   : 'border-amber-500 text-amber-600 hover:bg-amber-500 hover:text-white'"
            >
                Beli Tiket
            </a>
        </li>
    </ul>

    {{-- ── Hamburger (mobile only) ── --}}
    <button
        class="md:hidden relative z-50 w-10 h-10 flex flex-col justify-center items-center gap-[6px]"
        @click="open = !open"
        aria-label="Toggle menu"
        :aria-expanded="open"
    >
        <span
            class="block w-6 h-[2px] rounded-full transition-all duration-300 origin-center"
            :class="[open ? 'rotate-45 translate-y-2' : '', isHome ? 'bg-white' : 'bg-stone-700']"
        ></span>
        <span
            class="block w-6 h-[2px] rounded-full transition-all duration-300"
            :class="[open ? 'opacity-0 scale-x-0' : '', isHome ? 'bg-white' : 'bg-stone-700']"
        ></span>
        <span
            class="block w-6 h-[2px] rounded-full transition-all duration-300 origin-center"
            :class="[open ? '-rotate-45 -translate-y-2' : '', isHome ? 'bg-white' : 'bg-stone-700']"
        ></span>
    </button>

    {{-- ── Backdrop mobile ── --}}
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="md:hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-30"
        @click="open = false"
        style="display:none;"
    ></div>

    {{-- ── Drawer panel ── --}}
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
        class="md:hidden fixed top-0 left-0 right-0 z-40 bg-stone-900/95 backdrop-blur-md
               border-b border-white/10 pt-24 pb-8 px-6"
        style="display:none;"
    >
        <ul class="flex flex-col list-none">
            @foreach([
                ['/', 'Home'],
                ['/fasilitas', 'Fasilitas'],
                ['/paket', 'Paket'],
                ['/event', 'Event'],
                ['/blog', 'Blog'],
                ['/layanan', 'Layanan'],
                ['/resto', 'Resto'],
            ] as [$href, $label])
            <li class="border-b border-white/8">
                <a
                    href="{{ $href }}"
                    class="flex items-center justify-between py-4 font-dm text-white/70 text-lg hover:text-white transition-colors"
                    @click="open = false"
                >
                    {{ $label }}
                    <svg class="w-4 h-4 text-amber-500/60" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                    </svg>
                </a>
            </li>
            @endforeach
        </ul>

        <a
            href="/tiket"
            class="mt-6 flex items-center justify-center w-full py-3.5 font-dm text-sm font-semibold
                   tracking-widest uppercase bg-amber-500 text-white hover:bg-amber-600 transition-all duration-200"
            @click="open = false"
        >
            Beli Tiket
        </a>
    </div>

</nav>
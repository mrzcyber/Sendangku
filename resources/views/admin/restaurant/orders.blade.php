@extends('layouts.dashboard')

@section('title', 'Buat Pesanan (Kasir) - Sendangku')

@section('content')
<section class="min-h-screen bg-stone-50 w-full pb-28 pt-8  xl:pb-16">
     <div
     x-data="pooling(@js($orders), @js(route('admin.restaurant.orders.waiting')))" x-init="init()"
     class="flex h-[90px] w-full shrink-0 items-center justify-between border-b border-border bg-white px-5 md:px-8">
      <div class="flex items-center gap-4">
        <button onclick="toggleSidebar()" aria-label="Open menu" class="flex size-11 items-center justify-center rounded-xl ring-1 ring-border transition-all duration-300 hover:ring-primary lg:hidden">
          <i data-lucide="menu" class="size-6 text-foreground"></i>
        </button>
        <h2 class="text-xl font-bold text-foreground md:text-2xl">Konfirmasi Pesanan</h2>
      </div>
      <div class="flex items-center gap-3">

        <button type="button" x-show="!soundOn" x-cloak @click="enableSound()"
        class="cursor-pointer rounded-lg bg-amber-500 px-4 py-2 text-sm font-bold text-white transition-all hover:bg-amber-600">
        Aktifkan suara notifikasi
      </button>
      <span x-show="soundOn" x-cloak class="rounded-lg bg-success-light px-4 py-2 text-sm font-bold text-success-dark">
        Notifikasi aktif
      </span>

            <a href="{{ route('admin.restaurant.kasir') }}"
                       class="inline-flex cursor-pointer items-center justify-center rounded-full bg-success px-6 py-2.5 font-semibold text-white transition-all hover:bg-success-dark">
                        Kembali konfirmasi
            </a>
      <!-- Notifikasi Pesanan Belum Dikonfirmasi -->
      <button
        class="size-11 flex items-center justify-center rounded-xl ring-1 ring-border hover:ring-primary transition-all duration-300 cursor-pointer relative"
        aria-label="Pesanan belum dikonfirmasi"
        title="Pesanan belum dikonfirmasi"
      >
        <i data-lucide="bell" class="size-6 text-secondary"></i>

          <span x-show="notificationCount > 0" x-cloak
                class="absolute -top-1 -right-1 flex h-5 min-w-[20px] items-center justify-center rounded-full border-2 border-white bg-error px-[5px] text-xs font-bold text-white"
                x-text="notificationCount"></span>

      </button>

      </div>
    </div>
    <div
        class="w-full"
        x-data="kasirCheckout(@js([
            'menus'    => $data,
            'storeUrl' => route('admin.restaurant-order.store'),
        ]))"
    >


    <div class="mx-auto max-w-7xl px-5 pt-8 md:px-8">   

            <div class="mb-8 border-b border-stone-200 pb-6 ">
                <p class="text-sm font-medium text-amber-600">Mode Kasir</p>
                <h1 class="mt-1 font-poppins text-2xl font-semibold text-stone-900 sm:text-3xl">Buat pesanan langsung</h1>
                <p class="mt-2 text-sm text-stone-500">Pesanan langsung tercatat lunas (offline) dan terkonfirmasi.</p>
            </div>



        <form @submit.prevent="checkout()" class="grid grid-cols-1 gap-8 xl:grid-cols-[minmax(0,1fr)_360px] xl:items-start">

            {{-- Daftar menu --}}
            <section aria-labelledby="menu-heading">
                <div class="mb-5 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <h2 id="menu-heading" class="font-poppins text-xl font-semibold text-stone-800">Daftar Menu</h2>
                        <p class="mt-1 text-sm text-stone-500" x-text="filteredMenus.length + ' menu tersedia'"></p>
                    </div>
                    <div class="flex gap-2 overflow-x-auto pb-1" aria-label="Filter kategori">
                        <template x-for="category in categories" :key="category.value">
                            <button
                                type="button"
                                @click="activeCategory = category.value"
                                :class="activeCategory === category.value
                                    ? 'border-amber-600 bg-amber-600 text-white'
                                    : 'border-stone-200 bg-white text-stone-600 hover:border-amber-500'"
                                class="shrink-0 border px-3 py-2 text-sm font-medium transition-colors"
                                x-text="category.label"></button>
                        </template>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3 sm:gap-4 xl:grid-cols-3">
                    <template x-for="menu in filteredMenus" :key="menu.id">
                        <article class="overflow-hidden border border-stone-200 bg-white shadow-sm">
                            <div class="aspect-[4/3] overflow-hidden bg-stone-100">
                                <img :src="menu.image" :alt="menu.name" class="h-full w-full object-cover" x-on:error="onImageError($event)">
                            </div>
                            <div class="p-4">
                                <p class="text-xs font-medium capitalize text-amber-600" x-text="menu.category"></p>
                                <h3 class="mt-1 font-poppins text-base font-semibold text-stone-800" x-text="menu.name"></h3>
                                <div class="mt-4 flex items-center justify-between gap-3">
                                    <span class="font-poppins text-base font-semibold text-stone-900" x-text="formatPrice(menu.price)"></span>
                                    <button
                                        type="button"
                                        @click="add(menu)"
                                        class="flex h-9 w-9 items-center justify-center bg-amber-600 text-white transition-colors hover:bg-amber-700"
                                        :aria-label="'Tambah ' + menu.name"
                                        title="Tambah ke keranjang">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                                    </button>
                                </div>
                            </div>
                        </article>
                    </template>
                </div>

                <div x-show="filteredMenus.length === 0" class="border border-dashed border-stone-300 bg-white px-5 py-12 text-center text-sm text-stone-500">
                    Belum ada menu pada kategori ini.
                </div>
            </section>

            {{-- Keranjang --}}
            <aside x-ref="cart" class="scroll-mt-24 border border-stone-200 bg-white shadow-sm xl:sticky xl:top-24" aria-labelledby="cart-heading">
                <div class="border-b border-stone-100 px-5 py-4">
                    <div class="flex items-center justify-between">
                        <h2 id="cart-heading" class="font-poppins text-lg font-semibold text-stone-800">Keranjang Pesanan</h2>
                        <span class="bg-amber-100 px-2 py-1 text-xs font-semibold text-amber-800" x-text="itemCount + ' item'"></span>
                    </div>
                </div>

                <div class="max-h-72 divide-y divide-stone-100 overflow-y-auto px-5">
                    <template x-for="item in cart" :key="item.id">
                        <div class="flex gap-3 py-4">
                            <img :src="item.image" :alt="item.name" class="h-12 w-12 shrink-0 object-cover" x-on:error="onImageError($event)">
                            <div class="min-w-0 flex-1">
                                <div class="flex justify-between gap-2">
                                    <h3 class="truncate text-sm font-semibold text-stone-800" x-text="item.name"></h3>
                                    <button
                                        type="button"
                                        @click="remove(item.id)"
                                        class="text-stone-400 hover:text-red-600"
                                        :aria-label="'Hapus ' + item.name"
                                        title="Hapus menu">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m6 18 12-12M6 6l12 12" /></svg>
                                    </button>
                                </div>
                                <div class="mt-2 flex items-center justify-between gap-2">
                                    <div class="flex h-8 items-center border border-stone-200">
                                        <button type="button" @click="decrease(item)" class="grid h-full w-8 place-items-center text-stone-600 hover:bg-stone-100" aria-label="Kurangi jumlah">-</button>
                                        <span class="grid h-full w-7 place-items-center border-x border-stone-200 text-sm font-medium" x-text="item.qty"></span>
                                        <button type="button" @click="add(item)" class="grid h-full w-8 place-items-center text-stone-600 hover:bg-stone-100" aria-label="Tambah jumlah">+</button>
                                    </div>
                                    <span class="text-sm font-semibold text-stone-800" x-text="formatPrice(item.price * item.qty)"></span>
                                </div>
                            </div>
                        </div>
                    </template>

                    <div x-show="cart.length === 0" class="py-10 text-center">
                        <svg class="mx-auto h-9 w-9 text-stone-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3-3H3.106V5.272m4.394 8.978h9.75l2.25-9H5.106M7.5 14.25 5.106 5.272M7.5 14.25l-1.125 3h11.25" /></svg>
                        <p class="mt-3 text-sm text-stone-500">Keranjang masih kosong</p>
                    </div>
                </div>

                <div class="space-y-4 border-t border-stone-100 p-5">
                    <div class="flex items-center justify-between border-b border-dashed border-stone-200 pb-4">
                        <span class="text-sm text-stone-500">Total pesanan</span>
                        <span class="font-poppins text-xl font-semibold text-stone-900" x-text="formatPrice(total)"></span>
                    </div>

                    <div>
                        <label for="order-note" class="mb-1.5 block text-sm font-medium text-stone-700">Catatan pesanan <span class="font-normal text-stone-400">(opsional)</span></label>
                        <textarea
                            id="order-note"
                            x-model="note"
                            rows="3"
                            maxlength="1000"
                            placeholder="Contoh: tidak pedas"
                            class="w-full resize-y border border-stone-300 px-3 py-2.5 text-sm outline-none transition-colors focus:border-amber-600 focus:ring-2 focus:ring-amber-100"></textarea>
                    </div>

                    <p x-show="error" x-text="error" role="alert" style="display: none;"
                       class="border border-red-200 bg-red-50 px-3 py-2 text-sm text-red-700"></p>

                    <button
                        type="submit"
                        class="flex w-full items-center justify-center gap-2 bg-amber-600 px-4 py-3 font-poppins text-sm font-semibold text-white transition-colors hover:bg-amber-700 disabled:cursor-not-allowed disabled:bg-stone-300"
                        :disabled="cart.length === 0 || loading">
                        <span x-text="loading ? 'Menyimpan pesanan...' : 'Checkout'"></span>
                    </button>
                </div>
            </aside>
        </form>

        {{-- Tombol keranjang (mobile) --}}
        <button
            type="button"
            @click="$refs.cart.scrollIntoView({ behavior: 'smooth', block: 'start' })"
            class="fixed inset-x-4 bottom-4 z-40 flex items-center justify-between bg-stone-900 px-4 py-3 text-left text-white shadow-lg xl:hidden"
            aria-label="Lihat keranjang pesanan">
            <span>
                <span class="block text-sm font-semibold">Lihat keranjang</span>
                <span class="block text-xs text-stone-300" x-text="itemCount + ' item dipilih'"></span>
            </span>
            <span class="font-poppins text-sm font-semibold" x-text="formatPrice(total)"></span>
        </button>

        {{-- Modal pesanan berhasil --}}
        <div x-show="toast" x-cloak x-transition.opacity
             @keydown.escape.window="toast = null" @click.self="toast = null"
             class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 p-4">
            <div class="w-full max-w-lg overflow-hidden rounded-3xl bg-white shadow-2xl">
                <div class="flex items-center justify-between border-b border-border p-6">
                    <h3 class="text-xl font-bold text-foreground">Pesanan berhasil</h3>
                    <button type="button" @click="toast = null" aria-label="Tutup notifikasi"
                            class="cursor-pointer rounded-full p-2 transition-colors hover:bg-muted">
                        <i data-lucide="x" class="size-5 text-secondary"></i>
                    </button>
                </div>

                <div class="p-6">
                    <p class="text-sm text-secondary" x-text="toast"></p>
                </div>

                <div class="flex flex-col-reverse gap-3 border-t border-border bg-gray-50 p-4 sm:flex-row sm:justify-end">
                    <button type="button" @click="toast = null"
                            class="cursor-pointer rounded-full border border-border bg-white px-6 py-2.5 font-semibold text-foreground transition-all hover:bg-gray-100">
                        Pesan lagi
                    </button>
                    {{-- Isi href dengan route halaman konfirmasi yang diinginkan. --}}
                    <a href="{{ route('admin.restaurant.kasir') }}" 
                       class="inline-flex cursor-pointer items-center justify-center rounded-full bg-success px-6 py-2.5 font-semibold text-white transition-all hover:bg-success-dark">
                        Kembali konfirmasi
                    </a>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection

@push('scripts')
<script>

    function pooling(initialIds, waitingUrl) {
        return {
            knownIds: initialIds.map(Number),
            notificationCount: initialIds.length,
            waitingUrl,
            soundReady: false,
            soundOn: false,
            pollTimer: null,
            audio: new Audio('/sounds/order.mp3'),

            init() {
                // Browser hanya mengizinkan audio setelah interaksi pengguna.
                const enableSound = () => {
                    this.audio.play()
                        .then(() => {
                            this.audio.pause();
                            this.audio.currentTime = 0;
                            this.soundReady = true;
                            this.soundOn = true;
                        })
                        .catch(() => {});
                };

                ['click', 'keydown', 'touchstart'].forEach(event =>
                    document.addEventListener(event, enableSound, { once: true, capture: true })
                );

                this.pollTimer = setInterval(() => this.checkNotifications(), 5000);
                document.addEventListener('visibilitychange', () => {
                    if (!document.hidden) this.checkNotifications();
                });
            },

            async checkNotifications() {
                try {
                    const response = await fetch(this.waitingUrl, {
                        headers: { 'Accept': 'application/json' },
                    });

                    if (response.status === 401 || response.status === 419) {
                        window.location.reload();
                        return;
                    }
                    if (!response.ok) return;

                    const ids = (await response.json()).map(Number);
                    const hasNewOrder = ids.some(id => !this.knownIds.includes(id));

                    this.knownIds = ids;
                    this.notificationCount = ids.length;

                    if (hasNewOrder && this.soundReady) {
                        this.audio.currentTime = 0;
                        this.audio.play().catch(() => {});
                    }
                } catch (error) {
                    // Gangguan koneksi sementara akan dicoba kembali pada polling berikutnya.
                }
            },
        };
    }

    const FALLBACK_IMAGE = '/img/food2.avif';
    const MAX_QTY = 99;

    function formatRupiah(price) {
        return 'Rp' + Number(price).toLocaleString('id-ID');
    }

    function resolveImage(thumbnail) {
        if (!thumbnail) return FALLBACK_IMAGE;
        if (thumbnail.startsWith('http') || thumbnail.startsWith('/')) return thumbnail;
        return '/storage/' + thumbnail;
    }

    function csrfToken() {
        return document.querySelector('meta[name="csrf-token"]')?.content || '';
    }

    function kasirCheckout(config) {
        return {
            // data
            menus: config.menus.map(menu => ({ ...menu, image: resolveImage(menu.thumbnail) })),
            categories: [
                { value: 'semua',   label: 'Semua' },
                { value: 'makanan', label: 'Makanan' },
                { value: 'minuman', label: 'Minuman' },
                { value: 'lainnya', label: 'Lainnya' },
            ],
            cart: [],
            note: '',

            // state tampilan
            activeCategory: 'semua',
            loading: false,
            error: '',
            toast: null,

            // ----- turunan data -----

            get filteredMenus() {
                if (this.activeCategory === 'semua') return this.menus;
                return this.menus.filter(menu =>
                    (menu.category || '').toLowerCase() === this.activeCategory.toLowerCase()
                );
            },

            get total() {
                return this.cart.reduce((sum, item) => sum + item.price * item.qty, 0);
            },

            get itemCount() {
                return this.cart.reduce((sum, item) => sum + item.qty, 0);
            },

            // ----- tampilan -----

            formatPrice(price) {
                return formatRupiah(price);
            },

            onImageError(event) {
                event.target.src = FALLBACK_IMAGE;
            },

            showToast() {
                this.toast = 'Pesanan berhasil disimpan.';
            },

            // ----- keranjang -----

            add(menu) {
                const existing = this.cart.find(item => item.id === menu.id);
                if (existing) {
                    existing.qty = Math.min(existing.qty + 1, MAX_QTY);
                    return;
                }
                this.cart.push({
                    id: menu.id,
                    name: menu.name,
                    price: menu.price,
                    image: menu.image,
                    qty: 1,
                });
            },

            decrease(item) {
                if (item.qty <= 1) {
                    this.remove(item.id);
                    return;
                }
                item.qty--;
            },

            remove(id) {
                this.cart = this.cart.filter(item => item.id !== id);
            },

            // ----- checkout -----

            async checkout() {
                this.error = '';

                if (this.cart.length === 0) {
                    this.error = 'Pilih minimal satu menu sebelum checkout.';
                    return;
                }
                if (this.loading) return;

                this.loading = true;
                try {
                    const response = await fetch(config.storeUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken(),
                        },
                        body: JSON.stringify({
                            note: this.note,
                            items: this.cart.map(item => ({
                                restaurant_menu_id: item.id,
                                qty: item.qty,
                            })),
                        }),
                    });

                    const result = await response.json().catch(() => ({}));
                    console.log(response.status, result);

                    if (response.status === 401 || response.status === 419) {
                        this.error = 'Sesi habis. Muat ulang halaman lalu login kembali.';
                        return;
                    }

                    if (!response.ok) {
                        this.error = result.message
                            || Object.values(result.errors || {}).flat()[0]
                            || 'Pesanan tidak dapat disimpan.';
                        return;
                    }

                    this.showToast();
                    this.cart = [];
                    this.note = '';
                } catch (err) {
                    this.error = 'Terjadi kesalahan koneksi saat menyimpan pesanan.';
                } finally {
                    this.loading = false;
                }
            },
        };
    }
</script>
@endpush

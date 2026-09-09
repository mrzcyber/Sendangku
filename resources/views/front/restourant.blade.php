@extends('layouts.app')

@section('title', 'Pesan Menu Restoran - Sendangku')

@section('content')
<section class="min-h-screen bg-stone-50 px-4 pb-28 pt-28 sm:px-6 lg:px-10 xl:pb-16">
    <div class="mx-auto max-w-7xl" x-data="restaurantOrder(@js($data), @js($tables))">
        <div class="mb-8 border-b border-stone-200 pb-6">
            <p class="text-sm font-medium text-amber-600">Restoran Sendangku</p>
            <h1 class="mt-1 font-poppins text-2xl font-semibold text-stone-900 sm:text-3xl">Pilih menu favorit Anda</h1>
            <p class="mt-2 font-dm text-sm text-stone-500">Tambahkan menu ke keranjang, lalu lengkapi detail pesanan.</p>
        </div>

        @if (session('success'))
            <div class="mb-6 flex items-start gap-3 border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800" role="status">
                <svg class="mt-0.5 h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('restaurant.order.store') }}" @submit="prepareOrder($event)" class="grid grid-cols-1 gap-8 xl:grid-cols-[minmax(0,1fr)_360px] xl:items-start">
            @csrf

            <section aria-labelledby="menu-heading">
                <div class="mb-5 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <h2 id="menu-heading" class="font-poppins text-xl font-semibold text-stone-800">Daftar Menu</h2>
                        <p class="mt-1 text-sm text-stone-500" x-text="filteredMenus.length + ' menu tersedia'"></p>
                    </div>
                    <div class="flex gap-2 overflow-x-auto pb-1" aria-label="Filter kategori">
                        <template x-for="category in categories" :key="category.value">
                            <button type="button" @click="activeCategory = category.value" :class="activeCategory === category.value ? 'border-amber-600 bg-amber-600 text-white' : 'border-stone-200 bg-white text-stone-600 hover:border-amber-500'" class="shrink-0 border px-3 py-2 text-sm font-medium transition-colors" x-text="category.label"></button>
                        </template>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3 sm:gap-4 xl:grid-cols-3">
                    <template x-for="menu in filteredMenus" :key="menu.id">
                        <article class="overflow-hidden border border-stone-200 bg-white shadow-sm">
                            <div class="aspect-[4/3] overflow-hidden bg-stone-100">
                                <img :src="menu.image" :alt="menu.name" class="h-full w-full object-cover" x-on:error="$event.target.src = '/img/food2.png'">
                            </div>
                            <div class="p-4">
                                <p class="text-xs font-medium capitalize text-amber-600" x-text="menu.category"></p>
                                <h3 class="mt-1 font-poppins text-base font-semibold text-stone-800" x-text="menu.name"></h3>
                                <div class="mt-4 flex items-center justify-between gap-3">
                                    <span class="font-poppins text-base font-semibold text-stone-900" x-text="formatPrice(menu.price)"></span>
                                    <button type="button" @click="add(menu)" class="flex h-9 w-9 items-center justify-center bg-amber-600 text-white transition-colors hover:bg-amber-700" :aria-label="'Tambah ' + menu.name" title="Tambah ke keranjang">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                                    </button>
                                </div>
                            </div>
                        </article>
                    </template>
                </div>
                <div x-show="filteredMenus.length === 0" class="border border-dashed border-stone-300 bg-white px-5 py-12 text-center text-sm text-stone-500">Belum ada menu pada kategori ini.</div>
            </section>

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
                            <img :src="item.image" :alt="item.name" class="h-12 w-12 shrink-0 object-cover" x-on:error="$event.target.src = '/img/food2.png'">
                            <div class="min-w-0 flex-1">
                                <div class="flex justify-between gap-2">
                                    <h3 class="truncate text-sm font-semibold text-stone-800" x-text="item.name"></h3>
                                    <button type="button" @click="remove(item.id)" class="text-stone-400 hover:text-red-600" :aria-label="'Hapus ' + item.name" title="Hapus menu">
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
                        <label for="customer-name" class="mb-1.5 block text-sm font-medium text-stone-700">Nama pemesan</label>
                        <input id="customer-name" name="name" required maxlength="255" value="{{ old('name') }}" placeholder="Masukkan nama Anda" class="w-full border border-stone-300 px-3 py-2.5 text-sm outline-none transition-colors focus:border-amber-600 focus:ring-2 focus:ring-amber-100">
                    </div>
                    <div>
                        <label for="table-id" class="mb-1.5 block text-sm font-medium text-stone-700">Pilih meja</label>
                        <select id="table-id" name="table_id" required class="w-full border border-stone-300 bg-white px-3 py-2.5 text-sm outline-none transition-colors focus:border-amber-600 focus:ring-2 focus:ring-amber-100">
                            <option value="">Pilih nomor meja</option>
                            @foreach ($tables as $table)
                                <option value="{{ $table->id }}" @selected(old('table_id') == $table->id)>Meja {{ $table->number }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="order-note" class="mb-1.5 block text-sm font-medium text-stone-700">Catatan pesanan <span class="font-normal text-stone-400">(opsional)</span></label>
                        <textarea id="order-note" name="note" rows="3" maxlength="1000" placeholder="Contoh: tidak pedas" class="w-full resize-y border border-stone-300 px-3 py-2.5 text-sm outline-none transition-colors focus:border-amber-600 focus:ring-2 focus:ring-amber-100">{{ old('note') }}</textarea>
                    </div>
                    <template x-for="(item, index) in cart" :key="item.id">
                        <div>
                            <input type="hidden" :name="`items[${index}][restaurant_menu_id]`" :value="item.id">
                            <input type="hidden" :name="`items[${index}][qty]`" :value="item.qty">
                        </div>
                    </template>
                    <p x-show="error" x-text="error" class="text-sm text-red-600" role="alert"></p>
                    <button type="submit" class="flex w-full items-center justify-center gap-2 bg-amber-600 px-4 py-3 font-poppins text-sm font-semibold text-white transition-colors hover:bg-amber-700 disabled:cursor-not-allowed disabled:bg-stone-300" :disabled="cart.length === 0">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3-3H3.106V5.272m4.394 8.978h9.75l2.25-9H5.106M7.5 14.25 5.106 5.272M7.5 14.25l-1.125 3h11.25M16.5 16.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm-9 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" /></svg>
                        Pesan menu
                    </button>
                </div>
            </aside>
        </form>

        <button type="button" x-on:click="$refs.cart.scrollIntoView({ behavior: 'smooth', block: 'start' })" class="fixed inset-x-4 bottom-4 z-40 flex items-center justify-between bg-stone-900 px-4 py-3 text-left text-white shadow-lg xl:hidden" aria-label="Lihat keranjang pesanan">
            <span class="flex items-center gap-3">
                <span class="grid h-9 w-9 place-items-center bg-amber-600">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3-3H3.106V5.272m4.394 8.978h9.75l2.25-9H5.106M7.5 14.25 5.106 5.272M7.5 14.25l-1.125 3h11.25" /></svg>
                </span>
                <span>
                    <span class="block text-sm font-semibold">Lihat keranjang</span>
                    <span class="block text-xs text-stone-300" x-text="itemCount + ' item dipilih'"></span>
                </span>
            </span>
            <span class="font-poppins text-sm font-semibold" x-text="formatPrice(total)"></span>
        </button>
    </div>
</section>
@endsection

@push('scripts')
<script>
    function restaurantOrder(menus, tables) {
        return {
            menus: menus.map(menu => ({ ...menu, image: menu.thumbnail ? `/storage/${menu.thumbnail}` : '/img/food2.png' })),
            tables,
            cart: [],
            activeCategory: 'semua',
            error: '',
            categories: [
                { value: 'semua', label: 'Semua' },
                { value: 'makanan', label: 'Makanan' },
                { value: 'minuman', label: 'Minuman' },
                { value: 'lainnya', label: 'Lainnya' },
            ],
            get filteredMenus() {
                return this.activeCategory === 'semua' ? this.menus : this.menus.filter(menu => menu.category === this.activeCategory);
            },
            get total() {
                return this.cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
            },
            get itemCount() {
                return this.cart.reduce((sum, item) => sum + item.qty, 0);
            },
            formatPrice(price) {
                return 'Rp' + Number(price).toLocaleString('id-ID');
            },
            add(menu) {
                const existing = this.cart.find(item => item.id === menu.id);
                if (existing) {
                    existing.qty = Math.min(existing.qty + 1, 99);
                    return;
                }
                this.cart.push({ ...menu, qty: 1 });
            },
            decrease(item) {
                if (item.qty === 1) {
                    this.remove(item.id);
                    return;
                }
                item.qty--;
            },
            remove(id) {
                this.cart = this.cart.filter(item => item.id !== id);
            },
            prepareOrder(event) {
                this.error = '';
                if (this.cart.length === 0) {
                    event.preventDefault();
                    this.error = 'Pilih minimal satu menu sebelum memesan.';
                }
            },
        };
    }
</script>
@endpush

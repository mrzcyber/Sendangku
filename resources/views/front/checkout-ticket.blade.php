@extends('layouts.app')

@section('title', 'Checkout Tiket — Wisata Sendang Kun Gerit')

@push('scripts')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('services.midtrans.client_key') }}"></script>
@endpush

@section('content')

<section class="w-full bg-gray-50 flex px-4 md:px-10 xl:px-20 py-10 pt-28 md:py-42 md:pt-80">

<div
    class="max-w-3xl w-full mx-auto"
    x-data="{
        tickets: @js($tickets),

        purchase: 'online',
        buyer_name: '',
        buyer_email: '',
        buyer_phone: '',

        get total() {
            return this.tickets.reduce((acc, t) => acc + (t.qty * t.price), 0)
        },

        async pay() {
        console.log('paying...');
            const data = {
                purchase: this.purchase,
                buyer_name: this.buyer_name,
                buyer_email: this.buyer_email,
                buyer_phone: this.buyer_phone,
            };
            const items = this.tickets.filter(t => t.qty > 0).map(t => ({
                ticket_type_id: t.id,
                qty: t.qty,
            }));
            if (items.length === 0) {
                alert('Pilih tiket terlebih dahulu');
                return;
            }
            data.items = items;
            const response = await fetch('{{ route('checkout.ticket.create') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                     
                },
                body: JSON.stringify(data)
            });

            if(response.status === 429){
                const res = await response.json();
                alert(res.message);
                return;
            }
            const res = await response.json();
            window.snap.pay(res.snap_token, {
                onSuccess: function(result) {
                    window.location.href = '{{ route('checkout.ticket.success') }}';
                },
                onPending: function(result) {
                    alert('wating your payment!'); console.log(result);
                },
                onError: function(result) {
                    alert('payment failed!'); console.log(result);
                },
                onClose: function() {
                    alert('you closed the popup without finishing the payment');
                }
            });
        }
    }"
>


    <div class="text-center mb-8 md:mb-12">
        <h2 class="text-2xl md:text-3xl font-semibold font-poppins text-black uppercase">Pembelian Tiket</h2>
        <p class="mt-2 text-sm md:text-base text-gray-500 font-dm">Pilih tiket dan lengkapi data diri untuk melanjutkan pembelian</p>
        <div class="mx-auto mt-4 w-56 h-1 bg-amber-500"></div>
    </div>

    <form @submit.prevent="pay()" class="flex flex-col gap-6  ">

        {{-- Left side --}}

        <div class="lg:col-span-3 flex flex-col gap-6">

            <div
                class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">

                <div class="relative px-5 md:px-6 py-4 md:py-5 bg-amber-600 ticket-header-deco">
                    <div class="flex items-center gap-3">
                        <span class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center backdrop-blur-sm">
                            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z"/>
                            </svg>
                        </span>
                        <div>
                            <h3 class="text-lg md:text-xl font-semibold font-poppins text-white leading-tight">Pilih Tiket</h3>
                            <p class="text-amber-100 text-xs md:text-sm font-dm">Wisata Sendang Kun Gerit</p>
                        </div>
                    </div>
                </div>

                <div class="divide-y divide-gray-100">
                    <template x-for="(ticket, index) in tickets" :key="ticket.id">
                        <div class="px-5 md:px-6 py-4 md:py-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 transition-colors duration-200 hover:bg-amber-50/40">
                            <div class="flex-1 min-w-0">
                                <h4 class="text-base md:text-lg font-semibold font-poppins text-stone-800 leading-snug" x-text="ticket.name"></h4>
                                <template x-if="ticket.benefit">
                                    <ul class="mt-1.5 flex flex-row flex-wrap gap-x-4 gap-y-1">
                                        <template x-for="(b, bi) in (typeof ticket.benefit === 'string' ? ticket.benefit.split(',') : (Array.isArray(ticket.benefit) ? ticket.benefit : []))" :key="bi">
                                            <li class="flex items-center gap-1.5 text-xs md:text-sm text-gray-500 font-dm">
                                                <svg class="w-3.5 h-3.5 text-amber-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                <span x-text="b.trim()"></span>
                                            </li>
                                        </template>
                                    </ul>
                                </template>
                                <p class="mt-1.5 text-base md:text-lg text-amber-500 font-bold font-poppins">
                                    Rp<span x-text="ticket.price.toLocaleString('id-ID')"></span>
                                    <span class="text-gray-400 font-normal text-xs md:text-sm">/orang</span>
                                </p>
                            </div>

                            {{-- Qty controls --}}
                            <div class="flex items-center gap-0 w-fit self-end sm:self-center shrink-0">
                                {{-- Minus --}}
                                <button
                                    type="button"
                                    @click="if(ticket.qty > 0) ticket.qty--"
                                    class="w-9 h-9 sm:w-10 sm:h-10 flex items-center justify-center border border-gray-300
                                           text-gray-600 hover:bg-amber-500 hover:text-white hover:border-amber-500
                                           transition-all duration-200 active:scale-95 rounded-l-xl">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14"/>
                                    </svg>
                                </button>
                                {{-- Input --}}
                                <input
                                    type="number"
                                    x-model.number="ticket.qty"
                                    min="0"
                                    max="99"
                                    readonly
                                    class="w-12 sm:w-14 h-9 sm:h-10 text-center border-y border-gray-300 text-sm font-semibold
                                           text-stone-800 focus:outline-none bg-white
                                           no-spinner">
                                {{-- Plus --}}
                                <button
                                    type="button"
                                    @click="ticket.qty++"
                                    class="w-9 h-9 sm:w-10 sm:h-10 flex items-center justify-center border border-gray-300
                                           text-gray-600 hover:bg-amber-500 hover:text-white hover:border-amber-500
                                           transition-all duration-200 active:scale-95 rounded-r-xl">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </template>
                </div>

                {{-- Subtotal per ticket --}}
                <div class="px-5 md:px-6 py-3 bg-amber-50/60 border-t border-amber-100">
                    <template x-for="ticket in tickets.filter(t => t.qty > 0)" :key="ticket.id">
                        <div class="flex items-center justify-between py-1">
                            <span class="text-sm text-gray-600 font-dm" x-text="ticket.name + ' × ' + ticket.qty"></span>
                            <span class="text-sm font-semibold text-stone-800 font-poppins"
                                  x-text="'Rp' + (ticket.qty * ticket.price).toLocaleString('id-ID')"></span>
                        </div>
                    </template>
                    <div x-show="total === 0" class="text-sm text-gray-400 font-dm italic">Belum ada tiket dipilih</div>
                </div>
            </div>

            {{-- ── Kartu Data Pembeli ── --}}
            <div
                class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">

                {{-- Header --}}
                <div class="px-5 md:px-6 py-4 md:py-5 border-b border-gray-100">
                    <div class="flex items-center gap-3">
                        <span class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                            </svg>
                        </span>
                        <div>
                            <h3 class="text-lg md:text-xl font-semibold font-poppins text-stone-800 leading-tight">Data Pembeli</h3>
                            <p class="text-gray-400 text-xs md:text-sm font-dm">Lengkapi informasi di bawah ini</p>
                        </div>
                    </div>
                </div>

                {{-- Form fields --}}
                <div class="px-5 md:px-6 py-5 md:py-6 flex flex-col gap-5">

                    {{-- Nama --}}
                    <div>
                        <label for="buyer_name" class="block text-sm font-semibold font-poppins text-stone-700 mb-1.5">
                            Nama Lengkap <span class="text-red-400">*</span>
                        </label>
                        <input
                            type="text"
                            id="buyer_name"
                            x-model="buyer_name"
                            required
                            placeholder="Masukkan nama lengkap"
                            class="w-full border-2 border-gray-200 rounded-xl py-2.5 md:py-3 px-4 text-sm md:text-base font-dm text-stone-800
                                   placeholder:text-gray-400 transition-all duration-200
                                   focus:outline-none focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10">
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="buyer_email" class="block text-sm font-semibold font-poppins text-stone-700 mb-1.5">
                            Email <span class="text-red-400">*</span>
                        </label>
                        <input
                            type="email"
                            id="buyer_email"
                            x-model="buyer_email"
                            required
                            placeholder="contoh@email.com"
                            class="w-full border-2 border-gray-200 rounded-xl py-2.5 md:py-3 px-4 text-sm md:text-base font-dm text-stone-800
                                   placeholder:text-gray-400 transition-all duration-200
                                   focus:outline-none focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10">
                        <p class="mt-1.5 text-xs text-gray-400 font-dm italic flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/>
                            </svg>
                            Tiket akan dikirim ke alamat email ini
                        </p>
                    </div>

                    {{-- No. Telepon --}}
                    <div>
                        <label for="buyer_phone" class="block text-sm font-semibold font-poppins text-stone-700 mb-1.5">
                            Nomor Telepon <span class="text-red-400">*</span>
                        </label>
                        <input
                            type="tel"
                            id="buyer_phone"
                            x-model="buyer_phone"
                            required
                            placeholder="08xxxxxxxxxx"
                            @keydown="['e','E','+','-','.'].includes($event.key) && $event.preventDefault()"
                            class="w-full border-2 border-gray-200 rounded-xl py-2.5 md:py-3 px-4 text-sm md:text-base font-dm text-stone-800
                                   placeholder:text-gray-400 transition-all duration-200 no-spinner
                                   focus:outline-none focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10">
                    </div>

                    {{-- Hidden Purchase Type --}}
                    <input type="hidden" x-model="purchase" value="online">

                </div>

                <div>
                                    {{-- Ringkasan --}}
                <div class="px-5 md:px-6 py-4 md:py-5 ">
                    <h3 class="text-lg font-semibold font-poppins text-stone-800 mb-1">Ringkasan Pembelian</h3>
                    <p class="text-xs text-gray-400 font-dm">Wisata Sendang Kun Gerit</p>
                </div>

                {{-- Detail items --}}
                <div class="px-5 md:px-6 py-4 md:py-5 space-y-3">

                    {{-- Ticket list --}}
                    <template x-for="ticket in tickets" :key="ticket.id">
                        <div class="flex items-center justify-between" x-show="ticket.qty > 0" x-transition>
                            <div class="flex items-center gap-2 min-w-0">
                                <span class="w-6 h-6 rounded-md bg-amber-100 flex items-center justify-center shrink-0">
                                    <svg class="w-3.5 h-3.5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z"/>
                                    </svg>
                                </span>
                                <span class="text-sm text-gray-600 font-dm truncate" x-text="ticket.name + ' × ' + ticket.qty"></span>
                            </div>
                            <span class="text-sm font-semibold text-stone-800 font-poppins whitespace-nowrap ml-2"
                                  x-text="'Rp' + (ticket.qty * ticket.price).toLocaleString('id-ID')"></span>
                        </div>
                    </template>

                    {{-- Empty state --}}
                    <div x-show="total === 0" class="py-6 text-center">
                        <div class="w-14 h-14 mx-auto mb-3  flex items-center justify-center">
                            <svg class="w-10 h-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z"/>
                            </svg>
                        </div>
                        <p class="text-md text-gray-400 font-dm">Belum ada tiket dipilih</p>
                        <p class="text-sm text-gray-300 font-dm mt-1">Pilih tiket di bagian atas untuk mulai</p>
                    </div>
                </div>

                {{-- Tear line --}}
                <div class="tear-dashes-gray mx-5 md:mx-6"></div>

                {{-- Total --}}
                <div class="px-5 md:px-6 py-4 md:py-5">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-semibold font-poppins text-gray-600 uppercase tracking-wide">Total</span>
                        <span class="text-xl md:text-2xl font-bold font-poppins transition-all duration-300"
                              :class="total > 0 ? 'text-amber-500' : 'text-gray-300'"
                              x-text="'Rp' + total.toLocaleString('id-ID')"></span>
                    </div>
                </div>

                {{-- CTA Button --}}
                <div class="px-5 md:px-6 pb-5 md:pb-6">
                    <button
                        id="pay-button"
                        type="submit"
                        :disabled="total === 0"
                        class="w-full py-3.5 rounded-xl bg-amber-500 text-white font-semibold font-poppins text-sm md:text-base
                               text-center transition-all duration-300
                               hover:bg-amber-600 hover:shadow-lg hover:shadow-amber-200 hover:-translate-y-0.5
                               active:scale-[0.98]
                               disabled:opacity-40 disabled:cursor-not-allowed disabled:hover:bg-amber-500 disabled:hover:shadow-none disabled:hover:translate-y-0">
                        <span class="flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z"/>
                            </svg>
                            Bayar Sekarang
                        </span>
                    </button>

                    {{-- Security note --}}
                    <div class="mt-3 mb-3 flex items-center justify-center gap-1.5 text-xs text-gray-400 font-dm">
                        <svg class="w-3.5 h-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/>
                        </svg>
                        Pembayaran aman via Midtrans
                    </div>
                </div>
                </div>

            </div>

        </div>


    </form>

</div>

</section>

@endsection
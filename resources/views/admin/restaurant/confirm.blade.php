@extends('layouts.dashboard')

@section('title', 'Konfirmasi Pesanan Restaurant')
@section('meta_description', 'Konfirmasi pesanan restaurant yang telah dibayar.')
@section('body_class', 'font-sans bg-muted min-h-screen overflow-x-hidden text-foreground')

@section('content')
<style>[x-cloak]{display:none !important}</style>

<div x-data="kasir(@js($orders))" x-init="init()" class="contents">

<div class="flex h-screen max-h-screen flex-1 overflow-hidden">
  <main class="flex flex-1 flex-col bg-white min-h-screen overflow-x-hidden lg:ml-[280px]">
    <div class="flex h-[90px] w-full shrink-0 items-center justify-between border-b border-border bg-white px-5 md:px-8">
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
      <!-- Notifikasi Pesanan Belum Dikonfirmasi -->
      <button
        onclick="openUnconfirmedModal()"
        class="size-11 flex items-center justify-center rounded-xl ring-1 ring-border hover:ring-primary transition-all duration-300 cursor-pointer relative"
        aria-label="Pesanan belum dikonfirmasi"
        title="Pesanan belum dikonfirmasi"
      >
        <i data-lucide="bell" class="size-6 text-secondary"></i>

          <span class="absolute -top-1 -right-1 h-5 min-w-[20px] px-[5px] w-5  rounded-full bg-error text-white text-xs font-bold flex items-center justify-center border-2 border-white" x-text="orders.length"></span>

      </button>

      </div>
    </div>

    <div class="flex-1 overflow-y-auto p-5 md:p-8">
      <div class="mb-8">
        <h1 class="mb-1 text-2xl font-bold text-foreground">
          Pesanan Belum Dikonfirmasi
          <span class="ml-2 rounded-full bg-amber-100 px-3 py-0.5 text-base text-amber-900" x-text="orders.length"></span>
        </h1>
        <p class="text-sm text-secondary">Tinjau detail dan konfirmasi pesanan restaurant yang sudah dibayar.</p>
      </div>

      <div class="flex flex-col overflow-hidden rounded-3xl border border-border bg-white shadow-sm">
        <div class="border-b border-border p-6">
          <h3 class="text-lg font-bold text-foreground">Transaksi Penjualan</h3>
        </div>

        <div class="overflow-x-auto">
          <table class="w-full min-w-[1100px] border-collapse text-left">
            <thead>
              <tr class="border-b border-border bg-muted/50">
                <th class="w-[20%] px-6 py-4 text-xs font-semibold uppercase tracking-wider text-secondary">Code</th>
                <th class="w-[15%] px-6 py-4 text-xs font-semibold uppercase tracking-wider text-secondary">Meja</th>
                <th class="w-[12%] px-6 py-4 text-xs font-semibold uppercase tracking-wider text-secondary">Nama</th>
                <th class="w-[12%] px-6 py-4 text-xs font-semibold uppercase tracking-wider text-secondary">Harga</th>
                <th class="w-[10%] px-6 py-4 text-xs font-semibold uppercase tracking-wider text-secondary">Pembayaran</th>
                <th class="w-[14%] px-6 py-4 text-xs font-semibold uppercase tracking-wider text-secondary">Waktu</th>
                <th class="w-[10%] px-6 py-4 text-xs font-semibold uppercase tracking-wider text-secondary">Status</th>
                <th class="w-[12%] px-6 py-4 text-xs font-semibold uppercase tracking-wider text-secondary">Konfirmasi</th>
                <th class="w-[10%] px-6 py-4 text-xs font-semibold uppercase tracking-wider text-secondary">Aksi</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-border">

              <template x-for="o in orders" :key="o.id">
                <tr class="group transition-colors hover:bg-muted/30">
                  <td class="px-4 py-4"><span class="font-mono text-sm font-semibold text-foreground" x-text="o.order_code"></span></td>
                  <td class="px-4 py-4"><span class="rounded-full bg-amber-100 px-2.5 py-1 text-xs font-bold text-amber-900" x-text="o.table || 'Meja -'"></span></td>
                  <td class="px-4 py-4"><p class="max-w-[150px] truncate text-sm font-medium text-foreground" :title="o.name" x-text="o.name"></p></td>
                  <td class="px-4 py-4"><span class="text-sm font-bold text-success" x-text="o.total_price"></span></td>
                  <td class="px-4 py-4">
                    <div class="flex items-center gap-2 text-secondary">
                      {{-- ikon inline SVG (bukan lucide) supaya aman dirender ulang oleh Alpine --}}
                      <svg x-show="(o.payment || '').toLowerCase() === 'online'" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="14" height="20" x="5" y="2" rx="2"/><path d="M12 18h.01"/></svg>
                      <svg x-show="(o.payment || '').toLowerCase() !== 'online'" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="12" x="2" y="6" rx="2"/><circle cx="12" cy="12" r="2"/><path d="M6 12h.01M18 12h.01"/></svg>
                      <span class="text-sm font-medium" x-text="o.payment"></span>
                    </div>
                  </td>
                  <td class="px-4 py-4"><span class="text-sm font-medium text-secondary" x-text="o.time"></span></td>
                  <td class="px-4 py-4"><span class="inline-flex items-center justify-center rounded-full bg-success-light px-3 py-1 text-xs font-bold text-success-dark" x-text="o.status"></span></td>
                  <td class="px-4 py-4">
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-muted px-3 py-1 text-xs font-bold text-secondary">
                      <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                      Belum
                    </span>
                  </td>
                  <td class="px-6 py-4">
                    <button type="button" @click="openDetail(o.id)" class="cursor-pointer rounded-full bg-info/10 px-4 py-1.5 text-xs font-bold text-info-dark transition-all duration-300 hover:bg-info/20">Detail</button>
                  </td>
                </tr>
              </template>

              <template x-if="orders.length === 0">
                <tr>
                  <td colspan="9" class="px-6 py-12 text-center text-secondary">
                    <div class="mx-auto mb-3 flex size-12 items-center justify-center rounded-2xl bg-success/10"><i data-lucide="check-circle-2" class="size-6 text-success"></i></div>
                    <p class="font-semibold text-foreground">Semua Pesanan Sudah Dikonfirmasi</p>
                    <p class="mt-1 text-xs text-secondary">Tidak ada pesanan yang menunggu konfirmasi.</p>
                  </td>
                </tr>
              </template>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>
</div>

{{-- Modal detail --}}
<div x-show="selected" x-cloak x-transition.opacity
     @keydown.escape.window="closeDetail()" @click.self="closeDetail()"
     class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 p-4">
  <div class="w-full max-w-lg overflow-hidden rounded-3xl bg-white shadow-2xl">
    <div class="flex items-center justify-between border-b border-border p-6">
      <div>
        <h3 class="text-xl font-bold text-foreground">Detail Pesanan</h3>
        <p class="mt-0.5 font-mono text-xs text-secondary" x-text="selected?.order_code || '-'"></p>
      </div>
      <button type="button" @click="closeDetail()" aria-label="Tutup detail" class="cursor-pointer rounded-full p-2 transition-colors hover:bg-muted"><i data-lucide="x" class="size-5 text-secondary"></i></button>
    </div>

    <div class="max-h-[65vh] space-y-4 overflow-y-auto p-6">
      <div class="grid grid-cols-2 gap-3 rounded-2xl border border-border bg-muted/40 p-4 text-sm">
        <div><span class="block text-xs font-medium text-secondary">Nama Pemesan</span><span class="font-semibold text-foreground" x-text="selected?.name || '-'"></span></div>
        <div><span class="block text-xs font-medium text-secondary">Nomor Meja</span><span class="font-semibold text-foreground" x-text="selected?.table || '-'"></span></div>
        <div><span class="block text-xs font-medium text-secondary">Waktu Pesan</span><span class="text-xs font-medium text-foreground" x-text="selected?.time || '-'"></span></div>
        <div><span class="block text-xs font-medium text-secondary">Status & Pembayaran</span><span class="text-xs font-semibold" x-text="(selected?.status || '-') + ' • ' + (selected?.payment || '-')"></span></div>
        <div class="col-span-2 border-t border-border/60 pt-2"><span class="block text-xs font-medium text-secondary">Catatan</span><span class="text-xs italic text-foreground" x-text="selected?.note || '-'"></span></div>
      </div>

      <div>
        <h4 class="mb-2 text-xs font-semibold uppercase tracking-wider text-secondary">Item Menu Dipesan</h4>
        <div class="divide-y divide-border overflow-hidden rounded-2xl border border-border bg-white">
          <template x-for="(item, idx) in (selected?.items || [])" :key="idx">
            <div class="flex items-center justify-between p-3 text-sm">
              <div>
                <p class="font-medium text-foreground" x-text="item.name || 'Menu'"></p>
                <p class="text-xs text-secondary" x-text="(item.qty || 0) + ' × ' + (item.price || '-')"></p>
              </div>
              <p class="font-semibold text-foreground" x-text="item.subtotal || '-'"></p>
            </div>
          </template>
          <div x-show="!selected?.items?.length" class="p-4 text-center text-xs text-secondary">Tidak ada item menu</div>
        </div>
      </div>

      <div class="flex items-center justify-between rounded-2xl border border-primary/20 bg-primary/5 p-4">
        <span class="font-semibold text-foreground">Total Pembayaran</span>
        <span class="text-lg font-bold text-primary" x-text="selected?.total_price || '-'"></span>
      </div>
    </div>

    <div class="flex justify-end gap-3 border-t border-border bg-gray-50 p-4">
      <button type="button" x-show="selected?.confirm_url" @click="konfirmasi()" :disabled="busy"
              class="inline-flex cursor-pointer items-center gap-2 rounded-full bg-success px-6 py-2.5 font-semibold text-white transition-all hover:bg-success-dark disabled:cursor-not-allowed disabled:opacity-60">
        <span x-text="busy ? 'Mengkonfirmasi...' : 'Konfirmasi'"></span>
      </button>
      <button type="button" @click="closeDetail()" class="cursor-pointer rounded-full border border-border bg-white px-6 py-2.5 font-semibold text-foreground transition-all hover:bg-gray-100">Tutup</button>
    </div>
  </div>
</div>

{{-- Toast --}}
<div class="pointer-events-none fixed bottom-6 right-6 z-[110] flex flex-col gap-3">
  <template x-for="t in toasts" :key="t.id">
    <div class="pointer-events-auto rounded-2xl px-5 py-3.5 text-sm font-semibold text-white shadow-lg"
         :class="t.type === 'success' ? 'bg-success' : 'bg-error'" x-text="t.message"></div>
  </template>
</div>

</div>
@endsection

@push('scripts')
<script>
  function kasir(initial) {
    return {
      orders: initial,
      knownIds: initial.map(o => o.id),
      selectedId: null,
      busy: false,
      soundOn: false,
      toasts: [],
      audio: new Audio('/sounds/order.mp3'),

      get selected() {
        return this.orders.find(o => o.id === this.selectedId) || null;
      },

init() {
  window.lucide?.createIcons();

  // cek apakah browser sudah mengizinkan suara tanpa klik
  try {
    const ctx = new (window.AudioContext || window.webkitAudioContext)();
    if (ctx.state === 'running') this.soundOn = true;
    ctx.close();
  } catch (e) {}


  if (!this.soundOn) {
    const events = ['click', 'keydown', 'touchstart'];
    const unlock = () => {
      this.enableSound();
      events.forEach(ev => document.removeEventListener(ev, unlock, true));
    };
    events.forEach(ev => document.addEventListener(ev, unlock, true));
  }

  setInterval(() => this.check(), 5000); 
  document.addEventListener('visibilitychange', () => {
    if (!document.hidden) this.check();
  });
  },

      enableSound() {
        this.soundOn = true;
        this.audio.play().then(() => this.audio.pause()).catch(() => {});
      },

      openDetail(id) { this.selectedId = id; },
      closeDetail() { this.selectedId = null; },

      toast(message, type = 'success') {
        const id = Date.now() + Math.random();
        this.toasts.push({ id, message, type });
        setTimeout(() => { this.toasts = this.toasts.filter(t => t.id !== id); }, 3000);
      },

      async getJson(url) {
        const res = await fetch(url, { headers: { 'Accept': 'application/json' } });
        if (res.status === 401 || res.status === 419) { location.reload(); return null; } // sesi habis
        if (!res.ok) return null;
        return res.json();
      },

      async check() {
        try {
          const ids = await this.getJson('{{ route("admin.restaurant.orders.waiting") }}');
          if (!ids) return;
          if (ids.join(',') === this.knownIds.join(',')) return;   // tidak berubah, berhenti di sini

          const adaBaru = ids.some(id => !this.knownIds.includes(id));
          this.knownIds = ids;
          await this.loadOrders();

          if (adaBaru && this.soundOn) this.audio.play().catch(() => {});
        } catch (e) {
          // koneksi putus sesaat, coba lagi di polling berikutnya
        }
      },

      async loadOrders() {
        const data = await this.getJson('{{ route("admin.restaurant.orders.unconfirmed") }}');
        if (data) {
          this.orders = data;
          this.knownIds = data.map(o => o.id);
        }
      },

      async konfirmasi() {
        const order = this.selected;
        if (!order || !order.confirm_url || this.busy) return;
        this.busy = true;

        try {
          const res = await fetch(order.confirm_url, {
            method: 'PATCH',
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content,
              'Accept': 'application/json',
              'Content-Type': 'application/json',
            },
          });
          const result = await res.json().catch(() => ({}));

          if (!res.ok || !result.success) {
            this.toast(result.message || 'Gagal mengkonfirmasi pesanan.', 'error');
            await this.loadOrders();   // misal sudah dikonfirmasi kasir lain
            return;
          }

          this.orders = this.orders.filter(o => o.id !== order.id);
          this.knownIds = this.knownIds.filter(i => i !== order.id);
          this.closeDetail();
          this.toast('Pesanan berhasil dikonfirmasi!', 'success');
        } catch (e) {
          this.toast('Terjadi kesalahan saat mengkonfirmasi pesanan.', 'error');
        } finally {
          this.busy = false;
        }
      },
    };
  }
</script>
@endpush
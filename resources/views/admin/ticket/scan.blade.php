<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scan Tiket</title>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    @vite(['resources/css/app.css', 'resources/css/dashboard.css', 'resources/js/app.js', 'resources/js/dashboard.js'])
    <style>
        /* Fix 1: pastikan html & body tidak ada overflow */
        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        /* Fix 2: override semua style dari Html5Qrcode library */
        #reader {
            width: 100vw !important;
            height: 100dvh !important;
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            border: none !important;
        }

        #reader video {
            width: 100vw !important;
            height: 100dvh !important;
            object-fit: cover !important; /* cover biar penuh, bukan contain */
        }

        /* Fix 3: sembunyikan UI bawaan library yang bikin layout berantakan */
        #reader__scan_region {
            width: 100% !important;
            height: 100% !important;
        }

        #reader__dashboard {
            display: none !important;
        }
    </style>
</head>
<body>
<div
    x-data="scanner()"
    class="min-h-screen flex flex-col items-center justify-center bg-muted">

    <div class=" relative flex justify-between py-10 items-center flex-col inset-0 w-full h-screen bg-black "> 
        <div class=" text-white w-96 text-center z-10 text-xl font-semibold">
            Arahkan Tiket ke kamera
        </div>

        <div id="reader" class="absolute inset-0"></div>

        <a href="{{ route('admin.ticket-type.index') }}" class=" z-10 w-80 inline-flex items-center justify-center gap-2 px-5 py-3 ring-1 ring-border hover:ring-primary rounded-full text-foreground font-semibold transition-all duration-300 bg-white shadow-sm shadow-gray-600">
          <i data-lucide="arrow-left" class="size-5 text-secondary"></i>
          <span>Kembali</span>
        </a>


    </div>


<div
    x-show="show"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 bg-black/60 z-40"
    style="display: none;"
></div>

{{-- Modal Tengah --}}
<div
    x-show="show"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
    class="fixed inset-0 z-50 flex items-center justify-center px-6"
    style="display: none;"
>
    <div class="bg-white rounded-2xl w-full max-w-xs p-6 flex flex-col items-center shadow-xl">

        {{-- Icon --}}
        <div :class="success ? 'bg-green-100' : 'bg-red-100'"
             class="w-12 h-12 rounded-full flex items-center justify-center mb-3">
            <i :data-lucide="success ? 'circle-check' : 'circle-x'"
               :class="success ? 'text-green-600' : 'text-red-600'"
               class="size-6"></i>
        </div>

        {{-- Title --}}
        <p :class="success ? 'text-green-700' : 'text-red-700'"
           class="font-semibold text-base mb-1 text-center"
           x-text="success ? 'Tiket valid!' : 'Tiket tidak valid'"></p>

        {{-- Message --}}
        <p class="text-xs text-gray-400 text-center mb-3 leading-relaxed"
           x-text="message"></p>

        {{-- Data tiket (jika ada) --}}
        <template x-if="data && data.length > 0">
            <div class="w-full bg-gray-50 rounded-xl px-4 py-3 mb-5 space-y-2">
                <template x-for="item in data" :key="item.ticket_type">
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-500" x-text="item.ticket_type"></span>
                        <span class="text-xs font-medium text-gray-700"
                              x-text="item.qty + ' tiket'"></span>
                    </div>
                </template>
            </div>
        </template>

        {{-- Scan Lagi --}}
        <button
            @click="closePopup()"
            :class="success ? 'bg-green-600 hover:bg-green-700' : 'bg-red-600 hover:bg-red-700'"
            class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-full text-white text-sm font-medium transition-colors mb-2">
            <i data-lucide="scan" class="size-4"></i>
            Scan lagi
        </button>

        {{-- Kembali --}}
        <a href="{{ route('admin.ticket-type.index') }}"
           class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-full border border-gray-200 text-gray-500 text-sm font-medium hover:bg-gray-50 transition-colors">
            <i data-lucide="arrow-left" class="size-4"></i>
            Kembali
        </a>

    </div>
</div>



</div>

<script>
function scanner() {
    return {
        scanner: null,
        processing: false,
        show: false,
        success: false,
        message: '',
        data: [],

        init() {
            this.startScanner();
        },

        async startScanner() {
            if (!window.isSecureContext) {
                this.showPopup(false, 'Kamera hanya bisa dibuka dari HTTPS atau localhost.');
                return;
            }

            if (!window.Html5Qrcode) {
                this.showPopup(false, 'Library scanner belum berhasil dimuat.');
                return;
            }

            try {
                this.scanner = new Html5Qrcode("reader");

                await this.scanner.start(
                    { facingMode: "environment"},
                    {
                        fps: 30,
                        qrbox: function(viewfinderWidth, viewfinderHeight) {
                            const w = viewfinderWidth || window.innerWidth;
                            const h = viewfinderHeight || window.innerHeight;
                            const minEdge = Math.min(w, h);
                            const size = Math.floor(minEdge * 0.70);
                            return { width: size, height: size };
                        },
                    },
                    
                    (decodedText) => {
                        if (this.processing) return;

                        this.processing = true;
                        this.scanner.pause();
                        this.verify(decodedText);
                    }
                );
            } catch (error) {
                console.error(error);
                this.showPopup(false, 'Kamera tidak bisa dibuka. Pastikan izin kamera diberikan dan halaman dibuka lewat HTTPS atau localhost.');
            }
        },

        async verify(qrToken) {
            try {
                const response = await fetch("{{ route('admin.order-ticket.verify') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({ qr_token: qrToken }),
                });

                const result = await response.json();
                     this.data = result.data ?? [];

                if (!response.ok) {
                    this.showPopup(false, result.message ?? 'Terjadi kesalahan.');
                    return;
                }

                this.showPopup(result.success, result.message);

            } catch (err) {
                console.error(err);
                this.showPopup(false, 'Gagal terhubung ke server.');
            }
        },


        showPopup(success, message) {
            this.success = success;
            this.message = message;
            this.$nextTick(() => {
                this.show = true;
                this.$nextTick(() => lucide.createIcons());

            });
        },

        closePopup() {
            this.show = false;
            this.processing = false;
            this.data = [];
            this.scanner.resume();
        }
    }
}
</script>
</body>
</html>
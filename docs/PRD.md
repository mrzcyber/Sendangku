# 📋 Product Requirements Document (PRD)
## Wisata Sendang Kun Gerit (Sendangku) — Platform Terpadu

---

**Versi:** 1.5
**Tanggal:** Oktober 2026
**Status:** Sinkron dengan kode (as-built) — MVP berjalan, belum production-ready (lihat Section 11)
**Basis audit kode:** commit `84f9a12` (9 Okt 2026), repo `mrzcyber/Sendangku`
**Target Audience:** Wisatawan Lokal Indonesia

> **Cara membaca versi ini:** v1.5 adalah hasil penyelarasan PRD dengan kode yang sudah ada. Isi dokumen menggambarkan **apa yang benar-benar berjalan di kode**. Hal yang ada di PRD v1.4 tetapi belum dibangun ditandai ⚠️ / ❌ dan dirangkum di **Section 11**. Perubahan keputusan produk (bukan sekadar sinkronisasi) ada di **Section 12** dan perlu Anda putuskan.

---

## CHANGELOG

### v1.5 — Sinkronisasi PRD dengan kode aktual
| Perubahan | Detail |
|---|---|
| 🔄 Update | Tech stack: **Laravel 13** (`^13.8`, terkunci v13.12.0), PHP ^8.3 — sebelumnya tertulis Laravel 12 |
| 🔄 Update | Tabel `restaurant_orders_items` → nama aktual **`restaurant_order_items`** (FK `restaurant_order_id`, `restaurant_menu_id`) |
| 🔄 Update | `restaurant_orders`: kolom status bernama **`pay_status`** (bukan `status`); FK meja bernama **`table_id`** (bukan `tables_id`) |
| ➕ Tambah | `restaurant_orders`: kolom **`name`** (nama pemesan), **`note`** (catatan), **`snap_token`**, **`confirmed`** (boolean, konfirmasi kasir); index `(pay_status, confirmed)` |
| ➕ Tambah | `orders` (tiket): kolom **`pay_status`** (`pending`/`paid`/`failed`), **`snap_token`**, **`qr_path`** |
| ➕ Tambah | `restaurant_menus.category` (`makanan`/`minuman`/`lainnya`); `ticket_types.benefit` |
| 🔄 Update | `services`: kolom harga bernama **`price`** (bukan `start_from`); `service_packages.whatsapp_number` bertipe **string** (bukan INT) |
| ➕ Tambah | Modul **Manajemen User Staf** (CRUD akun admin/tiket/kasir) — ada di kode, belum ada di PRD |
| ➕ Tambah | **Scheduler**: `orders:expire` (tiap jam) dan `orders:cleanup` (harian) |
| ➕ Tambah | **Halaman kasir terpisah** (`/admin/restaurant-orders/kasir`) dengan polling 5 detik + suara notifikasi, dan **halaman input pesanan offline oleh kasir** |
| 🔄 Update | Alur F&B: pelanggan **memilih nomor meja dari dropdown** di halaman `/restourant` (bukan membuka URL QR ber-token). Pembayaran via **Midtrans Snap** (bukan QRIS dinamis khusus) |
| 🔄 Update | Alur order restoran: pesanan masuk ke kasir hanya jika `pay_status = success` **dan** `confirmed = false`; kasir menekan **Konfirmasi** |
| 🔄 Update | Hak akses menu restoran & meja: **admin dan kasir** (CRUD penuh), bukan "admin read-only" |
| 🔄 Update | Hak akses Jenis Tiket: **admin dan petugas tiket** (bukan admin saja) |
| ⚠️ Belum ada | QR meja berbasis `table_code`, testimonial landing, menu terlaris, pencarian `order_code`, mode offline scan, pengaturan sistem, SEO (sitemap/OG), rate limit login — lihat Section 11 |
| 📌 Temuan | Daftar risiko teknis yang perlu ditangani sebelum production — lihat Section 11.B |

### v1.4 — Finalisasi skema meja & modul restoran
| Perubahan | Detail |
|---|---|
| ✅ Resolve | Naming tabel restoran: `restaurant_orders` = header transaksi, item per menu = tabel terpisah |
| ➕ Tambah | Tabel `tables` (nomor meja + `table_code` unik) |
| ➕ Tambah | Snapshot harga (`price`, `subtotal`) di item order restoran |
| ➕ Tambah | `order_code` unik di `restaurant_orders` |
| ➕ Tambah | `created_at`/`updated_at` di `restaurant_orders` & `tables` |
| 🔧 Fix | Typo enum status `'faild'` → `'failed'` |
| ⚠️ Known limitation | Tabel `tables` tanpa kolom `is_active` |

### v1.3 — Sinkronisasi PRD dengan DB Schema aktual
| Perubahan | Detail |
|---|---|
| ❌ Hapus | Role `user` (customer login) — tiket **guest checkout** |
| ❌ Hapus | Modul User Account, `visit_date`, expiry tiket |
| ❌ Hapus | Modul Paket Wisata, Event, Fasilitas dari scope MVP |
| 🔄 Update | Tiket dinamis via `ticket_types` + `order_items` |
| ➕ Tambah | Modul Layanan (`services`, `service_galleries`, `service_packages`) dengan WA deep link per paket |
| 🔄 Update | Blog disederhanakan tanpa kategori/tag |

### v1.2 dan v1.1
Ringkasan lama: rating dinamis diganti testimonial hardcode, CFD dihapus, `visit_date` dihapus, flow F&B via Midtrans. v1.1 sempat menambah role User/akun pelanggan yang kemudian dihapus di v1.3.

---

## 1. RINGKASAN EKSEKUTIF

Platform website wisata destinasi ini adalah sistem terpadu yang mengelola touchpoint pengunjung: informasi destinasi, pembelian tiket online (guest checkout, tanpa akun), pemesanan makanan di lokasi dengan pembayaran online, dan booking layanan via WhatsApp. Di sisi internal tersedia back-office multi-role: **Admin**, **Kasir**, dan **Petugas Tiket**.

**Tagline:** *"Satu platform, pengalaman wisata yang lengkap."*

> **Catatan:** Tidak ada akun pelanggan. Semua transaksi tiket bersifat **guest checkout**; bukti tiket & QR code dikirim ke email pembeli. Transaksi restoran juga tanpa akun pelanggan (hanya nama pemesan dan nomor meja).

---

## 2. TUJUAN & SUCCESS METRICS

### Tujuan Bisnis
- Meningkatkan konversi pengunjung website menjadi pembelian tiket online
- Mendigitalisasi seluruh transaksi untuk akurasi laporan keuangan
- Mempercepat pelayanan di lokasi (tiket, restoran, booking layanan)
- Membangun awareness destinasi via konten blog & informasi lengkap


---

## 3. RUANG LINGKUP SISTEM

Sistem terdiri dari **5 area**:

```
┌──────────────────────────────────────────────────────────────────┐
│                     WEBSITE WISATA PLATFORM                      │
├───────────────┬──────────────┬──────────────┬────────────────────┤
│  PUBLIC WEB   │    TIKET     │   RESTORAN   │  BOOKING LAYANAN   │
│  (Guest Only) │   MODULE     │  / KASIR     │  & PAKET (WA)      │
├───────────────┴──────────────┴──────────────┴────────────────────┤
│              ADMIN DASHBOARD (+ Manajemen User Staf)             │
└──────────────────────────────────────────────────────────────────┘
```


---

## 4. USER ROLES & PERSONA

### 4.1 Guest / Pengunjung
- Akses halaman publik (beranda, layanan, blog, halaman pesan restoran), beli tiket online, pesan makanan, booking layanan via WhatsApp.
- Tidak perlu registrasi/login.

### 4.2 Petugas Tiket *(Role: `tiket`)*
- Verifikasi tiket (scan QR), input transaksi offline, lihat dashboard tiket, kelola jenis tiket.
- Setelah login diarahkan ke `/admin/order-ticket`.

### 4.3 Kasir Restoran *(Role: `kasir`)*
- Kelola menu & meja, konfirmasi pesanan masuk, input pesanan offline, lihat dashboard restoran.
- Setelah login diarahkan ke `/admin/restaurant-order`.

### 4.4 Admin *(Role: `admin`)*
- Akses semua area: dashboard agregat, user staf, blog, layanan & paket, serta seluruh fitur restoran dan tiket.
- Setelah login diarahkan ke `/admin/dashboard`.

### 4.5 Matriks Hak Akses (sesuai middleware `role:`)
| Area | URL (prefix `/admin`) | admin | kasir | tiket |
|---|---|:-:|:-:|:-:|
| Dashboard agregat | `/dashboard` | ✅ | — | — |
| Manajemen user staf | `/user` | ✅ | — | — |
| Blog | `/blog` | ✅ | — | — |
| Layanan | `/service` | ✅ | — | — |
| Paket layanan | `/service-package` | ✅ | — | — |
| Menu restoran | `/restaurant-menu` | ✅ | ✅ | — |
| Meja | `/table` | ✅ | ✅ | — |
| Dashboard restoran & order offline | `/restaurant-order` | ✅ | ✅ | — |
| Halaman kasir (konfirmasi) | `/restaurant-orders/kasir` | ✅ | ✅ | — |
| Dashboard tiket & input tiket offline | `/order-ticket` | ✅ | — | ✅ |
| Scan / verifikasi QR | `/order-ticket/scan`, `/order-ticket/verify` | ✅ | — | ✅ |
| Jenis tiket | `/ticket-type` | ✅ | — | ✅ |


---

## 5. MODUL & FITUR DETAIL

---

### 📱 MODUL 1 — PUBLIC WEBSITE (Guest)

#### 1.1 Beranda (`/`)
Satu halaman dengan section berjangkar, ditautkan dari navbar (Home, Tentang Kami, Layanan, Resto, Berita, Kontak):
- **Hero** dengan CTA "Beli Tiket Sekarang" (→ `/checkout/ticket`)
- **Tentang Kami** (`#tentang`)
- **Layanan** (`#layanan`) — diambil dari tabel `services`
- **Fasilitas** (`#fasilitas`) — **konten statis** (empat fasilitas umum), bukan dari database
- **Berita** (`#berita`) — 3 blog terbaru
- **Kontak** (`#kontak`) — bagian footer: Google Maps embed (iframe) + link petunjuk arah, tombol WhatsApp, Instagram
- Animasi scroll memakai AOS (via CDN)


#### 1.2 Layanan (`/layanan`, `/layanan/{slug}`)
- Daftar layanan dan halaman detail per layanan (slug otomatis dari nama via `spatie/laravel-sluggable`)
- Detail menampilkan galeri foto (`service_galleries`) dan paket (`service_packages`), diurutkan: paket **populer** dulu, lalu harga termurah
- Tombol **"Pesan via WhatsApp"** per paket → `https://wa.me/{nomor}?text={pesan}`;pesan di-URL-encode.

#### 1.3 Tiket Online (`/checkout/ticket`) — *Guest Checkout*
- Daftar jenis tiket dinamis dari `ticket_types` (nama, harga, benefit), pembeli memilih jumlah per jenis (bisa lebih dari satu jenis dalam satu order)
- Data pembeli wajib: nama, email, no. HP
- Checkout via **Midtrans Snap** (popup). Setelah sukses diarahkan ke `/checkout/ticket/success` ("Pembayaran Berhasil", petunjuk cek email termasuk folder spam)
- Rate limit: **5 permintaan per menit per IP**
- Harga selalu tetap; tidak ada `visit_date`; tiket berlaku sampai di-scan

#### 1.4 Pemesanan Restoran (`/restourant`)
- Menampilkan menu aktif (`restaurant_menus.status = true`), diurutkan per kategori lalu nama
- Pelanggan mengisi **nama**, **memilih nomor meja dari dropdown**, memilih menu + qty, dan catatan opsional
- Bayar via **Midtrans Snap**; saat sukses ditampilkan pesan terima kasih dan kode order
- Rate limit: **5 permintaan per menit per IP**
- Server memvalidasi ulang bahwa semua menu masih tersedia dan **menghitung harga dari database** (bukan dari input klien)

#### 1.5 Blog (`/blog`, `/blog/{slug}`)
- Daftar blog (9 per halaman) dan detail dengan 3 artikel terkait. Tanpa kategori/tag. Slug otomatis dari nama.

#### 1.6 Peta
- Google Maps embed (iframe) dan link "Get Directions" di footer.

#### 1.7 Login Staf (`/login`)
- Form email + password, opsi "remember". Setelah login diarahkan sesuai role (lihat Section 4).

---

### 🎟️ MODUL 2 — TIKET (Role: Petugas Tiket / Admin)

#### 2.1 Dashboard Tiket (`/admin/order-ticket`)
Hanya menghitung order dengan `pay_status = paid`. Filter periode: **Hari Ini / Minggu Ini / Bulan Ini / Semua Waktu**.
- Total pendapatan
- Jumlah tiket **terscan** (`status = used`) dan **belum terscan** (`status = active`)
- Total pengunjung (jumlah `qty` tiket valid)
- Rincian jumlah per jenis tiket (dinamis)
- Tabel transaksi (10 per halaman) dengan filter **status** (`active`/`used`) dan **metode** (`online`/`offline`)

> ⚠️ Pencarian by `order_code` dan filter by jenis tiket (ada di PRD v1.4) **belum ada**.

#### 2.2 Scan & Verifikasi QR (`/admin/order-ticket/scan`)
- Scan via kamera memakai pustaka `html5-qrcode` (mobile-friendly)
- `POST /admin/order-ticket/verify` memvalidasi `qr_token` harus berformat UUID
  - **Valid (`active`)** → set `status = used`, `scanned_at = now`, `scanned_by = id petugas`; respons berisi rincian jenis & qty tiket
  - **Sudah digunakan (`used`)** → respons gagal berisi waktu scan sebelumnya dan rincian tiket
  - **Tidak ditemukan** → HTTP 404
  - **Format token tidak valid** → HTTP 422
- ⚠️ Mode offline ("foto dulu, scan ulang saat koneksi kembali") **belum diimplementasikan**

#### 2.3 Transaksi Tiket Manual / Offline (`/admin/order-ticket/create`)
- Petugas memilih jenis tiket + jumlah untuk pengunjung offline (tanpa data pembeli; **tidak ada input nama pengunjung**, tidak ada pilihan metode bayar)
- Saat disimpan: `purchase = offline`, `pay_status = paid`, `status = used` (langsung dianggap masuk), `scanned_at` dan `scanned_by` terisi saat itu juga
- `qr_token` tetap otomatis dibuat (lewat model event), namun tidak dikirim ke siapa pun

#### 2.4 Kelola Jenis Tiket (`/admin/ticket-type`)
- CRUD `ticket_types`: nama, harga (integer), benefit (teks). Dapat diakses admin dan petugas tiket.

---

### 🍽️ MODUL 3 — RESTORAN & KASIR (Role: Kasir / Admin)

> Transaksi F&B berdiri sendiri, tidak terhubung ke sistem tiket maupun akun pembeli.

#### 3.1 Halaman Kasir — Konfirmasi Pesanan (`/admin/restaurant-orders/kasir`)
- Menampilkan pesanan dengan `pay_status = success` **dan** `confirmed = false` (terlama dulu): kode order, nama, nomor meja, catatan, rincian item, total, waktu
- **Polling tiap 5 detik** ke `GET /admin/restaurant-orders/waiting-ids` (mengembalikan daftar ID pesanan menunggu). Jika ada ID baru, daftar lengkap diambil dari `GET /admin/restaurant-orders/unconfirmed`
- **Notifikasi suara** (`/sounds/order.mp3`) yang dapat diaktifkan/dimatikan kasir
- Tombol **Konfirmasi** → `PATCH /admin/restaurant-order/{id}/confirm` (hanya berhasil bila `success` dan belum dikonfirmasi; selain itu HTTP 409)

#### 3.2 Dashboard Restoran (`/admin/restaurant-order`)
Hanya menghitung pesanan `pay_status = success`. Filter periode (Hari Ini / Minggu Ini / Bulan Ini / Semua Waktu) dan filter konfirmasi (Semua / Belum / Sudah).
- Total pendapatan dan jumlah transaksi
- Rekap jumlah item terjual per kategori (makanan, minuman, lainnya)
- Tabel transaksi (10 per halaman) dengan relasi meja & item
- Badge jumlah pesanan belum dikonfirmasi

> ⚠️ "Menu terlaris" (ada di PRD v1.4) **belum ada**. Export/void/edit transaksi tetap di luar scope.

#### 3.3 Input Pesanan Offline oleh Kasir (`/admin/restaurant-order/create`)
- Kasir memilih menu aktif + qty dan catatan; pesanan langsung tersimpan sebagai `payment = offline`, `pay_status = success`, `confirmed = true`, nama `Kasir`
- Halaman ini juga melakukan polling 5 detik untuk badge notifikasi pesanan online

#### 3.4 Manajemen Menu (`/admin/restaurant-menu`)
- CRUD: nama, kategori (`makanan`/`minuman`/`lainnya`), harga, foto (maks. 2 MB; jpg/jpeg/png/webp), toggle `status` tersedia/habis
- Pencarian by nama (awalan), 5 per halaman; foto lama dihapus saat diganti/dihapus

#### 3.5 Manajemen Meja (`/admin/table`)
- CRUD meja: input **nomor meja** (integer ≥ 1, unik). `table_code` dibuat otomatis dengan format **`MEJA-001`** (`MEJA-` + nomor 3 digit) dan ikut berubah saat nomor diedit
- ⚠️ `table_code` saat ini **hanya ditampilkan di admin**, belum dipakai di alur pelanggan manapun; belum ada generator QR maupun fitur regenerate token

#### 3.6 Alur Pemesanan Online
```
Pelanggan buka /restourant
  → isi nama, pilih meja (dropdown), pilih menu + qty, catatan (opsional)
  → POST /restourant : order dibuat (pay_status = pending, payment = online) + snap_token
  → Pelanggan bayar via Midtrans Snap
  → Midtrans kirim webhook (settlement) → pay_status = success
  → Pesanan muncul di halaman kasir (polling ≤ 5 detik) + bunyi notifikasi
  → Kasir cek & tekan Konfirmasi → confirmed = true
  → Makanan diantar ke meja
```
- Kode order: `RST-` + `YmdHis` + 4 karakter acak huruf besar
- Pesanan yang belum `success` (masih `pending`/`failed`) **tidak** tampil di kasir maupun dashboard

---

### 📲 MODUL 4 — BOOKING VIA WHATSAPP
- Tombol "Pesan via WhatsApp" per `service_packages`; pesan (`whatsapp_message`, maks. 255 karakter) dan nomor tujuan (`whatsapp_number`) disimpan **per paket**
- Tidak ada form booking internal, bot, atau API WhatsApp

---

### ⚙️ MODUL 5 — ADMIN DASHBOARD (Role: Admin)

#### 5.1 Dashboard Agregat (`/admin/dashboard`)
Filter periode Hari Ini / Minggu Ini / Bulan Ini / Semua Waktu.
- Total pendapatan = pendapatan tiket + pendapatan restoran (rincian keduanya)
- Total pengunjung (jumlah qty tiket), pembagian tiket **online vs offline** (jumlah & persentase)
- Grafik lalu lintas pengunjung **minggu berjalan** (Senin–Minggu), dihitung dari `scanned_at` (atau `created_at` bila belum ter-scan)
- Definisi tiket "berhasil": online dengan `pay_status = paid`, **atau** offline dengan `status = used`

#### 5.2 Kelola Konten
| Section | Aksi |
|---|---|
| **Layanan** | CRUD `services` (nama, deskripsi, harga, durasi, thumbnail, galeri **maks. 5 foto**). Saat edit dengan foto galeri baru, **seluruh galeri lama diganti** |
| **Paket layanan** | CRUD `service_packages` (judul, harga, benefit, pesan & nomor WA, flag populer) |
| **Blog** | CRUD (nama, thumbnail maks. 2 MB, konten) |
| **Menu & Meja** | CRUD (juga dapat diakses kasir) |
| **Jenis Tiket** | CRUD (juga dapat diakses petugas tiket) |

#### 5.3 Manajemen User Staf (`/admin/user`)
- CRUD akun staf: nama, email (unik), password (min. 8 karakter, di-hash), role (`admin`/`tiket`/`kasir`). Saat edit, password boleh dikosongkan (tidak diubah)
- Menampilkan ringkasan jumlah anggota, kasir, dan petugas tiket

#### 5.4 Konfigurasi Sistem
- ❌ **Belum ada.** Pengaturan umum (nama destinasi, logo, kontak, nomor WA pengelola) belum bisa diubah dari admin; nilai-nilai tersebut masih tertanam di view.

---

## 6. ALUR USER JOURNEY

### 6.1 Customer: Beli Tiket Online (Guest Checkout)
```
Beranda → "Beli Tiket Sekarang" → /checkout/ticket
→ Pilih jenis tiket + jumlah → isi nama, email, HP
→ Bayar (Midtrans Snap)
→ Midtrans webhook settlement → order paid → QR PNG dibuat → email konfirmasi terkirim
→ Tiba di lokasi → tunjukkan QR dari email → petugas scan → masuk ✅
```

### 6.2 Customer: Pesan Makanan
```
Buka /restourant → isi nama, pilih meja, pilih menu + qty
→ Bayar via Midtrans Snap
→ Webhook settlement → kasir mendapat notifikasi (polling)
→ Kasir konfirmasi → makanan diantar ke meja ✅
```

### 6.3 Customer: Booking Layanan
```
/layanan → pilih layanan → pilih paket → "Pesan via WhatsApp"
→ WA terbuka dengan pesan pre-fill → chat dengan pengelola ✅
```

### 6.4 Kasir: Pesanan Offline
```
Kasir buka /admin/restaurant-order/create → pilih menu + qty (+ catatan)
→ Simpan → tercatat langsung lunas (offline) & terkonfirmasi ✅
```

### 6.5 Petugas Tiket: Tiket Offline & Scan
```
Offline : /admin/order-ticket/create → pilih jenis & jumlah → simpan (langsung status used)
Scan    : /admin/order-ticket/scan → scan QR → valid / sudah dipakai / tidak ditemukan
```

---

## 7. TECHNICAL REQUIREMENTS

### 7.1 Tech Stack (as-built)
| Layer | Teknologi |
|---|---|
| **Backend** | PHP ^8.3, **Laravel 13** (`^13.8`, lock v13.12.0) |
| **Frontend** | Blade + Alpine.js 3 + Tailwind CSS v4 (Vite 8, `@tailwindcss/vite`) + AOS (CDN) |
| **Font** | Poppins, Playfair Display, DM Sans |
| **Database** | MySQL (`.env.example`: `DB_CONNECTION=mysql`, database `sendangku`) |
| **Payment Gateway** | Midtrans **Snap** (`midtrans/midtrans-php ^2.6`) untuk tiket **dan** restoran. Sandbox/produksi diatur lewat `MIDTRANS_IS_PRODUCTION` |
| **Notifikasi kasir** | AJAX polling 5 detik + audio |
| **WhatsApp** | Deep link `wa.me` per paket layanan |
| **QR Code** | `simplesoftwareio/simple-qrcode ^4.2` (generate PNG), `html5-qrcode` (scan kamera) |
| **Slug** | `spatie/laravel-sluggable` (Blog, Service) |
| **Maps** | Google Maps Embed (iframe) |
| **Storage** | Disk `public` Laravel; folder: `menu`, `blog`, `service`, `gallery`, `qrcodes` |
| **Queue / Session / Cache** | Driver `database` (default `.env.example`) |
| **Scheduler** | `orders:expire` (hourly), `orders:cleanup` (daily) — perlu cron `schedule:run` |
| **Auth** | Session auth (`Auth::attempt`), middleware alias `role:` (`AuthValidation`) — hanya staf |
| **Mail** | Mailable `OrderConfirmationMail` (markdown). Transport Resend tersedia di `config/mail.php`, default mailer `log` |
| **Testing/Tooling** | Pest 4, Pint (saat ini baru `ExampleTest`) |

### 7.2 Routing Ringkas
| Method | URL | Fungsi |
|---|---|---|
| GET | `/` | Beranda |
| GET | `/layanan`, `/layanan/{slug}` | Daftar & detail layanan |
| GET | `/blog`, `/blog/{slug}` | Daftar & detail blog |
| GET/POST | `/checkout/ticket` | Halaman checkout / buat order + snap token (JSON) |
| GET | `/checkout/ticket/success` | Halaman sukses tiket |
| GET/POST | `/restourant` | Halaman pesan restoran / buat order + snap token (JSON) |
| GET/POST | `/login`, POST `/logout` | Autentikasi staf |
| POST | `/api/midtrans/callback` | Webhook Midtrans (verifikasi signature) |
| — | `/admin/...` | Area staf (lihat matriks hak akses, Section 4.5) |

### 7.3 Database Schema (as-built, dari migrasi)

```sql
-- Akun staf saja (tidak ada customer)
users (
  id, name, email, password,
  role ENUM('admin','tiket','kasir') DEFAULT 'tiket',
  created_at, updated_at   -- + remember_token, email_verified_at (bawaan Laravel)
)

ticket_types (
  id, name, price UNSIGNED INT,
  benefit TEXT NULLABLE,
  created_at, updated_at
)

-- Order tiket (guest checkout)
orders (
  id,
  order_code VARCHAR UNIQUE NULLABLE,        -- TSG-ddmmyy + id 8 digit
  qr_token UUID UNIQUE,                      -- otomatis via model event saat create
  qr_path TEXT NULLABLE,                     -- path PNG QR di disk public
  buyer_name, buyer_phone, buyer_email  VARCHAR NULLABLE,
  total_price UNSIGNED INT DEFAULT 0,
  status ENUM('active','used') DEFAULT 'active',
  pay_status ENUM('pending','paid','failed') DEFAULT 'pending',
  snap_token VARCHAR NULLABLE,
  purchase ENUM('online','offline'),
  scanned_at TIMESTAMP NULLABLE,
  scanned_by FK→users NULLABLE (ON DELETE SET NULL),
  created_at, updated_at
)

order_items (
  id,
  order_id FK→orders (CASCADE),
  ticket_type_id FK→ticket_types NULLABLE (SET NULL),
  qty, price, subtotal  UNSIGNED INT,        -- snapshot harga
  created_at, updated_at
)

services (
  id, slug UNIQUE, name, description TEXT,
  price UNSIGNED INT, duration VARCHAR, thumbnail VARCHAR,
  created_at, updated_at
)

service_galleries (
  id, service_id FK→services (CASCADE), image VARCHAR,
  created_at, updated_at
)

service_packages (
  id, service_id FK→services (CASCADE),
  title, price UNSIGNED INT, benefit TEXT,
  whatsapp_message VARCHAR, whatsapp_number VARCHAR,
  populer BOOLEAN DEFAULT false,
  created_at, updated_at
)

blogs (
  id, name, slug UNIQUE, thumbnail, content TEXT,
  created_at, updated_at
)

restaurant_menus (
  id, status BOOLEAN DEFAULT true,
  category ENUM('makanan','minuman','lainnya'),
  name, thumbnail, price UNSIGNED INT,
  created_at, updated_at
)

tables (
  id, number UNSIGNED INT UNIQUE,
  table_code VARCHAR UNIQUE,                 -- otomatis 'MEJA-001' dst.
  created_at, updated_at
)

-- Header order restoran
restaurant_orders (
  id,
  order_code VARCHAR UNIQUE,                 -- RST-YmdHis + 4 acak
  name VARCHAR,                              -- nama pemesan ('Kasir' utk order offline)
  table_id FK→tables NULLABLE (SET NULL),
  note TEXT NULLABLE,
  total_price UNSIGNED INT,
  snap_token VARCHAR NULLABLE,
  pay_status ENUM('pending','success','failed') DEFAULT 'pending',
  confirmed BOOLEAN DEFAULT false,           -- konfirmasi kasir
  payment ENUM('offline','online') DEFAULT 'online',
  created_at, updated_at,
  INDEX (pay_status, confirmed)
)

-- Baris item (snapshot harga saat order dibuat)
restaurant_order_items (
  id,
  restaurant_order_id FK→restaurant_orders (CASCADE),
  restaurant_menu_id FK→restaurant_menus NULLABLE (SET NULL),
  qty, price, subtotal  UNSIGNED INT,
  created_at, updated_at
)
```

**Tabel infrastruktur Laravel:** `sessions`, `cache`, `jobs` (driver database).

**Tidak ada di schema (di luar scope):** `packages`, `events`, `facilities`.
**Known limitation:** `tables` tidak punya `is_active`; meja yang dihapus membuat `restaurant_orders.table_id` menjadi NULL pada order lama.

### 7.4 Status & Semantik Pembayaran
| Entitas | Kolom | Nilai | Arti |
|---|---|---|---|
| `orders` | `pay_status` | `pending` → `paid` / `failed` | Status pembayaran Midtrans |
| `orders` | `status` | `active` → `used` | Status pemakaian tiket (scan) |
| `restaurant_orders` | `pay_status` | `pending` → `success` / `failed` | Status pembayaran |
| `restaurant_orders` | `confirmed` | `false` → `true` | Sudah dicek/diterima kasir |

### 7.5 QR Code
**Tiket:**
- `qr_token` = UUID, dibuat otomatis saat order dibuat (semua order, termasuk offline)
- Setelah pembayaran online berhasil, sistem membuat gambar PNG 300 px dari `qr_token`, menyimpannya di `storage/app/public/qrcodes/{qr_token}.png` (`qr_path`), lalu menyematkannya di email lewat `asset('storage/...')` — **memerlukan `php artisan storage:link` dan `APP_URL` yang dapat diakses publik**
- Satu order (multi jenis tiket) memakai **satu** `qr_token`; sekali scan berarti seluruh order `used`
- Verifikasi: lihat Modul 2.2

**QR Meja:** ❌ belum diimplementasikan (lihat Section 11.A dan Section 12).

### 7.6 Midtrans Integration (as-built)
```
Semua pembayaran (tiket & restoran):
  → Server membuat order (pay_status = pending) + Snap token
     • order_id Midtrans = order_code
     • expiry Snap = 60 menit
     • item_details dari harga database
  → Pelanggan membayar lewat popup Snap

Webhook  POST /api/midtrans/callback
  → Verifikasi signature SHA-512 (order_id + status_code + gross_amount + server_key); salah → HTTP 403
  → Cari order_code di restaurant_orders dulu, lalu orders; tidak ketemu → HTTP 404
  → transaction_status = settlement  → paid / success
  → expire | cancel | deny | failure → failed (hanya jika masih pending)
  → Idempoten: update bersyarat (pay_status != paid/success)
  → Khusus tiket yang baru berubah ke paid: buat PNG QR → kirim OrderConfirmationMail ke buyer_email
```
- Metode pembayaran yang tersedia ditentukan konfigurasi akun Midtrans; kode tidak membatasi `enabled_payments`
- Order restoran offline tidak melewati Midtrans (dibuat langsung `success` oleh kasir)

### 7.7 Scheduler (`routes/console.php`)
| Command | Jadwal | Fungsi |
|---|---|---|
| `orders:expire` | Tiap jam | Order tiket & restoran `pending` yang berumur **> 25 jam** → `failed` |
| `orders:cleanup` | Harian | Order tiket & restoran `failed` yang `updated_at` > 1 bulan → **dihapus** |

### 7.8 Polling Architecture (Kasir)
```
Halaman Kasir ── setiap 5 detik ──▶ GET /admin/restaurant-orders/waiting-ids
                                      → [id pesanan success & belum dikonfirmasi]
                  ada ID baru? ──▶ GET /admin/restaurant-orders/unconfirmed
                                      → payload lengkap + bunyi notifikasi (jika diaktifkan)
Konfirmasi ─────────────────────▶ PATCH /admin/restaurant-order/{id}/confirm
```
Tanpa cache (query langsung dengan index `(pay_status, confirmed)`).

### 7.9 Business Rules (as-built)
```
TIKET:
✅ Beli online = guest checkout, tanpa akun
✅ Satu order dapat berisi beberapa jenis tiket (order_items)
✅ Harga tiket diambil dari ticket_types saat order dibuat (snapshot di order_items)
✅ Tiket online aktif (active) sampai di-scan; scan pertama → used (sekali pakai)
✅ Tiket offline dibuat petugas: langsung paid + used (dianggap sudah masuk)
✅ Tiket online baru dihitung di dashboard bila pay_status = paid
✅ Email berisi QR dikirim sekali saat pembayaran pertama kali berhasil

RESTORAN:
✅ Pelanggan memilih meja dari dropdown; nama pemesan wajib
✅ Hanya menu berstatus tersedia yang dapat dipesan online
✅ Harga & total dihitung server dari database
✅ Pesanan masuk kasir hanya bila pay_status = success dan confirmed = false
✅ Pesanan offline dari kasir langsung success + confirmed
❌ Tidak ada akun/riwayat per pelanggan; tidak ada PII wajib selain nama pemesan
```

---

## 8. NON-FUNCTIONAL REQUIREMENTS

| Aspek | Requirement | Status di kode |
|---|---|---|
| **Performance** | Halaman public load < 3 detik (LCP) | Belum diukur |
| **Mobile-first** | Responsive di semua device | Layout memakai Tailwind responsif; scan QR via kamera mobile |
| **Security** | HTTPS, CSRF, validasi signature webhook, rate limiting | CSRF ✅, signature webhook ✅, rate limit checkout (5/menit/IP) ✅, **rate limit login ❌** |
| **Scalability** | Handle 500 concurrent user pada peak | Belum diuji; polling kasir 5 detik cukup ringan (query ber-index) |
| **Availability** | Uptime 99.5% | Bergantung infrastruktur hosting |
| **Accessibility** | Kontras & font readable | Belum diaudit |
| **SEO** | Meta tags, Open Graph, sitemap.xml | **Belum ada** (hanya `robots.txt`) |
| **Data Backup** | Backup DB harian | Di luar kode; perlu disiapkan di server |
| **Privacy** | Data pembeli hanya di level order | ✅ (tidak ada profil akun pelanggan) |

---

## 9. STATUS IMPLEMENTASI & ROADMAP

### Phase 1 — MVP Core
- [x] Public website: beranda, layanan, blog, maps (footer)
- [x] Role middleware staf (admin/tiket/kasir), login & redirect per role
- [x] Tiket online: beli (guest checkout), bayar (Snap), generate QR, kirim email *(kode lengkap; pengiriman email nyata bergantung konfigurasi mailer — Section 11.B)*
- [x] Modul tiket: scan QR, dashboard, transaksi offline
- [x] Modul Layanan: CRUD services + galeri + paket, WA deep link per paket
- [x] Manajemen user staf *(tambahan)*

### Phase 2 — Restoran
- [x] Tabel `tables` + `table_code` otomatis per meja
- [~] Halaman pemesanan restoran *(selesai; **QR meja ber-token belum** — meja dipilih dari dropdown)*
- [x] Midtrans Snap untuk order restoran + order offline oleh kasir
- [x] Halaman kasir + polling + notifikasi suara + konfirmasi
- [x] Dashboard restoran (statistik & riwayat transaksi)

### Phase 3 — Admin & Polish
- [x] Dashboard admin agregat (tiket + restoran)
- [x] CRUD blog, jenis tiket
- [x] Scheduler pembersihan order *(tambahan)*
- [ ] Optimasi performa & SEO (sitemap, OG, meta)
- [ ] Testimonial, konfigurasi sistem, menu terlaris
- [ ] Pengujian otomatis (saat ini hanya `ExampleTest`)
- [ ] Evaluasi modul Fasilitas/Paket Wisata/Event

### Pra-Production (lihat Section 11.B)
- [ ] Ganti URL `snap.js` sandbox ke produksi
- [ ] Konfigurasi mailer produksi dan `storage:link`
- [ ] Rate limit login, ganti akun seeder default
- [ ] Rapikan route stub publik

---

## 10. OPEN ITEMS / PERLU DIPUTUSKAN

| # | Item | Status |
|---|---|---|
| 1 | Fasilitas: tetap statis atau jadi CRUD dinamis? | 🟡 Saat ini statis di beranda |
| 2 | Paket Wisata & Event masuk lagi di fase berikutnya? | 🟡 Belum diputuskan |
| 3 | `tables.is_active` — dibutuhkan setelah operasional? | 🟡 Ditunda |
| 4 | **QR meja:** dibangun (URL ber-`table_code`, mis. `/restourant?table=MEJA-005`) atau tetap dropdown? | 🔴 Perlu keputusan (Section 12) |
| 5 | **Ejaan URL `/restourant`** (typo) — ganti ke `/restoran` sebelum QR dicetak/dipublikasikan? | 🔴 Perlu keputusan |
| 6 | Perilaku `table_code`: deterministik `MEJA-###` (sekarang) vs token acak yang bisa di-regenerate? | 🟡 Terkait #4 |
| 7 | Testimonial: hardcode di view, atau ditunda? | 🟡 Belum diputuskan |
| 8 | Nomor WA pengelola global (footer) — dikelola dari konfigurasi sistem? | 🟡 Belum diputuskan |
| 9 | Kategori menu `paket` (dirujuk di dashboard) — dibuat atau dihapus dari kode? | 🟡 Belum diputuskan |

---

## 11. SELISIH PRD v1.4 vs KODE & TEMUAN TEKNIS

### 11.A Ada di PRD v1.4, belum ada di kode
| # | Fitur di PRD v1.4 | Kondisi di kode |
|---|---|---|
| 1 | QR meja berbasis `table_code` (`/menu?table={table_code}`), nomor meja otomatis terisi | **Belum.** Pelanggan memilih meja dari dropdown di `/restourant`. `table_code` hanya tampil di admin; tidak ada generator QR/cetak, tidak ada regenerate |
| 2 | `table_code` random string pendek | Dibuat deterministik `MEJA-` + nomor 3 digit |
| 3 | Midtrans **QRIS dinamis** khusus order meja | Memakai Snap yang sama dengan tiket |
| 4 | Testimonial hardcode di beranda | Tidak ditemukan |
| 5 | Dashboard kasir: menu terlaris | Tidak ada (hanya rekap per kategori) |
| 6 | History tiket: pencarian `order_code`, filter jenis tiket | Hanya filter periode, status, metode |
| 7 | Scan tiket: mode offline | Tidak ada |
| 8 | Tiket offline: input nama pengunjung & metode bayar | Tidak ada di form |
| 9 | Halaman "Makanan" (preview menu) terpisah dari pemesanan | Tidak ada; menu hanya tampil di halaman pesan |
| 10 | Konfigurasi sistem (nama, logo, kontak, WA) | Belum ada |
| 11 | SEO: meta, Open Graph, sitemap.xml | Belum ada |
| 12 | Rate limiting login staf (maks. 5×/menit) | Belum ada (rate limit hanya di checkout tiket & restoran) |
| 13 | Email via **Resend** & queue async | Resend belum terpasang; email terkirim **sinkron** (lihat B-6) |
| 14 | Menu: "admin read-only, edit oleh kasir" | Admin & kasir sama-sama CRUD penuh |

### 11.B Temuan teknis & risiko (urut prioritas)

**🔴 Perlu ditangani sebelum production**
| # | Temuan | Lokasi | Saran |
|---|---|---|---|
| 1 | `snap.js` **di-hardcode ke sandbox** (`app.sandbox.midtrans.com`) di halaman checkout tiket & restoran. Walau `MIDTRANS_IS_PRODUCTION=true`, popup tetap sandbox | `front/checkout-ticket.blade.php`, `front/restourant.blade.php` | Pilih URL snap.js berdasarkan `config('services.midtrans.is_production')` |
| 2 | **Rate limit login tidak ada** (PRD menyebut 5×/menit) | `Admin/UserController@authenticate` | Tambahkan throttle (mis. `RateLimiter` atau middleware `throttle`) |
| 3 | Seeder membuat akun default (`admin@`, `tiket@`, `kasir@example.com`) dengan password **`password`** | `database/seeders/DatabaseSeeder.php` | Jangan dijalankan di production, atau ubah password segera |
| 4 | **Email belum siap produksi:** default `MAIL_MAILER=log`; paket `resend/resend-php` tidak ada di `composer.json` (hanya saran dari framework); `OrderConfirmationMail` tidak `ShouldQueue` sehingga dikirim **sinkron** di dalam webhook (bila SMTP lambat/gagal, webhook ikut lambat/error) | `.env.example`, `Mail/OrderConfirmationMail`, `Webhook/CallbackMidtransController` | Pasang paket mailer yang dipilih, set kredensial, pertimbangkan `ShouldQueue` |
| 5 | Gambar QR di email memakai `asset('storage/...')` → butuh `php artisan storage:link` dan `APP_URL` publik; bila tidak, QR tidak tampil di email | `Mail/OrderConfirmationMail` | Pastikan di deployment; pertimbangkan lampiran inline |
| 6 | Verifikasi scan **tidak memeriksa `pay_status`**. Aman selama QR hanya dikirim setelah paid, tapi sebaiknya ditegakkan di server | `Admin/OrderController@verify` | Tolak token yang `pay_status != paid` |

**🟡 Sebaiknya dirapikan**
| # | Temuan | Lokasi | Saran |
|---|---|---|---|
| 7 | Route publik **tanpa autentikasi** untuk `Route::resource('/restaurant-menu')` dan `Route::resource('/restaurant-order')` (controller kosong/stub; `restaurant-order` bahkan memetakan ke controller pemesanan asli sehingga ada endpoint duplikat) | `routes/web.php` (bagian bawah) | Hapus kedua resource publik tersebut |
| 8 | Order offline kasir **meng-hardcode `table_id = 1`** (gagal jika meja ber-ID 1 tidak ada) dan **tidak mengecek status menu** (menu "habis" masih bisa dipesan lewat endpoint ini) | `Admin/RestaurantOrderController@store` | Beri opsi meja (atau null) dan filter `status = true` seperti alur online |
| 9 | Dashboard restoran merujuk kategori **`paket`** yang tidak ada di enum (`makanan/minuman/lainnya`) → hitungan selalu 0 | `Admin/RestaurantOrderController@index` | Tambah kategori atau hapus hitungan |
| 10 | Webhook memanggil `Cache::forget('kasir:waiting-ids')`, tetapi tidak ada kode yang menulis cache itu (polling tanpa cache) | `Webhook/CallbackMidtransController` | Hapus baris sisa |
| 11 | Webhook belum membandingkan `gross_amount` dengan `total_price` order | `Webhook/CallbackMidtransController` | Tambah pengecekan sebagai lapisan ekstra |
| 12 | Validasi qty tiket hanya `required` + `min:0` (tanpa aturan `integer`), dan order dengan total qty 0 lolos validasi (item berqty 0 dilewati) | `Requests/Order/StoreOrderRequest`, `Services/UserOrderService` | Wajibkan integer dan minimal 1 tiket total |
| 13 | `verify` memakai `firstOrFail()` lalu mengecek `! $order` (cabang tidak akan tercapai); token tak ada → respons 404 standar Laravel, bukan JSON pesan khusus | `Admin/OrderController@verify` | Gunakan `first()` dan kembalikan JSON 404 |
| 14 | Masa berlaku Snap **60 menit**, sedangkan scheduler baru menandai `failed` setelah **25 jam**; antara itu status DB tetap `pending` bila webhook `expire` tidak datang | `Services/*`, `Console/Commands/ExpireOrders` | Samakan atau pastikan webhook expire diterima |
| 15 | `spatie/laravel-translatable` terpasang tetapi tidak dipakai | `composer.json` | Hapus dependensi atau manfaatkan |
| 16 | Pengujian otomatis hanya `ExampleTest`; tidak ada tes untuk alur pembayaran/webhook | `tests/` | Tambah tes alur kritis (webhook, konfirmasi, scan) |
| 17 | Sisa konfigurasi `validateCsrfTokens(except: ['test-endpoint'])` di bootstrap | `bootstrap/app.php` | Hapus |
| 18 | Nomor WA footer masih `628XXXXXXXXXX` | `components/footer.blade.php` | Isi nomor sebenarnya |
| 19 | README masih bawaan Laravel | `README.md` | Ganti dengan petunjuk setup (env Midtrans, `storage:link`, queue, cron) |

> Catatan: PRD v1.4 menyebut `whatsapp_number` bertipe INT dan kolom harga layanan `start_from`; keduanya sudah dikoreksi di schema v1.5 sesuai migrasi (string dan `price`).

---

## 12. KEPUTUSAN PRODUK YANG PERLU ANDA KONFIRMASI

Bagian ini bukan sinkronisasi, melainkan tempat PRD dan kode **berbeda arah**. Tiap butir perlu diputuskan: ubah kode mengikuti PRD, atau ubah PRD mengikuti kode.

1. **QR meja vs dropdown meja.** PRD v1.4 mendesain QR ber-token (`table_code`) agar pelanggan tidak bisa mengisi nomor meja sembarangan. Kode saat ini memakai dropdown, sehingga siapa pun yang membuka `/restourant` dapat memilih meja mana pun. v1.5 mendokumentasikan kondisi **dropdown**; jika QR meja tetap diinginkan, alur dan `table_code` (termasuk apakah acak/regenerate) perlu dibangun.
2. **URL `/restourant`.** Ejaan URL dan nama kelas (`RestourantService`) memakai "restourant". Jika URL ini akan tercetak di QR, ganti sebelum dicetak.
3. **QRIS dinamis vs Snap.** v1.5 mencatat Snap (semua metode yang aktif di akun Midtrans). Jika ingin pembayaran meja hanya QRIS, perlu pembatasan `enabled_payments` atau integrasi Core API.
4. **Hak akses menu/meja & jenis tiket.** v1.5 mengikuti kode (kasir boleh CRUD menu & meja; petugas tiket boleh CRUD jenis tiket). Konfirmasi bahwa ini memang diinginkan.
5. **Tiket offline langsung `used`.** v1.5 mencatat perilaku kode (langsung dianggap masuk). Konfirmasi bahwa tiket offline memang tidak perlu discan.

---

*Dokumen ini bersifat living document dan diperbarui seiring perkembangan proyek.*

---

**Prepared by:** Reza Web Developer
**Versi:** 1.5
**Next Step:** Tangani daftar Pra-Production (Section 9 & 11.B) → putuskan Section 12 → lanjutkan Phase 3 (SEO, testimonial, konfigurasi sistem, pengujian otomatis)
# 📋 Product Requirements Document (PRD)
## Wisata Sendang Kun Gerit (Sendangku) — Platform Terpadu

---

**Versi:** 1.4
**Tanggal:** Juli 2026
**Status:** Draft — Siap Development
**Target Audience:** Wisatawan Lokal Indonesia

---

## CHANGELOG

### v1.4 — Finalisasi skema meja & modul restoran
| Perubahan | Detail |
|---|---|
| ✅ Resolve | Naming tabel restoran dibetulkan: `restaurant_orders` = header transaksi, `restaurant_orders_items` = baris item per menu |
| ➕ Tambah | Tabel `tables` (nomor meja + `table_code` unik) — menggantikan `table_number` polos. Validasi QR meja sekarang berbasis token, bukan angka bebas |
| ➕ Tambah | Snapshot harga (`price`, `subtotal`) di `restaurant_orders_items` — riwayat transaksi tidak berubah walau harga menu di-update di kemudian hari |
| ➕ Tambah | `order_code` unik di `restaurant_orders` — nomor referensi yang aman ditunjukkan ke customer/dicetak |
| ➕ Tambah | `created_at`/`updated_at` di `restaurant_orders` & `tables` — dibutuhkan untuk filter tanggal di dashboard kasir (PRD 3.1) |
| 🔧 Fix | Typo enum status `'faild'` → `'failed'` |
| ⚠️ Known limitation | Tabel `tables` **tanpa** kolom `is_active` — nonaktifkan meja rusak/renovasi ditangani di level aplikasi (jangan tampilkan di UI pemilihan meja / cabut akses `table_code`-nya), bukan flag database. Dicatat untuk revisit jika kebutuhan operasional berkembang |

### v1.3 — Sinkronisasi PRD dengan DB Schema aktual
| Perubahan | Detail |
|---|---|
| ❌ Hapus | Role `user` (customer login) — sistem tiket sekarang **guest checkout**, tanpa akun/login |
| ❌ Hapus | Modul 6 — User Account ("Tiket Saya", riwayat tiket per akun) — dihapus total dari scope |
| ❌ Hapus | `visit_date` dan expiry tiket — status tiket hanya `active` / `used` |
| ❌ Hapus | Modul Paket Wisata, Event, Fasilitas — di-drop dari scope MVP (belum ada tabel) |
| 🔄 Update | Tiket: dari `type ENUM('terusan','normal')` hardcode → tabel `ticket_types` dinamis (admin bisa CRUD jenis tiket) |
| 🔄 Update | Tiket: 1 order bisa berisi banyak jenis tiket sekaligus, via `order_items` |
| 🔄 Update | Struktur `orders` — pakai `buyer_name`, `buyer_phone`, `buyer_email` (bukan FK ke users) |
| 🔄 Update | Modul Restoran/F&B — struktur tabel dirombak: `restaurant_menus`, `restaurant_orders_items` (header), `restaurant_orders` (baris item) |
| ⚠️ Pending | Validasi nomor meja (`table_number`) & QR meja — **belum final, akan direvisi terpisah**. Untuk saat ini `table_number` disimpan sebagai integer polos tanpa tabel `tables`/`qr_token` |
| ➕ Tambah | Modul Layanan (Services) dengan struktur DB penuh: `services`, `service_galleries`, `service_packages` — masing-masing paket punya WA deep link sendiri |
| 🔄 Update | Blog disederhanakan — tanpa kategori/tag, sesuai schema aktual |
| 🔄 Update | Database schema — Section 7.2 ditulis ulang mengikuti DBML aktual |
| 🔄 Update | Tech Stack — Laravel 12 (dikonfirmasi), penyesuaian auth (tidak ada role `user`) |

### v1.2 — Finalisasi keputusan desain
| Perubahan | Detail |
|---|---|
| ❌ Hapus | Rating & review dinamis dari user — diganti testimonial hardcode |
| ❌ Hapus | CFD (Customer Facing Display) — dihapus karena keterbatasan resource |
| ❌ Hapus | `visit_date` dari tiket — harga selalu sama, tidak terikat tanggal |
| 🔄 Update | Flow F&B QR meja — bayar langsung via Midtrans QRIS dinamis |
| 🔄 Update | KPI — hapus target rating kepuasan |
| 🔄 Update | Database schema — tickets, orders |
| 🔄 Update | Tech Stack — Laravel 12 (bukan 13), klarifikasi Midtrans QRIS |
| 🔄 Update | Out of Scope — tambah: rating dinamis, CFD, booking tracking |
| 🔄 Update | Open Questions — hapus Q6 & Q8 (tidak relevan tanpa visit_date) |
| 🔧 Fix | Syntax error markdown di Section 7.5 |

### v1.1 — Tambah Role User, aturan scope akun
| Perubahan | Detail |
|---|---|
| ➕ Tambah | Modul 6 — User Account (history tiket, lihat QR) |
| 🔄 Update | Halaman Tiket Online — wajib login untuk beli tiket |
| 🔄 Update | F&B (QR meja & kasir) — tidak perlu login, tidak terikat ke akun user |
| 🔄 Update | Database entities — users, tickets, reviews |
| 🔄 Update | Roles & Persona — pisahkan Guest vs User Terdaftar |

---

## 1. RINGKASAN EKSEKUTIF

Platform website wisata destinasi ini dirancang sebagai sistem terpadu yang mengelola seluruh touchpoint pengunjung — mulai dari penemuan informasi, pembelian tiket online (tanpa perlu bikin akun), pemesanan makanan di lokasi, hingga booking layanan via WhatsApp. Sistem ini dilengkapi dengan back-office multi-role untuk operasional harian: Admin, Kasir, dan Petugas Tiket.

**Tagline:** *"Satu platform, pengalaman wisata yang lengkap."*

> **Catatan v1.3:** Sistem tidak lagi memiliki konsep akun pelanggan (customer login). Semua transaksi tiket bersifat **guest checkout** — bukti tiket & QR code dikirim langsung ke email pembeli, tanpa perlu daftar/login.

---

## 2. TUJUAN & SUCCESS METRICS

### Tujuan Bisnis
- Meningkatkan konversi pengunjung website menjadi pembelian tiket online
- Mendigitalisasi seluruh transaksi untuk akurasi laporan keuangan
- Mempercepat pelayanan di lokasi (tiket, restoran, booking layanan)
- Membangun awareness destinasi via konten blog & informasi lengkap

### Key Metrics (KPI)
| Metrik | Target (6 bulan) |
|---|---|
| Konversi tiket online | ≥ 30% dari total pengunjung |
| Rata-rata waktu check-in (QR scan) | < 10 detik |
| Order F&B via QR meja per hari | ≥ 50 transaksi |
| Uptime sistem | ≥ 99.5% |

> Target "Akun user terdaftar ≥ 500 akun" **dihapus** — tidak relevan lagi karena tidak ada sistem akun pelanggan.

---

## 3. RUANG LINGKUP SISTEM

Sistem terdiri dari **4 modul utama**:

```
┌──────────────────────────────────────────────────────────────────┐
│                     WEBSITE WISATA PLATFORM                      │
├───────────────┬──────────────┬──────────────┬────────────────────┤
│  PUBLIC WEB   │    TIKET     │   RESTORAN   │  BOOKING LAYANAN   │
│  (Guest Only) │   MODULE     │  / KASIR     │  & PAKET (WA)      │
├───────────────┴──────────────┴──────────────┴────────────────────┤
│                       ADMIN DASHBOARD                            │
└──────────────────────────────────────────────────────────────────┘
```

> **Catatan v1.3:** Modul "User Account" (sebelumnya Modul 6) dihapus total. Modul "Paket Wisata / Event / Fasilitas" sebagai modul konten CRUD di-drop dari scope MVP — halaman publiknya bisa tetap ada sebagai halaman statis/informasi, tapi tidak ada manajemen data terstruktur untuk itu di fase ini.

---

## 4. USER ROLES & PERSONA

### 4.1 Guest / Pengunjung (Semua Pengguna Publik)
- **Siapa:** Siapa pun yang membuka website — tidak ada perbedaan Guest vs User Terdaftar lagi
- **Bisa akses:** Seluruh halaman informasi publik (fasilitas, layanan, blog, maps, menu), beli tiket online (guest checkout), scan QR meja untuk pesan makanan, booking layanan via WhatsApp
- **Tidak perlu:** Registrasi atau login akun apa pun

### 4.2 Petugas Tiket *(Role: `tiket`)*
- **Siapa:** Staff di pintu masuk / loket
- **Kebutuhan:** Verifikasi tiket cepat, input transaksi offline, lihat rekap harian
- **Pain Point:** Tiket palsu, antrian panjang, pencatatan manual

### 4.3 Kasir Restoran *(Role: `kasir`)*
- **Siapa:** Staff restoran / food court di area wisata
- **Kebutuhan:** Kelola menu, proses order dari meja, konfirmasi order masuk
- **Pain Point:** Salah order, antrian order menumpuk, perhitungan manual

### 4.4 Admin *(Role: `admin`)*
- **Siapa:** Pengelola destinasi wisata / manajer operasional
- **Kebutuhan:** Pantau semua aktivitas, kelola konten, lihat laporan bisnis
- **Pain Point:** Data tersebar, tidak ada visibilitas real-time

> **Catatan v1.3:** Role `user` dihapus dari tabel `users`. Tabel `users` sekarang hanya berisi akun internal staf: `admin`, `tiket`, `kasir`.

---

## 5. MODUL & FITUR DETAIL

---

### 📱 MODUL 1 — PUBLIC WEBSITE (Guest)

#### 1.1 Halaman Utama / Landing Page
- Hero section dengan CTA "Beli Tiket Sekarang" & "Lihat Layanan"
- Ringkasan fasilitas unggulan (icon + deskripsi singkat)
- **Testimonial hardcoded** (diisi & dikelola langsung oleh developer / admin via config)
- Galeri foto/video destinasi

#### 1.2 Halaman Fasilitas
- Grid/list semua fasilitas (wahana, kolam renang, area foto, dll)
- Foto, deskripsi, jam operasional

> **Catatan:** Belum ada tabel `facilities` di database saat ini — halaman ini bisa dibangun sebagai konten statis untuk MVP, atau menyusul di fase berikutnya jika dibutuhkan pengelolaan dinamis.

#### 1.3 Halaman Layanan (Services)
- Katalog layanan (mis. spa, fotografi, sewa wahana, pemandu wisata, dll), diambil dari tabel `services`
- Setiap layanan punya galeri foto (`service_galleries`) dan paket harga (`service_packages`)
- Detail per paket: judul, harga, benefit/inklusi, badge "Populer" (opsional)
- Tombol **"Pesan via WhatsApp"** per paket — deep link WA dengan pesan otomatis dari `whatsapp_message` & `whatsapp_number` milik paket tersebut

#### 1.4 Halaman Tiket Online *(Guest Checkout — Tanpa Login)*
- Tidak ada pengecekan login. Siapa pun bisa langsung beli tiket.
- Pilih jenis tiket dari daftar dinamis (`ticket_types` — misalnya Terusan, Normal, atau jenis lain yang ditambahkan admin)
- Bisa memilih lebih dari satu jenis tiket dalam satu transaksi (mis. 2 Terusan + 1 Normal)
- Harga selalu tetap (tidak ada variasi weekday/weekend, tidak ada `visit_date`)
- Tiket berlaku hingga di-scan — tidak terikat tanggal kunjungan spesifik
- Isi data pembeli: nama, email, no. HP (`buyer_name`, `buyer_email`, `buyer_phone`)
- Ringkasan harga
- Checkout & pembayaran via **Midtrans SNAP** (transfer bank, QRIS, e-wallet)
- Setelah bayar: QR Code dikirim otomatis via email (Resend) ke `buyer_email` — **tidak disimpan ke akun mana pun**, karena tidak ada akun

#### 1.5 Halaman Layanan Tambahan / Booking WA Lainnya
- Sub-bagian dari halaman Layanan, mengikuti struktur `service_packages` per layanan
- Booking langsung via WhatsApp dengan pesan pre-fill per paket

#### 1.6 Halaman Makanan (Menu Restoran)
- Preview katalog menu makanan & minuman dari `restaurant_menus` (informasi saja)
- Harga & foto menu, status tersedia/habis (`status`)
- *Pemesanan aktual via scan QR di meja*

#### 1.7 Blog & Artikel
- Artikel wisata & informasi destinasi, diambil dari tabel `blogs`
- Struktur disederhanakan: nama, slug, thumbnail, content — **tanpa kategori/tag** untuk saat ini

#### 1.8 Integrasi Maps
- Embed Google Maps lokasi destinasi
- Petunjuk arah (Get Directions)

> **Dihapus dari scope MVP:** Halaman Paket Wisata dan Halaman Event sebagai modul CRUD terkelola — belum ada tabel `packages` maupun `events` di database. Bisa ditambahkan kembali sebagai modul terpisah jika dibutuhkan di fase berikutnya.

---

### 🎟️ MODUL 2 — TIKET (Role: Petugas Tiket)

#### 2.1 Dashboard Tiket
- Total pendapatan hari ini / minggu ini / bulan ini (chart)
- Total pengunjung masuk hari ini / minggu ini / bulan ini
- Breakdown per jenis tiket (dinamis, mengikuti `ticket_types`)

#### 2.2 Scan & Verifikasi QR
- Interface scan QR via kamera device (mobile-friendly)
- Validasi tiket berdasarkan `orders.qr_token`:
  - ✅ **Valid (`active`)** — tampil info lengkap, konfirmasi scan → set `status = 'used'`
  - ⚠️ **Sudah Digunakan (`used`)** — tampil alert + info kapan di-scan (`scanned_at`, `scanned_by`)
  - ❌ **Tidak Ditemukan** — alert QR tidak valid (token tidak ada di database)
- Tampil info tiket: nama pembeli (`buyer_name`), rincian jenis & jumlah tiket dari `order_items`
- Log waktu scan otomatis (`scanned_at`, `scanned_by`)
- Jika koneksi mati: bisa foto dulu, scan ulang saat koneksi kembali

> **Catatan v1.3:** Status tiket hanya dua kondisi tersimpan di database: `active` dan `used`. Kondisi "tidak ditemukan" adalah hasil pencarian (token tidak match), bukan nilai status yang disimpan.

#### 2.3 History Transaksi
- Tabel semua transaksi tiket (online + offline), sumber dari `orders` + `order_items`
- Pencarian by `order_code`
- Filter: tanggal, jenis tiket, status

#### 2.4 Tambah Transaksi Manual (Offline)
- Form input manual untuk pembayaran tunai di lokasi
- Input: nama pengunjung, jenis tiket (satu atau lebih dari `ticket_types`), jumlah, metode bayar
- Tiket offline (`purchase = 'offline'`) tidak wajib generate `qr_token` — petugas bisa langsung tandai masuk secara manual
- *Catatan: Tidak ada relasi ke akun user mana pun, karena tidak ada sistem akun*

---

### 🍽️ MODUL 3 — RESTORAN & KASIR (Role: Kasir)

> **Penting:** Seluruh transaksi F&B berdiri sendiri, tidak terhubung ke sistem tiket maupun identitas pembeli manapun.

#### 3.1 Dashboard Kasir
- Total pendapatan hari ini (update via polling)
- Jumlah transaksi hari ini
- Menu terlaris hari ini
- Daftar order masuk berstatus `pending` yang perlu dikonfirmasi

#### 3.2 Manajemen Menu
- CRUD `restaurant_menus`: nama, foto (thumbnail), harga
- Toggle `status` (Tersedia/Habis) — sync realtime ke halaman order pelanggan

#### 3.3 Order via QR Meja

> **Customer tidak perlu login.** QR meja mengarahkan ke halaman menu dengan nomor meja terisi otomatis dari parameter URL.

**Flow:**
```
Customer scan QR di meja
  → Redirect ke halaman menu (no login required)
  → Nomor meja (table_number) terisi otomatis dari parameter URL
  → Pilih menu + kuantitas
  → Lihat ringkasan order + total harga (restaurant_orders_items.total_price)
  → Bayar via Midtrans QRIS (online) atau tunai di kasir (offline)
  → Pembayaran sukses → status 'success' → notifikasi masuk ke dashboard kasir (polling)
  → Kasir konfirmasi
  → Makanan diantar ke meja
```

- Setiap order tersimpan sebagai satu baris `restaurant_orders` (header: kode order, meja, total, status, metode bayar)
- Detail item per order tersimpan di `restaurant_orders_items` (baris per menu: qty, harga snapshot, subtotal)
- Status order: `pending` → `success` / `failed`
- Metode pembayaran: `offline` (bayar di kasir) atau `online` (Midtrans QRIS)
- Setiap meja punya `table_code` unik (tabel `tables`) — URL QR meja memakai token ini, bukan nomor meja polos: `https://domain.com/menu?table={table_code}`
- Nomor meja (`number`) tetap dipakai untuk tampilan internal staf (mis. "Meja 12"), terpisah dari `table_code` yang jadi token keamanan URL

> **Known limitation:** Tabel `tables` belum punya kolom `is_active`. Untuk menonaktifkan meja yang rusak/direnovasi, tim operasional perlu menyembunyikannya dari UI pemilihan meja secara manual atau mencabut akses `table_code`-nya. Ini dicatat sebagai keterbatasan yang bisa direvisit jika kebutuhan berkembang, bukan blocker untuk MVP.

#### 3.4 History Transaksi Kasir
- Tabel semua transaksi order (`restaurant_orders_items`)
- Filter: tanggal, status
- Aksi: **Detail**

> Fitur export PDF/Excel dan void/edit transaksi F&B dipertimbangkan untuk fase berikutnya, menyesuaikan kebutuhan operasional setelah MVP berjalan.

---

### 📲 MODUL 4 — BOOKING VIA WHATSAPP

> Booking layanan (`service_packages`) dilakukan langsung via WhatsApp ke nomor pengelola. Tidak ada form booking internal di sistem.

#### 4.1 Booking Layanan
- Tombol "Pesan via WhatsApp" di setiap paket layanan (`service_packages`)
- Deep link WA dengan pesan pre-fill dari kolom `whatsapp_message`, dikirim ke `whatsapp_number` milik paket tersebut

---

### ⚙️ MODUL 5 — ADMIN DASHBOARD (Role: Admin)

#### 5.1 Dashboard Utama Admin
- **Ringkasan finansial:** Total pendapatan hari ini (tiket + kasir)
- **Statistik pengunjung:** Total masuk hari ini, trend mingguan/bulanan
- **Grafik:** Revenue periode terakhir, breakdown per sumber (tiket / F&B)
- **Top metrics:** Menu terlaris

#### 5.2 Kelola Konten Website
| Section | Aksi |
|---|---|
| **Layanan** | CRUD `services`, `service_galleries`, `service_packages` |
| **Blog** | CRUD (nama, slug, thumbnail, content) |
| **Menu Makanan** | Read + monitoring (edit diserahkan ke kasir) |
| **Jenis Tiket** | CRUD `ticket_types` (nama, harga) |

> Kelola Fasilitas, Paket Wisata, dan Event **tidak masuk scope MVP** — belum ada tabel database untuk modul ini.

#### 5.3 Manajemen Tiket
- Lihat semua transaksi tiket — create tiket offline
- Set harga per jenis tiket (`ticket_types`)

#### 5.4 Konfigurasi Sistem
- Pengaturan umum (nama destinasi, logo, kontak, nomor WA pengelola)

> Modul "Manajemen User" (akun pelanggan terdaftar) **dihapus** — tidak ada lagi sistem akun customer.
>
> Modul "Konfigurasi QR meja" **ditunda** hingga struktur tabel `tables`/`qr_token` direvisi dan difinalisasi.

---

## 6. ALUR USER JOURNEY

### 6.1 Customer: Beli Tiket Online (Guest Checkout)
```
Landing Page → Klik "Beli Tiket"
→ Pilih jenis tiket + jumlah (bisa lebih dari satu jenis) → Isi data pembeli (nama, email, HP)
→ Checkout → Bayar (Midtrans SNAP)
→ QR dikirim langsung via email ke buyer_email
→ Tiba di lokasi → Tunjukkan QR dari email → Scan oleh petugas → Masuk ✅
```

### 6.2 Customer: Pesan Makanan di Meja
```
Duduk di meja → Scan QR meja
→ Redirect ke halaman menu (nomor meja otomatis terisi)
→ Pilih menu + kuantitas
→ Lihat ringkasan → Bayar via QRIS (Midtrans) atau tunai
→ Pembayaran sukses → Kasir terima notifikasi
→ Kasir konfirmasi → Makanan diantar ke meja ✅
```

### 6.3 Customer: Booking Layanan
```
Halaman Layanan → Pilih paket
→ Klik "Pesan via WhatsApp"
→ Redirect ke WA dengan pesan pre-fill → Chat dengan pengelola ✅
```

---

## 7. TECHNICAL REQUIREMENTS

### 7.1 Tech Stack
| Layer | Teknologi |
|---|---|
| **Backend** | Laravel 12 |
| **Frontend** | Blade + Alpine.js + Tailwind CSS v4 + AOS |
| **Database** | MySQL 8 |
| **Payment Gateway** | Midtrans SNAP (tiket online) + Midtrans QRIS dinamis (F&B meja) |
| **Realtime / Polling** | AJAX polling (kasir dashboard) |
| **WhatsApp** | WA Business (deep link + nomor pengelola per paket) |
| **QR Code** | `simplesoftwareio/simple-qrcode` |
| **Maps** | Google Maps Embed (iframe) |
| **Storage** | Laravel Storage + S3 / local disk |
| **Queue** | Laravel Queue (database driver) untuk kirim email async |
| **Auth** | Manual, role-based middleware (hanya untuk staf: admin/tiket/kasir — tidak ada auth customer) |
| **Mail** | Resend |

### 7.2 Database Entities Utama

> Schema berikut mengikuti DBML aktual yang sudah diimplementasikan. Bagian bertanda ⚠️ masih pending revisi.

```sql
-- Akun internal staf saja (TIDAK ADA role 'user'/customer)
users (
  id, name, email, password,
  role ENUM('admin','tiket','kasir'),
  created_at, updated_at
)

-- Jenis tiket dinamis (dulu hardcode terusan/normal)
ticket_types (
  id, name, price
)

-- Order tiket (guest checkout, tidak terhubung ke akun mana pun)
orders (
  id,
  order_code VARCHAR UNIQUE,
  qr_token UUID UNIQUE,

  buyer_name VARCHAR,
  buyer_phone VARCHAR,
  buyer_email VARCHAR,

  total_price INT,

  status ENUM('active','used') DEFAULT 'active',   -- disederhanakan, tanpa expiry
  purchase ENUM('online','offline'),

  scanned_at TIMESTAMP NULLABLE,
  scanned_by FK→users NULLABLE,                     -- id petugas yang scan

  created_at, updated_at
)

-- Rincian jenis & jumlah tiket per order (mendukung multi jenis tiket dalam 1 order)
order_items (
  id,
  order_id FK→orders,
  ticket_type_id FK→ticket_types,
  qty INT,
  price INT,
  subtotal INT
)

-- Layanan (spa, fotografi, sewa wahana, dll)
services (
  id, slug UNIQUE, name, description,
  start_from INT, duration VARCHAR,
  thumbnail VARCHAR,
  created_at, updated_at
)

service_galleries (
  id, service_id FK→services, image,
  created_at, updated_at
)

service_packages (
  id, service_id FK→services,
  title, price, benefit TEXT,
  whatsapp_message VARCHAR, whatsapp_number INT,
  populer BOOLEAN DEFAULT false,
  created_at, updated_at
)

-- Blog (disederhanakan, tanpa kategori/tag)
blogs (
  id, name, slug UNIQUE,
  thumbnail, content TEXT,
  created_at, updated_at
)

-- Restoran — tidak terhubung ke user/akun manapun
restaurant_menus (
  id, status BOOL DEFAULT true,
  name, thumbnail, price,
  created_at, updated_at
)

-- Nomor meja + token QR unik per meja
tables (
  id, number INT UNIQUE,
  table_code VARCHAR UNIQUE,
  created_at, updated_at
)

-- Header order restoran (per transaksi/meja)
restaurant_orders (
  id,
  order_code VARCHAR UNIQUE,
  tables_id FK→tables,
  total_price INT,
  status ENUM('pending','success','failed') DEFAULT 'pending',
  payment ENUM('offline','online') DEFAULT 'online',
  created_at, updated_at
)

-- Baris item per order restoran (snapshot harga saat order dibuat)
restaurant_orders_items (
  id,
  restaurant_orders_id FK→restaurant_orders,
  restaurant_menus_id FK→restaurant_menus,
  qty INT,
  price INT,          -- harga satuan menu saat order dibuat (snapshot)
  subtotal INT         -- qty * price
)
```

**⚠️ Belum ada di schema saat ini (di luar scope MVP untuk sekarang):**
- `packages` (Paket Wisata)
- `events` (Event)
- `facilities` (Fasilitas) — jika butuh CRUD dinamis, bukan sekadar halaman statis

**Known limitation:** tabel `tables` tidak punya kolom `is_active`. Menonaktifkan meja (rusak/renovasi) dilakukan di level aplikasi, bukan flag database.

### 7.3 QR Code Specification

**Tiket Online & Offline (unified):**
- Format: UUID (`qr_token`), unik per order
- Validasi: cek `status` di tabel `orders` → `active` = boleh masuk, `used` = alert sudah dipakai, tidak ditemukan = token tidak match
- One-time use per order: set `status = 'used'` + `scanned_at` + `scanned_by` saat scan pertama
- Order dengan banyak jenis tiket (dari `order_items`) tetap menggunakan **satu `qr_token`** — validasi qty dilakukan di level tampilan/counter internal, bukan re-generate QR per tiket individual
- Tiket offline: `qr_token` boleh null jika petugas memilih tandai masuk manual tanpa generate QR; `order_code` tetap ada untuk pencatatan

**QR Meja:**
- Format URL: `https://domain.com/menu?table={table_code}`
- `table_code` unik per meja (tabel `tables`), digenerate sebagai random string pendek (bukan UUID) — cukup collision-resistant untuk skala jumlah meja venue, dan menghasilkan QR code yang lebih ringkas/mudah discan dibanding UUID
- Regenerate `table_code` dari admin jika token dicurigai bocor/disalahgunakan
- Nomor meja (`number`) terpisah dari `table_code` — dipakai untuk keperluan display internal staf, tidak pernah diekspos di URL publik

### 7.4 Midtrans Integration

```
Tiket Online:
  → Midtrans SNAP (semua metode: transfer bank, QRIS, e-wallet)
  → Webhook callback → update orders.status = 'active' + send email berisi QR ke buyer_email

Order QR Meja (payment = 'online'):
  → Midtrans QRIS Dinamis
  → Webhook callback → update restaurant_orders_items.status = 'success' + trigger polling kasir

Order QR Meja (payment = 'offline'):
  → Bayar langsung di kasir → kasir update status manual menjadi 'success'
```

### 7.5 Polling Architecture (Kasir)

```
Kasir Dashboard ──── polling GET /api/restaurant-orders/pending (3–5 detik)
                      → menampilkan order berstatus 'pending' / 'success' yang belum dikonfirmasi
```

### 7.6 WhatsApp Integration

- Menggunakan deep link WA: `https://wa.me/{whatsapp_number}?text={whatsapp_message_encoded}`
- Template pesan disimpan **per paket layanan** di `service_packages.whatsapp_message` beserta `whatsapp_number` tujuan (bisa diedit admin per paket, bukan global)
- Tidak ada bot/API — semua komunikasi manual oleh pengelola

### 7.7 Business Rules

```
TIKET:
✅ Beli tiket online → guest checkout, TANPA login/akun
✅ Tiket aktif hingga di-scan (tidak ada expiry date)
✅ QR tiket dikirim ke email pembeli saat checkout, tidak tersimpan di sistem akun mana pun
✅ Satu order bisa berisi kombinasi beberapa jenis tiket (order_items)
✅ Tiket offline tidak wajib generate QR, ditandai manual oleh petugas
✅ Status tiket hanya dua kondisi: active / used

F&B:
✅ Scan QR meja → redirect ke menu, meja teridentifikasi via table_code (token unik), bukan angka polos
✅ Pembayaran F&B: online (Midtrans QRIS) atau offline (bayar di kasir)
❌ Transaksi F&B tidak masuk ke history akun manapun (tidak ada akun customer)
❌ Tidak ada identitas pembeli wajib di transaksi F&B
```

---

## 8. NON-FUNCTIONAL REQUIREMENTS

| Aspek | Requirement |
|---|---|
| **Performance** | Halaman public load < 3 detik (LCP) |
| **Mobile-first** | Responsive di semua device, QR tiket & QRIS optimal di mobile |
| **Security** | HTTPS, CSRF protection, rate limiting login staf (max 5x/menit), validasi Midtrans webhook signature |
| **Scalability** | Handle 500 concurrent user pada peak season |
| **Availability** | Uptime 99.5%, maintenance window dini hari |
| **Accessibility** | Kontras warna memadai, font size readable |
| **SEO** | Meta tags, Open Graph, sitemap.xml untuk halaman public |
| **Data Backup** | Backup database harian otomatis |
| **Privacy** | Data pembeli tiket (nama/email/HP) hanya disimpan di level order — tidak ada profil akun permanen. Transaksi F&B anonim, tidak menyimpan PII pembeli |

---

## 9. MILESTONE & ROADMAP

### Phase 1 — MVP Core (Estimasi: 6–8 minggu)
- [ ] Public website: landing page, layanan, blog, maps
- [ ] Role middleware untuk staf (admin/tiket/kasir) — tanpa auth customer
- [ ] Tiket online: beli (guest checkout, tanpa login), bayar (Midtrans SNAP), generate QR, kirim via email
- [ ] Modul tiket: scan QR, dashboard, transaksi manual offline
- [ ] Modul Layanan: CRUD services + galeri + packages, WA deep link per paket

### Phase 2 — Restoran & Konten (Estimasi: 4–6 minggu)
- [ ] Tabel `tables` + generate `table_code` per meja (admin)
- [ ] QR meja + halaman menu (meja teridentifikasi via `table_code`)
- [ ] Midtrans QRIS dinamis untuk order meja (online) + flow bayar offline
- [ ] Dashboard kasir + polling order masuk
- [ ] History transaksi kasir

### Phase 3 — Admin & Polish (Estimasi: 3–4 minggu)
- [ ] Admin dashboard agregat (tiket + kasir)
- [ ] CRUD blog, jenis tiket
- [ ] Optimasi performa & SEO
- [ ] Evaluasi apakah modul Fasilitas/Paket Wisata/Event perlu ditambahkan sebagai fase lanjutan

---

## 10. OPEN ITEMS / PERLU DIPUTUSKAN

| # | Item | Status |
|---|---|---|
| 1 | Apakah Fasilitas perlu jadi modul CRUD dinamis atau cukup halaman statis? | 🟡 Belum diputuskan |
| 2 | Apakah Paket Wisata & Event akan masuk kembali di fase selanjutnya? | 🟡 Belum diputuskan |
| 3 | `tables.is_active` — apakah dibutuhkan setelah operasional berjalan (mis. meja rusak/renovasi)? | 🟡 Ditunda, revisit jika perlu |

---

*Dokumen ini bersifat living document dan akan diperbarui seiring perkembangan proyek.*

---

**Prepared by:** Reza Web Developer
**Versi:** 1.4
**Next Step:** Migration Laravel sesuai schema final → Development Sprint 1 (Frontend Publik) → Sprint 2 (Backend & Modul Transaksi)
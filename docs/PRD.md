# 📋 Product Requirements Document (PRD)
## Website Destinasi Wisata — Platform Terpadu

---

**Versi:** 1.2
**Tanggal:** Juni 2026
**Status:** Draft
**Target Audience:** Wisatawan Lokal Indonesia

---

## CHANGELOG

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

Platform website wisata destinasi ini dirancang sebagai sistem terpadu yang mengelola seluruh touchpoint pengunjung — mulai dari penemuan informasi, pembelian tiket online, pemesanan makanan di lokasi, hingga booking layanan via WhatsApp. Sistem ini dilengkapi dengan back-office multi-role untuk operasional harian: Admin, Kasir, dan Petugas Tiket.

**Tagline:** *"Satu platform, pengalaman wisata yang lengkap."*

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
| Akun user terdaftar | ≥ 500 akun |
| Uptime sistem | ≥ 99.5% |

---

## 3. RUANG LINGKUP SISTEM

Sistem terdiri dari **6 modul utama**:

```
┌──────────────────────────────────────────────────────────────────┐
│                     WEBSITE WISATA PLATFORM                      │
├───────────────┬──────────────┬──────────────┬────────────────────┤
│  PUBLIC WEB   │    TIKET     │   RESTORAN   │  BOOKING LAYANAN   │
│  (Guest/User) │   MODULE     │  / KASIR     │  & PAKET (WA)      │
├───────────────┴──────────────┴──────────────┴────────────────────┤
│                  USER ACCOUNT (History Tiket)                    │
├──────────────────────────────────────────────────────────────────┤
│                       ADMIN DASHBOARD                            │
└──────────────────────────────────────────────────────────────────┘
```

---

## 4. USER ROLES & PERSONA

### 4.1 Guest (Pengunjung Tidak Login)
- **Siapa:** Siapa pun yang membuka website tanpa akun
- **Bisa akses:** Semua halaman informasi publik (fasilitas, paket, event, blog, maps, menu), scan QR meja untuk pesan makanan
- **Tidak bisa:** Beli tiket online

### 4.2 User Terdaftar *(Role: `user`)*
- **Siapa:** Wisatawan yang sudah register & login
- **Bisa akses:** Semua akses guest + beli tiket online, lihat history tiket, lihat QR tiket
- **Scope akun:** Tiket saja — transaksi F&B tidak terikat ke akun

### 4.3 Petugas Tiket *(Role: `tiket`)*
- **Siapa:** Staff di pintu masuk / loket
- **Kebutuhan:** Verifikasi tiket cepat, input transaksi offline, lihat rekap harian
- **Pain Point:** Tiket palsu, antrian panjang, pencatatan manual

### 4.4 Kasir Restoran *(Role: `kasir`)*
- **Siapa:** Staff restoran / food court di area wisata
- **Kebutuhan:** Kelola menu, proses order dari meja, print struk setelah konfirmasi
- **Pain Point:** Salah order, antrian order menumpuk, perhitungan manual

### 4.5 Admin *(Role: `admin`)*
- **Siapa:** Pengelola destinasi wisata / manajer operasional
- **Kebutuhan:** Pantau semua aktivitas, kelola konten, lihat laporan bisnis
- **Pain Point:** Data tersebar, tidak ada visibilitas real-time

---

## 5. MODUL & FITUR DETAIL

---

### 📱 MODUL 1 — PUBLIC WEBSITE (Guest & User)

#### 1.1 Halaman Utama / Landing Page
- Hero section dengan CTA "Beli Tiket Sekarang" & "Lihat Paket Wisata"
- Ringkasan fasilitas unggulan (icon + deskripsi singkat)
- Preview event yang akan datang
- **Testimonial hardcoded** (diisi & dikelola langsung oleh developer / admin via config)
- Galeri foto/video destinasi

#### 1.2 Halaman Fasilitas
- Grid/list semua fasilitas (wahana, kolam renang, area foto, dll)
- Foto, deskripsi, jam operasional, harga (jika berbayar terpisah)
- Status ketersediaan (buka/tutup/penuh)

#### 1.3 Halaman Paket Wisata
- Katalog paket (Paket Keluarga, Paket Rombongan, Paket Honeymoon, dll)
- Detail: inclusi, harga, durasi, kapasitas, syarat & ketentuan
- Tombol **"Pesan via WhatsApp"** (deep link WA dengan pesan otomatis ke nomor pengelola)

#### 1.4 Halaman Tiket Online ⚠️ *Login Required*
- **User wajib login** sebelum bisa melanjutkan pembelian tiket
- Jika belum login → redirect ke halaman login/register dengan pesan: *"Silakan daftar atau masuk untuk membeli tiket"*
- Setelah login:
  - Pilih jenis tiket: **Terusan** / **Normal**
  - Pilih jumlah tiket
  - Harga selalu tetap (tidak ada variasi weekday/weekend)
  - Tiket berlaku hingga di-scan — tidak terikat tanggal kunjungan spesifik
  - Ringkasan harga + promo (jika ada)
  - Checkout & pembayaran via **Midtrans SNAP** (transfer bank, QRIS, e-wallet)
  - Setelah bayar: QR Code tersimpan otomatis di akun user + dikirim otomatis via email (resend)

#### 1.5 Halaman Event
- Daftar event & festival
- Detail event: tanggal, lokasi, deskripsi, harga (jika berbayar)
- Tombol daftar langsung via WhatsApp

#### 1.6 Halaman Layanan
- List layanan tambahan: spa, fotografi, sewa wahana, pemandu wisata, dll
- Detail layanan + harga
- Booking langsung via WhatsApp

#### 1.7 Halaman Makanan (Menu Restoran)
- Preview katalog menu makanan & minuman (informasi saja)
- Filter kategori (makanan berat, snack, minuman, dessert)
- Harga & foto menu
- *Pemesanan aktual via scan QR di meja dengan pembayaran QRIS*

#### 1.8 Blog & Artikel
- Artikel wisata, informasi destinasi, update blog
- Kategori artikel, tag

#### 1.9 Integrasi Maps
- Embed Google Maps lokasi destinasi
- Petunjuk arah (Get Directions)

---

### 🎟️ MODUL 2 — TIKET (Role: Petugas Tiket)

#### 2.1 Dashboard Tiket
- Total pendapatan hari ini / minggu ini / bulan ini (chart)
- Total pengunjung masuk hari ini / minggu ini / bulan ini
- Breakdown per jenis tiket (Terusan vs Normal)

#### 2.2 Scan & Verifikasi QR
- Interface scan QR via kamera device (mobile-friendly)
- Validasi tiket:
  - ✅ **Valid** — tampil info lengkap, konfirmasi scan
  - ⚠️ **Sudah Digunakan** — tampil alert + info kapan di-scan
  - ❌ **Tidak Ditemukan** — alert QR tidak valid
- Tampil info tiket: nama pemesan, jenis tiket, jumlah orang, QR code
- Log waktu scan otomatis
- Jika koneksi mati: bisa foto dulu, scan ulang saat koneksi kembali

#### 2.3 History Transaksi
- Tabel semua transaksi tiket (online + offline)
- Pencarian by ID transaksi
- Filter: tanggal, jenis tiket, status

#### 2.4 Tambah Transaksi Manual (Offline)
- Form input manual untuk pembayaran tunai di lokasi
- Input: nama pengunjung (guest), jenis tiket, jumlah, harga, metode bayar (cash/QRIS)
- Tiket offline tidak di-generate QR (petugas langsung tandai masuk secara manual)
- *Catatan: Tiket offline tidak terhubung ke akun user manapun*

---

### 🍽️ MODUL 3 — RESTORAN & KASIR (Role: Kasir)

> **Penting:** Seluruh transaksi F&B berdiri sendiri dan **tidak terhubung ke akun user manapun**. Tidak ada identitas pembeli yang disimpan.

#### 3.1 Dashboard Kasir
- Total pendapatan hari ini (update via polling)
- Jumlah transaksi hari ini
- Menu terlaris hari ini
- Daftar order masuk yang perlu dikonfirmasi (antrian)

#### 3.2 Manajemen Menu
- CRUD menu: nama, foto, kategori, harga, deskripsi
- Toggle status: **Tersedia / Habis** (sync realtime ke halaman order pelanggan)
- Toggle **Favorit** untuk urutan tampil prioritas

#### 3.3 Sistem POS (Point of Sale)
*Untuk pelanggan yang datang langsung ke kasir (tidak via QR meja)*

- Tambah item ke keranjang, set jumlah, beri catatan per item
- Hitung total otomatis
- Pilih metode pembayaran: **QRIS** atau **Tunai**
- Generate & cetak struk
- **Tidak ada field identitas pembeli** — transaksi anonim

#### 3.4 Order via QR Meja

> **Customer tidak perlu login.** QR meja mengarahkan ke halaman menu dengan nomor meja terisi otomatis. Pembayaran wajib via **Midtrans QRIS dinamis**.

**Flow:**
```
Customer scan QR di meja
  → Redirect ke halaman menu (no login required)
  → Nomor meja terisi otomatis dari parameter URL
  → Pilih menu + kuantitas + catatan
  → Lihat ringkasan order + total harga
  → Bayar via Midtrans QRIS (generate QR dinamis, batas waktu 30 menit)
  → Pembayaran sukses → notifikasi masuk ke dashboard kasir (polling 3–5 detik)
  → Kasir konfirmasi & cetak struk
  → Makanan diantar ke meja
```

- QR unik per meja berisi URL: `/menu?table={nomor_meja}`
- Nomor meja otomatis terbaca dari URL, tidak perlu diisi manual oleh pelanggan
- Setelah bayar, order terkunci (tidak bisa diubah)
- Jika QRIS kadaluarsa (30 menit): pelanggan bisa generate ulang

#### 3.5 History Transaksi Kasir
- Tabel semua transaksi (POS + order QR meja)
- Filter: tanggal
- Aksi: **Edit**, **Hapus** (void), **Detail / Cetak ulang**
- Export ke PDF / Excel

---

### 📲 MODUL 4 — BOOKING VIA WHATSAPP

> Semua booking (paket wisata & layanan) dilakukan langsung via WhatsApp ke nomor pengelola. Tidak ada form booking internal di sistem.

#### 4.1 Booking Paket Wisata
- Tombol "Pesan via WhatsApp" di halaman paket
- Deep link WA dengan pesan pre-fill: nama paket, harga, permintaan info lebih lanjut

#### 4.2 Booking Layanan
- Tombol "Booking via WhatsApp" di halaman layanan
- Deep link WA dengan pesan pre-fill: nama layanan, harga, permintaan jadwal

---

### 👤 MODUL 6 — USER ACCOUNT *(Role: `user`)*

> Scope terbatas pada **tiket** saja. Tidak ada rating, tidak ada history F&B.

#### 6.1 Registrasi & Login
- Register: nama lengkap, email, no. HP, password
- Login via email + password
- Forgot password via email (reset link)
- Setelah register → `route-back` ke halaman sebelumnya (biasanya halaman tiket)

#### 6.2 Halaman "Tiket Saya" (My Tickets)
- List semua tiket yang pernah dibeli oleh akun ini
- Informasi per tiket:
  - Jenis tiket (Terusan / Normal)
  - Jumlah orang
  - Status: **Aktif** / **Sudah Digunakan**
  - Tanggal pembelian
  - Total harga yang dibayar
- **Tiket aktif selalu tampil paling atas**

#### 6.3 Detail Tiket & QR Code
- Klik tiket → halaman detail tiket
- Tampil **QR Code besar** siap di-scan oleh petugas di pintu masuk
- Info lengkap: nama pemesan, jenis tiket, jumlah orang
- Status tiket ditampilkan jelas (Aktif / Sudah Digunakan + timestamp scan)
- Jika tiket sudah digunakan: QR tetap tampil tapi dengan overlay "Sudah Digunakan"

#### 6.4 Profil Akun
- Edit nama, no. HP, foto profil
- Ganti password

---

### ⚙️ MODUL 5 — ADMIN DASHBOARD (Role: Admin)

#### 5.1 Dashboard Utama Admin
- **Ringkasan finansial:** Total pendapatan hari ini (tiket + kasir)
- **Statistik pengunjung:** Total masuk hari ini, trend mingguan/bulanan
- **Grafik:** Revenue 30 hari terakhir, breakdown per sumber (tiket / F&B)
- **Top metrics:** Menu terlaris, paket terpopuler
- **User stats:** Jumlah akun user terdaftar

#### 5.2 Kelola Konten Website
| Section | Aksi |
|---|---|
| **Fasilitas** | CRUD (nama, foto, deskripsi, status buka/tutup) |
| **Paket Wisata** | CRUD (nama, harga, inklusi, foto, status aktif) |
| **Event** | CRUD (nama, tanggal, deskripsi, poster, harga) |
| **Layanan** | CRUD (nama, harga, deskripsi, foto) |
| **Blog** | CRUD (judul, konten rich-text, thumbnail, kategori, publish/draft) |
| **Menu Makanan** | Read + monitoring (edit diserahkan ke kasir) |

#### 5.3 Manajemen Tiket
- Lihat semua transaksi tiket — create tiket offline + export
- Set harga tiket (Terusan / Normal)
- Set promo / diskon (opsional)


#### 5.5 Manajemen User
- List akun user terdaftar (read + export)
- Log aktivitas user

#### 5.6 Konfigurasi Sistem
- Konfigurasi QR meja (generate / regenerate per nomor meja)
- Pengaturan umum (nama destinasi, logo, kontak, nomor WA pengelola)

---

## 6. ALUR USER JOURNEY

### 6.1 Customer: Register & Beli Tiket Online
```
Landing Page → Klik "Beli Tiket"
→ Belum login? → Redirect ke Register/Login
→ Register (nama, email, HP, password) → Login
→ route-back ke halaman Tiket
→ Pilih jenis tiket + jumlah → Checkout → Bayar (Midtrans)
→ QR tersimpan di akun + dikirim via email
→ Tiba di lokasi → Buka "Tiket Saya" → Tampilkan QR → Scan → Masuk ✅
```

### 6.2 Customer: Lihat & Gunakan Tiket
```
Login → "Tiket Saya" → Pilih tiket aktif (paling atas)
→ Tampil QR Code besar → Scan oleh petugas → Masuk ✅
```

### 6.3 Customer: Pesan Makanan di Meja
```
Duduk di meja → Scan QR meja
→ Redirect ke halaman menu (nomor meja otomatis terisi)
→ Pilih menu + kuantitas + catatan
→ Lihat ringkasan → Bayar via QRIS (Midtrans, batas 30 menit)
→ Pembayaran sukses → Kasir terima notifikasi
→ Kasir konfirmasi + cetak struk → Makanan diantar ke meja ✅
```

### 6.4 Customer: Booking Paket / Layanan
```
Halaman Paket atau Layanan
→ Klik "Pesan / Booking via WhatsApp"
→ Redirect ke WA dengan pesan pre-fill → Chat dengan pengelola ✅
```

---

## 7. TECHNICAL REQUIREMENTS

### 7.1 Tech Stack
| Layer | Teknologi |
|---|---|
| **Backend** | Laravel 13 |
| **Frontend** | Blade + Alpine.js + Tailwind CSS v4 + AOS |
| **Database** | MySQL 8 |
| **Payment Gateway** | Midtrans SNAP (tiket online) + Midtrans QRIS dinamis (F&B meja) |
| **Realtime / Polling** | AJAX polling interval 3–5 detik (kasir dashboard) |
| **WhatsApp** | WA Business (deep link + nomor pengelola) |
| **QR Code** | `simplesoftwareio/simple-qrcode` |
| **Maps** | Google Maps Embed (iframe) |
| **Storage** | Laravel Storage + S3 / local disk |
| **Queue** | Laravel Queue (database driver) untuk kirim email async |
| **Auth** | Manual, role-based middleware via route |
| **Mail** | Resend|

### 7.2 Database Entities Utama

```sql
-- Akun internal & user terdaftar
users (
  id, name, email, phone, password,
  role ENUM('admin','tiket','kasir','user') DEFAULT 'user',
  created_at
)

-- Tiket (online & offline digabung)
tickets (
  id,
  user_id FK→users NULLABLE,           -- null jika tiket offline
  code VARCHAR UNIQUE,
  qr_hash VARCHAR UNIQUE NULLABLE,     -- null jika tiket offline
  type ENUM('terusan','normal'),
  qty INT,
  price_per_person INT,
  total_price INT,
  status ENUM('active','used','voided'),
  purchase ENUM('online','offline'),
  scanned_at TIMESTAMP NULLABLE,
  scanned_by FK→users NULLABLE,        -- id petugas yang scan
  created_at
)

-- Restoran — tidak terhubung ke user
menu_items (
  id, name, category, price, photo, description,
  is_available BOOL, is_favorite BOOL
)

tables (
  id, number INT UNIQUE, qr_token VARCHAR UNIQUE
)

orders (
  id,
  table_id FK→tables,
  status ENUM('pending','paid','confirmed','cancelled'),
  total INT,
  payment_method ENUM('qris_meja','pos_qris','pos_cash'),
  midtrans_order_id VARCHAR NULLABLE,  -- untuk order via QR meja
  midtrans_status VARCHAR NULLABLE,
  paid_at TIMESTAMP NULLABLE,
  created_at
)

order_items (
  id, order_id, menu_item_id, qty, note, price_snapshot
)

-- Konten & booking (WA only — tidak ada tabel booking internal)
packages    (id, name, price, description, inclusions JSON, photo, is_active, wa_message_template TEXT)
services    (id, name, price, description, photo, wa_message_template TEXT)
events      (id, name, event_date, end_date, description, poster)
facilities  (id, name, description, photo, is_open)
blog_posts  (id, title, slug, content, thumbnail, category, published_at)
```

### 7.3 QR Code Specification

**Tiket Online:**
- Format: UUID v4 ter-enkripsi (HMAC SHA-256 dengan secret key)
- Validasi: cek `status` di database → `active` = boleh masuk, `used` = alert sudah dipakai
- One-time use: set `status = 'used'` + `scanned_at` saat scan pertama
- Tiket rombongan: QR tunggal, counter internal di sistem (scan N kali sesuai `qty`)

**Tiket Offline:**
- Tidak di-generate QR — petugas tandai masuk secara manual di sistem
- Prefix kode: `OFL-{id}` untuk identifikasi cepat di history transaksi

**QR Meja:**
- Format URL: `https://domain.com/menu?table={nomor_meja}`
- Token unik per meja di `tables.qr_token` untuk validasi URL
- Generate ulang dari admin jika token dikompromikan

### 7.4 Midtrans Integration

```
Tiket Online:
  → Midtrans SNAP (semua metode: transfer bank, QRIS, e-wallet)
  → Webhook callback → update tickets.status = 'active' + send email

Order QR Meja:
  → Midtrans QRIS Dinamis (create charge API, batas waktu 30 menit)
  → Webhook callback → update orders.status = 'paid' + trigger polling kasir
  → Jika expire → pelanggan bisa generate QRIS baru untuk order yang sama
```

### 7.5 Polling Architecture (Kasir)

```
Kasir Dashboard ──── polling GET /api/orders/pending (3 detik)
                      → menampilkan order berstatus 'paid' yang belum dikonfirmasi
```

*CFD dan polling customer page dihapus dari scope.*

### 7.6 WhatsApp Integration

- Menggunakan deep link WA: `https://wa.me/{nomor}?text={pesan_encoded}`
- Template pesan per paket/layanan disimpan di kolom `wa_message_template` (bisa diedit admin)
- Tidak ada bot/API — semua komunikasi manual oleh pengelola

### 7.7 Business Rules

```
TIKET:
✅ Beli tiket online → wajib login sebagai role 'user'
✅ Tiket aktif hingga di-scan (tidak ada expiry date)
✅ QR tiket bisa diakses kapan saja dari "Tiket Saya"
✅ Tiket offline tidak generate QR, ditandai manual oleh petugas
✅ Admin & petugas internal tidak bisa beli tiket via akun internal mereka

F&B:
✅ Scan QR meja → redirect ke menu, nomor meja otomatis dari URL
✅ Pembayaran QR meja wajib via Midtrans QRIS dinamis
✅ POS kasir (pelanggan datang langsung) → QRIS atau tunai
✅ Order via QR meja terkunci setelah bayar
❌ Transaksi F&B tidak masuk ke history user manapun
❌ Tidak ada identitas pembeli di transaksi F&B
```

---

## 8. NON-FUNCTIONAL REQUIREMENTS

| Aspek | Requirement |
|---|---|
| **Performance** | Halaman public load < 3 detik (LCP) |
| **Mobile-first** | Responsive di semua device, QR tiket & QRIS optimal di mobile |
| **Security** | HTTPS, CSRF protection, rate limiting login (max 5x/menit), validasi Midtrans webhook signature |
| **Scalability** | Handle 500 concurrent user pada peak season |
| **Availability** | Uptime 99.5%, maintenance window dini hari |
| **Accessibility** | Kontras warna memadai, font size readable |
| **SEO** | Meta tags, Open Graph, sitemap.xml untuk halaman public |
| **Data Backup** | Backup database harian otomatis |
| **Privacy** | Transaksi F&B anonim — tidak ada PII pembeli yang disimpan |

---

## 9. MILESTONE & ROADMAP

### Phase 1 — MVP Core (Estimasi: 6–8 minggu)
- [ ] Public website: landing page, fasilitas, paket, blog, maps
- [ ] Auth user (register, login, forgot password, route-back) + role middleware
- [ ] Tiket online: beli (login required), bayar (Midtrans SNAP), generate QR
- [ ] User Account: halaman "Tiket Saya" + tampilan QR tiket + resend email
- [ ] Modul tiket: scan QR, dashboard, transaksi manual offline

### Phase 2 — Restoran & Konten (Estimasi: 4–6 minggu)
- [ ] QR meja + halaman menu (nomor meja otomatis)
- [ ] Midtrans QRIS dinamis untuk order meja
- [ ] Dashboard kasir + polling order masuk
- [ ] POS kasir (cash / QRIS)
- [ ] History transaksi kasir + export

### Phase 3 — Admin & Polish (Estimasi: 3–4 minggu)
- [ ] Admin dashboard agregat (tiket + kasir)
- [ ] CRUD event, layanan, blog, fasilitas, paket
- [ ] Export laporan PDF/Excel
- [ ] Optimasi performa & SEO
- [ ] Konfigurasi QR meja (generate/regenerate)


---


*Dokumen ini bersifat living document dan akan diperbarui seiring perkembangan proyek.*

---

**Prepared by:** Reza Web Developer
**Versi:** 1.2
**Next Step:** ERD finalisasi → Wireframe halaman kritis → Development Sprint 1

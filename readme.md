# 📄 Product Requirements Document (PRD)

# KoBook — The Hybrid Library-Cafe Ecosystem

| Field | Detail |
|---|---|
| **Product Name** | KoBook |
| **Version** | 1.0 |
| **Author** | KoBook Dev Team |
| **Tanggal** | 15 Maret 2026 |
| **Status** | Draft — Menunggu Review |

---

## 1. Ringkasan Eksekutif

**KoBook** adalah platform manajemen *all-in-one* berbasis web yang menggabungkan dua model bisnis dalam satu ekosistem digital:

1. **F&B Management (Point of Sales)** — Pengelolaan menu kopi, makanan ringan, dan transaksi penjualan.
2. **Library Management System** — Pengelolaan katalog buku, peminjaman, pengembalian, dan denda.

Platform ini dirancang untuk pemilik cafe berkonsep *reading cafe* yang ingin mengelola operasional kopi dan perpustakaan secara terpadu, tanpa perlu membeli dua software terpisah.

**Nilai Diferensiasi Utama:** KoBook menangani dua jenis entitas yang bertolak belakang — barang *consumable* (kopi, habis setelah dijual) dan barang *circulating* (buku, dipinjamkan dan dikembalikan) — dalam satu sistem relasional yang saling terintegrasi.

---

## 2. Visi & Tujuan Produk

### 2.1 Visi
Menjadi solusi digital terdepan bagi cafe-cafe berkonsep literasi di Indonesia, di mana pengalaman menikmati kopi dan membaca buku menjadi satu kesatuan yang seamless.

### 2.2 Tujuan
| # | Tujuan | Indikator Keberhasilan |
|---|---|---|
| 1 | Menyederhanakan operasional cafe + perpustakaan | Owner cukup login ke 1 dashboard |
| 2 | Meningkatkan retensi pelanggan | Member aktif naik 20% dalam 3 bulan melalui reward cross-selling |
| 3 | Mengurangi kehilangan buku | Tingkat pengembalian buku ≥ 95% berkat reminder otomatis |
| 4 | Menjadi portofolio fullstack yang kuat | Menampilkan kemampuan arsitektur sistem, logika bisnis, dan UI/UX |

---

## 3. Target Pengguna

### 3.1 Persona Utama

#### 👤 Persona 1: Rizky — Pemilik Cafe (Owner)
- **Usia:** 28 tahun
- **Latar Belakang:** Pengusaha muda yang membuka cafe berkonsep perpustakaan
- **Pain Point:** Mengelola stok kopi dan inventaris buku secara terpisah menggunakan spreadsheet
- **Kebutuhan:** Satu dashboard yang menampilkan laporan penjualan kopi DAN status peminjaman buku

#### 👤 Persona 2: Dina — Barista / Kasir
- **Usia:** 22 tahun
- **Latar Belakang:** Part-time barista
- **Pain Point:** Proses pencatatan pesanan yang lambat
- **Kebutuhan:** Antarmuka kasir yang cepat dan sederhana

#### 👤 Persona 3: Andi — Pustakawan
- **Usia:** 25 tahun
- **Latar Belakang:** Staff yang mengurus koleksi buku cafe
- **Pain Point:** Susah melacak siapa yang meminjam buku apa dan kapan harus kembali
- **Kebutuhan:** Dashboard peminjaman dengan notifikasi deadline

#### 👤 Persona 4: Maya — Pelanggan / Member
- **Usia:** 20 tahun (Mahasiswi)
- **Latar Belakang:** Sering nongkrong di cafe sambil baca buku
- **Pain Point:** Datang ke cafe tapi buku yang diinginkan sedang dipinjam orang lain
- **Kebutuhan:** Bisa cek ketersediaan buku dan booking dari rumah

---

## 4. Arsitektur Sistem

### 4.1 Tech Stack

| Layer | Teknologi | Alasan |
|---|---|---|
| **Backend Framework** | Laravel 12 (PHP 8.2+) | Eloquent ORM untuk relasi data kompleks, Task Scheduling untuk reminder otomatis |
| **Frontend Template** | Blade | Template engine bawaan Laravel, SEO-friendly |
| **CSS Framework** | Tailwind CSS | Modern, utility-first, responsif, estetik untuk cafe branding |
| **JavaScript** | Alpine.js | Lightweight interactivity (dropdown, modal, toggle) |
| **Admin Panel** | FilamentPHP v3 | Rapid admin dashboard development, multi-panel support |
| **Database** | MySQL 8.0 / MariaDB | Relational database, ACID compliance untuk transaksi |
| **Authentication** | Laravel Breeze | Scaffolding login/register/forgot password |
| **File Storage** | Laravel Storage (Local/S3) | Upload cover buku, foto menu |
| **Scheduling** | Laravel Task Scheduler | Cron job untuk reminder pengembalian buku |

### 4.2 Arsitektur Tingkat Tinggi

```
┌─────────────────────────────────────────────────────────────────┐
│                    FRONTEND (Browser)                           │
│  ┌──────────────────────┐    ┌──────────────────────────────┐   │
│  │  Landing Page /      │    │  Admin Panel (FilamentPHP)   │   │
│  │  Katalog Publik      │    │  ┌────────┐ ┌───────────┐   │   │
│  │  (Blade + Tailwind   │    │  │ Owner  │ │  Barista  │   │   │
│  │   + Alpine.js)       │    │  │Dashboard│ │  POS      │   │   │
│  │                      │    │  └────────┘ └───────────┘   │   │
│  │  ┌────────────────┐  │    │  ┌─────────────────────┐    │   │
│  │  │ Member         │  │    │  │ Pustakawan Panel    │    │   │
│  │  │ Dashboard      │  │    │  │ (Library Mgmt)      │    │   │
│  │  └────────────────┘  │    │  └─────────────────────┘    │   │
│  └──────────────────────┘    └──────────────────────────────┘   │
└─────────────────────────────────────────────────────────────────┘
                              │
                              ▼
┌─────────────────────────────────────────────────────────────────┐
│                    BACKEND (Laravel 12)                         │
│  ┌──────────────┐  ┌──────────────┐  ┌───────────────────┐     │
│  │ Auth &       │  │ F&B Module   │  │ Library Module    │     │
│  │ Authorization│  │ Menu &       │  │ Buku &            │     │
│  │              │  │ Transaksi    │  │ Peminjaman        │     │
│  └──────────────┘  └──────────────┘  └───────────────────┘     │
│  ┌──────────────────────┐  ┌──────────────────────────────┐    │
│  │ Cross-Selling Engine │  │ Notification & Scheduler     │    │
│  └──────────────────────┘  └──────────────────────────────┘    │
└─────────────────────────────────────────────────────────────────┘
                              │
                              ▼
┌─────────────────────────────────────────────────────────────────┐
│                    DATABASE (MySQL)                              │
│  ┌────────┐ ┌──────────┐ ┌───────┐ ┌──────────────┐           │
│  │ users  │ │ products │ │ books │ │ transactions │           │
│  └────────┘ └──────────┘ └───────┘ └──────────────┘           │
│  ┌─────────────┐ ┌───────────────────┐ ┌────────────────┐     │
│  │ borrowings  │ │ transaction_items │ │ book_reserv.   │     │
│  └─────────────┘ └───────────────────┘ └────────────────┘     │
│  ┌────────────┐                                                │
│  │ categories │                                                │
│  └────────────┘                                                │
└─────────────────────────────────────────────────────────────────┘
```

---

## 5. User Roles & Permissions

| Permission | Owner | Barista | Pustakawan | Member |
|---|:---:|:---:|:---:|:---:|
| Lihat Dashboard Laporan Bisnis | ✅ | ❌ | ❌ | ❌ |
| Kelola User & Role | ✅ | ❌ | ❌ | ❌ |
| Kelola Menu F&B (CRUD) | ✅ | ❌ | ❌ | ❌ |
| Kelola Katalog Buku (CRUD) | ✅ | ❌ | ✅ | ❌ |
| Proses Transaksi Kopi (POS) | ✅ | ✅ | ❌ | ❌ |
| Proses Peminjaman & Pengembalian Buku | ✅ | ❌ | ✅ | ❌ |
| Lihat Katalog Menu (Publik) | ✅ | ✅ | ✅ | ✅ |
| Lihat Katalog Buku (Publik) | ✅ | ✅ | ✅ | ✅ |
| Booking Buku Online | ❌ | ❌ | ❌ | ✅ |
| Lihat Riwayat Peminjaman Sendiri | ❌ | ❌ | ❌ | ✅ |
| Lihat Reward / Badge | ❌ | ❌ | ❌ | ✅ |

---

## 6. Fitur & Spesifikasi Detail

### 6.1 Modul Landing Page (Publik)

Halaman depan website KoBook yang bisa diakses siapa saja tanpa login.

| Fitur | Deskripsi |
|---|---|
| **Hero Section** | Banner estetik dengan tagline KoBook, CTA "Lihat Menu" dan "Jelajahi Koleksi Buku" |
| **Menu Showcase** | Grid / carousel menampilkan menu kopi & makanan unggulan beserta harga |
| **Katalog Buku Publik** | Daftar buku dengan filter: genre, status (Tersedia / Dipinjam), dan pencarian judul |
| **Tentang Kami** | Cerita singkat tentang konsep KoBook |
| **Lokasi & Kontak** | Peta (Google Maps embed), jam operasional, form kontak |
| **Login / Register** | Tombol akses untuk Member dan Staff |

---

### 6.2 Modul F&B Management (Kopi & Makanan)

#### A. Manajemen Menu (Admin/Owner)
| Field | Tipe | Keterangan |
|---|---|---|
| `nama_menu` | string | Nama menu (e.g., "Kopi Susu KoBook") |
| `kategori` | enum | `kopi`, `non-kopi`, `makanan`, `snack` |
| `harga` | integer | Harga dalam Rupiah |
| `deskripsi` | text | Deskripsi singkat menu |
| `gambar` | file | Foto menu |
| `stok_harian` | integer | Jumlah porsi yang tersedia per hari |
| `is_available` | boolean | Status ketersediaan |

#### B. Point of Sales / Kasir (Barista)
- Input pesanan customer (pilih menu, jumlah)
- Hitung total otomatis
- Cetak struk / tampilkan ringkasan
- Pesanan tercatat di tabel `transactions`

#### C. Laporan Penjualan (Owner)
- Laporan harian, mingguan, bulanan
- Menu terlaris
- Total pendapatan F&B

---

### 6.3 Modul Library Management (Perpustakaan)

#### A. Manajemen Katalog Buku (Owner / Pustakawan)
| Field | Tipe | Keterangan |
|---|---|---|
| `judul` | string | Judul buku |
| `penulis` | string | Nama penulis |
| `isbn` | string | Kode ISBN (opsional) |
| `genre` | enum | `fiksi`, `non-fiksi`, `self-improvement`, `teknologi`, `bisnis`, `sastra`, `lainnya` |
| `cover` | file | Foto sampul buku |
| `jumlah_eksemplar` | integer | Total eksemplar yang dimiliki |
| `stok_tersedia` | integer | Eksemplar yang belum dipinjam |
| `status` | enum | `available`, `borrowed`, `reserved`, `maintenance` |
| `lokasi_rak` | string | Kode rak (e.g., "Rak-A3") |

#### B. Peminjaman Buku
| Proses | Detail |
|---|---|
| **Syarat Pinjam** | Harus terdaftar sebagai Member |
| **Durasi Pinjam** | Default 7 hari (bisa diperpanjang 1x) |
| **Maks. Pinjam** | 2 buku per member secara bersamaan |
| **Proses** | Pustakawan scan/input ID Buku → Sistem catat tanggal pinjam & deadline → Status buku berubah |
| **Perpanjangan** | Member bisa request perpanjangan via dashboard (approval dari Pustakawan) |

#### C. Pengembalian Buku
| Proses | Detail |
|---|---|
| **Verifikasi** | Pustakawan cek kondisi fisik buku |
| **Kondisi Buku** | `baik`, `sedikit_rusak`, `rusak_berat`, `hilang` |
| **Denda Keterlambatan** | Rp 2.000 / hari keterlambatan |
| **Denda Kerusakan** | Sesuai kebijakan (input manual oleh Pustakawan) |
| **Update Status** | Status buku kembali ke `available` setelah dikembalikan |

#### D. Booking Buku Online (Member)
- Member bisa memesan buku yang statusnya `available` dari rumah
- Status berubah menjadi `reserved` selama 24 jam
- Jika tidak diambil dalam 24 jam, reservasi batal otomatis (via Laravel Scheduler)
- Member hanya bisa reserve maksimal 1 buku dalam satu waktu

---

### 6.4 Modul Cross-Selling Engine

Sistem reward otomatis yang menghubungkan transaksi kopi dengan benefit perpustakaan.

| Rule | Trigger | Reward |
|---|---|---|
| **Bronze Member** | Total pembelian kopi ≥ Rp 100.000 | Gratis denda keterlambatan 1x |
| **Silver Member** | Total pembelian kopi ≥ Rp 300.000 | Gratis sewa 1 buku (7 hari) |
| **Gold Member** | Total pembelian kopi ≥ Rp 500.000 | Maks. pinjam naik jadi 3 buku + perpanjangan otomatis |

Implementasi menggunakan **Laravel Observers** pada model `Transaction`. Setiap transaksi berhasil, sistem mengecek total spending member dan meng-update tier secara otomatis.

---

### 6.5 Modul Notifikasi & Reminder

| Notifikasi | Trigger | Channel | Pesan |
|---|---|---|---|
| **Reminder H-1** | 1 hari sebelum deadline pengembalian | Email | "Hai {nama}, jangan lupa kembalikan buku **{judul}** besok ya! ☕📚" |
| **Reminder H-Day** | Hari deadline | Email | "Hari ini deadline pengembalian buku **{judul}**. Mampir ke KoBook yuk!" |
| **Overdue Alert** | 1 hari setelah deadline | Email | "Buku **{judul}** sudah melewati batas waktu. Denda Rp 2.000/hari berlaku." |
| **Reservasi Berhasil** | Saat buku di-reserve | Email | "Buku **{judul}** sudah direservasi untukmu. Ambil dalam 24 jam ya!" |
| **Tier Upgrade** | Tier member naik | Email | "Selamat! Kamu naik ke level **{tier}**! Nikmati benefit barumu 🎉" |

Semua notifikasi diproses oleh **Laravel Task Scheduler** yang berjalan via cron job setiap hari jam 09:00 WIB.

---

## 7. Skema Database (ERD)

### Tabel & Relasi

```
┌──────────────────────┐          ┌───────────────────────┐
│       USERS          │          │      CATEGORIES       │
├──────────────────────┤          ├───────────────────────┤
│ id (PK)              │          │ id (PK)               │
│ name                 │          │ nama                  │
│ email (UK)           │          │ tipe (fnb|buku)       │
│ password             │          └───────┬───────────────┘
│ role (owner|barista| │                  │
│   pustakawan|member) │                  │ 1:N
│ tier (bronze|silver| │          ┌───────┴───────────────┐
│   gold)              │          │                       │
│ total_spending       │          ▼                       ▼
│ created_at           │  ┌──────────────────┐  ┌──────────────────┐
│ updated_at           │  │    PRODUCTS      │  │     BOOKS        │
└──────┬───────────────┘  ├──────────────────┤  ├──────────────────┤
       │                  │ id (PK)          │  │ id (PK)          │
       │                  │ category_id (FK) │  │ category_id (FK) │
       │ 1:N              │ nama_menu        │  │ judul            │
       │                  │ kategori         │  │ penulis          │
       ▼                  │ harga            │  │ isbn             │
┌──────────────────┐      │ deskripsi        │  │ genre            │
│  TRANSACTIONS    │      │ gambar           │  │ cover            │
├──────────────────┤      │ stok_harian      │  │ jumlah_eksemplar │
│ id (PK)          │      │ is_available     │  │ stok_tersedia    │
│ user_id (FK)     │      └────────┬─────────┘  │ status           │
│ cashier_id (FK)  │               │            │ lokasi_rak       │
│ total_harga      │               │ 1:N        └──┬──────────┬───┘
│ status           │               │               │          │
│ created_at       │               ▼               │ 1:N      │ 1:N
└────────┬─────────┘  ┌────────────────────────┐   │          │
         │            │  TRANSACTION_ITEMS     │   │          │
         │ 1:N        ├────────────────────────┤   │          │
         │            │ id (PK)                │   │          │
         └───────────►│ transaction_id (FK)    │   │          │
                      │ product_id (FK)        │◄──┘          │
                      │ quantity               │              │
                      │ subtotal               │              │
                      └────────────────────────┘              │
                                                              │
       ┌──────────────────────────────────────────────────────┘
       │
       ▼                                    ▼
┌──────────────────────┐    ┌─────────────────────────┐
│    BORROWINGS        │    │   BOOK_RESERVATIONS     │
├──────────────────────┤    ├─────────────────────────┤
│ id (PK)              │    │ id (PK)                 │
│ user_id (FK)         │    │ user_id (FK)            │
│ book_id (FK)         │    │ book_id (FK)            │
│ librarian_id (FK)    │    │ reserved_at             │
│ tanggal_pinjam       │    │ expires_at              │
│ tanggal_deadline     │    │ status (active|         │
│ tanggal_kembali      │    │   fulfilled|expired|    │
│ kondisi_kembali      │    │   cancelled)            │
│ denda                │    └─────────────────────────┘
│ status (active|      │
│   returned|overdue|  │
│   lost)              │
└──────────────────────┘
```

### Relasi Antar Tabel
| Relasi | Tipe | Keterangan |
|---|---|---|
| Users → Transactions | 1:N | Member membuat transaksi kopi |
| Users → Transactions (cashier) | 1:N | Barista memproses transaksi |
| Users → Borrowings | 1:N | Member meminjam buku |
| Users → Borrowings (librarian) | 1:N | Pustakawan memproses peminjaman |
| Users → Book_Reservations | 1:N | Member mereservasi buku |
| Transactions → Transaction_Items | 1:N | Satu transaksi berisi banyak item |
| Products → Transaction_Items | 1:N | Satu produk bisa dipesan berkali-kali |
| Books → Borrowings | 1:N | Satu buku bisa dipinjam berkali-kali |
| Books → Book_Reservations | 1:N | Satu buku bisa direservasi |
| Categories → Products | 1:N | Kategori mengelompokkan produk |
| Categories → Books | 1:N | Kategori mengelompokkan buku |

---

## 8. User Stories

### Member (Customer)
| ID | Story | Priority |
|---|---|---|
| US-01 | Sebagai member, saya ingin **melihat daftar menu kopi** beserta harga supaya saya bisa memilih pesanan sebelum datang | Must Have |
| US-02 | Sebagai member, saya ingin **melihat katalog buku** dan mengetahui statusnya (tersedia/dipinjam) | Must Have |
| US-03 | Sebagai member, saya ingin **mendaftar akun** agar bisa meminjam buku | Must Have |
| US-04 | Sebagai member, saya ingin **memesan (booking) buku** dari rumah agar buku tersedia saat saya tiba | Should Have |
| US-05 | Sebagai member, saya ingin **melihat riwayat peminjaman** buku saya | Must Have |
| US-06 | Sebagai member, saya ingin **mendapat notifikasi** saat deadline pengembalian buku mendekat | Should Have |
| US-07 | Sebagai member, saya ingin **melihat tier reward** saya berdasarkan total pembelian kopi | Could Have |

### Barista
| ID | Story | Priority |
|---|---|---|
| US-08 | Sebagai barista, saya ingin **menginput pesanan** customer dengan cepat | Must Have |
| US-09 | Sebagai barista, saya ingin **melihat ringkasan pesanan** dan total harga sebelum konfirmasi | Must Have |
| US-10 | Sebagai barista, saya ingin **melihat stok harian** menu agar tahu mana yang masih tersedia | Should Have |

### Pustakawan
| ID | Story | Priority |
|---|---|---|
| US-11 | Sebagai pustakawan, saya ingin **memproses peminjaman buku** dengan cepat | Must Have |
| US-12 | Sebagai pustakawan, saya ingin **memproses pengembalian buku** dan mencatat kondisinya | Must Have |
| US-13 | Sebagai pustakawan, saya ingin **melihat daftar buku yang jatuh tempo hari ini** | Must Have |
| US-14 | Sebagai pustakawan, saya ingin **menyetujui atau menolak perpanjangan** pinjaman | Should Have |

### Owner
| ID | Story | Priority |
|---|---|---|
| US-15 | Sebagai owner, saya ingin **melihat laporan penjualan kopi** (harian/mingguan/bulanan) | Must Have |
| US-16 | Sebagai owner, saya ingin **melihat laporan peminjaman buku** (yang aktif, overdue, returned) | Must Have |
| US-17 | Sebagai owner, saya ingin **mengelola menu dan katalog buku** (tambah, edit, hapus) | Must Have |
| US-18 | Sebagai owner, saya ingin **mengelola akun staff** (barista & pustakawan) | Must Have |
| US-19 | Sebagai owner, saya ingin **melihat data cross-selling** untuk strategi marketing | Could Have |

---

## 9. Prioritas Fitur (MoSCoW)

| Prioritas | Fitur |
|---|---|
| **Must Have** | Landing page, Katalog menu, Katalog buku, Registrasi member, Login multi-role, POS kasir, CRUD buku, Peminjaman & pengembalian buku, Dashboard owner (laporan dasar) |
| **Should Have** | Booking buku online, Reminder email (H-1, H-Day, Overdue), Perpanjangan pinjaman, Filter & search katalog, Stok harian menu |
| **Could Have** | Cross-selling engine (tier reward otomatis), Badge system, Laporan analytics lanjutan, WhatsApp notification |
| **Won't Have (v1)** | Online ordering kopi (delivery), Payment gateway integration, Mobile app, Multi-cabang support |

---

## 10. Alur Halaman (Wireframe Flow)

```
Landing Page ──► Login
                  │
                  ├── Owner ──────► Filament Owner Dashboard
                  │                    ├── Laporan Penjualan
                  │                    ├── Kelola Menu
                  │                    ├── Kelola Buku
                  │                    └── Kelola Staff
                  │
                  ├── Barista ────► Filament POS Kasir
                  │                    ├── Input Pesanan
                  │                    └── Konfirmasi & Cetak
                  │
                  ├── Pustakawan ─► Filament Library Panel
                  │                    ├── Peminjaman Buku
                  │                    ├── Pengembalian Buku
                  │                    └── Daftar Jatuh Tempo
                  │
                  └── Member ─────► Member Dashboard
                                       ├── Lihat Menu
                                       ├── Katalog Buku
                                       ├── Booking Buku
                                       ├── Riwayat Pinjaman
                                       └── Tier & Reward
```

---

## 11. Timeline Pengembangan

| Fase | Durasi | Deliverables |
|---|---|---|
| **Fase 1 — Foundation** | Minggu 1 | Setup Laravel + Tailwind + Breeze + Filament, migrasi database, seeder |
| **Fase 2 — Core F&B** | Minggu 2 | CRUD Menu, POS Kasir (Barista Panel), Transaksi |
| **Fase 3 — Core Library** | Minggu 3 | CRUD Buku, Peminjaman, Pengembalian, Denda |
| **Fase 4 — Member Experience** | Minggu 4 | Landing page, Katalog publik, Member dashboard, Booking buku |
| **Fase 5 — Smart Features** | Minggu 5 | Cross-selling engine, Reminder email, Scheduler |
| **Fase 6 — Polish & Deploy** | Minggu 6 | UI polishing, testing, bug fixing, deployment |

---

## 12. Risiko & Mitigasi

| Risiko | Dampak | Mitigasi |
|---|---|---|
| Race condition saat booking buku | Dua member book buku yang sama | Gunakan database locking (`lockForUpdate()`) di Laravel |
| Stok buku tidak sinkron | Data `stok_tersedia` tidak akurat | Hitung stok secara dinamis dari relasi `borrowings` dan `reservations` |
| Email tidak terkirim | Member tidak tahu deadline | Logging notifikasi + tampilkan deadline juga di dashboard member |
| FilamentPHP learning curve | Memperlambat development | Mulai dari panel sederhana, tingkatkan kompleksitas bertahap |

---

## 13. Metrik Keberhasilan

| Metrik | Target |
|---|---|
| **Waktu load halaman** | < 2 detik |
| **Uptime** | ≥ 99% |
| **Tingkat pengembalian buku tepat waktu** | ≥ 95% |
| **Portofolio score** | Menampilkan minimal 5 fitur teknis berbeda (Auth, CRUD, POS, Scheduling, Multi-role) |

---

> **CATATAN:** Dokumen ini adalah Draft v1. Semua spesifikasi dapat berubah setelah diskusi dan review lebih lanjut. Fitur pada kategori "Could Have" dan "Won't Have" tidak akan diimplementasikan di versi pertama.

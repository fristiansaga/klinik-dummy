# Panduan Instalasi & Eksekusi Sistem Informasi Klinik PUSDIKZI
## (Laravel 11 + Livewire v3 + MySQL)

Dokumen ini berisi panduan langkah demi langkah untuk menjalankan backend **Laravel 11** dengan **Livewire v3** yang telah disiapkan untuk **Sistem Informasi Klinik Pratama PUSDIKZI**.

---

### 1. Persyaratan Sistem (Prerequisites)

Untuk menjalankan Laravel dan Livewire di komputer Windows Anda, pastikan telah menginstall:
1. **Web Server & Database**: Disarankan menggunakan **Laragon** (paling mudah) atau **XAMPP**.
   - Download Laragon: [https://laragon.org/download/](https://laragon.org/download/)
   - Atau XAMPP: [https://www.apachefriends.org/](https://www.apachefriends.org/)
2. **PHP**: Versi **8.2** atau **8.3**
3. **Composer**: [https://getcomposer.org/download/](https://getcomposer.org/download/)

---

### 2. Struktur Modul Livewire yang Telah Dibuat

Semua kode Laravel & Livewire sudah selesai disusun di folder `laravel-klinik/`:

```
laravel-klinik/
├── app/
│   ├── Livewire/
│   │   ├── DashboardKlinik.php        <-- Statistik & KPI Pelayanan
│   │   ├── PendaftaranPasien.php      <-- Registrasi Pasien & Auto No RM
│   │   ├── DisplayAntrian.php         <-- Layar Display Panggilan Real-Time
│   │   ├── PemeriksaanDokter.php      <-- E-Rekam Medis SOAP & ICD-10 & e-Resep
│   │   ├── ApotekFarmasi.php          <-- Antrian Resep & Pengurangan Stok
│   │   └── KasirPembayaran.php        <-- Billing Biaya & Struk Kwitansi
│   └── Models/
│       ├── Pasien.php, Poli.php, Dokter.php, Antrian.php,
│       ├── RekamMedis.php, Obat.php, ResepDetail.php, Transaksi.php
├── database/
│   ├── migrations/                    <-- Skema 8 Tabel Medis MySQL
│   └── seeders/DatabaseSeeder.php     <-- Data Awal Dokter, Poli, Obat & Pasien
├── resources/views/
│   ├── layouts/app.blade.php          <-- Layout Modern Glassmorphic
│   └── livewire/                      <-- Tampilan 6 Modul Livewire
└── routes/
    ├── web.php                        <-- Route Halaman Livewire
    └── api.php                        <-- REST API untuk Mobile / Eksternal
```

---

### 3. Langkah Menjalankan Proyek Laravel + Livewire

#### **Cara Termudah (Menggunakan Laravel Fresh Project):**

1. Buka Terminal / PowerShell di folder yang Anda inginkan (misal `e:/`):
   ```powershell
   composer create-project laravel/laravel klinik-pusdikzi
   cd klinik-pusdikzi
   ```

2. Install **Livewire v3**:
   ```powershell
   composer require livewire/livewire
   ```

3. Salin/Copy folder yang telah kita siapkan dari `laravel-klinik/` ke dalam folder `klinik-pusdikzi/`:
   - `app/Livewire/` ➔ ke `klinik-pusdikzi/app/Livewire/`
   - `app/Models/` ➔ ke `klinik-pusdikzi/app/Models/`
   - `database/migrations/` ➔ ke `klinik-pusdikzi/database/migrations/`
   - `database/seeders/` ➔ ke `klinik-pusdikzi/database/seeders/`
   - `resources/views/` ➔ ke `klinik-pusdikzi/resources/views/`
   - `routes/web.php` & `routes/api.php` ➔ ke `klinik-pusdikzi/routes/`

4. Buat Database MySQL baru di phpMyAdmin/HeidiSQL:
   - Nama database: `klinik_pusdikzi`

5. Sesuaikan file `.env` di Laravel Anda:
   ```ini
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=klinik_pusdikzi
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. Jalankan Migrasi dan Seeder Data Awal:
   ```powershell
   php artisan migrate:fresh --seed
   ```

7. Jalankan Server Laravel:
   ```powershell
   php artisan serve
   ```

8. Buka browser di alamat:
   - **Dashboard Utama**: `http://127.0.0.1:8000/`
   - **Pendaftaran Pasien**: `http://127.0.0.1:8000/pendaftaran`
   - **Layar Display Antrian**: `http://127.0.0.1:8000/antrian`
   - **Pemeriksaan Dokter (SOAP)**: `http://127.0.0.1:8000/pemeriksaan`
   - **Apotek & Farmasi**: `http://127.0.0.1:8000/farmasi`
   - **Kasir & Kwitansi**: `http://127.0.0.1:8000/kasir`

---

### 4. Fitur Reaktif Livewire yang Tersedia

1. **Auto-Polling Display Antrian**: Menggunakan `wire:poll.3s` pada layar antrian sehingga saat dokter memanggil pasien, layar di ruang tunggu langsung berganti otomatis tanpa reload browser.
2. **Dynamic Search & Pagination**: Pencarian pasien terdaftar dengan debounce 300ms tanpa me-refresh halaman.
3. **e-Resep Interaktif**: Dokter dapat menambah beberapa obat secara instan ke tabel resep sebelum disimpan.
4. **Billing Otomatis**: Kasir otomatis menghitung biaya konsultasi, tindakan medis, dan total obat dari rekam medis dokter.

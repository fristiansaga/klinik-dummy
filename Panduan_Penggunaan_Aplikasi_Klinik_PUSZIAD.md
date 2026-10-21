# 🏥 PANDUAN LENGKAP PENGGUNAAN APLIKASI SISTEM INFORMASI KLINIK PRATAMA PUSDIKZI
*(Dokumen Panduan Operasional Resmi — Siap Disalin & Diimpor ke Google Docs)*

---

## 📑 DAFTAR ISI
1. [Tentang Sistem Informasi KLINIK PRATAMA PUSDIKZI](#1-tentang-sistem-informasi-klinik-pratama-pusdikzi)
2. [Cara Membuka & Masuk ke Sistem (Login Multi-Role)](#2-cara-membuka--masuk-ke-sistem-login-multi-role)
3. [Panduan Pasien & Pengunjung Publik](#3-panduan-pasien--pengunjung-publik)
   - 3.1. [Ambil Antrean Cepat Tanpa Login](#31-ambil-antrean-cepat-tanpa-login)
   - 3.2. [Booking Jadwal Konsultasi Dokter](#32-booking-jadwal-konsultasi-dokter)
   - 3.3. [Personal Health Hub & Health Passport](#33-personal-health-hub--health-passport)
   - 3.4. [Memantau Antrean Real-Time](#34-memantau-antrean-real-time)
   - 3.5. [Fitur Medication Streak (Pengingat Minum Obat)](#35-fitur-medication-streak-pengingat-minum-obat)
   - 3.6. [Melihat E-Resep & Riwayat Tagihan](#36-melihat-e-resep--riwayat-tagihan)
   - 3.7. [Menggunakan Pusat Bantuan & FAQ](#37-menggunakan-pusat-bantuan--faq)
4. [Panduan Dokter (Clinical Workspace)](#4-panduan-dokter-clinical-workspace)
   - 4.1. [Daftar Antrean Prioritas Pasien (Predictive Triage)](#41-daftar-antrean-prioritas-pasien-predictive-triage)
   - 4.2. [Pemeriksaan EMR SOAP & Pencarian ICD-10](#42-pemeriksaan-emr-soap--pencarian-icd-10)
   - 4.3. [Pembuatan E-Resep & Cek Otomatis Interaksi Obat](#43-pembuatan-e-resep--cek-otomatis-interaksi-obat)
   - 4.4. [Melihat Riwayat Medis Pasien Terdahulu](#44-melihat-riwayat-medis-pasien-terdahulu)
5. [Panduan Kasir (Smart Billing Counter)](#5-panduan-kasir-smart-billing-counter)
   - 5.1. [Memproses Tagihan Pasien](#51-memproses-tagihan-pasien)
   - 5.2. [Metode Pembayaran (Tunai, QRIS, Transfer, Asuransi)](#52-metode-pembayaran-tunai-qris-transfer-asuransi)
   - 5.3. [Mencetak Struk Resmi & Menyimpan PDF](#53-mencetak-struk-resmi--menyimpan-pdf)
   - 5.4. [Rekapitulasi Kas Shift Harian](#54-rekapitulasi-kas-shift-harian)
6. [Panduan Apoteker (Pharmacy Module)](#6-panduan-apoteker-pharmacy-module)
   - 6.1. [Penerimaan E-Resep dari Dokter](#61-penerimaan-e-resep-dari-dokter)
   - 6.2. [Pengecekan Stok Obat & Peringatan Stok Menipis](#62-pengecekan-stok-obat--peringatan-stok-menipis)
   - 6.3. [Penyerahan Obat ke Pasien](#63-penyerahan-obat-ke-pasien)
7. [Panduan Administrator (Command Center)](#7-panduan-administrator-command-center)
   - 7.1. [Dashboard KPI & Analitik Operasional](#71-dashboard-kpi--analitik-operasional)
   - 7.2. [Manajemen Hak Akses Pengguna (RBAC)](#72-manajemen-hak-akses-pengguna-rbac)
   - 7.3. [Manajemen Master Data (Dokter, Poli, Obat)](#73-manajemen-master-data-dokter-poli-obat)
   - 7.4. [Audit Log Keamanan & Integrasi SATUSEHAT](#74-audit-log-keamanan--integrasi-satusehat)
8. [Panduan Khusus Penggunaan di HP / Smartphone](#8-panduan-khusus-penggunaan-di-hp--smartphone)
9. [Fitur Pintas (Command Palette Ctrl+K & Mode Gelap)](#9-fitur-pintas-command-palette-ctrlk--mode-gelap)

---

## 1. Tentang Sistem Informasi KLINIK PRATAMA PUSDIKZI

**Sistem Informasi KLINIK PRATAMA PUSDIKZI** adalah platform rekam medis elektronik terpadu (*Integrated Electronic Medical Record & Hospital Management System*) yang dirancang untuk mendukung operasional klinik modern berstandar akreditasi Kemenkes RI.

### Fitur Kunci:
- **Cloud Digital EMR:** SOAP terstandar, integrasi koding ICD-10 otomatis, dan riwayat klinis longitudinal.
- **Health Passport Pasien:** Ringkasan tanda vital, golongan darah, alergi, dan streak kepatuhan obat.
- **Smart Queueing:** Antrean real-time dengan prediksi waktu tunggu dan triase prioritas.
- **Smart Billing & Farmasi:** Penghitungan tagihan otomatis terintegrasi langsung antara tindakan dokter dan obat apotek.
- **Interoperabilitas SATUSEHAT & BPJS:** Siap integrasi standar FHIR HL7 Kemenkes.

---

## 2. Cara Membuka & Masuk ke Sistem (Login Multi-Role)

### A. Membuka Aplikasi
1. Buka browser (Google Chrome, Microsoft Edge, Safari, atau Firefox).
2. Buka alamat sistem klinik (contoh: `http://localhost:8085` atau URL domain server klinik).

### B. Masuk ke Akun (Login)
1. Klik tombol **Login Sistem** di pojok kanan atas layar (atau tab **Login** di menu bawah HP).
2. Sistem menyediakan 5 role utama:
   - 👤 **Pasien:** Mengakses Health Passport, riwayat berobat, jadwal dokter, dan booking antrean.
   - 🩺 **Dokter:** Mengakses daftar antrean pemeriksaan, input EMR SOAP, dan pembuatan E-Resep.
   - 💳 **Kasir:** Memproses pembayaran tagihan tindakan & obat serta cetak kuitansi.
   - 💊 **Apoteker:** Validasi resep dokter, penyerahan obat, dan stok inventori farmasi.
   - 🛡️ **Administrator:** Monitoring KPI klinik, audit log, master data, dan integrasi SATUSEHAT.
3. Untuk keperluan demonstrasi cepat, klik tombol **Quick Demo 1-Klik Access** pada role yang diinginkan (misal: *Login Pasien*, *Login Dokter*, dst.).

---

## 3. Panduan Pasien & Pengunjung Publik

### 3.1. Ambil Antrean Cepat di Homepage (Bagi Pasien yang Belum Memiliki Akun)
Fitur ini dirancang khusus untuk mempermudah pasien baru, lansia, atau pasien darurat/walk-in yang datang langsung ke klinik tanpa harus registrasi atau menginstal aplikasi terlebih dahulu:
1. Buka halaman awal (**Homepage**) klinik di HP atau layar monitor pendaftaran mandiri.
2. Scroll ke bagian kartu **Ambil Antrean Cepat**.
3. Masukkan **Nama Lengkap atau NIK KTP**.
4. Pilih **Poliklinik Tujuan** (Poli Penyakit Dalam, Gigi, Umum, KIA, Mata, Anak).
5. Klik tombol **"Ambil Nomor Sekarang"**.
6. **Tiket Terbit Instan:** Sistem langsung menerbitkan nomor antrean resmi (misal: `A-012`) lengkap dengan info nomor yang sedang dipanggil saat ini (`A-011`) dan perkiraan jam layanan.
7. **Pendaftaran Otomatis:** Jika NIK belum pernah terdaftar di rekam medis klinik, sistem akan memunculkan formulir ringkas instan (NIK, No BPJS, TTL, TB/BB) untuk langsung dibuatkan akun rekam medis digital secara otomatis tanpa perlu antre di loket administrasi manual.

### 3.2. Booking Jadwal Konsultasi Dokter
Untuk menjadwalkan kunjungan pada hari berikutnya:
1. Klik tombol **Booking Sekarang** di banner utama atau menu **Booking** di navigasi.
2. Pilih poliklinik dan dokter spesialis yang bertugas.
3. Tentukan tanggal kunjungan dan jam periksa yang tersedia.
4. Klik **Konfirmasi Booking**. Notifikasi jadwal akan tersimpan di akun Anda.

### 3.3. Personal Health Hub & Health Passport
Setelah login sebagai Pasien, Anda akan masuk ke halaman **Health Passport Pasien**:
- **Tanda Vital:** Memantau Tekanan Darah terakhir, Detak Jantung (*Heart Rate*), Saturasi Oksigen ($SpO_2$), dan Suhu Tubuh.
- **Identitas Medis:** Menampilkan Nomor Rekam Medis (No. RM), NIK, Golongan Darah, dan Riwayat Alergi Obat.
- **Grafik Tren Kesehatan:** Melihat grafik riwayat tekanan darah sistolik dan diastolik dari kunjungan-kunjungan sebelumnya.

### 3.4. Memantau Antrean Real-Time
1. Klik menu **Antrean Real-time** pada sidebar (atau tab **Antrean** di HP).
2. Anda dapat melihat:
   - Nomor antrean Anda sendiri.
   - Nomor antrean yang sedang diperiksa dokter saat ini di ruang poli.
   - Perkiraan sisa waktu tunggu (menit).
   - Indikator progres antrean interaktif.

### 3.5. Fitur Medication Streak (Pengingat Minum Obat)
Fitur gamifikasi kesehatan untuk memotivasi pasien rutin mengonsumsi obat:
1. Buka menu **Resep & Medication Streak**.
2. Lihat daftar obat aktif beserta aturan pakainya (misal: *1x1 Pagi setelah makan*).
3. Setelah meminum obat, klik tombol **"Check-in Minum Obat"**.
4. Jumlah hari *streak* (konsistensi) Anda akan bertambah (misal: `🔥 8 Hari Kepatuhan`).

### 3.6. Melihat E-Resep & Riwayat Tagihan
- **Resep Digital:** Melihat rincian nama obat, jumlah tablet, dosis, dan petunjuk dokter tanpa perlu membawa kertas fisik.
- **Riwayat Tagihan:** Melihat kuitansi invoice pembayaran perawatan sebelumnya dan mengunduh struk bukti bayar dalam bentuk PDF.

### 3.7. Menggunakan Pusat Bantuan & FAQ
1. Klik ikon **Bantuan (?)** melayang di pojok kanan bawah layar.
2. Panel **Pusat Bantuan & FAQ** akan terbuka.
3. Anda dapat memilih tombol topik cepat (*Jam Operasional, Syarat BPJS, Cara Booking, Peta Lokasi*) atau mengetik pertanyaan bebas di kolom pesan.

---

## 4. Panduan Dokter (Clinical Workspace)

### 4.1. Daftar Antrean Prioritas Pasien (Predictive Triage)
1. Masuk sebagai **Dokter** (`DOC-001`).
2. Masuk ke menu **Beranda Praktik** atau **Antrean Pemeriksaan**.
3. Sistem secara otomatis menyusun urutan pasien berdasarkan tingkat keparahan/urgensi klinis:
   - 🔴 **Urgensi Tinggi (Merah):** Pasien dengan keluhan berat / tanda vital tidak stabil (diprioritaskan pertama).
   - 🟡 **Urgensi Sedang (Kuning):** Pasien dengan demam atau keluhan akut.
   - 🟢 **Urgensi Rendah (Hijau):** Pasien kontrol rutin.
4. Klik tombol **Panggil & Periksa** pada pasien yang akan dilayani.

### 4.2. Pemeriksaan EMR SOAP & Pencarian ICD-10
Pada halaman **Ruang Periksa EMR**:
1. **S (Subjektif):** Tuliskan anamnesa, keluhan utama pasien, dan riwayat perjalanan penyakit.
2. **O (Objektif):** Masukkan hasil pemeriksaan fisik, tensi darah, nadi, laju nafas, dan suhu.
3. **A (Asesmen / Diagnosa):** 
   - Ketik nama penyakit atau kode pada kolom pencarian ICD-10 (contoh: ketik `I10` untuk *Hypertension*, `E11` untuk *Diabetes Mellitus*, atau `J06` untuk *ISPA*).
   - Klik kode diagnosa yang sesuai untuk memasukkannya ke rekam medis pasien.
4. **P (Plan / Rencana Terapi):** Tuliskan edukasi dan tindakan medis yang diberikan.

### 4.3. Pembuatan E-Resep & Cek Otomatis Interaksi Obat
1. Pada bagian resep, pilih obat dari katalog master data (misal: *Amlodipine 10mg, Paracetamol 500mg, Simvastatin 20mg*).
2. Tentukan dosis dan aturan pakai.
3. Klik tombol **"Cek Interaksi Obat Auto"**:
   - Sistem akan otomatis mendeteksi apakah obat yang diresepkan memiliki kontraindikasi atau interaksi berbahaya dengan obat lain atau riwayat alergi pasien.
4. Klik **Simpan EMR & Kirim Resep ke Apotek**. Pasien dan petugas apotek akan langsung menerima data secara instan.

### 4.4. Melihat Riwayat Medis Pasien Terdahulu
Klik menu **Riwayat Pasien** untuk melihat catatan kunjungan masa lalu pasien, hasil diagnosa terdahulu, dan terapi obat yang pernah diberikan.

---

## 5. Panduan Kasir (Smart Billing Counter)

### 5.1. Memproses Tagihan Pasien
1. Masuk sebagai **Kasir** (`kasir_rina`).
2. Masuk ke menu **Antrean Pembayaran** atau **Kasir & Billing**.
3. Klik pada nama pasien atau nomor invoice yang berstatus *Menunggu Pembayaran* (misal: `INV/20260727/001 - Bambang Soeprapto`).
4. Panel rincian tagihan akan otomatis menghitung:
   - Jasa Konsultasi Dokter Spesialis.
   - Biaya Tindakan Medis / Administrasi.
   - Rincian Total Harga Obat dari Apotek.
   - Potongan / Penjaminan (BPJS Kesehatan / Asuransi Rekanan).

### 5.2. Metode Pembayaran
Pilih metode bayar yang digunakan pasien:
- 💵 **Tunai (Cash):** Masukkan nominal uang yang diterima, sistem otomatis menghitung uang kembalian.
- 📱 **QRIS:** Sistem memunculkan kode QRIS statis/dinamis untuk dipindai melalui mobile banking pasien.
- 💳 **Debit / Kartu Kredit:** Masukkan nomor referensi mesin EDC.
- 🏢 **Klaim BPJS / Asuransi:** Menandai tagihan sebagai klaim penjaminan.

### 5.3. Mencetak Struk Resmi & Menyimpan PDF
1. Setelah pembayaran diverifikasi, klik tombol **"Proses Bayar & Terbitkan Kuitansi"**.
2. Modal pratinjau struk resmi KLINIK PRATAMA PUSDIKZI akan muncul dengan format rapi.
3. Klik tombol **Cetak / Simpan PDF** untuk mencetak ke printer thermal / printer kuitansi atau menyimpannya sebagai file digital.

### 5.4. Rekapitulasi Kas Shift Harian
Klik menu **Rekap Kas Shift** untuk melihat total uang masuk per metode pembayaran (Tunai vs Non-Tunai) selama shift berlangsung sebelum melakukan serah terima kasir.

---

## 6. Panduan Apoteker (Pharmacy Module)

### 6.1. Penerimaan E-Resep dari Dokter
1. Masuk sebagai **Apoteker** (`apoteker_budi`).
2. Buka menu **Resep Digital (E-Resep)**.
3. Resep dari dokter yang baru saja selesai diperiksa akan otomatis muncul dengan status *"Siap Diracik"*.
4. Apoteker tidak perlu lagi membaca tulisan tangan dokter, mencegah kesalahan interpretasi obat (*Medication Error*).

### 6.2. Pengecekan Stok Obat & Peringatan Stok Menipis
1. Buka menu **Manajemen Stok Obat**.
2. Lihat status ketersediaan obat:
   - 🟢 **Aman:** Stok di atas batas minimum.
   - 🔴 **Kritis (Low Stock):** Stok tersisa sedikit (misal: di bawah 50 tablet).
3. Untuk menambah persediaan obat yang baru datang dari distributor, klik tombol **Tambah Obat Baru / Update Stok**.

### 6.3. Penyerahan Obat ke Pasien
1. Siapkan obat sesuai etiket dan dosis yang tertera.
2. Panggil nama pasien dan klik tombol **"Serahkan Obat & Selesai"**.
3. Status obat pasien di akun Health Hub pasien otomatis berubah menjadi *"Obat Siap Dikonsumsi"*.

---

## 7. Panduan Administrator (Command Center)

### 7.1. Dashboard KPI & Analitik Operasional
1. Masuk sebagai **Admin** (`admin_pusdikzi`).
2. Halaman **Command Center KPI** menampilkan ringkasan performa klinik secara real-time:
   - Jumlah total kunjungan pasien hari ini.
   - Waktu tunggu rata-rata pasien (*Average Waiting Time*).
   - Tingkat kepuasan pasien (*Patient Satisfaction Score*).
   - Total pendapatan klinik harian dan bulanan.
   - Grafik persebaran kunjungan antar poliklinik.

### 7.2. Manajemen Hak Akses Pengguna (RBAC)
Buka menu **Manajemen RBAC** untuk:
- Mengatur level otoritas dokter, perawat, kasir, apoteker, dan staf registrasi.
- Mengaktifkan atau menonaktifkan akun staf yang sedang cuti atau mutasi.

### 7.3. Manajemen Master Data (Dokter, Poli, Obat)
Buka menu **Master Data**:
- **Tab Dokter:** Menambah data dokter baru, spesialisasi, nomor SIP, foto profil, dan jadwal dinas.
- **Tab Poliklinik:** Mengatur kuota antrean per hari dan tarif layanan dasar poli.
- **Tab Obat:** Mengedit harga obat eceran tertinggi (HET) dan kategori obat (Keras, Bebas, Antibiotik).

### 7.4. Audit Log Keamanan & Integrasi SATUSEHAT
- **Audit Log System:** Merekam jejak digital setiap aksi (siapa yang mengubah rekam medis, jam berapa faktur diterbitkan, dan riwayat login).
- **Integrasi SATUSEHAT & BPJS:** Memeriksa status sinkronisasi API Kemenkes RI (indikator hijau menandakan server terhubung normal).

---

## 8. Panduan Khusus Penggunaan di HP / Smartphone

Aplikasi telah dioptimalkan secara khusus untuk smartphone Android dan iPhone:

1. **Bottom Navigation Bar (Menu Bawah):**  
   Gunakan menu navigasi di bagian bawah layar untuk berpindah modul utama dengan sentuhan ibu jari.
2. **Menu Drawer Geser Samping:**  
   Tekan tombol **Menu (☰)** di menu navigasi bawah atau ikon tiga garis di pojok kiri atas untuk membuka seluruh daftar menu aplikasi.
3. **Sentuh Luar untuk Menutup:**  
   Ketuk di luar area drawer untuk kembali ke lembar kerja utama.
4. **Formulir Responsif:**  
   Seluruh kolom isian formulir otomatis tersusun satu kolom yang nyaman diketik pada keyboard virtual layar sentuh.

---

## 9. Fitur Pintas (Command Palette & Mode Tampilan)

- 🔍 **Command Palette (Ctrl + K):**  
  Tekan `Ctrl + K` pada keyboard laptop/komputer untuk membuka jendela pencarian kilat. Ketik nama menu, nama dokter, atau nama pasien untuk langsung berpindah halaman dalam hitungan detik.
- 🌓 **Mode Terang / Gelap (Light / Dark Theme):**  
  Tekan ikon **Bulan / Matahari** di bar atas untuk menyesuaikan kenyamanan mata saat bekerja di ruangan terang maupun shift malam.

---

> 💡 **Cara Membuka / Menyimpan ke Google Docs:**  
> 1. Salin (*Copy*) seluruh isi teks dokumen ini (`Ctrl + A` lalu `Ctrl + C`).  
> 2. Buka dokumen baru di Google Docs ([docs.new](https://docs.new)).  
> 3. Tempel (*Paste*) teks (`Ctrl + V`). Format heading, tabel, dan daftar poin akan langsung tertata rapi secara otomatis.

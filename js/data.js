/* ==========================================================================
   KLINIK PRATAMA PUSDIKZI - Master Data Store & Indonesian Medical Dummy Datasets
   ========================================================================== */

window.KlinikData = {
  // Klinik General Info
  info: {
    nama: "KLINIK PRATAMA PUSDIKZI",
    tagline: "Layanan Kesehatan Terpadu, Modern & Terpercaya",
    alamat: "Jl. Jenderal Sudirman No. 35, Pabaton, Kecamatan Bogor Tengah, Kota Bogor",
    telepon: "(0251) 832-1234 / 0812-9988-7766",
    email: "info@klinikpusdikzi.go.id",
    sip: "503/123/DISKES/2024",
    izin: "440/PUSDIKZI/2025",
    operasional: "Senin - Sabtu: 07.00 - 21.00 WIB | IGD 24 Jam"
  },

  // Poli List
  poliList: [
    { id: "umum", nama: "Poli Umum", icon: "stethoscope", deskripsi: "Pemeriksaan kesehatan umum, diagnosa awal, dan konsultasi dokter keluarga." },
    { id: "gigi", nama: "Poli Gigi & Mulut", icon: "smile", deskripsi: "Perawatan gigi, penambalan, pembersihan karang gigi (scalling), dan bedah mulut sederhana." },
    { id: "kia", nama: "Poli KIA & Kebidanan", icon: "heart", deskripsi: "Pemeriksaan kehamilan (ANC), USG 4D, imunisasi bayi, dan program keluarga berencana." },
    { id: "spesialis_dalam", nama: "Poli Spesialis Penyakit Dalam", icon: "activity", deskripsi: "Penanganan penyakit kronis seperti Hipertensi, Diabetes Melitus, Kolesterol, dan Jantung." },
    { id: "anak", nama: "Poli Anak (Pediatri)", icon: "users", deskripsi: "Konsultasi tumbuh kembang anak, vaksinasi lengkap, dan penanganan demam/infeksi anak." },
    { id: "mata", nama: "Poli Mata", icon: "eye", deskripsi: "Pemeriksaan refraksi kacamata, tekanan bola mata, dan perawatan infeksi mata." }
  ],

  // Doctor Catalog
  dokterList: [
    {
      id: "DOC-001",
      nama: "dr. Ahmad Ridwan, Sp.PD",
      spesialis: "Spesialis Penyakit Dalam",
      poliId: "spesialis_dalam",
      rating: 4.9,
      pengalaman: "12 Tahun",
      foto: "assets/images/doctor_headshot_pro.png",
      jadwal: "Senin - Kamis (08.00 - 14.00)",
      alumni: "FK Universitas Indonesia",
      str: "31.1.1.100.2.18.098765"
    },
    {
      id: "DOC-002",
      nama: "drg. Anisa Rahmawati",
      spesialis: "Dokter Gigi",
      poliId: "gigi",
      rating: 4.8,
      pengalaman: "8 Tahun",
      foto: "assets/images/doctor_headshot_pro.png",
      jadwal: "Senin - Sabtu (13.00 - 18.00)",
      alumni: "FKG Universitas Padjadjaran",
      str: "32.2.1.200.3.19.123456"
    },
    {
      id: "DOC-003",
      nama: "dr. Siti Zulaikha, Sp.A",
      spesialis: "Spesialis Anak",
      poliId: "anak",
      rating: 5.0,
      pengalaman: "15 Tahun",
      foto: "assets/images/doctor_headshot_pro.png",
      jadwal: "Selasa, Kamis, Sabtu (09.00 - 15.00)",
      alumni: "FK Universitas Gadjah Mada",
      str: "33.1.2.100.1.15.543210"
    },
    {
      id: "DOC-004",
      nama: "dr. Budi Santoso",
      spesialis: "Dokter Umum",
      poliId: "umum",
      rating: 4.7,
      pengalaman: "6 Tahun",
      foto: "assets/images/doctor_headshot_pro.png",
      jadwal: "Setiap Hari (07.00 - 21.00 - Shift)",
      alumni: "FK Universitas Airlangga",
      str: "35.1.1.300.4.20.987123"
    }
  ],

  // ICD-10 Diagnoses Database
  icd10Database: [
    { code: "I10", name: "Essential (primary) hypertension", category: "Kardiovaskular" },
    { code: "E11", name: "Type 2 diabetes mellitus", category: "Endokrin" },
    { code: "J00", name: "Acute nasopharyngitis [common cold]", category: "Respirasi" },
    { code: "K29.7", name: "Gastritis, unspecified", category: "Pencernaan" },
    { code: "J45.9", name: "Asthma, unspecified", category: "Respirasi" },
    { code: "M54.5", name: "Low back pain", category: "Muskuloskeletal" },
    { code: "E78.5", name: "Hyperlipidemia, unspecified", category: "Endokrin" },
    { code: "A09", name: "Infectious gastroenteritis and colitis", category: "Infeksi" },
    { code: "H10.1", name: "Acute atopic conjunctivitis", category: "Mata" },
    { code: "K02.9", name: "Dental caries, unspecified", category: "Gigi & Mulut" }
  ],

  // ICD-9 CM Procedures Database
  icd9Database: [
    { code: "89.07", name: "General medical examination" },
    { code: "23.09", name: "Tooth extraction, unspecified" },
    { code: "96.54", name: "Dental scaling and polishing" },
    { code: "88.72", name: "Diagnostic ultrasound of heart (Echocardiography)" },
    { code: "90.59", name: "Microscopic examination of blood" },
    { code: "99.21", name: "Injection of antibiotic" }
  ],

  // Drug Catalog & Inventory with Interaction Matrix
  obatList: [
    { id: "OBT-001", nama: "Amlodipine 10mg", kategori: "Antihipertensi", stok: 450, satuan: "Tablet", harga: 1500, minStok: 100, exp: "2027-11-20", interactWith: ["OBT-005"] },
    { id: "OBT-002", nama: "Metformin 500mg", kategori: "Antidiabetes", stok: 620, satuan: "Tablet", harga: 2000, minStok: 150, exp: "2028-03-15", interactWith: [] },
    { id: "OBT-003", nama: "Paracetamol 500mg", kategori: "Analgesik/Antipiretik", stok: 1200, satuan: "Kaplet", harga: 800, minStok: 200, exp: "2027-08-10", interactWith: [] },
    { id: "OBT-004", nama: "Amoxicillin 500mg", kategori: "Antibiotik", stok: 85, satuan: "Kaplet", harga: 3500, minStok: 100, exp: "2026-10-05", interactWith: [] }, // Critical stock
    { id: "OBT-005", nama: "Simvastatin 20mg", kategori: "Antihiperlipidemia", stok: 310, satuan: "Tablet", harga: 4000, minStok: 80, exp: "2027-05-30", interactWith: ["OBT-001"] },
    { id: "OBT-006", nama: "Cefadroxil 500mg", kategori: "Antibiotik", stok: 40, satuan: "Kapsul", harga: 5000, minStok: 100, exp: "2026-09-12", interactWith: [] } // Warning stock
  ],

  // Patient Database (Health Passport Vitals & Medical History)
  pasienList: [
    {
      id: "PAS-2026-001",
      nama: "Bambang Soeprapto",
      nik: "3175081205780001",
      tglLahir: "1978-05-12",
      gender: "Laki-laki",
      noHp: "0812-3456-7890",
      golDarah: "O+",
      tinggi: 172,
      berat: 74,
      bpjs: "0001234567890",
      alergi: "Penisilin, Udang",
      streakObat: 7,
      badge: "Rajin Kontrol 3x Berturut-turut ⭐",
      vitalsTrend: {
        sistol: [135, 130, 128, 122],
        diastol: [88, 85, 82, 80],
        dates: ["Apr", "Mei", "Jun", "Jul"]
      },
      rekamMedis: [
        { tgl: "2026-07-10", doctor: "dr. Ahmad Ridwan, Sp.PD", poli: "Spesialis Penyakit Dalam", diagnosis: "Essential Hypertension (I10)", resep: "Amlodipine 10mg (1x1)", catatan: "Tekanan darah mulai stabil. Lanjutkan diet rendah garam." },
        { tgl: "2026-06-08", doctor: "dr. Budi Santoso", poli: "Poli Umum", diagnosis: "Acute Nasopharyngitis (J00)", resep: "Paracetamol 500mg (3x1)", catatan: "Istirahat cukup dan minum air hangat." }
      ]
    },
    {
      id: "PAS-2026-002",
      nama: "Siti Rahmawati",
      nik: "3175024409850003",
      tglLahir: "1985-09-24",
      gender: "Perempuan",
      noHp: "0857-1122-3344",
      golDarah: "A+",
      tinggi: 160,
      berat: 58,
      bpjs: "0009876543210",
      alergi: "Tidak Ada",
      streakObat: 12,
      badge: "Pasien Teladan 🏅",
      vitalsTrend: {
        sistol: [118, 120, 115, 116],
        diastol: [78, 79, 76, 75],
        dates: ["Apr", "Mei", "Jun", "Jul"]
      },
      rekamMedis: [
        { tgl: "2026-07-02", doctor: "drg. Anisa Rahmawati", poli: "Poli Gigi", diagnosis: "Dental Scaling (96.54)", resep: "Paracetamol 500mg (prn)", catatan: "Pembersihan karang gigi selesai tanpa komplikasi." }
      ]
    }
  ],

  // Queue Data (Doctor & Cashier Queue)
  antreanAktif: [
    { no: "A-001", nama: "Bambang Soeprapto", poli: "Poli Spesialis Penyakit Dalam", dokter: "dr. Ahmad Ridwan, Sp.PD", urgensi: "Tinggi", waktu: "09.15 WIB", status: "Sedang Diperiksa", keluhan: "Kontrol Hipertensi rutin, agak pusing sejak kemarin malam." },
    { no: "A-002", nama: "Dewi Lestari", poli: "Poli Umum", dokter: "dr. Budi Santoso", urgensi: "Sedang", waktu: "09.30 WIB", status: "Menunggu", keluhan: "Demam 38.2C, batuk kering 2 hari." },
    { no: "A-003", nama: "Hendra Wijaya", poli: "Poli Gigi", dokter: "drg. Anisa Rahmawati", urgensi: "Rutin", waktu: "09.45 WIB", status: "Menunggu", keluhan: "Gigi geraham kanan bawah ngilu saat minum dingin." },
    { no: "A-004", nama: "Siti Rahmawati", poli: "Poli Anak", dokter: "dr. Siti Zulaikha, Sp.A", urgensi: "Sedang", waktu: "10.00 WIB", status: "Menunggu", keluhan: "Vaksinasi DPT Anak usia 18 bulan." }
  ],

  // Billing Cashier Queue
  antreanBayar: [
    { invoiceNo: "INV/20260727/001", noRm: "PAS-2026-001", nama: "Bambang Soeprapto", poli: "Poli Spesialis Penyakit Dalam", total: 175000, statusVerifikasi: "Verified", items: [ { name: "Konsultasi Dokter Spesialis", Rp: 100000 }, { name: "Amlodipine 10mg (30 Tab)", Rp: 45000 }, { name: "Tindakan Cek EKG Singkat", Rp: 30000 } ] },
    { invoiceNo: "INV/20260727/002", noRm: "PAS-2026-002", nama: "Siti Rahmawati", poli: "Poli Gigi", total: 250000, statusVerifikasi: "Verified", items: [ { name: "Konsultasi Dokter Gigi", Rp: 80000 }, { name: "Tindakan Scaling Gigi Full", Rp: 170000 } ] }
  ],

  // Apotek/Pharmacy Prescriptions Queue
  resepAktif: [
    { id: "RSP-2607-001", namaPasien: "Bambang Soeprapto", dokter: "dr. Ahmad Ridwan, Sp.PD", status: "Menunggu", items: [{ namaObat: "Amlodipine 10mg", jumlah: 30, dosis: "1x1" }, { namaObat: "Simvastatin 20mg", jumlah: 30, dosis: "1x1" }] },
    { id: "RSP-2607-002", namaPasien: "Budi Santoso", dokter: "dr. Budi Santoso", status: "Menunggu", items: [{ namaObat: "Paracetamol 500mg", jumlah: 15, dosis: "3x1" }] },
    { id: "RSP-2607-003", namaPasien: "Dewi Lestari", dokter: "dr. Siti Zulaikha, Sp.A", status: "Menunggu", items: [{ namaObat: "Amoxicillin 500mg", jumlah: 15, dosis: "3x1" }] }
  ],

  // System Audit Log
  auditLogs: [
    { time: "2026-07-27 09:42:15", user: "dr. Ahmad Ridwan", action: "UPDATE_EMR", detail: "Mengisi catatan SOAP & E-Resep Pasien PAS-2026-001" },
    { time: "2026-07-27 09:30:04", user: "Kasir Rina", action: "PROCESS_PAYMENT", detail: "Menerima pembayaran QRIS Rp 250.000 (INV/20260727/002)" },
    { time: "2026-07-27 09:10:22", user: "Admin Hendra", action: "SATUSEHAT_SYNC", detail: "Sinkronisasi 14 Rekam Medis ke Portal SATUSEHAT Kemenkes - BERHASIL" },
    { time: "2026-07-27 08:00:10", user: "System Auto", action: "PO_GENERATE", detail: "Auto Purchase Order diterbitkan untuk Amoxicillin 500mg (Stok Kritis)" }
  ],

  // SATUSEHAT & BPJS Status
  integrasi: {
    satuSehatStatus: "Connected",
    satuSehatLatency: "45 ms",
    satuSehatLastSync: "2026-07-27 09:30 WIB",
    bpjsStatus: "Connected",
    bpjsBridgeVersion: "v2.4.1 (vClaim Direct)"
  },

  // FAQ Chatbot Knowledgebase
  faqChatbot: {
    "jadwal": "KLINIK PRATAMA PUSDIKZI buka Setiap Hari pukul 07.00 - 21.00 WIB. Untuk Unit Gawat Darurat (IGD) melayani 24 Jam nonstop.",
    "bpjs": "Ya! KLINIK PRATAMA PUSDIKZI menerima pasien BPJS Kesehatan (Faskes Tingkat 1 & Rujukan Spesialis). Harap membawa KTP & Kartu BPJS aktif.",
    "booking": "Anda dapat melakukan booking kunjungan secara mudah melalui dashboard Pasien di tab 'Booking Kunjungan' atau menekan tombol 'Booking Sekarang' di landing page.",
    "lokasi": "KLINIK PRATAMA PUSDIKZI berlokasi di Jl. Jenderal Sudirman No. 35, Pabaton, Kecamatan Bogor Tengah, Kota Bogor. Petunjuk arah dapat dilihat pada section Lokasi & Kontak."
  }
};

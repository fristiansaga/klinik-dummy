/* ==========================================================================
   KLINIK PRATAMA PUSDIKZI - Shared Clinical Mock Data
   ========================================================================== */

export const mockPoliklinik = [
  { id: "umum", name: "Poli Umum & MCU", doctor: "dr. Siti Rahmawati", queue: "B-012", active: true, color: "emerald", hours: "07:30 - 21:00 WIB" },
  { id: "penyakit-dalam", name: "Poli Penyakit Dalam (Sp.PD)", doctor: "dr. Agus Susanto, Sp.PD", queue: "A-003", active: true, color: "amber", hours: "08:00 - 13:00 WIB" },
  { id: "gigi", name: "Poli Gigi & Mulut", doctor: "drg. Budi Santoso", queue: "C-005", active: true, color: "orange", hours: "09:00 - 15:00 WIB" },
  { id: "kia", name: "Poli KIA, KB & Imunisasi", doctor: "Bdn. Nurhasanah, S.ST", queue: "D-002", active: true, color: "purple", hours: "08:00 - 14:00 WIB" },
  { id: "farmasi", name: "Instalasi Farmasi & Apotek", doctor: "apt. Nurul Hidayah, S.Farm", queue: "F-020", active: true, color: "teal", hours: "Siaga 24 Jam" },
  { id: "ugd", name: "IGD & Ambulans 24 Jam", doctor: "Tim Medis Emergency", queue: "EM-001", active: true, color: "rose", hours: "Siaga 24/7" }
];

export const mockPatientsQueue = [
  { no: "A-001", rm: "RM-2026-0042", name: "Kopda Bambang Trihatmojo", poli: "Poli Penyakit Dalam", status: "Selesai", type: "Dinas TNI-AD", time: "08:15" },
  { no: "A-002", rm: "RM-2026-0109", name: "Ny. Ratna Dewi", poli: "Poli Penyakit Dalam", status: "Selesai", type: "Keluarga Dinas", time: "08:40" },
  { no: "A-003", rm: "RM-2026-0312", name: "Sertu Wahyu Hidayat", poli: "Poli Penyakit Dalam", status: "Sedang Diperiksa", type: "Dinas TNI-AD", time: "09:05" },
  { no: "A-004", rm: "RM-2026-0881", name: "Bapak Achmad Nurhadi", poli: "Poli Penyakit Dalam", status: "Menunggu", type: "Umum / BPJS", time: "09:30" },
  { no: "A-005", rm: "RM-2026-0923", name: "Ibu Siti Aminah", poli: "Poli Penyakit Dalam", status: "Menunggu", type: "BPJS Kesehatan", time: "09:50" }
];

export const mockMedicinesStock = [
  { id: 1, name: "Amoxicillin 500mg", batch: "AMX-202608", inbound: "2026-01-10", expiry: "2027-08-15", stock: 120, min: 30, price: 12000, status: "Aman", cat: "Antibiotik" },
  { id: 2, name: "Paracetamol 500mg", batch: "PCT-202611", inbound: "2026-02-14", expiry: "2028-02-01", stock: 450, min: 100, price: 5000, status: "Aman", cat: "Analgesik" },
  { id: 3, name: "Metformin 500mg", batch: "MTF-202604", inbound: "2025-11-20", expiry: "2026-09-30", stock: 65, min: 40, price: 18000, status: "Waspada FEFO (< 30 Hari)", cat: "Antidiabetes" },
  { id: 4, name: "Amlodipine 10mg", batch: "AML-202609", inbound: "2026-03-01", expiry: "2027-11-20", stock: 180, min: 50, price: 22000, status: "Aman", cat: "Antihipertensi" },
  { id: 5, name: "Antasida Doen Susp", batch: "ATS-202601", inbound: "2025-10-05", expiry: "2026-08-31", stock: 8, min: 20, price: 9000, status: "Kritis (< 7 Hari)", cat: "Antasida" }
];

export const mockTarifMaster = [
  { id: 1, code: "TAR-001", name: "Konsultasi & Pemeriksaan Dokter Spesialis", bpjs: 0, umum: 75000, poli: "Poli Penyakit Dalam" },
  { id: 2, code: "TAR-002", name: "Pemeriksaan Dokter Umum & MCU Ringan", bpjs: 0, umum: 35000, poli: "Poli Umum" },
  { id: 3, code: "TAR-003", name: "Penambalan Gigi Komposit Sinar / Kavitas", bpjs: 0, umum: 150000, poli: "Poli Gigi" },
  { id: 4, code: "TAR-004", name: "Pembersihan Karang Gigi (Scaling Penuh)", bpjs: 0, umum: 120000, poli: "Poli Gigi" },
  { id: 5, code: "TAR-005", name: "Pemeriksaan Glukosa Darah POCT (GDS)", bpjs: 0, umum: 20000, poli: "Laboratorium POCT" },
  { id: 6, code: "TAR-006", name: "Pemeriksaan Kolesterol Total POCT", bpjs: 0, umum: 35000, poli: "Laboratorium POCT" },
  { id: 7, code: "TAR-007", name: "Pemeriksaan Asam Urat POCT", bpjs: 0, umum: 25000, poli: "Laboratorium POCT" },
  { id: 8, code: "TAR-008", name: "Penerbitan Surat Keterangan Dokter (SKBS)", bpjs: 15000, umum: 25000, poli: "Poli Umum" }
];

export const mockIcd10 = [
  { code: "J00", name: "Acute nasopharyngitis (Common Cold / Flu)" },
  { code: "I10", name: "Essential (primary) hypertension" },
  { code: "K30", name: "Dyspepsia (Gangguan Lambung)" },
  { code: "E11", name: "Type 2 diabetes mellitus" },
  { code: "M79.1", name: "Myalgia (Nyeri Otot)" },
  { code: "K02.1", name: "Caries of dentine (Gigi Berlubang)" },
  { code: "A09", name: "Infectious gastroenteritis and colitis (Diare)" }
];

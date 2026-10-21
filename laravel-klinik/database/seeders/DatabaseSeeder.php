<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Poli;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Obat;
use App\Models\Antrian;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Poli
        $poliUmum = Poli::create([
            'kode_poli' => 'UMUM',
            'nama_poli' => 'Poli Umum',
            'icon' => 'stethoscope',
            'deskripsi' => 'Pemeriksaan umum dan diagnosa dokter keluarga'
        ]);

        $poliGigi = Poli::create([
            'kode_poli' => 'GIGI',
            'nama_poli' => 'Poli Gigi & Mulut',
            'icon' => 'smile',
            'deskripsi' => 'Pemeriksaan dan penambalan gigi'
        ]);

        $poliSpesialis = Poli::create([
            'kode_poli' => 'DALAM',
            'nama_poli' => 'Poli Penyakit Dalam',
            'icon' => 'activity',
            'deskripsi' => 'Pemeriksaan spesialis penyakit dalam'
        ]);

        // 2. Seed Dokter
        $dok1 = Dokter::create([
            'kode_dokter' => 'DOC-001',
            'nama_lengkap' => 'dr. Ahmad Ridwan, Sp.PD',
            'spesialisasi' => 'Spesialis Penyakit Dalam',
            'poli_id' => $poliSpesialis->id,
            'nomor_str' => '31.1.1.100.2.18.098765',
            'alumni' => 'FK Universitas Indonesia',
            'jadwal_praktek' => 'Senin - Kamis (08.00 - 14.00)',
        ]);

        $dok2 = Dokter::create([
            'kode_dokter' => 'DOC-002',
            'nama_lengkap' => 'dr. Budi Santoso',
            'spesialisasi' => 'Dokter Umum',
            'poli_id' => $poliUmum->id,
            'nomor_str' => '35.1.1.300.4.20.987123',
            'alumni' => 'FK Universitas Airlangga',
            'jadwal_praktek' => 'Setiap Hari (07.00 - 21.00)',
        ]);

        // 3. Seed Obat
        $obats = [
            ['kode_obat' => 'OBT-001', 'nama_obat' => 'Paracetamol 500mg', 'kategori' => 'Tablet', 'satuan' => 'Strip', 'stok' => 120, 'min_stok' => 20, 'harga_beli' => 4000, 'harga_jual' => 7500],
            ['kode_obat' => 'OBT-002', 'nama_obat' => 'Amoxicillin 500mg', 'kategori' => 'Kapsul', 'satuan' => 'Strip', 'stok' => 85, 'min_stok' => 15, 'harga_beli' => 8000, 'harga_jual' => 14000],
            ['kode_obat' => 'OBT-003', 'nama_obat' => 'Amlodipine 10mg', 'kategori' => 'Tablet', 'satuan' => 'Strip', 'stok' => 95, 'min_stok' => 20, 'harga_beli' => 6000, 'harga_jual' => 12000],
            ['kode_obat' => 'OBT-004', 'nama_obat' => 'Metformin 500mg', 'kategori' => 'Tablet', 'satuan' => 'Strip', 'stok' => 60, 'min_stok' => 20, 'harga_beli' => 5000, 'harga_jual' => 9500],
            ['kode_obat' => 'OBT-005', 'nama_obat' => 'Omeprazole 20mg', 'kategori' => 'Kapsul', 'satuan' => 'Strip', 'stok' => 45, 'min_stok' => 10, 'harga_beli' => 7000, 'harga_jual' => 13500],
            ['kode_obat' => 'OBT-006', 'nama_obat' => 'Antasida Doen Suspensi', 'kategori' => 'Sirup', 'satuan' => 'Botol', 'stok' => 8, 'min_stok' => 10, 'harga_beli' => 6500, 'harga_jual' => 11000],
        ];

        foreach ($obats as $obt) {
            Obat::create($obt);
        }

        // 4. Seed Pasien Awal
        $pasien1 = Pasien::create([
            'no_rm' => 'RM-00001',
            'nik' => '3201011504850001',
            'nama_lengkap' => 'Mayor Czi Bambang Suryono',
            'jenis_kelamin' => 'Laki-laki',
            'tanggal_lahir' => '1985-04-15',
            'tempat_lahir' => 'Magelang',
            'golongan_darah' => 'O',
            'alamat' => 'Komplek Pusdikzi Blok A No. 12, Bogor',
            'no_telepon' => '081234567890',
            'kategori_pasien' => 'Militer PUSDIKZI',
            'nrp_nip' => '11050012340485',
            'kesatuan' => 'PUSDIKZI KODIKLATAD',
            'pangkat' => 'Mayor Czi',
        ]);

        $pasien2 = Pasien::create([
            'no_rm' => 'RM-00002',
            'nik' => '3201015809920002',
            'nama_lengkap' => 'Ny. Dewi Kusuma Wardhani',
            'jenis_kelamin' => 'Perempuan',
            'tanggal_lahir' => '1992-09-18',
            'tempat_lahir' => 'Bogor',
            'golongan_darah' => 'B',
            'alamat' => 'Jl. Pengadilan No. 4, Pabaton, Bogor',
            'no_telepon' => '085712349876',
            'kategori_pasien' => 'BPJS Kesehatan',
            'no_bpjs' => '0001239874561',
        ]);

        // 5. Seed Antrian Demo
        Antrian::create([
            'nomor_antrian' => 'U-001',
            'pasien_id' => $pasien1->id,
            'poli_id' => $poliUmum->id,
            'dokter_id' => $dok2->id,
            'status' => 'dipanggil',
            'waktu_daftar' => now(),
            'waktu_panggil' => now(),
            'keluhan_utama' => 'Pusing dan demam sejak kemarin malam',
            'tensi' => '120/80',
            'suhu' => '37.8',
        ]);

        Antrian::create([
            'nomor_antrian' => 'U-002',
            'pasien_id' => $pasien2->id,
            'poli_id' => $poliUmum->id,
            'status' => 'menunggu',
            'waktu_daftar' => now(),
            'keluhan_utama' => 'Nyeri lambung / maag kambuh',
            'tensi' => '110/70',
            'suhu' => '36.5',
        ]);
    }
}

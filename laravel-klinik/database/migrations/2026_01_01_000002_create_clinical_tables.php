<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dokters', function (Blueprint $table) {
            $table->id();
            $table->string('kode_dokter', 20)->unique();
            $table->string('nama_lengkap', 150);
            $table->string('spesialisasi', 100);
            $table->foreignId('poli_id')->constrained('polis')->onDelete('cascade');
            $table->string('nomor_str', 50)->nullable();
            $table->string('nomor_sip', 50)->nullable();
            $table->string('alumni', 100)->nullable();
            $table->string('pengalaman_tahun', 20)->nullable();
            $table->string('jadwal_praktek', 150)->nullable();
            $table->string('foto_url', 255)->nullable();
            $table->boolean('status_aktif')->default(true);
            $table->timestamps();
        });

        Schema::create('pasiens', function (Blueprint $table) {
            $table->id();
            $table->string('no_rm', 20)->unique();
            $table->string('nik', 20)->unique();
            $table->string('nama_lengkap', 150);
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir', 100)->nullable();
            $table->string('golongan_darah', 5)->nullable();
            $table->text('alamat');
            $table->string('no_telepon', 30)->nullable();
            $table->enum('kategori_pasien', ['Militer PUSDIKZI', 'PNS / Keluarga', 'BPJS Kesehatan', 'Umum'])->default('Umum');
            $table->string('nrp_nip', 50)->nullable();
            $table->string('kesatuan', 100)->nullable();
            $table->string('pangkat', 100)->nullable();
            $table->string('no_bpjs', 50)->nullable();
            $table->text('riwayat_alergi')->nullable();
            $table->timestamps();
        });

        Schema::create('antrians', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_antrian', 20);
            $table->foreignId('pasien_id')->constrained('pasiens')->onDelete('cascade');
            $table->foreignId('poli_id')->constrained('polis')->onDelete('cascade');
            $table->foreignId('dokter_id')->nullable()->constrained('dokters')->nullOnDelete();
            $table->enum('status', ['menunggu', 'dipanggil', 'diperiksa', 'selesai', 'batal'])->default('menunggu');
            $table->dateTime('waktu_daftar')->useCurrent();
            $table->dateTime('waktu_panggil')->nullable();
            $table->dateTime('waktu_selesai')->nullable();
            $table->text('keluhan_utama')->nullable();
            $table->string('tensi', 20)->nullable();
            $table->string('suhu', 10)->nullable();
            $table->string('berat_badan', 10)->nullable();
            $table->string('tinggi_badan', 10)->nullable();
            $table->timestamps();
        });

        Schema::create('obats', function (Blueprint $table) {
            $table->id();
            $table->string('kode_obat', 30)->unique();
            $table->string('nama_obat', 150); // Nama Zat Aktif / Generik + Dosis (e.g. Paracetamol 500 mg)
            $table->string('merek', 100)->nullable(); // Nama Dagang / Merek Paten (e.g. Sanmol, Panadol, Biogesic)
            $table->string('produsen', 100)->nullable(); // Pabrik Farmasi (e.g. Sanbe Farma, Kimia Farma, Dexa)
            $table->string('golongan_obat', 50)->default('Generik'); // Generik, Paten / Bermerek, BHP / Alkes
            $table->string('kategori', 50)->default('Tablet');
            $table->string('satuan', 30)->default('Strip');
            $table->integer('stok')->default(0);
            $table->integer('min_stok')->default(10);
            $table->decimal('harga_beli', 12, 2)->default(0);
            $table->decimal('harga_jual', 12, 2)->default(0);
            $table->date('tgl_kadaluarsa')->nullable();
            $table->string('lokasi_rak', 50)->nullable();
            $table->string('kfa_code', 50)->nullable(); // Kode Kamus Farmasi SATUSEHAT
            $table->timestamps();
        });

        Schema::create('rekam_medis', function (Blueprint $table) {
            $table->id();
            $table->string('no_transaksi', 30)->unique();
            $table->foreignId('pasien_id')->constrained('pasiens')->onDelete('cascade');
            $table->foreignId('dokter_id')->constrained('dokters')->onDelete('cascade');
            $table->foreignId('antrian_id')->nullable()->constrained('antrians')->nullOnDelete();
            $table->dateTime('tanggal_periksa')->useCurrent();
            
            // SOAP Data
            $table->text('subjektif_keluhan')->nullable();
            $table->text('objektif_fisik')->nullable();
            $table->string('tekanan_darah', 20)->nullable();
            $table->string('suhu_tubuh', 10)->nullable();
            $table->string('nadi', 10)->nullable();
            $table->string('pernapasan', 10)->nullable();
            $table->string('berat_badan', 10)->nullable();
            $table->string('tinggi_badan', 10)->nullable();
            
            // Diagnosis
            $table->string('kode_icd10', 20)->nullable();
            $table->string('nama_diagnosa', 255)->nullable();
            $table->text('diagnosa_sekunder')->nullable();
            
            // Plan & Actions
            $table->text('tindakan_icd9')->nullable();
            $table->text('catatan_dokter')->nullable();
            $table->enum('status_pelayanan', ['selesai', 'rawat_inap', 'rujuk'])->default('selesai');
            $table->timestamps();
        });

        Schema::create('resep_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rekam_medis_id')->constrained('rekam_medis')->onDelete('cascade');
            $table->foreignId('obat_id')->nullable()->constrained('obats')->nullOnDelete();
            $table->string('nama_obat', 150);
            $table->integer('jumlah')->default(1);
            $table->string('aturan_pakai', 100);
            $table->decimal('harga_satuan', 12, 2)->default(0);
            $table->decimal('total_harga', 12, 2)->default(0);
            $table->enum('status_tebus', ['pending', 'diproses', 'selesai'])->default('pending');
            $table->timestamps();
        });

        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('no_kwitansi', 30)->unique();
            $table->foreignId('rekam_medis_id')->nullable()->constrained('rekam_medis')->nullOnDelete();
            $table->foreignId('pasien_id')->constrained('pasiens')->onDelete('cascade');
            $table->decimal('biaya_konsultasi', 12, 2)->default(0);
            $table->decimal('biaya_tindakan', 12, 2)->default(0);
            $table->decimal('biaya_obat', 12, 2)->default(0);
            $table->decimal('diskon', 12, 2)->default(0);
            $table->decimal('total_tagihan', 12, 2)->default(0);
            $table->decimal('jumlah_bayar', 12, 2)->default(0);
            $table->decimal('kembalian', 12, 2)->default(0);
            $table->string('metode_pembayaran', 50)->default('Tunai');
            $table->enum('status_pembayaran', ['lunas', 'pending', 'batal'])->default('pending');
            $table->unsignedBigInteger('kasir_user_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksis');
        Schema::dropIfExists('resep_details');
        Schema::dropIfExists('rekam_medis');
        Schema::dropIfExists('obats');
        Schema::dropIfExists('antrians');
        Schema::dropIfExists('pasiens');
        Schema::dropIfExists('dokters');
    }
};

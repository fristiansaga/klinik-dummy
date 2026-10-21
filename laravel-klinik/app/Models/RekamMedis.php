<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    use HasFactory;

    protected $table = 'rekam_medis';

    protected $fillable = [
        'no_transaksi',
        'pasien_id',
        'dokter_id',
        'antrian_id',
        'tanggal_periksa',
        
        // Format SOAP
        'subjektif_keluhan', // Anamnesis / Keluhan pasien
        'objektif_fisik',    // Hasil pemeriksaan fisik & tanda vital
        'tekanan_darah',
        'suhu_tubuh',
        'nadi',
        'pernapasan',
        'berat_badan',
        'tinggi_badan',
        
        // Asesmen & Diagnosa
        'kode_icd10',        // Kode ICD-10 e.g. I10, E11
        'nama_diagnosa',     // Deskripsi diagnosa
        'diagnosa_sekunder',
        
        // Plan & Terapi
        'tindakan_icd9',     // Tindakan medis (ICD-9 CM)
        'catatan_dokter',
        'status_pelayanan',  // selesai, rawat_inap, rujuk
    ];

    protected $casts = [
        'tanggal_periksa' => 'datetime',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }

    public function antrian()
    {
        return $this->belongsTo(Antrian::class);
    }

    public function resepDetails()
    {
        return $this->hasMany(ResepDetail::class);
    }

    public function transaksi()
    {
        return $this->hasOne(Transaksi::class);
    }
}

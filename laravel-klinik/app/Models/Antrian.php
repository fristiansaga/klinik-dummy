<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    use HasFactory;

    protected $table = 'antrians';

    protected $fillable = [
        'nomor_antrian', // e.g. U-001, G-002
        'pasien_id',
        'poli_id',
        'dokter_id',
        'status', // menunggu, dipanggil, diperiksa, selesai, batal
        'waktu_daftar',
        'waktu_panggil',
        'waktu_selesai',
        'keluhan_utama',
        'tensi',
        'suhu',
        'berat_badan',
        'tinggi_badan',
    ];

    protected $casts = [
        'waktu_daftar' => 'datetime',
        'waktu_panggil' => 'datetime',
        'waktu_selesai' => 'datetime',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function poli()
    {
        return $this->belongsTo(Poli::class);
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }

    public function rekamMedis()
    {
        return $this->hasOne(RekamMedis::class);
    }
}

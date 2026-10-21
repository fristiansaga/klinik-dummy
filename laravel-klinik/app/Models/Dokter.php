<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $table = 'dokters';

    protected $fillable = [
        'kode_dokter',
        'nama_lengkap',
        'spesialisasi',
        'poli_id',
        'nomor_str',
        'nomor_sip',
        'alumni',
        'pengalaman_tahun',
        'jadwal_praktek',
        'foto_url',
        'status_aktif',
    ];

    public function poli()
    {
        return $this->belongsTo(Poli::class);
    }

    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasiens';

    protected $fillable = [
        'no_rm',
        'nik',
        'nama_lengkap',
        'jenis_kelamin',
        'tanggal_lahir',
        'tempat_lahir',
        'golongan_darah',
        'alamat',
        'no_telepon',
        'kategori_pasien', // Militer PUSDIKZI, PNS/Keluarga, BPJS Kesehatan, Umum
        'nrp_nip',
        'kesatuan',
        'pangkat',
        'no_bpjs',
        'riwayat_alergi',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function antrians()
    {
        return $this->hasMany(Antrian::class);
    }

    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class);
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }

    // Helper umur
    public function getUmurAttribute()
    {
        return $this->tanggal_lahir ? $this->tanggal_lahir->age . ' Thn' : '-';
    }
}

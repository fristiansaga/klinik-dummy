<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $table = 'obats';

    protected $fillable = [
        'kode_obat',
        'nama_obat',     // Nama Generik / Zat Aktif
        'merek',         // Nama Dagang / Merek Paten
        'produsen',      // Pabrik Farmasi
        'golongan_obat', // Generik / Paten / BHP
        'kategori',      // Tablet, Sirup, Injeksi, Salep, Kapsul
        'satuan',        // Strip, Botol, Ampul, Tube, Pcs
        'stok',
        'min_stok',
        'harga_beli',
        'harga_jual',
        'tgl_kadaluarsa',
        'lokasi_rak',
        'kfa_code',
    ];

    protected $casts = [
        'tgl_kadaluarsa' => 'date',
        'harga_beli' => 'decimal:2',
        'harga_jual' => 'decimal:2',
    ];

    public function resepDetails()
    {
        return $this->hasMany(ResepDetail::class);
    }
}

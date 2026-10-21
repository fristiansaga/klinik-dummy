<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResepDetail extends Model
{
    use HasFactory;

    protected $table = 'resep_details';

    protected $fillable = [
        'rekam_medis_id',
        'obat_id',
        'nama_obat',
        'jumlah',
        'aturan_pakai', // e.g. 3x1 sesudah makan
        'harga_satuan',
        'total_harga',
        'status_tebus', // pending, diproses, selesai
    ];

    protected $casts = [
        'harga_satuan' => 'decimal:2',
        'total_harga' => 'decimal:2',
    ];

    public function rekamMedis()
    {
        return $this->belongsTo(RekamMedis::class);
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }
}

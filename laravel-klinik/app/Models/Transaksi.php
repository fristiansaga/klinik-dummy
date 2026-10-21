<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksis';

    protected $fillable = [
        'no_kwitansi',
        'rekam_medis_id',
        'pasien_id',
        'biaya_konsultasi',
        'biaya_tindakan',
        'biaya_obat',
        'diskon',
        'total_tagihan',
        'jumlah_bayar',
        'kembalian',
        'metode_pembayaran', // Tunai, QRIS, Transfer, Ditanggung Dinas/TNI, BPJS
        'status_pembayaran', // lunas, pending, batal
        'kasir_user_id',
    ];

    protected $casts = [
        'biaya_konsultasi' => 'decimal:2',
        'biaya_tindakan' => 'decimal:2',
        'biaya_obat' => 'decimal:2',
        'diskon' => 'decimal:2',
        'total_tagihan' => 'decimal:2',
        'jumlah_bayar' => 'decimal:2',
        'kembalian' => 'decimal:2',
    ];

    public function rekamMedis()
    {
        return $this->belongsTo(RekamMedis::class);
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }
}

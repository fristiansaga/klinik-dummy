<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    use HasFactory;

    protected $table = 'polis';

    protected $fillable = [
        'kode_poli',
        'nama_poli',
        'icon',
        'deskripsi',
        'status_aktif',
    ];

    public function dokters()
    {
        return $this->hasMany(Dokter::class);
    }

    public function antrians()
    {
        return $this->hasMany(Antrian::class);
    }
}

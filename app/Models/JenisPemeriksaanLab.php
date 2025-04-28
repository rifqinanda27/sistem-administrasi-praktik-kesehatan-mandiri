<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisPemeriksaanLab extends Model
{
    protected $table = 'jenis_pemeriksaan_lab';

    protected $primaryKey = 'id_jenis_pemeriksaan';

    protected $fillable = [
        'nama_pemeriksaan',
        'kategori',
        'deskripsi',
        'biaya'
    ];
}

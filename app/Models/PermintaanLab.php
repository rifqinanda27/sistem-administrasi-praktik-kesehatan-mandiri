<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermintaanLab extends Model
{
    protected $table = 'permintaan_lab';

    protected $primaryKey = 'id_permintaan';

    protected $fillable = [
        'id_kunjungan',
        'id_laboratorium',
        'id_jenis_pemeriksaan',
        'diminta_oleh',
        'status_permintaan',
        'tanggal_permintaan'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilLab extends Model
{
    protected $table = 'hasil_lab';
    protected $primaryKey = 'id_hasil';

    protected $fillable = [
        'id_permintaan',
        'id_jenis_pemeriksaan',
        'nilai_hasil',
        'interpretasi',
        'id_laboratorium',
        'dilakukan_oleh',
        'status_hasil',
        'tanggal_pemeriksaan'
    ];
}

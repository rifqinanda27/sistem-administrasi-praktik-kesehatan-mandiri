<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $table = 'dokter';
    protected $primaryKey = 'id_dokter';
    protected $fillable = [
        'id_pengguna',
        'nomor_sip',
        'spesialisasi',
        'pengalaman_tahun',
        'status_praktik',
        'tarif_konsultasi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_pengguna', 'id');
    }
}

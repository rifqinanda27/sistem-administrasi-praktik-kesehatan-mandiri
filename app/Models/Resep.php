<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;

    protected $table = 'resep';
    protected $primaryKey = 'id_resep';

    protected $fillable = [
        'id_kunjungan',
        'id_obat',
        'dosis',
        'frekuensi',
        'resep_obat',
        'petunjuk',
        'diresepkan_oleh',
        'status',
    ];

    // Relasi ke kunjungan
    public function kunjungan()
    {
        return $this->belongsTo(Visit::class, 'id_kunjungan');
    }

    // Relasi ke obat
    public function obat()
    {
        return $this->belongsTo(Obat::class, 'id_obat');
    }

    public function dokter()
    {
        return $this->belongsTo(User::class, 'diresepkan_oleh', 'id');
    }
    
    // public function obat()
    // {
    //     return $this->belongsTo(Obat::class, 'id_obat');
    // }

    // public function kunjungan()
    // {
    //     return $this->belongsTo(Visit::class, 'id_kunjungan');
    // }
}

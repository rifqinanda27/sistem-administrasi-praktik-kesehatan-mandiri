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
        'catatan',
        'status',
    ];

    // Relasi ke kunjungan
    public function kunjungan()
    {
        return $this->belongsTo(Visit::class, 'id_kunjungan');
    }

    // Relasi ke obat
    public function detail_resep()
    {
        return $this->hasMany(detail_resep::class, 'id_resep');
    }

    public function dokter()
    {
        return $this->belongsTo(User::class, 'diresepkan_oleh', 'id');
    }

    public function obat()
    {
        return $this->hasMany(Obat::class, 'id_obat');
    }
    
}

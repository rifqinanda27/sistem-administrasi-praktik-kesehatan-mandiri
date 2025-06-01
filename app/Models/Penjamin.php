<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjamin extends Model
{
    use HasFactory;

    protected $table = 'penjamin';
    protected $primaryKey = 'id_penjamin';

    protected $fillable = [
        'nama',
        'tipe',
        'catatan',
    ];

    /**
     * Relasi ke kunjungan (satu penjamin bisa punya banyak kunjungan)
     */
    public function kunjungan()
    {
        return $this->hasMany(Visit::class, 'id_penjamin', 'id_penjamin');
    }
}

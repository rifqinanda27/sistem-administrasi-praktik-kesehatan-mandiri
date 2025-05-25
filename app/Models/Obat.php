<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $table = 'obat';
    protected $primaryKey = 'id_obat';

    protected $fillable = [
        'nama_obat',
        'bentuk',
        'dosis',
        'jumlah_stok',
        'satuan',
        'golongan',
        'indikasi',
        'tanggal_kadaluarsa',
        'harga_satuan',
    ];

    public function resep()
    {
        return $this->hasMany(Resep::class, 'id_obat', 'id_obat');
    }
}

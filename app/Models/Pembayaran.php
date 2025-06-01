<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';

    protected $fillable = [
        'id_kunjungan',
        'tanggal_pembayaran',
        'total_biaya',
        'metode_pembayaran',
        'status',
    ];

    public function detailPembayaran()
    {
        return $this->hasMany(DetailPembayaran::class, 'id_pembayaran', 'id_pembayaran');
    }

    public function kunjungan()
    {
        return $this->belongsTo(Visit::class, 'id_kunjungan');
    }
}

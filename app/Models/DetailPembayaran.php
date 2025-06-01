<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailPembayaran extends Model
{
    use HasFactory;

    protected $table = 'detail_pembayaran';
    protected $primaryKey = 'id_detail';

    protected $fillable = [
        'id_pembayaran',
        'jenis_biaya',
        'keterangan',
        'jumlah',
    ];

    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class, 'id_pembayaran');
    }
}

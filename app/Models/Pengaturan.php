<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengaturan extends Model
{
    use HasFactory;

    protected $table = 'pengaturans';
    protected $primaryKey = 'id';

    protected $fillable = [
        'logo',
        'alamat',
        'no_telpon',
        'email',
        'kode_pos',
        'kop_surat',
        'nama_aplikasi',
        'kota',
    ];
}

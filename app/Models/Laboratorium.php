<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laboratorium extends Model
{
    protected $table = 'laboratorium';

    protected $primaryKey = 'id_laboratorium'; // <- tambahkan ini

    protected $fillable = [
        'nama_laboratorium',
        'lokasi',
        'telepon',
        'email',
        'status_aktif',
        'kapasitas_max',
        'jam_operasional'
    ];
}

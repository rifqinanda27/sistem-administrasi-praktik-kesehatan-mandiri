<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instruksi extends Model
{
    use HasFactory;

    protected $table = 'instruksi';
    protected $primaryKey = 'id_instruksi';

    protected $fillable = [
        'nama_instruksi',
        'keterangan'
    ];
}

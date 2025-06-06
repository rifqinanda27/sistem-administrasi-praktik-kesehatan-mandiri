<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tindakan extends Model
{
    use HasFactory;

    protected $table = 'tindakan';
    protected $primaryKey = 'id_tindakan';

    protected $fillable = [
        'id_kunjungan',
        'tindakan_lanjut',
        'status',
    ];

    public function visit()
    {
        return $this->belongsTo(Visit::class, 'id_kunjungan');
    }
}

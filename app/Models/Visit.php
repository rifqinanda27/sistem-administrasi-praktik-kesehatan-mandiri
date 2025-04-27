<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    protected $table = 'visits';
    protected $primaryKey = 'id_kunjungan';
    protected $fillable = [
        'id_pasien', 'id_dokter', 'tanggal_kunjungan', 'tipe_kunjungan', 
        'status_kunjungan', 'catatan'
    ];

    public function pasien()
    {
        return $this->belongsTo(Patients::class, 'id_pasien');
    }

    public function dokter()
    {
        return $this->belongsTo(User::class, 'id');
    }
}

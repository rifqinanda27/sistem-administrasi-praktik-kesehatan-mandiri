<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    use HasFactory;

    protected $table = 'patients';
    protected $primaryKey = 'id_pasien';
    protected $fillable = [
        'no_rekam_medis', 'nama_lengkap', 'tanggal_lahir', 'jenis_kelamin', 
        'no_ktp', 'alamat', 'telepon', 'status_aktif'
    ];
}

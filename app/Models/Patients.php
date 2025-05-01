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

    // Relasi ke kunjungan
    public function kunjungan()
    {
        return $this->hasMany(Visit::class, 'id_pasien', 'id_pasien');
    }

    // Relasi ke resep melalui kunjungan
    public function resep()
    {
        return $this->hasManyThrough(
            Resep::class,
            Visit::class,
            'id_pasien',       // FK di Visit
            'id_kunjungan',    // FK di Resep
            'id_pasien',       // PK di Patients
            'id_kunjungan'     // PK di Visit
        );
    }

}

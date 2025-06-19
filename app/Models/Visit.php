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
        'status_kunjungan', 'catatan', 'id_penjamin'
    ];

    // Relasi ke pasien
    public function pasien()
    {
        return $this->belongsTo(Patients::class, 'id_pasien');
    }

    // Relasi ke resep
    public function resep()
    {
        return $this->hasMany(Resep::class, 'id_kunjungan');
    }

    public function dokter()
    {
        return $this->belongsTo(User::class, 'id_dokter', 'id');
    }

    public function tindakan()
    {
        return $this->hasMany(Tindakan::class, 'id_kunjungan');
    }

    public function catatan_medis()
    {
        return $this->belongsTo(CatatanMedis::class, 'id_kunjungan', 'id_kunjungan');
    }

    public function penjamin()
    {
        return $this->belongsTo(Penjamin::class, 'id_penjamin', 'id_penjamin');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'id_kunjungan');
    }

    public function permintaan_lab()
    {
        return $this->hasMany(PermintaanLab::class, 'id_kunjungan');
    }
}

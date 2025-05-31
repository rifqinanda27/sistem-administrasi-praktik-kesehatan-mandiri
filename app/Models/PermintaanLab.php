<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermintaanLab extends Model
{
    protected $table = 'permintaan_lab';

    protected $primaryKey = 'id_permintaan';

    protected $fillable = [
        'id_kunjungan',
        'id_laboratorium',
        'id_jenis_pemeriksaan',
        'diminta_oleh',
        'status_permintaan',
        'tanggal_permintaan'
    ];

    public function kunjungan()
    {
        return $this->belongsTo(Visit::class, 'id_kunjungan');
    }

    public function laboratorium()
    {
        return $this->belongsTo(Laboratorium::class, 'id_laboratorium');
    }

    public function jenis_pemeriksaan_lab()
    {
        return $this->belongsTo(JenisPemeriksaanLab::class, 'id_jenis_pemeriksaan');
    }

    public function dokter()
    {
        return $this->belongsTo(User::class, 'diminta_oleh', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanMedis extends Model
{
    use HasFactory;

    protected $table = 'catatan_medis';
    protected $primaryKey = 'id_catatan';

    protected $fillable = [
        'no_rekam_medis',
        'id_kunjungan',
        'keluhan_utama',
        'keluhan_tambahan',
        'riwayat_penyakit_pribadi',
        'riwayat_penyakit_keluarga',
        'kebiasaan_pasien',
        'berat_badan',
        'frekuensi_nafas',
        'tinggi_badan',
        'suhu_tubuh',
        'tekanan_darah',
        'keadaan_umum',
        'neurologi',
        'diagnosa_sementara',
        'diagnosa_tambahan',
        'tanggal',
    ];
}

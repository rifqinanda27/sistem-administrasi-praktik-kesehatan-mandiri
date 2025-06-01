<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_resep extends Model
{
    use HasFactory;

    protected $table = 'detail_resep';
    protected $primaryKey = 'id_detail_resep';

    protected $fillable = [
        'id_dokter',
        'id_obat',
        'id_instruksi'
    ];

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'id_obat');
    }

    public function instruksi()
    {
        return $this->belongsTo(Instruksi::class, 'id_instruksi');
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter');
    }
}

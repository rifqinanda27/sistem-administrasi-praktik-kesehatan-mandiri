<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    use HasFactory;
    protected $table = 'tarif';
    protected $primaryKey = 'id_tarif';

    protected $fillable = ['biaya_admin', 'biaya_rujukan_lab'];

}

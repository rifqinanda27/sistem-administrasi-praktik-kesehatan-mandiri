<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ModifyBentukColumnInObatTable extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE obat 
            MODIFY COLUMN bentuk ENUM(
                'tablet', 
                'kaplet', 
                'kapsul', 
                'sirup', 
                'suspensi', 
                'tetes', 
                'salep', 
                'krim', 
                'gel', 
                'inhaler', 
                'serbuk'
            )
        ");
    }

    public function down(): void
    {
        // Optional: ubah balik ke VARCHAR jika perlu
        DB::statement("ALTER TABLE obat MODIFY COLUMN bentuk VARCHAR(50)");
    }
}

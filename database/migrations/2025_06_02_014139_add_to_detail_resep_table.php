<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('detail_resep', function (Blueprint $table) {
            $table->string('dosis')->nullable(); // Contoh: Antibiotik, Analgesik
            $table->string('frekuensi')->nullable(); // Contoh: Antibiotik, Analgesik
            $table->text('petunjuk')->nullable(); // Contoh: Antibiotik, Analgesik
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_resep', function (Blueprint $table) {
            //
        });
    }
};

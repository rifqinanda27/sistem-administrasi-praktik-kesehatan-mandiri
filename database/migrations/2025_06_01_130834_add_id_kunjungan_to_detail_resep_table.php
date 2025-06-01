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
            $table->unsignedBigInteger('id_kunjungan')->nullable()->after('id_dokter');
            $table->foreign('id_kunjungan')->references('id_kunjungan')->on('visits')->onDelete('set null');
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

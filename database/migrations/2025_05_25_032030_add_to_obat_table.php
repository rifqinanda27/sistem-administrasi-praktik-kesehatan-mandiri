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
        Schema::table('obat', function (Blueprint $table) {
            $table->string('satuan')->nullable(); // Contoh: tablet, botol, strip
            $table->string('golongan')->nullable(); // Contoh: Antibiotik, Analgesik
            $table->text('indikasi')->nullable(); // Penjelasan singkat kegunaan obat
            $table->date('tanggal_kadaluarsa')->nullable(); // Tanggal kadaluarsa
            $table->decimal('harga_satuan', 10, 2)->nullable(); // Harga satuan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('obat', function (Blueprint $table) {
            //
        });
    }
};

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
        Schema::create('pengaturans', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();       // nama file logo
            $table->text('alamat')->nullable();       // alamat lengkap
            $table->string('no_telpon', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('kode_pos', 10)->nullable();
            $table->text('kop_surat')->nullable();    // isi HTML kop surat
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaturans');
    }
};

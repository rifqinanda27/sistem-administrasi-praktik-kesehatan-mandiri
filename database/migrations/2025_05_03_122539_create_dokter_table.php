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
        Schema::create('dokter', function (Blueprint $table) {
            $table->id('id_dokter'); // Auto increment
            $table->unsignedBigInteger('id_pengguna')->unique(); // Tetap relasi ke pengguna
            $table->string('nomor_sip')->unique()->nullable();
            $table->string('spesialisasi')->default('umum')->nullable();
            $table->unsignedInteger('pengalaman_tahun')->default(0)->nullable();
            $table->enum('status_praktik', ['aktif', 'tidak_aktif'])->default('aktif')->nullable();
            $table->timestamps();

            $table->foreign('id_pengguna')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokter');
    }
};

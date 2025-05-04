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
            $table->unsignedBigInteger('id_dokter')->primary(); // Menggunakan ID dari tabel pengguna
            $table->string('nomor_str')->unique();
            $table->string('spesialisasi')->nullable(); // Kosong untuk dokter umum
            $table->unsignedInteger('pengalaman_tahun')->default(0);
            $table->enum('status_praktik', ['aktif', 'tidak_aktif'])->default('aktif');
            $table->timestamps();

            // Foreign key ke tabel pengguna
            $table->foreign('id_dokter')
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

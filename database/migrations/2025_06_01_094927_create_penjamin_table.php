<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penjamin', function (Blueprint $table) {
            $table->id('id_penjamin');
            $table->string('nama')->unique(); // e.g., "BPJS", "Umum", "Asuransi XYZ"
            $table->enum('tipe', ['gratis', 'bayar_sebagian', 'bayar_penuh'])->default('bayar_penuh');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penjamin');
    }
};

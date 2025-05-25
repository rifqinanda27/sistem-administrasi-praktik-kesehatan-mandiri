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
        Schema::create('detail_resep', function (Blueprint $table) {
            $table->id('id_detail_resep');

            $table->unsignedBigInteger('id_resep')->nullable();
            $table->unsignedBigInteger('id_obat')->nullable();
            $table->unsignedBigInteger('id_instruksi')->nullable();

            $table->timestamps();

            // Foreign keys
            $table->foreign('id_resep')->references('id_resep')->on('resep')->onDelete('cascade');
            $table->foreign('id_obat')->references('id_obat')->on('obat')->onDelete('restrict');
            $table->foreign('id_instruksi')->references('id_instruksi')->on('instruksi')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_resep');
    }
};

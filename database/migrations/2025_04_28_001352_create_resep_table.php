<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('resep', function (Blueprint $table) {
            $table->id('id_resep');
            $table->foreignId('id_kunjungan')->constrained('visits', 'id_kunjungan')->onDelete('cascade')->nullable();
            $table->foreignId('id_obat')->constrained('obat', 'id_obat')->onDelete('cascade')->nullable();
            $table->string('dosis')->nullable();
            $table->string('frekuensi')->nullable();
            $table->text('petunjuk')->nullable();
            $table->foreignId('diresepkan_oleh')->constrained('users', 'id')->onDelete('cascade')->nullable();
            $table->enum('status', ['aktif', 'diberikan'])->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('resep');
    }
};

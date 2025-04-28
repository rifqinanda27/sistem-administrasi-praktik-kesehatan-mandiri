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
        Schema::create('tindakan', function (Blueprint $table) {
            $table->id('id_tindakan');
            $table->unsignedBigInteger('id_kunjungan');
            $table->foreign('id_kunjungan')->references('id_kunjungan')->on('visits')->onDelete('cascade');
            $table->text('tindakan_lanjut');
            $table->enum('status', ['terjadwal', 'selesai']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tindakan');
    }
};

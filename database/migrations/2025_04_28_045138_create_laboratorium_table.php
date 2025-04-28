<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('laboratorium', function (Blueprint $table) {
            $table->id('id_laboratorium');
            $table->string('nama_laboratorium');
            $table->text('lokasi');
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();
            $table->boolean('status_aktif')->default(true);
            $table->integer('kapasitas_max')->default(100);
            $table->string('jam_operasional');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('laboratorium');
    }
};

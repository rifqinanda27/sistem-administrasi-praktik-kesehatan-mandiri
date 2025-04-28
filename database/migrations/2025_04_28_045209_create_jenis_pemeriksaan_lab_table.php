<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('jenis_pemeriksaan_lab', function (Blueprint $table) {
            $table->id('id_jenis_pemeriksaan');
            $table->string('nama_pemeriksaan');
            $table->string('kategori');
            $table->text('deskripsi')->nullable();
            $table->float('biaya');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jenis_pemeriksaan_lab');
    }
};

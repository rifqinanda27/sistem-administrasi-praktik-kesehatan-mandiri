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
        Schema::create('catatan_medis', function (Blueprint $table) {
            $table->id('id_catatan');
            $table->unsignedBigInteger('id_kunjungan');
            $table->foreign('id_kunjungan')->references('id_kunjungan')->on('visits')->onDelete('cascade');
            
            $table->text('keluhan_utama')->nullable();
            $table->text('keluhan_tambahan')->nullable();
            $table->text('riwayat_penyakit_pribadi')->nullable();
            $table->text('riwayat_penyakit_keluarga')->nullable();
            $table->text('kebiasaan_pasien')->nullable();
            
            $table->float('berat_badan')->nullable();
            $table->float('frekuensi_nafas')->nullable();
            $table->float('tinggi_badan')->nullable();
            $table->float('suhu_tubuh')->nullable();
            $table->string('tekanan_darah')->nullable();
            $table->text('keadaan_umum')->nullable();
            $table->text('neurologi')->nullable();
            
            $table->text('diagnosa_sementara')->nullable();
            $table->text('diagnosa_tambahan')->nullable();
            
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('catatan_medis');
    }
};

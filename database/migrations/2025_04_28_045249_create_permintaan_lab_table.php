<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('permintaan_lab', function (Blueprint $table) {
            $table->id('id_permintaan');
            $table->foreignId('id_kunjungan')->constrained('visits', 'id_kunjungan')->onDelete('cascade');
            $table->foreignId('id_laboratorium')->constrained('laboratorium', 'id_laboratorium')->onDelete('cascade');
            $table->foreignId('diminta_oleh')->constrained('users', 'id')->onDelete('cascade');
            $table->enum('status_permintaan', ['menunggu', 'dalam_proses', 'selesai']);
            $table->timestamp('tanggal_permintaan')->useCurrent();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('permintaan_lab');
    }
};

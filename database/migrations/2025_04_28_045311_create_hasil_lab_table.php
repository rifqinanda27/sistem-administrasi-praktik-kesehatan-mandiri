<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('hasil_lab', function (Blueprint $table) {
            $table->id('id_hasil');
            $table->foreignId('id_permintaan')->constrained('permintaan_lab', 'id_permintaan')->onDelete('cascade');
            $table->foreignId('id_jenis_pemeriksaan')->constrained('jenis_pemeriksaan_lab', 'id_jenis_pemeriksaan')->onDelete('cascade');
            $table->string('nilai_hasil')->nullable();
            $table->text('interpretasi')->nullable();
            $table->foreignId('id_laboratorium')->constrained('laboratorium', 'id_laboratorium')->onDelete('cascade');
            $table->foreignId('dilakukan_oleh')->constrained('users', 'id')->onDelete('cascade');
            $table->enum('status_hasil', ['normal', 'abnormal', 'kritis']);
            $table->timestamp('tanggal_pemeriksaan')->useCurrent();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hasil_lab');
    }
};

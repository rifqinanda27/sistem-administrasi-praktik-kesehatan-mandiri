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
        Schema::create('visits', function (Blueprint $table) {
            $table->id('id_kunjungan');
            $table->foreignId('id_pasien')->constrained('patients')->onDelete('cascade');
            $table->foreignId('id_dokter')->constrained('users')->onDelete('cascade'); // Sesuaikan dengan nama tabel pengguna jika berbeda
            $table->dateTime('tanggal_kunjungan');
            $table->enum('tipe_kunjungan', ['awal', 'lanjutan', 'prenatal', 'postnatal', 'darurat']);
            $table->enum('status_kunjungan', ['terjadwal', 'dalam_proses', 'selesai', 'dibatalkan']);
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('visits');
    }
};

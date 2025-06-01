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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('id_pembayaran');
            $table->unsignedBigInteger('id_kunjungan');
            $table->dateTime('tanggal_pembayaran')->useCurrent();
            $table->decimal('total_biaya', 12, 2);
            $table->enum('metode_pembayaran', ['tunai', 'kartu', 'transfer', 'bpjs']);
            $table->enum('status', ['belum_dibayar', 'lunas', 'dibatalkan'])->default('belum_dibayar');
            $table->timestamps();

            $table->foreign('id_kunjungan')->references('id_kunjungan')->on('visits')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};

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
        Schema::create('detail_pembayaran', function (Blueprint $table) {
            $table->id('id_detail');
            $table->unsignedBigInteger('id_pembayaran');
            $table->enum('jenis_biaya', ['admin', 'dokter', 'obat', 'lab', 'lainnya']);
            $table->text('keterangan')->nullable();
            $table->decimal('jumlah', 12, 2);
            $table->timestamps();

            $table->foreign('id_pembayaran')->references('id_pembayaran')->on('pembayaran')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_pembayaran');
    }
};

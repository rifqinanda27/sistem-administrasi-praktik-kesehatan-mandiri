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
        Schema::table('visits', function (Blueprint $table) {
            $table->unsignedBigInteger('id_penjamin')->nullable()->after('id_dokter');
            $table->foreign('id_penjamin')->references('id_penjamin')->on('penjamin')->onDelete('set null')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('visits', function (Blueprint $table) {
            $table->dropForeign(['id_penjamin']);
            $table->dropColumn('id_penjamin');
        });
    }
};

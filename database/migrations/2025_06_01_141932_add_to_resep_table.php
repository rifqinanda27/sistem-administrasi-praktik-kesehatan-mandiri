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
        Schema::table('resep', function (Blueprint $table) {
            $table->unsignedBigInteger('id_detail_resep')->nullable()->after('id_obat');
            $table->foreign('id_detail_resep')->references('id_detail_resep')->on('detail_resep')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('resep', function (Blueprint $table) {
            $table->dropForeign(['id_obat']);
            $table->dropColumn('id_obat');
        });
    }
};

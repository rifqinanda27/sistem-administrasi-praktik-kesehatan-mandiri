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
        Schema::table('detail_resep', function (Blueprint $table) {
            $table->unsignedBigInteger('id_resep')->nullable()->after('id_detail_resep');
            $table->foreign('id_resep')->references('id_resep')->on('resep')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_resep', function (Blueprint $table) {
            //
        });
    }
};

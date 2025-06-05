<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnsFromResepTable extends Migration
{
    public function up()
    {
        Schema::table('resep', function (Blueprint $table) {
            // Drop foreign keys dulu
            $table->dropForeign(['id_detail_resep']);
            $table->dropForeign(['diresepkan_oleh']);

            // Drop kolom-kolom
            $table->dropColumn([
                'id_detail_resep',
                'dosis',
                'frekuensi',
                'petunjuk',
                'diresepkan_oleh'
            ]);
        });
    }

    public function down()
    {
        Schema::table('resep', function (Blueprint $table) {
            // Restore kolom
            $table->unsignedBigInteger('id_detail_resep')->nullable();
            $table->string('dosis')->nullable();
            $table->string('frekuensi')->nullable();
            $table->text('petunjuk')->nullable();
            $table->unsignedBigInteger('diresepkan_oleh')->nullable();

            // Restore foreign keys
            $table->foreign('id_detail_resep')->references('id')->on('detail_resep')->onDelete('set null');
            $table->foreign('diresepkan_oleh')->references('id')->on('users')->onDelete('set null');
        });
    }
}

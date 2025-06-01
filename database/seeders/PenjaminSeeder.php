<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class PenjaminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('penjamin')->insert([
            [
                'nama' => 'Umum',
                'tipe' => 'bayar_penuh',
                'catatan' => 'Pasien membayar seluruh biaya secara mandiri.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'BPJS',
                'tipe' => 'gratis',
                'catatan' => 'Biaya ditanggung penuh oleh BPJS.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Asuransi XYZ',
                'tipe' => 'bayar_sebagian',
                'catatan' => '80% biaya ditanggung oleh asuransi.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

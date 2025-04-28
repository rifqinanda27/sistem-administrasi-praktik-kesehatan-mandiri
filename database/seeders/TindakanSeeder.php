<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tindakan;
use App\Models\Visit;

class TindakanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $kunjunganIds = Visit::pluck('id_kunjungan')->toArray();

        if (empty($kunjunganIds)) {
            $this->command->warn('Tidak ada data kunjungan untuk tindakan.');
            return;
        }

        foreach (range(1, 10) as $index) {
            Tindakan::create([
                'id_kunjungan' => fake()->randomElement($kunjunganIds),
                'tindakan_lanjut' => fake()->sentence(),
                'status' => fake()->randomElement(['terjadwal', 'selesai']),
            ]);
        }
    }
}

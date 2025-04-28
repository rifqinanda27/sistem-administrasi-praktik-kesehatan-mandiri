<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Resep;
use App\Models\Obat;
use App\Models\Visit;
use App\Models\User;

class ResepSeeder extends Seeder
{
    public function run(): void
    {
        $kunjunganIds = Visit::pluck('id_kunjungan')->toArray();
        $obatIds = Obat::pluck('id_obat')->toArray();
        $dokterIds = User::where('role_id', 4)->pluck('id')->toArray();

        if (empty($kunjunganIds) || empty($obatIds) || empty($dokterIds)) {
            $this->command->warn('Data kunjungan, obat, atau dokter tidak tersedia untuk resep.');
            return;
        }

        foreach (range(1, 10) as $index) {
            Resep::create([
                'id_kunjungan' => fake()->randomElement($kunjunganIds),
                'id_obat' => fake()->randomElement($obatIds),
                'dosis' => fake()->randomElement(['1x1', '2x1', '3x1']),
                'frekuensi' => fake()->randomElement(['pagi', 'siang', 'malam', 'pagi dan malam']),
                'petunjuk' => fake()->sentence(),
                'diresepkan_oleh' => fake()->randomElement($dokterIds),
                'status' => fake()->randomElement(['aktif', 'diberikan']),
            ]);
        }
    }
}

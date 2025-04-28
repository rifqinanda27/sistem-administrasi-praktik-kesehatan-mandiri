<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PermintaanLab;
use App\Models\Visit;
use App\Models\Laboratorium;
use App\Models\User;

class PermintaanLabSeeder extends Seeder
{
    public function run()
    {
        $kunjunganIds = Visit::pluck('id_kunjungan')->toArray();
        $laboratoriumIds = Laboratorium::pluck('id_laboratorium')->toArray();
        $laboranIds = User::where('role_id', 6)->pluck('id')->toArray();

        if (empty($kunjunganIds) || empty($laboratoriumIds) || empty($laboranIds)) {
            $this->command->warn('Data kunjungan/laboratorium/laboran belum ada. PermintaanLab Seeder dilewati.');
            return;
        }

        foreach (range(1, 10) as $i) {
            PermintaanLab::create([
                'id_kunjungan' => fake()->randomElement($kunjunganIds),
                'id_laboratorium' => fake()->randomElement($laboratoriumIds),
                'diminta_oleh' => fake()->randomElement($laboranIds),
                'status_permintaan' => fake()->randomElement(['menunggu', 'dalam_proses', 'selesai']),
                'tanggal_permintaan' => now()->subDays(rand(0, 30)),
            ]);
        }
    }
}

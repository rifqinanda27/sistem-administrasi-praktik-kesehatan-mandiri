<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JenisPemeriksaanLab;

class JenisPemeriksaanLabSeeder extends Seeder
{
    public function run()
    {
        foreach (range(1, 10) as $i) {
            JenisPemeriksaanLab::create([
                'nama_pemeriksaan' => fake()->word() . ' Test',
                'kategori' => fake()->randomElement(['Darah', 'Urine', 'Radiologi']),
                'deskripsi' => fake()->sentence(),
                'biaya' => fake()->randomFloat(2, 100, 500),
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Laboratorium;

class LaboratoriumSeeder extends Seeder
{
    public function run()
    {
        foreach (range(1, 5) as $i) {
            Laboratorium::create([
                'nama_laboratorium' => fake()->company(),
                'lokasi' => fake()->address(),
                'telepon' => fake()->phoneNumber(),
                'email' => fake()->safeEmail(),
                'status_aktif' => true,
                'kapasitas_max' => fake()->numberBetween(50, 200),
                'jam_operasional' => '08:00 - 17:00',
            ]);
        }
    }
}

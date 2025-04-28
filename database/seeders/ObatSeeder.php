<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Obat;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 10) as $index) {
            Obat::create([
                'nama_obat' => fake()->word(),
                'bentuk' => fake()->randomElement(['tablet', 'sirup', 'kapsul', 'injeksi']),
                'dosis' => fake()->randomElement(['500mg', '250mg', '5ml', '10ml']),
                'jumlah_stok' => fake()->randomFloat(1, 10, 500),
            ]);
        }
    }
}

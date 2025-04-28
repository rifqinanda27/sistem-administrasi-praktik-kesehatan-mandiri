<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HasilLab;
use App\Models\PermintaanLab;
use App\Models\JenisPemeriksaanLab;
use App\Models\Laboratorium;
use App\Models\User;

class HasilLabSeeder extends Seeder
{
    
    public function run()
    {
        $permintaanIds = PermintaanLab::pluck('id_permintaan')->toArray();
        $pemeriksaanIds = JenisPemeriksaanLab::pluck('id_jenis_pemeriksaan')->toArray();
        $laboratoriumIds = Laboratorium::pluck('id_laboratorium')->toArray();
        $laboranIds = User::where('role_id', 6)->pluck('id')->toArray();

        if (empty($permintaanIds) || empty($pemeriksaanIds) || empty($laboratoriumIds) || empty($laboranIds)) {
            $this->command->warn('Data permintaan/pemeriksaan/laboratorium/laboran belum ada. HasilLab Seeder dilewati.');
            return;
        }

        foreach ($permintaanIds as $idPermintaan) {
            HasilLab::create([
                'id_permintaan' => $idPermintaan,
                'id_jenis_pemeriksaan' => fake()->randomElement($pemeriksaanIds),
                'nilai_hasil' => fake()->randomFloat(1, 1, 10),
                'interpretasi' => fake()->sentence(),
                'id_laboratorium' => fake()->randomElement($laboratoriumIds),
                'dilakukan_oleh' => fake()->randomElement($laboranIds),
                'status_hasil' => fake()->randomElement(['normal', 'abnormal', 'kritis']),
                'tanggal_pemeriksaan' => now()->subDays(rand(0, 30)),
            ]);
        }
    }
}

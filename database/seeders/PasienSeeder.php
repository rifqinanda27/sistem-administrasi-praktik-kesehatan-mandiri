<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Patients;
use Illuminate\Support\Str;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat 10 data dummy pasien
        for ($i = 1; $i <= 10; $i++) {
            Patients::create([
                'no_rekam_medis' => 'RM' . str_pad($i, 5, '0', STR_PAD_LEFT),
                'nama_lengkap' => 'Pasien ' . $i,
                'tanggal_lahir' => now()->subYears(rand(20, 60))->subDays(rand(0, 365)),
                'jenis_kelamin' => ['laki-laki', 'perempuan', 'lainnya'][array_rand(['laki-laki', 'perempuan', 'lainnya'])],
                'no_ktp' => '3210' . rand(10000000, 99999999),
                'alamat' => 'Jl. Contoh Alamat No. ' . $i,
                'telepon' => '08' . rand(1000000000, 9999999999),
                'status_aktif' => true,
            ]);
        }
    }
}

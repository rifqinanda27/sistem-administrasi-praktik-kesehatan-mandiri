<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Visit;
use App\Models\Patients;
use App\Models\User; 

class KunjunganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dokterIds = User::where('role_id', 4)->pluck('id')->toArray();

        if (empty($dokterIds)) {
            // Jika tidak ada dokter, buat dummy dokter dulu
            $dokter = \App\Models\User::create([
                'name' => 'Dr. Dummy',
                'email' => 'drdummy@example.com',
                'password' => bcrypt('password'),
                'role_id' => 4,
            ]);
            $dokterIds[] = $dokter->id;
        }

        $pasienIds = Patients::pluck('id_pasien')->toArray();

        foreach ($pasienIds as $pasienId) {
            Visit::create([
                'id_pasien' => $pasienId,
                'id_dokter' => $dokterIds[array_rand($dokterIds)],
                'tanggal_kunjungan' => now()->addDays(rand(-30, 30)),
                'tipe_kunjungan' => ['awal', 'lanjutan', 'prenatal', 'postnatal', 'darurat'][array_rand(['awal', 'lanjutan', 'prenatal', 'postnatal', 'darurat'])],
                'status_kunjungan' => ['terjadwal', 'dalam_proses', 'selesai', 'dibatalkan'][array_rand(['terjadwal', 'dalam_proses', 'selesai', 'dibatalkan'])],
                'catatan' => 'Catatan kunjungan pasien #' . $pasienId,
            ]);
        }
    }
}

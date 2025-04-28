<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CatatanMedis;
use App\Models\Visit;

class CatatanMedisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $kunjunganIds = Visit::pluck('id_kunjungan')->toArray();

        if (empty($kunjunganIds)) {
            $this->command->warn('Tidak ada data kunjungan untuk catatan medis.');
            return;
        }

        foreach (range(1, 10) as $index) {
            CatatanMedis::create([
                'id_kunjungan' => fake()->randomElement($kunjunganIds),
                'keluhan_utama' => fake()->sentence(),
                'keluhan_tambahan' => fake()->sentence(),
                'riwayat_penyakit_pribadi' => fake()->paragraph(),
                'riwayat_penyakit_keluarga' => fake()->paragraph(),
                'kebiasaan_pasien' => fake()->words(3, true),
                'berat_badan' => fake()->randomFloat(1, 40, 90),
                'frekuensi_nafas' => fake()->randomFloat(1, 16, 24),
                'tinggi_badan' => fake()->randomFloat(1, 140, 190),
                'suhu_tubuh' => fake()->randomFloat(1, 36, 39),
                'tekanan_darah' => fake()->numberBetween(100, 140) . '/' . fake()->numberBetween(60, 90),
                'keadaan_umum' => fake()->sentence(),
                'neurologi' => fake()->sentence(),
                'diagnosa_sementara' => fake()->sentence(),
                'diagnosa_tambahan' => fake()->sentence(),
                'tanggal' => fake()->date(),
            ]);
        }
    }
}

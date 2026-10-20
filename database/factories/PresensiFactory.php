<?php

namespace Database\Factories;

use App\Models\Jadwal;
use App\Models\Presensi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Presensi>
 */
class PresensiFactory extends Factory
{
    protected $model = Presensi::class;

    public function definition(): array
    {
        $jamMasuk = fake()->dateTimeBetween('-20 days', '-1 day');
        $jamKeluar = (clone $jamMasuk)->modify('+8 hours');

        return [
            'id_jadwal' => Jadwal::factory(),
            'jam_masuk' => $jamMasuk,
            'jam_keluar' => $jamKeluar,
            'status' => 'hadir',
            'total_jam' => 8,
            'menit_terlambat' => 0,
            'terkunci' => false,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Shift;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Shift>
 */
class ShiftFactory extends Factory
{
    protected $model = Shift::class;

    public function definition(): array
    {
        $lintasTengahMalam = fake()->boolean(20);

        return [
            'nama_shift' => 'Shift '.fake()->unique()->numberBetween(1, 999999),
            'jam_mulai' => $lintasTengahMalam ? '22:00:00' : '08:00:00',
            'jam_selesai' => $lintasTengahMalam ? '06:00:00' : '16:00:00',
            'lintas_tengah_malam' => $lintasTengahMalam,
            'durasi_jam' => 8,
            'toleransi_telat_menit' => 10,
            'status' => 'aktif',
        ];
    }
}

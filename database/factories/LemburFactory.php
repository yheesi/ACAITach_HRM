<?php

namespace Database\Factories;

use App\Models\Jadwal;
use App\Models\Lembur;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Lembur>
 */
class LemburFactory extends Factory
{
    protected $model = Lembur::class;

    public function definition(): array
    {
        return [
            'id_jadwal' => Jadwal::factory(),
            'tanggal_lembur' => fake()->dateTimeBetween('-20 days', 'now')->format('Y-m-d'),
            'jam_lembur' => fake()->randomElement([1, 1.5, 2, 2.5, 3]),
            'alasan' => fake()->sentence(),
            'status' => 'menunggu',
            'disetujui_oleh' => null,
            'disetujui_pada' => null,
            'terkunci' => false,
        ];
    }
}

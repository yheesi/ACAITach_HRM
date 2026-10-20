<?php

namespace Database\Factories;

use App\Models\Cabang;
use App\Models\Jadwal;
use App\Models\Karyawan;
use App\Models\Pengguna;
use App\Models\Shift;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Jadwal>
 */
class JadwalFactory extends Factory
{
    protected $model = Jadwal::class;

    public function definition(): array
    {
        return [
            'id_karyawan' => Karyawan::factory(),
            'id_cabang' => Cabang::factory(),
            'id_shift' => Shift::factory(),
            'tanggal' => fake()->dateTimeBetween('-30 days', '+30 days')->format('Y-m-d'),
            'status' => 'terjadwal',
            'dibuat_oleh' => Pengguna::factory(),
        ];
    }
}

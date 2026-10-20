<?php

namespace Database\Factories;

use App\Models\Cabang;
use App\Models\Karyawan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Karyawan>
 */
class KaryawanFactory extends Factory
{
    protected $model = Karyawan::class;

    public function definition(): array
    {
        return [
            'id_cabang' => Cabang::factory(),
            'nama' => fake()->name(),
            'jabatan' => fake()->randomElement(['staf', 'supervisor', 'manajer']),
            'no_identitas' => fake()->unique()->numerify('################'),
            'telepon' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'status_kerja' => 'aktif',
            'tanggal_bergabung' => fake()->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
            'tanggal_keluar' => null,
        ];
    }
}

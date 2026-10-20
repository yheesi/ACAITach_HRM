<?php

namespace Database\Factories;

use App\Models\Karyawan;
use App\Models\Pengguna;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pengguna>
 */
class PenggunaFactory extends Factory
{
    protected $model = Pengguna::class;

    public function definition(): array
    {
        return [
            'id_karyawan' => Karyawan::factory(),
            'username' => fake()->unique()->userName(),
            'password' => 'password',
            'peran' => 'staf',
            'aktif' => true,
            'terakhir_login' => null,
        ];
    }
}

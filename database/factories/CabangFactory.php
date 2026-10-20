<?php

namespace Database\Factories;

use App\Models\Cabang;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Cabang>
 */
class CabangFactory extends Factory
{
    protected $model = Cabang::class;

    public function definition(): array
    {
        return [
            'nama_cabang' => fake()->unique()->company(),
            'alamat' => fake()->streetAddress(),
            'kota' => fake()->city(),
            'telepon' => fake()->phoneNumber(),
            'status' => 'aktif',
        ];
    }
}

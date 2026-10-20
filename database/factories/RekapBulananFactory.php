<?php

namespace Database\Factories;

use App\Models\Cabang;
use App\Models\Pengguna;
use App\Models\RekapBulanan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<RekapBulanan>
 */
class RekapBulananFactory extends Factory
{
    protected $model = RekapBulanan::class;

    public function definition(): array
    {
        return [
            'id_cabang' => Cabang::factory(),
            'tanggal_mulai' => now()->startOfMonth()->toDateString(),
            'tanggal_selesai' => now()->endOfMonth()->toDateString(),
            'total_karyawan' => fake()->numberBetween(1, 100),
            'total_jam_kerja' => fake()->randomFloat(2, 100, 2000),
            'total_jam_terlambat' => fake()->randomFloat(2, 0, 100),
            'total_jam_lembur' => fake()->randomFloat(2, 0, 200),
            'dibuat_oleh' => Pengguna::factory(),
            'terkunci' => false,
            'dikunci_pada' => null,
        ];
    }
}

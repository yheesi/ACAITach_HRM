<?php

namespace Database\Factories;

use App\Models\Jadwal;
use App\Models\Karyawan;
use App\Models\Pengguna;
use App\Models\Shift;
use Illuminate\Database\Eloquent\Factories\Factory;
use RuntimeException;

/**
 * @extends Factory<Jadwal>
 */
class JadwalFactory extends Factory
{
    protected $model = Jadwal::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_karyawan' => fn () => Karyawan::query()->inRandomOrder()->value('id_karyawan')
                ?? throw new RuntimeException('Buat data karyawan sebelum membuat jadwal.'),
            'id_cabang' => function (array $attributes): int {
                return Karyawan::query()
                    ->where('id_karyawan', $attributes['id_karyawan'])
                    ->value('id_cabang')
                    ?? throw new RuntimeException('Cabang karyawan untuk jadwal tidak ditemukan.');
            },
            'id_shift' => fn () => Shift::query()->inRandomOrder()->value('id_shift')
                ?? throw new RuntimeException('Buat data shift sebelum membuat jadwal.'),
            'tanggal' => fake()->dateTimeBetween('today', '+30 days')->format('Y-m-d'),
            'status' => 'aktif',
            'dibuat_oleh' => fn () => Pengguna::query()->inRandomOrder()->value('id_pengguna')
                ?? throw new RuntimeException('Buat data pengguna sebelum membuat jadwal.'),
        ];
    }
}

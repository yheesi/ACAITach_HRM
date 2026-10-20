<?php

namespace Database\Factories;

use App\Models\LogAudit;
use App\Models\Pengguna;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LogAudit>
 */
class LogAuditFactory extends Factory
{
    protected $model = LogAudit::class;

    public function definition(): array
    {
        return [
            'id_pengguna' => Pengguna::factory(),
            'aksi' => fake()->randomElement(['CREATE', 'UPDATE', 'DELETE']),
            'nama_tabel' => fake()->randomElement(['karyawan', 'jadwal', 'presensi', 'lembur']),
            'id_objek' => fake()->numberBetween(1, 1000),
            'data_lama' => null,
            'data_baru' => ['catatan' => fake()->sentence()],
            'waktu_catat' => now(),
        ];
    }
}

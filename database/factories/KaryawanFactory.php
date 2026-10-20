<?php

namespace Database\Factories;

use App\Models\Cabang;
use App\Models\Karyawan;
use Illuminate\Database\Eloquent\Factories\Factory;
use RuntimeException;

/**
 * @extends Factory<Karyawan>
 */
class KaryawanFactory extends Factory
{
    protected $model = Karyawan::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_cabang' => fn () => Cabang::query()->value('id_cabang')
                ?? throw new RuntimeException('Buat data cabang sebelum membuat karyawan.'),
            'nama' => fake()->name(),
            'jabatan' => fake()->jobTitle(),
            'no_identitas' => function (): string {
                do {
                    $noIdentitas = fake()->unique()->numerify('################');
                } while (Karyawan::query()->where('no_identitas', $noIdentitas)->exists());

                return $noIdentitas;
            },
            'telepon' => fake()->phoneNumber(),
            'email' => function (): string {
                do {
                    $email = fake()->unique()->safeEmail();
                } while (Karyawan::query()->where('email', $email)->exists());

                return $email;
            },
            'status_kerja' => fake()->randomElement(['aktif', 'cuti', 'resign']),
            'tanggal_bergabung' => fake()->date(),
            'tanggal_keluar' => null,
        ];
    }
}
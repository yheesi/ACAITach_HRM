<?php

namespace Database\Seeders;

use App\Models\Karyawan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KaryawanSeeder extends Seeder
{
    public function run(): void
    {
        $cabangId = DB::table('cabang')->value('id_cabang');

        if ($cabangId === null) {
            $now = now();
            $cabangId = DB::table('cabang')->insertGetId([
                'nama_cabang' => 'Cabang Utama',
                'alamat' => 'Jl. Contoh No. 1',
                'kota' => 'Jakarta',
                'telepon' => null,
                'status' => 'aktif',
                'dibuat_pada' => $now,
                'diperbarui_pada' => $now,
            ], 'id_cabang');
        }

        $remaining = max(0, 100000 - Karyawan::query()->count());

        if ($remaining === 0) {
            return;
        }

        Karyawan::factory()
            ->count($remaining)
            ->create(['id_cabang' => $cabangId]);
    }
}
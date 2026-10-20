<?php

namespace Database\Seeders;

use App\Models\Jadwal;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class JadwalSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        if (DB::table('shift')->doesntExist()) {
            DB::table('shift')->insert([
                'nama_shift' => 'Pagi',
                'jam_mulai' => '09:00:00',
                'jam_selesai' => '17:00:00',
                'lintas_tengah_malam' => false,
                'durasi_jam' => '8.00',
                'toleransi_telat_menit' => 15,
                'status' => 'aktif',
                'dibuat_pada' => $now,
                'diperbarui_pada' => $now,
            ]);
        }

        if (DB::table('pengguna')->doesntExist()) {
            DB::table('pengguna')->insert([
                'id_karyawan' => null,
                'username' => 'seeder',
                'password' => Hash::make(Str::random(40)),
                'peran' => 'admin',
                'aktif' => true,
                'terakhir_login' => null,
                'dibuat_pada' => $now,
                'diperbarui_pada' => $now,
            ]);
        }

        $remaining = max(0, 1000 - Jadwal::query()->count());

        if ($remaining > 0) {
            Jadwal::factory()->count($remaining)->create();
        }
    }
}

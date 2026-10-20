<?php

namespace Database\Seeders;

use App\Models\Cabang;
use App\Models\Jadwal;
use App\Models\Karyawan;
use App\Models\Lembur;
use App\Models\LogAudit;
use App\Models\Pengguna;
use App\Models\Presensi;
use App\Models\RekapBulanan;
use App\Models\Shift;
use Illuminate\Database\Seeder;

class HrmSeeder extends Seeder
{
    public function run(): void
    {
        $cabangUtama = Cabang::query()->firstOrCreate(
            ['nama_cabang' => 'Kantor Pusat'],
            ['alamat' => fake()->streetAddress(), 'kota' => 'Jakarta', 'telepon' => fake()->phoneNumber(), 'status' => 'aktif'],
        );
        $cabangBandung = Cabang::query()->firstOrCreate(
            ['nama_cabang' => 'Cabang Bandung'],
            ['alamat' => fake()->streetAddress(), 'kota' => 'Bandung', 'telepon' => fake()->phoneNumber(), 'status' => 'aktif'],
        );

        $shiftPagi = Shift::query()->firstOrCreate(
            ['nama_shift' => 'Pagi'],
            ['jam_mulai' => '08:00:00', 'jam_selesai' => '16:00:00', 'lintas_tengah_malam' => false, 'durasi_jam' => 8, 'toleransi_telat_menit' => 10, 'status' => 'aktif'],
        );
        $shiftSiang = Shift::query()->firstOrCreate(
            ['nama_shift' => 'Siang'],
            ['jam_mulai' => '14:00:00', 'jam_selesai' => '22:00:00', 'lintas_tengah_malam' => false, 'durasi_jam' => 8, 'toleransi_telat_menit' => 10, 'status' => 'aktif'],
        );
        $shiftMalam = Shift::query()->firstOrCreate(
            ['nama_shift' => 'Malam'],
            ['jam_mulai' => '22:00:00', 'jam_selesai' => '06:00:00', 'lintas_tengah_malam' => true, 'durasi_jam' => 8, 'toleransi_telat_menit' => 10, 'status' => 'aktif'],
        );

        $karyawan = collect();
        foreach ([$cabangUtama, $cabangBandung] as $cabang) {
            $pegawaiCabang = Karyawan::query()->where('id_cabang', $cabang->id_cabang)->get();
            if ($pegawaiCabang->isEmpty()) {
                Karyawan::factory()->count(5)->create([
                    'id_cabang' => $cabang->id_cabang,
                ]);
                $pegawaiCabang = Karyawan::query()->where('id_cabang', $cabang->id_cabang)->get();
            }

            $karyawan = $karyawan->merge($pegawaiCabang);
        }

        $admin = Pengguna::query()->where('username', 'admin')->first();
        if (! $admin) {
            $admin = Pengguna::factory()->create([
                'id_karyawan' => $karyawan->first()->id_karyawan,
                'username' => 'admin',
                'password' => 'password',
                'peran' => 'admin',
            ]);
        }

        $shifts = collect([$shiftPagi, $shiftSiang, $shiftMalam]);
        $jadwal = $karyawan->map(function (Karyawan $pegawai, int $index) use ($admin, $shifts) {
            $shift = $shifts[$index % $shifts->count()];
            $tanggal = now()->subDays($index % 7)->toDateString();

            $item = Jadwal::query()
                ->where('id_karyawan', $pegawai->id_karyawan)
                ->whereDate('tanggal', $tanggal)
                ->first();

            if (! $item) {
                $item = Jadwal::factory()->create([
                    'id_karyawan' => $pegawai->id_karyawan,
                    'tanggal' => $tanggal,
                    'id_cabang' => $pegawai->id_cabang,
                    'id_shift' => $shift->id_shift,
                    'status' => 'terjadwal',
                    'dibuat_oleh' => $admin->id_pengguna,
                ]);
            }

            if (! Presensi::query()->where('id_jadwal', $item->id_jadwal)->exists()) {
                Presensi::factory()->create([
                    'id_jadwal' => $item->id_jadwal,
                    'status' => $index % 4 === 0 ? 'terlambat' : 'hadir',
                    'menit_terlambat' => $index % 4 === 0 ? 10 : 0,
                ]);
            }

            return $item;
        });

        $jumlahLembur = Lembur::query()->count();
        foreach ($jadwal->take(3) as $item) {
            if ($jumlahLembur >= 3) {
                break;
            }

            if (Lembur::query()->where('id_jadwal', $item->id_jadwal)->exists()) {
                continue;
            }

            Lembur::factory()->create([
                'id_jadwal' => $item->id_jadwal,
                'tanggal_lembur' => $item->tanggal,
                'disetujui_oleh' => $admin->id_pengguna,
                'status' => 'disetujui',
                'disetujui_pada' => now(),
            ]);
            $jumlahLembur++;
        }

        $tanggalMulai = now()->startOfMonth()->toDateString();
        if (! RekapBulanan::query()->where('id_cabang', $cabangUtama->id_cabang)->whereDate('tanggal_mulai', $tanggalMulai)->exists()) {
            RekapBulanan::factory()->create([
                'id_cabang' => $cabangUtama->id_cabang,
                'tanggal_mulai' => $tanggalMulai,
                'tanggal_selesai' => now()->endOfMonth()->toDateString(),
                'total_karyawan' => $karyawan->where('id_cabang', $cabangUtama->id_cabang)->count(),
                'total_jam_kerja' => $karyawan->where('id_cabang', $cabangUtama->id_cabang)->count() * 160,
                'total_jam_terlambat' => 0,
                'total_jam_lembur' => 0,
                'dibuat_oleh' => $admin->id_pengguna,
                'terkunci' => false,
            ]);
        }

        LogAudit::query()->firstOrCreate(
            [
                'id_pengguna' => $admin->id_pengguna,
                'aksi' => 'CREATE',
                'nama_tabel' => 'karyawan',
                'id_objek' => $karyawan->first()->id_karyawan,
            ],
            ['data_baru' => ['catatan' => 'Data contoh dibuat oleh seeder'], 'waktu_catat' => now()],
        );
    }
}

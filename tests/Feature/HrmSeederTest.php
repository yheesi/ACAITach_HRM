<?php

namespace Tests\Feature;

use App\Models\Cabang;
use App\Models\Jadwal;
use App\Models\Karyawan;
use App\Models\Lembur;
use App\Models\LogAudit;
use App\Models\Pengguna;
use App\Models\Presensi;
use App\Models\RekapBulanan;
use App\Models\Shift;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class HrmSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_database_seeder_creates_related_hrm_sample_data(): void
    {
        $this->seed();

        $this->assertSame(2, Cabang::count());
        $this->assertSame(10, Karyawan::count());
        $this->assertSame(3, Shift::count());
        $this->assertSame(1, Pengguna::count());
        $this->assertSame(10, Jadwal::count());
        $this->assertSame(10, Presensi::count());
        $this->assertSame(3, Lembur::count());
        $this->assertSame(1, RekapBulanan::count());
        $this->assertSame(1, LogAudit::count());

        $admin = Pengguna::query()->where('username', 'admin')->firstOrFail();

        $this->assertTrue(Hash::check('password', $admin->password));
        $this->assertNotNull($admin->karyawan);
        $this->assertSame($admin->karyawan->id_cabang, $admin->karyawan->jadwal->first()->id_cabang);

        $this->seed();

        $this->assertSame(2, Cabang::count());
        $this->assertSame(10, Karyawan::count());
        $this->assertSame(10, Jadwal::count());
        $this->assertSame(10, Presensi::count());
        $this->assertSame(3, Lembur::count());
    }

    public function test_factories_can_create_hrm_records_with_custom_primary_keys(): void
    {
        $cabang = Cabang::factory()->create();
        $karyawan = Karyawan::factory()->create(['id_cabang' => $cabang->id_cabang]);
        $pengguna = Pengguna::factory()->create(['id_karyawan' => $karyawan->id_karyawan]);
        $jadwal = Jadwal::factory()->create([
            'id_karyawan' => $karyawan->id_karyawan,
            'id_cabang' => $cabang->id_cabang,
            'dibuat_oleh' => $pengguna->id_pengguna,
        ]);

        $this->assertSame($cabang->id_cabang, $karyawan->cabang->id_cabang);
        $this->assertSame($karyawan->id_karyawan, $pengguna->karyawan->id_karyawan);
        $this->assertSame($pengguna->id_pengguna, $jadwal->pembuat->id_pengguna);
    }
}

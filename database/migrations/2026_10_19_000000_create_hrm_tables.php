<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cabang', function (Blueprint $table) {
            $table->id('id_cabang');
            $table->string('nama_cabang', 100);
            $table->string('alamat', 255);
            $table->string('kota', 50);
            $table->string('telepon', 20)->nullable();
            $table->string('status', 10);
            $table->timestamp('dibuat_pada')->useCurrent();
            $table->timestamp('diperbarui_pada')->useCurrent();
        });

        Schema::create('shift', function (Blueprint $table) {
            $table->id('id_shift');
            $table->string('nama_shift', 30)->unique();
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->boolean('lintas_tengah_malam')->default(false);
            $table->decimal('durasi_jam', 4, 2);
            $table->smallInteger('toleransi_telat_menit');
            $table->string('status', 10);
            $table->timestamp('dibuat_pada')->useCurrent();
            $table->timestamp('diperbarui_pada')->useCurrent();
        });

        Schema::create('karyawan', function (Blueprint $table) {
            $table->id('id_karyawan');
            $table->foreignId('id_cabang')->constrained('cabang', 'id_cabang');
            $table->string('nama', 100);
            $table->string('jabatan', 30);
            $table->string('no_identitas', 20)->unique();
            $table->string('telepon', 20)->nullable();
            $table->string('email', 100)->nullable()->unique();
            $table->string('status_kerja', 15);
            $table->date('tanggal_bergabung');
            $table->date('tanggal_keluar')->nullable();
            $table->timestamp('dibuat_pada')->useCurrent();
            $table->timestamp('diperbarui_pada')->useCurrent();
        });

        Schema::create('pengguna', function (Blueprint $table) {
            $table->id('id_pengguna');
            $table->foreignId('id_karyawan')->nullable()->unique()->constrained('karyawan', 'id_karyawan')->nullOnDelete();
            $table->string('username', 50)->unique();
            $table->string('password');
            $table->string('peran', 20);
            $table->boolean('aktif');
            $table->timestamp('terakhir_login')->nullable();
            $table->timestamp('dibuat_pada')->useCurrent();
            $table->timestamp('diperbarui_pada')->useCurrent();
        });

        Schema::create('jadwal', function (Blueprint $table) {
            $table->id('id_jadwal');
            $table->foreignId('id_karyawan')->constrained('karyawan', 'id_karyawan');
            $table->foreignId('id_cabang')->constrained('cabang', 'id_cabang');
            $table->foreignId('id_shift')->constrained('shift', 'id_shift');
            $table->date('tanggal');
            $table->string('status', 15);
            $table->foreignId('dibuat_oleh')->constrained('pengguna', 'id_pengguna');
            $table->timestamp('dibuat_pada')->useCurrent();
            $table->timestamp('diperbarui_pada')->useCurrent();
        });

        Schema::create('presensi', function (Blueprint $table) {
            $table->id('id_presensi');
            $table->foreignId('id_jadwal')->unique()->constrained('jadwal', 'id_jadwal');
            $table->timestamp('jam_masuk')->nullable();
            $table->timestamp('jam_keluar')->nullable();
            $table->string('status', 20);
            $table->decimal('total_jam', 5, 2)->nullable();
            $table->integer('menit_terlambat')->default(0);
            $table->boolean('terkunci')->default(false);
            $table->timestamp('dibuat_pada')->useCurrent();
            $table->timestamp('diperbarui_pada')->useCurrent();
        });

        Schema::create('lembur', function (Blueprint $table) {
            $table->id('id_lembur');
            $table->foreignId('id_jadwal')->constrained('jadwal', 'id_jadwal');
            $table->date('tanggal_lembur');
            $table->decimal('jam_lembur', 3, 1);
            $table->string('alasan', 255);
            $table->string('status', 15);
            $table->foreignId('disetujui_oleh')->nullable()->constrained('pengguna', 'id_pengguna')->nullOnDelete();
            $table->timestamp('disetujui_pada')->nullable();
            $table->boolean('terkunci')->default(false);
            $table->timestamp('dibuat_pada')->useCurrent();
            $table->timestamp('diperbarui_pada')->useCurrent();
        });

        Schema::create('rekap_bulanan', function (Blueprint $table) {
            $table->id('id_rekap');
            $table->foreignId('id_cabang')->constrained('cabang', 'id_cabang');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->integer('total_karyawan');
            $table->decimal('total_jam_kerja', 10, 2);
            $table->decimal('total_jam_terlambat', 8, 2);
            $table->decimal('total_jam_lembur', 8, 2);
            $table->foreignId('dibuat_oleh')->constrained('pengguna', 'id_pengguna');
            $table->boolean('terkunci')->default(false);
            $table->timestamp('dikunci_pada')->nullable();
            $table->timestamp('dibuat_pada')->useCurrent();
        });

        Schema::create('log_audit', function (Blueprint $table) {
            $table->id('id_audit');
            $table->foreignId('id_pengguna')->nullable()->constrained('pengguna', 'id_pengguna')->nullOnDelete();
            $table->string('aksi', 10);
            $table->string('nama_tabel', 50);
            $table->unsignedBigInteger('id_objek');
            $table->json('data_lama')->nullable();
            $table->json('data_baru')->nullable();
            $table->timestamp('waktu_catat')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('log_audit');
        Schema::dropIfExists('rekap_bulanan');
        Schema::dropIfExists('lembur');
        Schema::dropIfExists('presensi');
        Schema::dropIfExists('jadwal');
        Schema::dropIfExists('pengguna');
        Schema::dropIfExists('karyawan');
        Schema::dropIfExists('shift');
        Schema::dropIfExists('cabang');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {

    public function up()
    {
        Schema::create('rekap_bulanan', function (Blueprint $table) {
            $table->increments('id_rekap');
            $table->unsignedInteger('id_cabang');
            $table->foreign('id_cabang')->references('id_cabang')->on('cabang');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->integer('total_karyawan');
            $table->string('total_jam_kerja');
            $table->string('total_jam_terlambat');
            $table->string('total_jam_lembur');
            $table->unsignedInteger('dibuat_oleh');
            $table->foreign('dibuat_oleh')->references('id_pengguna')->on('pengguna');
            $table->boolean('terkunci')->default(false);
            $table->timestampTz('dikunci_pada')->nullable();
            $table->timestampTz('dibuat_pada');

        });
    }

    public function down()
    {
        Schema::dropIfExists('rekap_bulanan');
    }
};

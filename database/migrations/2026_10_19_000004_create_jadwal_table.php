<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {

    public function up()
    {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->increments('id_jadwal');
            $table->unsignedInteger('id_karyawan');
            $table->foreign('id_karyawan')->references('id_karyawan')->on('karyawan');
            $table->unsignedInteger('id_cabang');
            $table->foreign('id_cabang')->references('id_cabang')->on('cabang');
            $table->unsignedInteger('id_shift');
            $table->foreign('id_shift')->references('id_shift')->on('shift');
            $table->date('tanggal');
            $table->string('status');
            $table->unsignedInteger('dibuat_oleh');
            $table->foreign('dibuat_oleh')->references('id_pengguna')->on('pengguna');
            $table->timestampTz('dibuat_pada');
            $table->timestampTz('diperbarui_pada');

        });
    }

    public function down()
    {
        Schema::dropIfExists('jadwal');
    }
};

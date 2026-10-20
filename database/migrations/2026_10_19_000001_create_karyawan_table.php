<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {

    public function up()
    {
        Schema::create('karyawan', function (Blueprint $table) {
            $table->increments('id_karyawan');
            $table->unsignedInteger('id_cabang');
            $table->foreign('id_cabang')->references('id_cabang')->on('cabang');
            $table->string('nama');
            $table->string('jabatan');
            $table->string('no_identitas')->unique();
            $table->string('telepon')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('status_kerja');
            $table->date('tanggal_bergabung');
            $table->date('tanggal_keluar')->nullable();
            $table->timestampTz('dibuat_pada');
            $table->timestampTz('diperbarui_pada');

        });
    }

    public function down()
    {
        Schema::dropIfExists('karyawan');
    }
};

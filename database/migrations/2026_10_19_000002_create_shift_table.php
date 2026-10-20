<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {

    public function up()
    {
        Schema::create('shift', function (Blueprint $table) {
            $table->increments('id_shift');
            $table->string('nama_shift')->unique();
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->boolean('lintas_tengah_malam')->default(false);
            $table->string('durasi_jam');
            $table->smallInteger('toleransi_telat_menit');
            $table->string('status');
            $table->timestampTz('dibuat_pada');
            $table->timestampTz('diperbarui_pada');

        });
    }

    public function down()
    {
        Schema::dropIfExists('shift');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {

    public function up()
    {
        Schema::create('presensi', function (Blueprint $table) {
            $table->increments('id_presensi');
            $table->unsignedInteger('id_jadwal')->unique();
            $table->timestampTz('jam_masuk')->nullable();
            $table->timestampTz('jam_keluar')->nullable();
            $table->string('status');
            $table->string('total_jam')->nullable();
            $table->integer('menit_terlambat')->default(0);
            $table->boolean('terkunci')->default(false);
            $table->timestampTz('dibuat_pada');
            $table->timestampTz('diperbarui_pada');

        });
    }

    public function down()
    {
        Schema::dropIfExists('presensi');
    }
};

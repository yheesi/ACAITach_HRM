<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {

    public function up()
    {
        Schema::create('lembur', function (Blueprint $table) {
            $table->increments('id_lembur');
            $table->unsignedInteger('id_jadwal');
            $table->foreign('id_jadwal')->references('id_jadwal')->on('jadwal');
            $table->date('tanggal_lembur');
            $table->string('jam_lembur');
            $table->string('alasan');
            $table->string('status');
            $table->unsignedInteger('disetujui_oleh')->nullable();
            $table->foreign('disetujui_oleh')->references('id_pengguna')->on('pengguna');
            $table->timestampTz('disetujui_pada')->nullable();
            $table->boolean('terkunci')->default(false);
            $table->timestampTz('dibuat_pada');
            $table->timestampTz('diperbarui_pada');

        });
    }

    public function down()
    {
        Schema::dropIfExists('lembur');
    }
};

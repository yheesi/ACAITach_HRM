<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {

    public function up()
    {
        Schema::create('log_audit', function (Blueprint $table) {
            $table->increments('id_audit');
            $table->unsignedInteger('id_pengguna')->nullable();
            $table->foreign('id_pengguna')->references('id_pengguna')->on('pengguna');
            $table->string('aksi');
            $table->string('nama_tabel');
            $table->integer('id_objek');
            $table->json('data_lama')->nullable();
            $table->json('data_baru')->nullable();
            $table->timestampTz('waktu_catat');

        });
    }

    public function down()
    {
        Schema::dropIfExists('log_audit');
    }
};

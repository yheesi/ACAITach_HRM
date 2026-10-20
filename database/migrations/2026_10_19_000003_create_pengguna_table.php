<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {

    public function up()
    {
        Schema::create('pengguna', function (Blueprint $table) {
            $table->increments('id_pengguna');
            $table->unsignedInteger('id_karyawan')->nullable()->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('peran');
            $table->boolean('aktif');
            $table->timestampTz('terakhir_login')->nullable();
            $table->timestampTz('dibuat_pada');
            $table->timestampTz('diperbarui_pada');

        });
    }

    public function down()
    {
        Schema::dropIfExists('pengguna');
    }
};

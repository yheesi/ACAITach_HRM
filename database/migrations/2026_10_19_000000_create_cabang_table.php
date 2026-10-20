<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {

    public function up()
    {
        Schema::create('cabang', function (Blueprint $table) {
            $table->increments('id_cabang');
            $table->string('nama_cabang');
            $table->string('alamat');
            $table->string('kota');
            $table->string('telepon')->nullable();
            $table->string('status');
            $table->timestampTz('dibuat_pada');
            $table->timestampTz('diperbarui_pada');

        });
    }

    public function down()
    {
        Schema::dropIfExists('cabang');
    }
};

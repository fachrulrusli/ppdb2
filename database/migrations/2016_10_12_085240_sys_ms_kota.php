<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SysMsKota extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_ms_kota', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_prov');
            $table->string('nama_kota',50);
            $table->index(['id_prov','nama_kota'], 'IDX_sys_ms_akses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_ms_kota');
    }
}

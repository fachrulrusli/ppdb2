<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SysMsAkses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_ms_akses', function (Blueprint $table) {
            $table->increments('id_akses');
            $table->string('nama');
            $table->string('slug')->unique();
            $table->string('keterangan')->nullable();
            $table->timestamps();
            $table->index(['nama','slug'], 'IDX_sys_ms_akses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_ms_akses');
    }
}

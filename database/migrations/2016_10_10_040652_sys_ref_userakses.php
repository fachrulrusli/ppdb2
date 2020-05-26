<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SysRefUserakses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_ref_userakses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user');
            $table->integer('id_akses')->nullable();
            $table->index(['id_user','id_akses'], 'IDX_ref_user_akses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_ref_userakses');
    }
}

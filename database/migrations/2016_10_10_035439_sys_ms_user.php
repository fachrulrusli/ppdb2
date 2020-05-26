<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SysMsUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_ms_user', function (Blueprint $table) {
            $table->increments('id_user');
            $table->string('username', 25);
            $table->binary('password', 100);
            $table->binary('password_otorisasi', 100);
            $table->string('nama_user', 50);
            $table->integer('status')->default(0);
            $table->string('kode_cabang',5);
            $table->integer('login')->nullable()->default(0);
            $table->dateTime('login_terakhir')->nullable();
            $table->string('login_ip', 50)->nullable();
            $table->string('created_by',25);
            $table->timestamps();
            $table->index(['username','nama_user','status','kode_cabang','login'], 'IDX_sys_ms_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_ms_user');
    }
}

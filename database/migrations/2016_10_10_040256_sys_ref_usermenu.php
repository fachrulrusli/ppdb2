<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SysRefUsermenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_ref_usermenu', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_user');
            $table->integer('id_menu');
            $table->index(['id_user','id_menu'], 'IDX_ref_user_menu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_ref_usermenu');
    }
}

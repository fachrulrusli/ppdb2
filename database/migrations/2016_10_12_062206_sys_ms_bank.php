<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SysMsBank extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_ms_bank', function (Blueprint $table) {
            $table->increments('id_bank');
            $table->string('nama_bank',255);
            $table->string('keyword',255);
            $table->string('rtgs',255);
            $table->string('kliring',255);
            $table->string('int_code',255);
            $table->timestamps();
            $table->index(['nama_bank','keyword','rtgs','kliring','int_code'], 'IDX_sys_ms_bank');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_ms_bank');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SysRefGrupakses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_ref_grupakses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_grup');
            $table->integer('id_akses');
            $table->index(['id_grup','id_akses'], 'IDX_ref_grup_akses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_ref_grupakses');
    }
}

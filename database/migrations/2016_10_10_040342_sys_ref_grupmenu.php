<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SysRefGrupmenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_ref_grupmenu', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_grup');
            $table->integer('id_menu');
            $table->index(['id_grup','id_menu'], 'IDX_ref_grup_menu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_ref_grupmenu');
    }
}

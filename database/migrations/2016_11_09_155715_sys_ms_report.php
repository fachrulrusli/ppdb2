<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SysMsReport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_ms_report', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama', 50)->nullable();
            $table->string('url', 100)->nullable();
            $table->string('keterengan', 50)->nullable();
            $table->text('parameter', 16)->nullable();
            $table->index(['nama','url'],'IDX_sys_ms_report');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_ms_report');
    }
}

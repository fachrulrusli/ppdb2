<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SysMsGrup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_ms_grup', function (Blueprint $table) {
            $table->integer('id_grup', true);
            $table->string('nama_grup', 100);
            $table->integer('status')->default(0);
            $table->string('keterangan')->nullable();
            $table->timestamps();
            $table->index(['nama_grup','status'], 'IDX_sys_ms_grup');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_ms_grup');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SysMsMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_ms_menu', function (Blueprint $table) {
            $table->increments('id_menu');
            $table->string('nama_menu', 50)->nullable();
            $table->string('url', 100)->nullable();
            $table->integer('menu_grup')->nullable();
            $table->string('attribut')->nullable();
            $table->string('deskripsi')->nullable();
            $table->string('menu_utama')->default('1');
            $table->integer('status')->nullable()->default(0);
            $table->integer('urutan')->nullable()->default(1);
            $table->string('icon', 100)->nullable();
            $table->timestamps();
            $table->index(['nama_menu','menu_grup','menu_utama','status','urutan'], 'IDX_sys_menu');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_ms_menu');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SysMsCabang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_ms_cabang', function (Blueprint $table) {
            $table->string('id_cabang',4);
            $table->string('nama_cabang',50);
            $table->string('regional',4);
            $table->integer('id_kota');
            $table->tinyInteger('jenis')->nullable()->default(0);
            $table->tinyInteger('urutan')->nullable()->default(0);
            $table->string('bm',8);
            $table->string('rm',8);
            $table->date('tgl_berdiri');
            $table->string('alamat',500);
            $table->tinyInteger('id_bank');
            $table->string('atas_nama_rekening',50);
            $table->string('no_rekening',50);
            $table->decimal('taget_pj',20,4)->nullable()->default(0);
            $table->decimal('taget_sp',20,4)->nullable()->default(0);
            $table->tinyInteger('fl_jasa_baru')->nullable()->default(0);
            $table->tinyInteger('status')->nullable()->default(0);
            $table->timestamps();
            $table->primary('id_cabang');
            $table->index(['nama_cabang','regional','id_kota','jenis','bm','rm','id_bank','status'], 'IDX_sys_ms_cabang');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_ms_cabang');
    }
}

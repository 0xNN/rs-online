<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataRuanganTempatTidursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_ruangan_tempat_tidurs', function (Blueprint $table) {
            $table->id();
            $table->integer('id_tt')->nullable();
            $table->integer('id_t_tt')->nullable();
            $table->string('tt')->nullable();
            $table->string('ruang')->nullable();
            $table->integer('jumlah_ruang')->nullable();
            $table->integer('jumlah')->nullable();
            $table->integer('terpakai')->nullable();
            $table->integer('antrian')->nullable();
            $table->integer('prepare')->nullable();
            $table->integer('prepare_plan')->nullable();
            $table->integer('covid')->nullable();
            $table->tinyInteger('status_sinkron'); // 0 = input, 1 = sinkron
            $table->date('tanggal_input');
            $table->date('tanggal_sinkron')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_ruangan_tempat_tidurs');
    }
}

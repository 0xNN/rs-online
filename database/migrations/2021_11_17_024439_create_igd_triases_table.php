<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIgdTriasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igd_triases', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->integer('igd_suspek')->nullable();
            $table->integer('igd_konfirmasi')->nullable();
            $table->integer('g_ringan_murni_covid')->nullable();
            $table->integer('g_ringan_komorbid')->nullable();
            $table->integer('g_ringan_koinsiden')->nullable();
            $table->integer('g_sedang')->nullable();
            $table->integer('g_berat')->nullable();
            $table->integer('igd_dirujuk')->nullable();
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
        Schema::dropIfExists('igd_triases');
    }
}

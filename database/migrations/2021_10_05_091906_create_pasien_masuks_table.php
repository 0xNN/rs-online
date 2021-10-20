<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasienMasuksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasien_masuks', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->integer('igd_suspect_l')->nullable();
            $table->integer('igd_suspect_p')->nullable();
            $table->integer('igd_confirm_l')->nullable();
            $table->integer('igd_confirm_p')->nullable();
            $table->integer('rj_suspect_l')->nullable();
            $table->integer('rj_suspect_p')->nullable();
            $table->integer('rj_confirm_l')->nullable();
            $table->integer('rj_confirm_p')->nullable();
            $table->integer('ri_suspect_l')->nullable();
            $table->integer('ri_suspect_p')->nullable();
            $table->integer('ri_confirm_l')->nullable();
            $table->integer('ri_confirm_p')->nullable();
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
        Schema::dropIfExists('pasien_masuks');
    }
}

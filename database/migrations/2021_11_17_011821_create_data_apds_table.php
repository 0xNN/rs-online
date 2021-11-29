<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataApdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_apds', function (Blueprint $table) {
            $table->id();
            $table->integer('id_kebutuhan');
            $table->string('kebutuhan')->nullable();
            $table->integer('jumlah_eksisting')->nullable();
            $table->integer('jumlah')->nullable();
            $table->integer('jumlah_diterima')->nullable();
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
        Schema::dropIfExists('data_apds');
    }
}

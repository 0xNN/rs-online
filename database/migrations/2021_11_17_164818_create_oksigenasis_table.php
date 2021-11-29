<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOksigenasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oksigenasis', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->decimal('p_cair',10,3)->nullable();
            $table->decimal('p_tabung_kecil',10,2)->nullable();
            $table->decimal('p_tabung_sedang',10,2)->nullable();
            $table->decimal('p_tabung_besar',10,)->nullable();
            $table->decimal('k_isi_cair',10,3)->nullable();
            $table->decimal('k_isi_tabung_kecil',10,2)->nullable();
            $table->decimal('k_isi_tabung_sedang',10,2)->nullable();
            $table->decimal('k_isi_tabung_besar',10,2)->nullable();
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
        Schema::dropIfExists('oksigenasis');
    }
}

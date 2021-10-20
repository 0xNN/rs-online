<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasienKeluarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasien_keluars', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->integer('sembuh')->nullable();
            $table->integer('discarded')->nullable();
            $table->integer('meninggal_komorbid')->nullable();
            $table->integer('meninggal_tanpa_komorbid')->nullable();
            $table->integer('meninggal_prob_pre_komorbid')->nullable();
            $table->integer('meninggal_prob_neo_komorbid')->nullable();
            $table->integer('meninggal_prob_bayi_komorbid')->nullable();
            $table->integer('meninggal_prob_balita_komorbid')->nullable();
            $table->integer('meninggal_prob_anak_komorbid')->nullable();
            $table->integer('meninggal_prob_remaja_komorbid')->nullable();
            $table->integer('meninggal_prob_dws_komorbid')->nullable();
            $table->integer('meninggal_prob_lansia_komorbid')->nullable();
            $table->integer('meninggal_prob_pre_tanpa_komorbid')->nullable();
            $table->integer('meninggal_prob_neo_tanpa_komorbid')->nullable();
            $table->integer('meninggal_prob_bayi_tanpa_komorbid')->nullable();
            $table->integer('meninggal_prob_balita_tanpa_komorbid')->nullable();
            $table->integer('meninggal_prob_anak_tanpa_komorbid')->nullable();
            $table->integer('meninggal_prob_remaja_tanpa_komorbid')->nullable();
            $table->integer('meninggal_prob_dws_tanpa_komorbid')->nullable();
            $table->integer('meninggal_prob_lansia_tanpa_komorbid')->nullable();
            $table->integer('meninggal_discarded_komorbid')->nullable();
            $table->integer('meninggal_discarded_tanpa_komorbid')->nullable();
            $table->integer('dirujuk')->nullable();
            $table->integer('isman')->nullable();
            $table->integer('aps')->nullable();
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
        Schema::dropIfExists('pasien_keluars');
    }
}

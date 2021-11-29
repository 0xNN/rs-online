<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasienDirawatNonKomorbidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasien_dirawat_non_komorbids', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->integer('icu_dengan_ventilator_suspect_l')->nullable();
            $table->integer('icu_dengan_ventilator_suspect_p')->nullable();
            $table->integer('icu_dengan_ventilator_confirm_l')->nullable();
            $table->integer('icu_dengan_ventilator_confirm_p')->nullable();
            $table->integer('icu_tanpa_ventilator_suspect_l')->nullable();
            $table->integer('icu_tanpa_ventilator_suspect_p')->nullable();
            $table->integer('icu_tanpa_ventilator_confirm_l')->nullable();
            $table->integer('icu_tanpa_ventilator_confirm_p')->nullable();
            $table->integer('icu_tekanan_negatif_dengan_ventilator_suspect_l')->nullable();
            $table->integer('icu_tekanan_negatif_dengan_ventilator_suspect_p')->nullable();
            $table->integer('icu_tekanan_negatif_dengan_ventilator_confirm_l')->nullable();
            $table->integer('icu_tekanan_negatif_dengan_ventilator_confirm_p')->nullable();
            $table->integer('icu_tekanan_negatif_tanpa_ventilator_suspect_l')->nullable();
            $table->integer('icu_tekanan_negatif_tanpa_ventilator_suspect_p')->nullable();
            $table->integer('icu_tekanan_negatif_tanpa_ventilator_confirm_l')->nullable();
            $table->integer('icu_tekanan_negatif_tanpa_ventilator_confirm_p')->nullable();
            $table->integer('isolasi_tekanan_negatif_suspect_l')->nullable();
            $table->integer('isolasi_tekanan_negatif_suspect_p')->nullable();
            $table->integer('isolasi_tekanan_negatif_confirm_l')->nullable();
            $table->integer('isolasi_tekanan_negatif_confirm_p')->nullable();
            $table->integer('isolasi_tanpa_tekanan_negatif_suspect_l')->nullable();
            $table->integer('isolasi_tanpa_tekanan_negatif_suspect_p')->nullable();
            $table->integer('isolasi_tanpa_tekanan_negatif_confirm_l')->nullable();
            $table->integer('isolasi_tanpa_tekanan_negatif_confirm_p')->nullable();
            $table->integer('nicu_khusus_covid_suspect_l')->nullable();
            $table->integer('nicu_khusus_covid_suspect_p')->nullable();
            $table->integer('nicu_khusus_covid_confirm_l')->nullable();
            $table->integer('nicu_khusus_covid_confirm_p')->nullable();
            $table->integer('picu_khusus_covid_suspect_l')->nullable();
            $table->integer('picu_khusus_covid_suspect_p')->nullable();
            $table->integer('picu_khusus_covid_confirm_l')->nullable();
            $table->integer('picu_khusus_covid_confirm_p')->nullable();
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
        Schema::dropIfExists('pasien_dirawat_non_komorbids');
    }
}

<?php

namespace App\Imports;

use App\Models\PasienDirawatNonKomorbid;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class PasienDirawatNonKomorbidImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach($rows as $row)
        {
            PasienDirawatNonKomorbid::updateOrCreate(['tanggal' => Date::excelToDateTimeObject($row['tanggal'])->format('Y-m-d')],[
                'tanggal' => Date::excelToDateTimeObject($row['tanggal'])->format('Y-m-d'),
                'icu_dengan_ventilator_suspect_l' => $row['icu_dengan_ventilator_suspect_l'],
                'icu_dengan_ventilator_suspect_p' => $row['icu_dengan_ventilator_suspect_p'],
                'icu_dengan_ventilator_confirm_l' => $row['icu_dengan_ventilator_confirm_l'],
                'icu_dengan_ventilator_confirm_p' => $row['icu_dengan_ventilator_confirm_p'],
                'icu_tanpa_ventilator_suspect_l' => $row['icu_tanpa_ventilator_suspect_l'],
                'icu_tanpa_ventilator_suspect_p' => $row['icu_tanpa_ventilator_suspect_p'],
                'icu_tanpa_ventilator_confirm_l' => $row['icu_tanpa_ventilator_confirm_l'],
                'icu_tanpa_ventilator_confirm_p' => $row['icu_tanpa_ventilator_confirm_p'],
                'icu_tekanan_negatif_dengan_ventilator_suspect_l' => $row['icu_tekanan_negatif_dengan_ventilator_suspect_l'],
                'icu_tekanan_negatif_dengan_ventilator_suspect_p' => $row['icu_tekanan_negatif_dengan_ventilator_suspect_p'],
                'icu_tekanan_negatif_dengan_ventilator_confirm_l' => $row['icu_tekanan_negatif_dengan_ventilator_confirm_l'],
                'icu_tekanan_negatif_dengan_ventilator_confirm_p' => $row['icu_tekanan_negatif_dengan_ventilator_confirm_p'],
                'icu_tekanan_negatif_tanpa_ventilator_suspect_l' => $row['icu_tekanan_negatif_tanpa_ventilator_suspect_l'],
                'icu_tekanan_negatif_tanpa_ventilator_suspect_p' => $row['icu_tekanan_negatif_tanpa_ventilator_suspect_p'],
                'icu_tekanan_negatif_tanpa_ventilator_confirm_l' => $row['icu_tekanan_negatif_tanpa_ventilator_confirm_l'],
                'icu_tekanan_negatif_tanpa_ventilator_confirm_p' => $row['icu_tekanan_negatif_tanpa_ventilator_confirm_p'],
                'isolasi_tekanan_negatif_suspect_l' => $row['isolasi_tekanan_negatif_suspect_l'],
                'isolasi_tekanan_negatif_suspect_p' => $row['isolasi_tekanan_negatif_suspect_p'],
                'isolasi_tekanan_negatif_confirm_l' => $row['isolasi_tekanan_negatif_confirm_l'],
                'isolasi_tekanan_negatif_confirm_p' => $row['isolasi_tekanan_negatif_confirm_p'],
                'isolasi_tanpa_tekanan_negatif_suspect_l' => $row['isolasi_tanpa_tekanan_negatif_suspect_l'],
                'isolasi_tanpa_tekanan_negatif_suspect_p' => $row['isolasi_tanpa_tekanan_negatif_suspect_p'],
                'isolasi_tanpa_tekanan_negatif_confirm_l' => $row['isolasi_tanpa_tekanan_negatif_confirm_l'],
                'isolasi_tanpa_tekanan_negatif_confirm_p' => $row['isolasi_tanpa_tekanan_negatif_confirm_p'],
                'nicu_khusus_covid_suspect_l' => $row['nicu_khusus_covid_suspect_l'],
                'nicu_khusus_covid_suspect_p' => $row['nicu_khusus_covid_suspect_p'],
                'nicu_khusus_covid_confirm_l' => $row['nicu_khusus_covid_confirm_l'],
                'nicu_khusus_covid_confirm_p' => $row['nicu_khusus_covid_confirm_p'],
                'picu_khusus_covid_suspect_l' => $row['picu_khusus_covid_suspect_l'],
                'picu_khusus_covid_suspect_p' => $row['picu_khusus_covid_suspect_p'],
                'picu_khusus_covid_confirm_l' => $row['picu_khusus_covid_confirm_l'],
                'picu_khusus_covid_confirm_p' => $row['picu_khusus_covid_confirm_p'],
                'status_sinkron' => 0,
                'tanggal_input' => date('Y-m-d'),
                'tanggal_sinkron' => null
            ]);
        }
    }
}

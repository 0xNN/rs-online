<?php

namespace App\Imports;

use App\Models\PasienKeluar;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PasienKeluarImport implements ToCollection, WithHeadingRow
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
            PasienKeluar::updateOrCreate(['tanggal' => $row['tanggal']],[
                'tanggal' => $row['tanggal'],
                'sembuh' => $row['sembuh'],
                'discarded' => $row['discarded'],
                'meninggal_komorbid' => $row['meninggal_komorbid'],
                'meninggal_tanpa_komorbid' => $row['meninggal_tanpa_komorbid'],
                'meninggal_prob_pre_komorbid' => $row['meninggal_prob_pre_komorbid'],
                'meninggal_prob_neo_komorbid' => $row['meninggal_prob_neo_komorbid'],
                'meninggal_prob_bayi_komorbid' => $row['meninggal_prob_bayi_komorbid'],
                'meninggal_prob_balita_komorbid' => $row['meninggal_prob_balita_komorbid'],
                'meninggal_prob_anak_komorbid' => $row['meninggal_prob_anak_komorbid'],
                'meninggal_prob_remaja_komorbid' => $row['meninggal_prob_remaja_komorbid'],
                'meninggal_prob_dws_komorbid' => $row['meninggal_prob_dws_komorbid'],
                'meninggal_prob_lansia_komorbid' => $row['meninggal_prob_lansia_komorbid'],
                'meninggal_prob_pre_tanpa_komorbid' => $row['meninggal_prob_pre_tanpa_komorbid'],
                'meninggal_prob_neo_tanpa_komorbid' => $row['meninggal_prob_neo_tanpa_komorbid'],
                'meninggal_prob_bayi_tanpa_komorbid' => $row['meninggal_prob_bayi_tanpa_komorbid'],
                'meninggal_prob_balita_tanpa_komorbid' => $row['meninggal_prob_balita_tanpa_komorbid'],
                'meninggal_prob_anak_tanpa_komorbid' => $row['meninggal_prob_anak_tanpa_komorbid'],
                'meninggal_prob_remaja_tanpa_komorbid' => $row['meninggal_prob_remaja_tanpa_komorbid'],
                'meninggal_prob_dws_tanpa_komorbid' => $row['meninggal_prob_dws_tanpa_komorbid'],
                'meninggal_prob_lansia_tanpa_komorbid' => $row['meninggal_prob_lansia_tanpa_komorbid'],
                'meninggal_discarded_komorbid' => $row['meninggal_discarded_komorbid'],
                'meninggal_discarded_tanpa_komorbid' => $row['meninggal_discarded_tanpa_komorbid'],
                'dirujuk' => $row['dirujuk'],
                'isman' => $row['isman'],
                'aps' => $row['aps'],
                'status_sinkron' => 0,
                'tanggal_input' => date('Y-m-d'),
                'tanggal_sinkron' => null
            ]);
        }
    }
}

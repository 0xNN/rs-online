<?php

namespace App\Imports;

use App\Models\PasienMasuk;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PasienMasukImport implements ToCollection, WithHeadingRow
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
            PasienMasuk::updateOrCreate(['tanggal' => $row['tanggal']],[
                'tanggal' => $row['tanggal'],
                'igd_suspect_l' => $row['igd_suspect_l'],
                'igd_suspect_p' => $row['igd_suspect_p'],
                'igd_confirm_l' => $row['igd_confirm_l'],
                'igd_confirm_p' => $row['igd_confirm_p'],
                'rj_suspect_l' => $row['rj_suspect_l'],
                'rj_suspect_p' => $row['rj_suspect_p'],
                'rj_confirm_l' => $row['rj_confirm_l'],
                'rj_confirm_p' => $row['rj_confirm_p'],
                'ri_suspect_l' => $row['ri_suspect_l'],
                'ri_suspect_p' => $row['ri_suspect_p'],
                'ri_confirm_l' => $row['ri_confirm_l'],
                'ri_confirm_p' => $row['ri_confirm_p'],
                'status_sinkron' => 0,
                'tanggal_input' => date('Y-m-d'),
                'tanggal_sinkron' => null
            ]);
        }
    }
}

<?php

namespace App\Imports;

use App\Models\DataRuanganTempatTidur;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataRuanganTempatTidurImport implements ToCollection, WithHeadingRow
{
    public function  __construct($id_tt, $tt)
    {
        $this->id_tt = $id_tt;
        $this->tt = $tt;
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach($rows as $row)
        {
            // dd($row["ruang"]);
            DataRuanganTempatTidur::updateOrCreate([
                'id_tt' => $this->id_tt,
                'tt' => $this->tt,
                'ruang' => $row["ruang"]
            ],[
                'id_tt' => $this->id_tt,
                'id_t_tt' => null,
                'tt' => $this->tt,
                'ruang' => $row['ruang'],
                'jumlah_ruang' => $row['jumlah_ruang'],
                'jumlah' => $row['jumlah'],
                'terpakai' => $row['terpakai'],
                'antrian' => $row['antrian'],
                'prepare' => $row['prepare'],
                'prepare_plan' => $row['prepare_plan'],
                'covid' => $row['covid'],
                'status_sinkron' => 0,
                'tanggal_input' => date('Y-m-d'),
                'tanggal_sinkron' => null
            ]);
        }
    }
}

<?php

namespace App\Imports;

use App\Models\DataSdm;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataSdmImport implements ToCollection, WithHeadingRow
{
    public function  __construct($id_kebutuhan)
    {
        $this->id_kebutuhan = $id_kebutuhan;
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach($rows as $row)
        {
            // dd($row["ruang"]);
            DataSdm::updateOrCreate([
                'id_kebutuhan' => $this->id_kebutuhan,
            ],[
                'id_kebutuhan' => $this->id_kebutuhan,
                'kebutuhan' => $row['kebutuhan'],
                'jumlah_eksisting' => $row['jumlah_eksisting'],
                'jumlah' => $row['jumlah'],
                'jumlah_diterima' => $row['jumlah_diterima'],
                'status_sinkron' => 0,
                'tanggal_input' => date('Y-m-d'),
                'tanggal_sinkron' => null
            ]);
        }
    }
}

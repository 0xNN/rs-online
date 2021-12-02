<?php

namespace App\Imports;

use App\Models\Oksigenasi;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class OksigenasiImport implements ToCollection, WithHeadingRow
{
    public function  __construct($data)
    {
        $this->data = $data;
    }
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach($rows as $row)
        {
            // dd($row);
            $p_cair = $this->konversi($row['p_cair'], $this->data['satuan_p_cair']);
            $k_isi_cair = $this->konversi($row['k_isi_cair'], $this->data['satuan_k_isi_cair']);
            Oksigenasi::updateOrCreate(['tanggal' => Date::excelToDateTimeObject($row['tanggal'])->format('Y-m-d')],[
                'tanggal' => Date::excelToDateTimeObject($row['tanggal'])->format('Y-m-d'),
                "p_cair" => $p_cair,
                "p_tabung_kecil" => $row['p_tabung_kecil'],
                "p_tabung_sedang" => $row['p_tabung_sedang'],
                "p_tabung_besar" => $row['p_tabung_besar'],
                "k_isi_cair" => $k_isi_cair,
                "k_isi_tabung_kecil" => $row['k_isi_tabung_kecil'],
                "k_isi_tabung_sedang" => $row['k_isi_tabung_sedang'],
                "k_isi_tabung_besar" => $row['k_isi_tabung_besar'],
                'status_sinkron' => 0,
                'tanggal_input' => date('Y-m-d'),
                'tanggal_sinkron' => null
            ]);
        }
    }

    function konversi($nilai, $satuan)
    {
        $konversi = 0;
        if($satuan == "m3"){
            $konversi = $nilai;
        }else if($satuan == "liter"){
            $konversi = $nilai * 0.897;
        }else if($satuan == "kg"){
            $konversi = $nilai * 0.78;
        }else if($satuan == "ton"){
            $konversi = $nilai * 788.86;
        }else if($satuan == "galon"){
            $konversi = $nilai * 3.04;
        }
        return (string)$konversi;
    }
}

<?php

namespace App\Imports;

use App\Models\IgdTriase;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class IgdTriaseImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach($rows as $row)
        {
            IgdTriase::updateOrCreate(['tanggal' => Date::excelToDateTimeObject($row['tanggal'])->format('Y-m-d')],[
                'tanggal' => Date::excelToDateTimeObject($row['tanggal'])->format('Y-m-d'),
                'igd_suspek' => $row['igd_suspek'],
                'igd_konfirmasi' => $row['igd_konfirmasi'],
                'g_ringan_murni_covid' => $row['g_ringan_murni_covid'],
                'g_ringan_komorbid' => $row['g_ringan_komorbid'],
                'g_ringan_koinsiden' => $row['g_ringan_koinsiden'],
                'g_sedang' => $row['g_sedang'],
                'g_berat' => $row['g_berat'],
                'igd_dirujuk' => $row['igd_dirujuk'],
                'status_sinkron' => 0,
                'tanggal_input' => date('Y-m-d'),
                'tanggal_sinkron' => null
            ]);
        }
    }
}

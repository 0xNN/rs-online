<?php

namespace App\Imports;

use App\Models\Oksigenasi;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class OksigenasiImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach($rows as $row)
        {
            Oksigenasi::updateOrCreate(['tanggal' => Date::excelToDateTimeObject($row['tanggal'])->format('Y-m-d')],[
                'tanggal' => Date::excelToDateTimeObject($row['tanggal'])->format('Y-m-d'),
            ]);
        }
    }
}

<?php

namespace App\Imports;

use App\Models\NakesTerinfeksi;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class NakesTerinfeksiImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach($rows as $row)
        {
            NakesTerinfeksi::updateOrCreate(['tanggal' => Date::excelToDateTimeObject($row['tanggal'])->format('Y-m-d')],[
                'tanggal' => Date::excelToDateTimeObject($row['tanggal'])->format('Y-m-d'),
                'co_ass' => $row['co_ass'],
                'residen' => $row['residen'],
                'intership' => $row['intership'],
                'dokter_spesialis' => $row['dokter_spesialis'],
                'dokter_umum' => $row['dokter_umum'],
                'dokter_gigi' => $row['dokter_gigi'],
                'perawat' => $row['perawat'],
                'bidan' => $row['bidan'],
                'apoteker' => $row['apoteker'],
                'radiografer' => $row['radiografer'],
                'analis_lab' => $row['analis_lab'],
                'nakes_lainnya' => $row['nakes_lainnya'],
                'co_ass_meninggal' => $row['co_ass_meninggal'],
                'residen_meninggal' => $row['residen_meninggal'],
                'intership_meninggal' => $row['intership_meninggal'],
                'dokter_spesialis_meninggal' => $row['dokter_spesialis_meninggal'],
                'dokter_umum_meninggal' => $row['dokter_umum_meninggal'],
                'dokter_gigi_meninggal' => $row['dokter_gigi_meninggal'],
                'perawat_meninggal' => $row['perawat_meninggal'],
                'bidan_meninggal' => $row['bidan_meninggal'],
                'apoteker_meninggal' => $row['apoteker_meninggal'],
                'radiografer_meninggal' => $row['radiografer_meninggal'],
                'analis_lab_meninggal' => $row['analis_lab_meninggal'],
                'nakes_lainnya_meninggal' => $row['nakes_lainnya_meninggal'],
                'co_ass_dirawat' => $row['co_ass_dirawat'],
                'co_ass_isoman' => $row['co_ass_isoman'],
                'co_ass_sembuh' => $row['co_ass_sembuh'],
                'residen_dirawat' => $row['residen_dirawat'],
                'residen_isoman' => $row['residen_isoman'],
                'residen_sembuh' => $row['residen_sembuh'],
                'intership_dirawat' => $row['intership_dirawat'],
                'intership_isoman' => $row['intership_isoman'],
                'intership_sembuh' => $row['intership_sembuh'],
                'dokter_spesialis_dirawat' => $row['dokter_spesialis_dirawat'],
                'dokter_spesialis_isoman' => $row['dokter_spesialis_isoman'],
                'dokter_spesialis_sembuh' => $row['dokter_spesialis_sembuh'],
                'dokter_umum_dirawat' => $row['dokter_umum_dirawat'],
                'dokter_umum_isoman' => $row['dokter_umum_isoman'],
                'dokter_umum_sembuh' => $row['dokter_umum_sembuh'],
                'dokter_gigi_dirawat' => $row['dokter_gigi_dirawat'],
                'dokter_gigi_isoman' => $row['dokter_gigi_isoman'],
                'dokter_gigi_sembuh' => $row['dokter_gigi_sembuh'],
                'bidan_dirawat' => $row['bidan_dirawat'],
                'bidan_isoman' => $row['bidan_isoman'],
                'bidan_sembuh' => $row['bidan_sembuh'],
                'apoteker_dirawat' => $row['apoteker_dirawat'],
                'apoteker_isoman' => $row['apoteker_isoman'],
                'apoteker_sembuh' => $row['apoteker_sembuh'],
                'radiografer_dirawat' => $row['radiografer_dirawat'],
                'radiografer_isoman' => $row['radiografer_isoman'],
                'radiografer_sembuh' => $row['radiografer_sembuh'],
                'analis_lab_dirawat' => $row['analis_lab_dirawat'],
                'analis_lab_isoman' => $row['analis_lab_isoman'],
                'analis_lab_sembuh' => $row['analis_lab_sembuh'],
                'nakes_lainnya_dirawat' => $row['nakes_lainnya_dirawat'],
                'nakes_lainnya_isoman' => $row['nakes_lainnya_isoman'],
                'nakes_lainnya_sembuh' => $row['nakes_lainnya_sembuh'],
                'perawat_dirawat' => $row['perawat_dirawat'],
                'perawat_isoman' => $row['perawat_isoman'],
                'perawat_sembuh' => $row['perawat_sembuh'],
                'status_sinkron' => 0,
                'tanggal_input' => date('Y-m-d'),
                'tanggal_sinkron' => null
            ]);
        }
    }
}

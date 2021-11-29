<?php

namespace App\Imports;

use App\Models\PcrNakes;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class PcrNakesImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach($rows as $row)
        {
            PcrNakes::updateOrCreate(['tanggal' => Date::excelToDateTimeObject($row['tanggal'])->format('Y-m-d')],[
                'tanggal' => Date::excelToDateTimeObject($row['tanggal'])->format('Y-m-d'),
                'jumlah_tenaga_dokter_umum' => $row['jumlah_tenaga_dokter_umum'],
                'sudah_periksa_dokter_umum' => $row['sudah_periksa_dokter_umum'],
                'hasil_pcr_dokter_umum' => $row['hasil_pcr_dokter_umum'],
                'jumlah_tenaga_dokter_spesialis' => $row['jumlah_tenaga_dokter_spesialis'],
                'sudah_periksa_dokter_spesialis' => $row['sudah_periksa_dokter_spesialis'],
                'hasil_pcr_dokter_spesialis' => $row['hasil_pcr_dokter_spesialis'],
                'jumlah_tenaga_dokter_gigi' => $row['jumlah_tenaga_dokter_gigi'],
                'sudah_periksa_dokter_gigi' => $row['sudah_periksa_dokter_gigi'],
                'hasil_pcr_dokter_gigi' => $row['hasil_pcr_dokter_gigi'],
                'jumlah_tenaga_residen' => $row['jumlah_tenaga_residen'],
                'sudah_periksa_residen' => $row['sudah_periksa_residen'],
                'hasil_pcr_residen' => $row['hasil_pcr_residen'],
                'jumlah_tenaga_perawat' => $row['jumlah_tenaga_perawat'],
                'sudah_periksa_perawat' => $row['sudah_periksa_perawat'],
                'hasil_pcr_perawat' => $row['hasil_pcr_perawat'],
                'jumlah_tenaga_bidan' => $row['jumlah_tenaga_bidan'],
                'sudah_periksa_bidan' => $row['sudah_periksa_bidan'],
                'hasil_pcr_bidan' => $row['hasil_pcr_bidan'],
                'jumlah_tenaga_apoteker' => $row['jumlah_tenaga_apoteker'],
                'sudah_periksa_apoteker' => $row['sudah_periksa_apoteker'],
                'hasil_pcr_apoteker' => $row['hasil_pcr_apoteker'],
                'jumlah_tenaga_radiografer' => $row['jumlah_tenaga_radiografer'],
                'sudah_periksa_radiografer' => $row['sudah_periksa_radiografer'],
                'hasil_pcr_radiografer' => $row['hasil_pcr_radiografer'],
                'jumlah_tenaga_analis_lab' => $row['jumlah_tenaga_analis_lab'],
                'sudah_periksa_analis_lab' => $row['sudah_periksa_analis_lab'],
                'hasil_pcr_analis_lab' => $row['hasil_pcr_analis_lab'],
                'jumlah_tenaga_co_ass' => $row['jumlah_tenaga_co_ass'],
                'sudah_periksa_co_ass' => $row['sudah_periksa_co_ass'],
                'hasil_pcr_co_ass' => $row['hasil_pcr_co_ass'],
                'jumlah_tenaga_internship' => $row['jumlah_tenaga_internship'],
                'sudah_periksa_internship' => $row['sudah_periksa_internship'],
                'hasil_pcr_internship' => $row['hasil_pcr_internship'],
                'jumlah_tenaga_nakes_lainnya' => $row['jumlah_tenaga_nakes_lainnya'],
                'sudah_periksa_nakes_lainnya' => $row['sudah_periksa_nakes_lainnya'],
                'hasil_pcr_nakes_lainnya' => $row['hasil_pcr_nakes_lainnya'],
                'rekap_jumlah_tenaga' => $row['rekap_jumlah_tenaga'],
                'rekap_jumlah_sudah_diperiksa' => $row['rekap_jumlah_sudah_diperiksa'],
                'rekap_jumlah_hasil_pcr' => $row['rekap_jumlah_hasil_pcr'],
                'status_sinkron' => 0,
                'tanggal_input' => date('Y-m-d'),
                'tanggal_sinkron' => null
            ]);
        }
    }
}

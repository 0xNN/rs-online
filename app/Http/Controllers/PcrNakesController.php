<?php

namespace App\Http\Controllers;

use App\Imports\PcrNakesImport;
use App\Models\PcrNakes;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;

class PcrNakesController extends Controller
{
    public function index(Request $request)
    {
        $ts = strtotime(date('F').' '.date('Y'));
        $period = $this->date_range(date('Y-m-d', $ts), date('Y-m-d'), "+1 day", "Y-m-d");

        foreach($period as $value) {
            // $headers = config('custom.headers');
            $now = new DateTime();
            $now->format('Y-m-d H:i:s');
            $headers = [
                'X-rs-id' => '1671347',
                'X-timestamp' => $now->getTimestamp(),
                'X-pass' => '112233',
                'x-tanggal' => $value,
                // 'Content-Type' => 'application/json'
            ];
    
            $url =  config('custom.url_api').'Pasien/pcr_nakes';
            $response = Http::withHeaders($headers)->get($url);
    
            $obj = $response->object()->PCRNakes;
            foreach($obj as $data) {
                if(isset($data->message)) {
                    continue;
                } else {
                    PcrNakes::updateOrCreate([
                        'tanggal' => $data->tanggal
                    ],[
                        'tanggal' => $data->tanggal,
                        'jumlah_tenaga_dokter_umum' => $data->jumlah_tenaga_dokter_umum,
                        'sudah_periksa_dokter_umum' => $data->sudah_periksa_dokter_umum,
                        'hasil_pcr_dokter_umum' => $data->hasil_pcr_dokter_umum,
                        'jumlah_tenaga_dokter_spesialis' => $data->jumlah_tenaga_dokter_spesialis,
                        'sudah_periksa_dokter_spesialis' => $data->sudah_periksa_dokter_spesialis,
                        'hasil_pcr_dokter_spesialis' => $data->hasil_pcr_dokter_spesialis,
                        'jumlah_tenaga_dokter_gigi' => $data->jumlah_tenaga_dokter_gigi,
                        'sudah_periksa_dokter_gigi' => $data->sudah_periksa_dokter_gigi,
                        'hasil_pcr_dokter_gigi' => $data->hasil_pcr_dokter_gigi,
                        'jumlah_tenaga_residen' => $data->jumlah_tenaga_residen,
                        'sudah_periksa_residen' => $data->sudah_periksa_residen,
                        'hasil_pcr_residen' => $data->hasil_pcr_residen,
                        'jumlah_tenaga_perawat' => $data->jumlah_tenaga_perawat,
                        'sudah_periksa_perawat' => $data->sudah_periksa_perawat,
                        'hasil_pcr_perawat' => $data->hasil_pcr_perawat,
                        'jumlah_tenaga_bidan' => $data->jumlah_tenaga_bidan,
                        'sudah_periksa_bidan' => $data->sudah_periksa_bidan,
                        'hasil_pcr_bidan' => $data->hasil_pcr_bidan,
                        'jumlah_tenaga_apoteker' => $data->jumlah_tenaga_apoteker,
                        'sudah_periksa_apoteker' => $data->sudah_periksa_apoteker,
                        'hasil_pcr_apoteker' => $data->hasil_pcr_apoteker,
                        'jumlah_tenaga_radiografer' => $data->jumlah_tenaga_radiografer,
                        'sudah_periksa_radiografer' => $data->sudah_periksa_radiografer,
                        'hasil_pcr_radiografer' => $data->hasil_pcr_radiografer,
                        'jumlah_tenaga_analis_lab' => $data->jumlah_tenaga_analis_lab,
                        'sudah_periksa_analis_lab' => $data->sudah_periksa_analis_lab,
                        'hasil_pcr_analis_lab' => $data->hasil_pcr_analis_lab,
                        'jumlah_tenaga_co_ass' => $data->jumlah_tenaga_co_ass,
                        'sudah_periksa_co_ass' => $data->sudah_periksa_co_ass,
                        'hasil_pcr_co_ass' => $data->hasil_pcr_co_ass,
                        'jumlah_tenaga_internship' => $data->jumlah_tenaga_internship,
                        'sudah_periksa_internship' => $data->sudah_periksa_internship,
                        'hasil_pcr_internship' => $data->hasil_pcr_internship,
                        'jumlah_tenaga_nakes_lainnya' => $data->jumlah_tenaga_nakes_lainnya,
                        'sudah_periksa_nakes_lainnya' => $data->sudah_periksa_nakes_lainnya,
                        'hasil_pcr_nakes_lainnya' => $data->hasil_pcr_nakes_lainnya,
                        'rekap_jumlah_tenaga' => $data->rekap_jumlah_tenaga,
                        'rekap_jumlah_sudah_diperiksa' => $data->rekap_jumlah_sudah_diperiksa,
                        'rekap_jumlah_hasil_pcr' => $data->rekap_jumlah_hasil_pcr,
                        'status_sinkron' => 1,
                        'tanggal_input' => date('Y-m-d'),
                        'tanggal_sinkron' => date('Y-m-d')
                    ]);
                }
            }
        }

        if($request->ajax()) {
            $model = PcrNakes::orderBy('tanggal','desc');
            return datatables()
                ->of($model)
                ->addIndexColumn()
                ->editColumn('action', function($row) {
                    $button = '<div class="btn-group" role="group">';
                    $button .= '<button data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Sinkron" class="sinkron btn btn-info btn-sm sinkron-post"><i class="cil-loop-circular"></i></button>';
                    // $button .= '<button data-toggle="tooltip" data-tanggal="'.$row->tanggal.'" data-id="'.$row->id.'" data-original-title="Delete" class="delete btn btn-danger btn-sm delete-post"><i class="cil-trash"></i></button>';
                    $button .= '</div>';
                    return $button;
                    // if($row->status_sinkron == 0) {
                    // } else {
                    //     return '<span class="badge badge-success"><i class="cil-check-alt"></i></span>';
                    // }
                })
                ->editColumn('tanggal', function($row) {
                    if($row->status_sinkron == 0) {
                        $status = '<i class="cil-warning" style="color: red"></i>';
                    } else {
                        $status = '<i class="cil-check" style="color: green"></i>';
                    }
                    return Carbon::parse($row->tanggal)->isoFormat('dddd, D MMMM Y').' '.$status;
                })
                ->escapeColumns([])
                ->make(true);
        }
        return view('sinkron.pcr-nakes.index');
    }

    public function date_range($first, $last, $step = '+1 day', $output_format = 'Y-m-d' ) {

        $dates = array();
        $current = strtotime($first);
        $last = strtotime($last);
    
        while( $current <= $last ) {
    
            $dates[] = date($output_format, $current);
            $current = strtotime($step, $current);
        }
    
        return $dates;
    }

    public function create()
    {
        return view('sinkron.pcr-nakes.create');
    }

    public function store()
    {
        try {
            Excel::import(new PcrNakesImport, request()->file('file'));
        } catch(Exception $e) {
            return back()->withError($e->getMessage());
        }

        return redirect()->route('pcr-nakes.index')->withMessage('Upload berhasil!');
    }

    public function show($id)
    {
        $data = PcrNakes::find($id);
        return response()->json($data);
    }

    public function sinkronisasi(Request $request)
    {
        $headers = config('custom.headers');
        $url = config('custom.url_api').'Pasien/pcr_nakes';

        $postDataArr = array(
            'tanggal' => $request->tanggal,
            'jumlah_tenaga_dokter_umum' => $request->jumlah_tenaga_dokter_umum,
            'sudah_periksa_dokter_umum' => $request->sudah_periksa_dokter_umum,
            'hasil_pcr_dokter_umum' => $request->hasil_pcr_dokter_umum,
            'jumlah_tenaga_dokter_spesialis' => $request->jumlah_tenaga_dokter_spesialis,
            'sudah_periksa_dokter_spesialis' => $request->sudah_periksa_dokter_spesialis,
            'hasil_pcr_dokter_spesialis' => $request->hasil_pcr_dokter_spesialis,
            'jumlah_tenaga_dokter_gigi' => $request->jumlah_tenaga_dokter_gigi,
            'sudah_periksa_dokter_gigi' => $request->sudah_periksa_dokter_gigi,
            'hasil_pcr_dokter_gigi' => $request->hasil_pcr_dokter_gigi,
            'jumlah_tenaga_residen' => $request->jumlah_tenaga_residen,
            'sudah_periksa_residen' => $request->sudah_periksa_residen,
            'hasil_pcr_residen' => $request->hasil_pcr_residen,
            'jumlah_tenaga_perawat' => $request->jumlah_tenaga_perawat,
            'sudah_periksa_perawat' => $request->sudah_periksa_perawat,
            'hasil_pcr_perawat' => $request->hasil_pcr_perawat,
            'jumlah_tenaga_bidan' => $request->jumlah_tenaga_bidan,
            'sudah_periksa_bidan' => $request->sudah_periksa_bidan,
            'hasil_pcr_bidan' => $request->hasil_pcr_bidan,
            'jumlah_tenaga_apoteker' => $request->jumlah_tenaga_apoteker,
            'sudah_periksa_apoteker' => $request->sudah_periksa_apoteker,
            'hasil_pcr_apoteker' => $request->hasil_pcr_apoteker,
            'jumlah_tenaga_radiografer' => $request->jumlah_tenaga_radiografer,
            'sudah_periksa_radiografer' => $request->sudah_periksa_radiografer,
            'hasil_pcr_radiografer' => $request->hasil_pcr_radiografer,
            'jumlah_tenaga_analis_lab' => $request->jumlah_tenaga_analis_lab,
            'sudah_periksa_analis_lab' => $request->sudah_periksa_analis_lab,
            'hasil_pcr_analis_lab' => $request->hasil_pcr_analis_lab,
            'jumlah_tenaga_co_ass' => $request->jumlah_tenaga_co_ass,
            'sudah_periksa_co_ass' => $request->sudah_periksa_co_ass,
            'hasil_pcr_co_ass' => $request->hasil_pcr_co_ass,
            'jumlah_tenaga_internship' => $request->jumlah_tenaga_internship,
            'sudah_periksa_internship' => $request->sudah_periksa_internship,
            'hasil_pcr_internship' => $request->hasil_pcr_internship,
            'jumlah_tenaga_nakes_lainnya' => $request->jumlah_tenaga_nakes_lainnya,
            'sudah_periksa_nakes_lainnya' => $request->sudah_periksa_nakes_lainnya,
            'hasil_pcr_nakes_lainnya' => $request->hasil_pcr_nakes_lainnya,
            'rekap_jumlah_tenaga' => $request->rekap_jumlah_tenaga,
            'rekap_jumlah_sudah_diperiksa' => $request->rekap_jumlah_sudah_diperiksa,
            'rekap_jumlah_hasil_pcr' => $request->rekap_jumlah_hasil_pcr,
        );

        $response = Http::withHeaders($headers)
                    ->post($url,$postDataArr);

        if($response->status() == 200) {
            $obj = $response->object()->PCRNakes;
            if($obj[0]->status == 200) {
                $data = PcrNakes::find($request->id);
                $data->jumlah_tenaga_dokter_umum = $request->jumlah_tenaga_dokter_umum;
                $data->sudah_periksa_dokter_umum = $request->sudah_periksa_dokter_umum;
                $data->hasil_pcr_dokter_umum = $request->hasil_pcr_dokter_umum;
                $data->jumlah_tenaga_dokter_spesialis = $request->jumlah_tenaga_dokter_spesialis;
                $data->sudah_periksa_dokter_spesialis = $request->sudah_periksa_dokter_spesialis;
                $data->hasil_pcr_dokter_spesialis = $request->hasil_pcr_dokter_spesialis;
                $data->jumlah_tenaga_dokter_gigi = $request->jumlah_tenaga_dokter_gigi;
                $data->sudah_periksa_dokter_gigi = $request->sudah_periksa_dokter_gigi;
                $data->hasil_pcr_dokter_gigi = $request->hasil_pcr_dokter_gigi;
                $data->jumlah_tenaga_residen = $request->jumlah_tenaga_residen;
                $data->sudah_periksa_residen = $request->sudah_periksa_residen;
                $data->hasil_pcr_residen = $request->hasil_pcr_residen;
                $data->jumlah_tenaga_perawat = $request->jumlah_tenaga_perawat;
                $data->sudah_periksa_perawat = $request->sudah_periksa_perawat;
                $data->hasil_pcr_perawat = $request->hasil_pcr_perawat;
                $data->jumlah_tenaga_bidan = $request->jumlah_tenaga_bidan;
                $data->sudah_periksa_bidan = $request->sudah_periksa_bidan;
                $data->hasil_pcr_bidan = $request->hasil_pcr_bidan;
                $data->jumlah_tenaga_apoteker = $request->jumlah_tenaga_apoteker;
                $data->sudah_periksa_apoteker = $request->sudah_periksa_apoteker;
                $data->hasil_pcr_apoteker = $request->hasil_pcr_apoteker;
                $data->jumlah_tenaga_radiografer = $request->jumlah_tenaga_radiografer;
                $data->sudah_periksa_radiografer = $request->sudah_periksa_radiografer;
                $data->hasil_pcr_radiografer = $request->hasil_pcr_radiografer;
                $data->jumlah_tenaga_analis_lab = $request->jumlah_tenaga_analis_lab;
                $data->sudah_periksa_analis_lab = $request->sudah_periksa_analis_lab;
                $data->hasil_pcr_analis_lab = $request->hasil_pcr_analis_lab;
                $data->jumlah_tenaga_co_ass = $request->jumlah_tenaga_co_ass;
                $data->sudah_periksa_co_ass = $request->sudah_periksa_co_ass;
                $data->hasil_pcr_co_ass = $request->hasil_pcr_co_ass;
                $data->jumlah_tenaga_internship = $request->jumlah_tenaga_internship;
                $data->sudah_periksa_internship = $request->sudah_periksa_internship;
                $data->hasil_pcr_internship = $request->hasil_pcr_internship;
                $data->jumlah_tenaga_nakes_lainnya = $request->jumlah_tenaga_nakes_lainnya;
                $data->sudah_periksa_nakes_lainnya = $request->sudah_periksa_nakes_lainnya;
                $data->hasil_pcr_nakes_lainnya = $request->hasil_pcr_nakes_lainnya;
                $data->rekap_jumlah_tenaga = $request->rekap_jumlah_tenaga;
                $data->rekap_jumlah_sudah_diperiksa = $request->rekap_jumlah_sudah_diperiksa;
                $data->rekap_jumlah_hasil_pcr = $request->rekap_jumlah_hasil_pcr;
                $data->tanggal_sinkron = date('Y-m-d');
                $data->status_sinkron = 1;
                $data->save();

                return response()->json([
                    'code' => 200,
                    'message' => $obj[0]->message
                ],200);
            } else {
                return response()->json([
                    'code' => 401,
                    'message' => $obj[0]->message
                ],401);
            }
        } else {
            return response()->json([
                'code' => 401,
                'message' => 'Kesalahan Server!'
            ],401);
        }
    }

    public function range(Request $request)
    {
    //     $period = new DatePeriod(
    //         new DateTime($request->start_date),
    //         new DateInterval('P1D'),
    //         new DateTime($request->end_date)
    //     );

        $period = $this->date_range($request->start_date, $request->end_date, "+1 day", "Y-m-d");

        try {
            foreach($period as $value)
            {
                $now = new DateTime();
                $now->format('Y-m-d H:i:s');
                $headers = [
                    'X-rs-id' => '1671347',
                    'X-timestamp' => $now->getTimestamp(),
                    'X-pass' => '112233',
                    'X-tanggal' => $value
                    // 'X-tanggal' => '2021-08-03'
                ];
                $url = config('custom.url_api').'Pasien/pcr_nakes';
                $response = Http::withHeaders($headers)->get($url);
    
                $obj = $response->object()->PCRNakes;
                foreach($obj as $data) {
                    if(isset($data->message)) {
                        continue;
                    }
                    PcrNakes::updateOrCreate([
                        'tanggal' => $data->tanggal
                    ],[
                        'tanggal' => $data->tanggal,
                        'jumlah_tenaga_dokter_umum' => $data->jumlah_tenaga_dokter_umum,
                        'sudah_periksa_dokter_umum' => $data->sudah_periksa_dokter_umum,
                        'hasil_pcr_dokter_umum' => $data->hasil_pcr_dokter_umum,
                        'jumlah_tenaga_dokter_spesialis' => $data->jumlah_tenaga_dokter_spesialis,
                        'sudah_periksa_dokter_spesialis' => $data->sudah_periksa_dokter_spesialis,
                        'hasil_pcr_dokter_spesialis' => $data->hasil_pcr_dokter_spesialis,
                        'jumlah_tenaga_dokter_gigi' => $data->jumlah_tenaga_dokter_gigi,
                        'sudah_periksa_dokter_gigi' => $data->sudah_periksa_dokter_gigi,
                        'hasil_pcr_dokter_gigi' => $data->hasil_pcr_dokter_gigi,
                        'jumlah_tenaga_residen' => $data->jumlah_tenaga_residen,
                        'sudah_periksa_residen' => $data->sudah_periksa_residen,
                        'hasil_pcr_residen' => $data->hasil_pcr_residen,
                        'jumlah_tenaga_perawat' => $data->jumlah_tenaga_perawat,
                        'sudah_periksa_perawat' => $data->sudah_periksa_perawat,
                        'hasil_pcr_perawat' => $data->hasil_pcr_perawat,
                        'jumlah_tenaga_bidan' => $data->jumlah_tenaga_bidan,
                        'sudah_periksa_bidan' => $data->sudah_periksa_bidan,
                        'hasil_pcr_bidan' => $data->hasil_pcr_bidan,
                        'jumlah_tenaga_apoteker' => $data->jumlah_tenaga_apoteker,
                        'sudah_periksa_apoteker' => $data->sudah_periksa_apoteker,
                        'hasil_pcr_apoteker' => $data->hasil_pcr_apoteker,
                        'jumlah_tenaga_radiografer' => $data->jumlah_tenaga_radiografer,
                        'sudah_periksa_radiografer' => $data->sudah_periksa_radiografer,
                        'hasil_pcr_radiografer' => $data->hasil_pcr_radiografer,
                        'jumlah_tenaga_analis_lab' => $data->jumlah_tenaga_analis_lab,
                        'sudah_periksa_analis_lab' => $data->sudah_periksa_analis_lab,
                        'hasil_pcr_analis_lab' => $data->hasil_pcr_analis_lab,
                        'jumlah_tenaga_co_ass' => $data->jumlah_tenaga_co_ass,
                        'sudah_periksa_co_ass' => $data->sudah_periksa_co_ass,
                        'hasil_pcr_co_ass' => $data->hasil_pcr_co_ass,
                        'jumlah_tenaga_internship' => $data->jumlah_tenaga_internship,
                        'sudah_periksa_internship' => $data->sudah_periksa_internship,
                        'hasil_pcr_internship' => $data->hasil_pcr_internship,
                        'jumlah_tenaga_nakes_lainnya' => $data->jumlah_tenaga_nakes_lainnya,
                        'sudah_periksa_nakes_lainnya' => $data->sudah_periksa_nakes_lainnya,
                        'hasil_pcr_nakes_lainnya' => $data->hasil_pcr_nakes_lainnya,
                        'rekap_jumlah_tenaga' => $data->rekap_jumlah_tenaga,
                        'rekap_jumlah_sudah_diperiksa' => $data->rekap_jumlah_sudah_diperiksa,
                        'rekap_jumlah_hasil_pcr' => $data->rekap_jumlah_hasil_pcr,
                        'status_sinkron' => 1,
                        'tanggal_input' => date('Y-m-d'),
                        'tanggal_sinkron' => date('Y-m-d')
                    ]);
                }
            }
        } catch (Exception $e) {
            return response()->json([
                'code' => 202,
                'message' => $e->getMessage()
            ]);
        }

        return response()->json([
            'code' => 200,
            'message' => 'Sinkronisasi berhasil!'
        ], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Imports\NakesTerinfeksiImport;
use App\Models\NakesTerinfeksi;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;

class NakesTerinfeksiController extends Controller
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
    
            $url =  config('custom.url_api').'Pasien/harian_nakes_terinfeksi';
            $response = Http::withHeaders($headers)->get($url);

            $obj = $response->object()->HarianNakesTerinfeksi;
            foreach($obj as $data) {
                if(isset($data->message)) {
                    continue;
                } else {
                    NakesTerinfeksi::updateOrCreate([
                        'tanggal' => $data->tanggal
                    ],[
                        'tanggal' => $data->tanggal,
                        'co_ass' => $data->co_ass,
                        'residen' => $data->residen,
                        'intership' => $data->intership,
                        'dokter_spesialis' => $data->dokter_spesialis,
                        'dokter_umum' => $data->dokter_umum,
                        'dokter_gigi' => $data->dokter_gigi,
                        'perawat' => $data->perawat,
                        'bidan' => $data->bidan,
                        'apoteker' => $data->apoteker,
                        'radiografer' => $data->radiografer,
                        'analis_lab' => $data->analis_lab,
                        'nakes_lainnya' => $data->nakes_lainnya,
                        'co_ass_meninggal' => $data->co_ass_meninggal,
                        'residen_meninggal' => $data->residen_meninggal,
                        'intership_meninggal' => $data->intership_meninggal,
                        'dokter_spesialis_meninggal' => $data->dokter_spesialis_meninggal,
                        'dokter_umum_meninggal' => $data->dokter_umum_meninggal,
                        'dokter_gigi_meninggal' => $data->dokter_gigi_meninggal,
                        'perawat_meninggal' => $data->perawat_meninggal,
                        'bidan_meninggal' => $data->bidan_meninggal,
                        'apoteker_meninggal' => $data->apoteker_meninggal,
                        'radiografer_meninggal' => $data->radiografer_meninggal,
                        'analis_lab_meninggal' => $data->analis_lab_meninggal,
                        'nakes_lainnya_meninggal' => $data->nakes_lainnya_meninggal,
                        'co_ass_dirawat' => $data->co_ass_dirawat,
                        'co_ass_isoman' => $data->co_ass_isoman,
                        'co_ass_sembuh' => $data->co_ass_sembuh,
                        'residen_dirawat' => $data->residen_dirawat,
                        'residen_isoman' => $data->residen_isoman,
                        'residen_sembuh' => $data->residen_sembuh,
                        'intership_dirawat' => $data->intership_dirawat,
                        'intership_isoman' => $data->intership_isoman,
                        'intership_sembuh' => $data->intership_sembuh,
                        'dokter_spesialis_dirawat' => $data->dokter_spesialis_dirawat,
                        'dokter_spesialis_isoman' => $data->dokter_spesialis_isoman,
                        'dokter_spesialis_sembuh' => $data->dokter_spesialis_sembuh,
                        'dokter_umum_dirawat' => $data->dokter_umum_dirawat,
                        'dokter_umum_isoman' => $data->dokter_umum_isoman,
                        'dokter_umum_sembuh' => $data->dokter_umum_sembuh,
                        'dokter_gigi_dirawat' => $data->dokter_gigi_dirawat,
                        'dokter_gigi_isoman' => $data->dokter_gigi_isoman,
                        'dokter_gigi_sembuh' => $data->dokter_gigi_sembuh,
                        'bidan_dirawat' => $data->bidan_dirawat,
                        'bidan_isoman' => $data->bidan_isoman,
                        'bidan_sembuh' => $data->bidan_sembuh,
                        'apoteker_dirawat' => $data->apoteker_dirawat,
                        'apoteker_isoman' => $data->apoteker_isoman,
                        'apoteker_sembuh' => $data->apoteker_sembuh,
                        'radiografer_dirawat' => $data->radiografer_dirawat,
                        'radiografer_isoman' => $data->radiografer_isoman,
                        'radiografer_sembuh' => $data->radiografer_sembuh,
                        'analis_lab_dirawat' => $data->analis_lab_dirawat,
                        'analis_lab_isoman' => $data->analis_lab_isoman,
                        'analis_lab_sembuh' => $data->analis_lab_sembuh,
                        'nakes_lainnya_dirawat' => $data->nakes_lainnya_dirawat,
                        'nakes_lainnya_isoman' => $data->nakes_lainnya_isoman,
                        'nakes_lainnya_sembuh' => $data->nakes_lainnya_sembuh,
                        'perawat_dirawat' => $data->perawat_dirawat,
                        'perawat_isoman' => $data->perawat_isoman,
                        'perawat_sembuh' => $data->perawat_sembuh,
                        'status_sinkron' => 1,
                        'tanggal_input' => date('Y-m-d'),
                        'tanggal_sinkron' => date('Y-m-d')
                    ]);
                }
            }
        }

        if($request->ajax()) {
            $model = NakesTerinfeksi::orderBy('tanggal','desc')->get();
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
        return view('sinkron.harian-nakes-terinfeksi.index');
    }

    public function create()
    {
        return view('sinkron.harian-nakes-terinfeksi.create');
    }

    public function store()
    {
        if(request()->has('proses')) {
            try {
                Excel::import(new NakesTerinfeksiImport, request()->file('file'));
            } catch(Exception $e) {
                return back()->withError($e->getMessage());
            }
            return redirect()->route('harian-nakes-terinfeksi.index')->withMessage('Upload berhasil!');
        }
        if(request()->has('contoh_format')) {
            if(file_exists(storage_path('FormatNakesTerinfeksi.xlsx'))) {
                return response()->download(storage_path('FormatNakesTerinfeksi.xlsx'));
            } else {
                return back()->withError('File tidak ditemukan!');
            }
        }
    }

    public function show($id)
    {
        $data = NakesTerinfeksi::find($id);
        return response()->json($data);
    }

    public function sinkronisasi(Request $request)
    {
        $headers = config('custom.headers');
        $url = config('custom.url_api').'Pasien/harian_nakes_terinfeksi';

        $postDataArr = array(
            'tanggal' => $request->tanggal,
            'co_ass' => $request->co_ass,
            'residen' => $request->residen,
            'intership' => $request->intership,
            'dokter_spesialis' => $request->dokter_spesialis,
            'dokter_umum' => $request->dokter_umum,
            'dokter_gigi' => $request->dokter_gigi,
            'perawat' => $request->perawat,
            'bidan' => $request->bidan,
            'apoteker' => $request->apoteker,
            'radiografer' => $request->radiografer,
            'analis_lab' => $request->analis_lab,
            'nakes_lainnya' => $request->nakes_lainnya,
            'co_ass_meninggal' => $request->co_ass_meninggal,
            'residen_meninggal' => $request->residen_meninggal,
            'intership_meninggal' => $request->intership_meninggal,
            'dokter_spesialis_meninggal' => $request->dokter_spesialis_meninggal,
            'dokter_umum_meninggal' => $request->dokter_umum_meninggal,
            'dokter_gigi_meninggal' => $request->dokter_gigi_meninggal,
            'perawat_meninggal' => $request->perawat_meninggal,
            'bidan_meninggal' => $request->bidan_meninggal,
            'apoteker_meninggal' => $request->apoteker_meninggal,
            'radiografer_meninggal' => $request->radiografer_meninggal,
            'analis_lab_meninggal' => $request->analis_lab_meninggal,
            'nakes_lainnya_meninggal' => $request->nakes_lainnya_meninggal,
            'co_ass_dirawat' => $request->co_ass_dirawat,
            'co_ass_isoman' => $request->co_ass_isoman,
            'co_ass_sembuh' => $request->co_ass_sembuh,
            'residen_dirawat' => $request->residen_dirawat,
            'residen_isoman' => $request->residen_isoman,
            'residen_sembuh' => $request->residen_sembuh,
            'intership_dirawat' => $request->intership_dirawat,
            'intership_isoman' => $request->intership_isoman,
            'intership_sembuh' => $request->intership_sembuh,
            'dokter_spesialis_dirawat' => $request->dokter_spesialis_dirawat,
            'dokter_spesialis_isoman' => $request->dokter_spesialis_isoman,
            'dokter_spesialis_sembuh' => $request->dokter_spesialis_sembuh,
            'dokter_umum_dirawat' => $request->dokter_umum_dirawat,
            'dokter_umum_isoman' => $request->dokter_umum_isoman,
            'dokter_umum_sembuh' => $request->dokter_umum_sembuh,
            'dokter_gigi_dirawat' => $request->dokter_gigi_dirawat,
            'dokter_gigi_isoman' => $request->dokter_gigi_isoman,
            'dokter_gigi_sembuh' => $request->dokter_gigi_sembuh,
            'bidan_dirawat' => $request->bidan_dirawat,
            'bidan_isoman' => $request->bidan_isoman,
            'bidan_sembuh' => $request->bidan_sembuh,
            'apoteker_dirawat' => $request->apoteker_dirawat,
            'apoteker_isoman' => $request->apoteker_isoman,
            'apoteker_sembuh' => $request->apoteker_sembuh,
            'radiografer_dirawat' => $request->radiografer_dirawat,
            'radiografer_isoman' => $request->radiografer_isoman,
            'radiografer_sembuh' => $request->radiografer_sembuh,
            'analis_lab_dirawat' => $request->analis_lab_dirawat,
            'analis_lab_isoman' => $request->analis_lab_isoman,
            'analis_lab_sembuh' => $request->analis_lab_sembuh,
            'nakes_lainnya_dirawat' => $request->nakes_lainnya_dirawat,
            'nakes_lainnya_isoman' => $request->nakes_lainnya_isoman,
            'nakes_lainnya_sembuh' => $request->nakes_lainnya_sembuh,
            'perawat_dirawat' => $request->perawat_dirawat,
            'perawat_isoman' => $request->perawat_isoman,
            'perawat_sembuh' => $request->perawat_sembuh,
        );

        $response = Http::withHeaders($headers)
                    ->post($url,$postDataArr);

        if($response->status() == 200) {
            $obj = $response->object()->HarianNakesTerinfeksi;
            if($obj[0]->status == 200) {
                $data = NakesTerinfeksi::find($request->id);
                $data->co_ass = $request->co_ass;
                $data->residen = $request->residen;
                $data->intership = $request->intership;
                $data->dokter_spesialis = $request->dokter_spesialis;
                $data->dokter_umum = $request->dokter_umum;
                $data->dokter_gigi = $request->dokter_gigi;
                $data->perawat = $request->perawat;
                $data->bidan = $request->bidan;
                $data->apoteker = $request->apoteker;
                $data->radiografer = $request->radiografer;
                $data->analis_lab = $request->analis_lab;
                $data->nakes_lainnya = $request->nakes_lainnya;
                $data->co_ass_meninggal = $request->co_ass_meninggal;
                $data->residen_meninggal = $request->residen_meninggal;
                $data->intership_meninggal = $request->intership_meninggal;
                $data->dokter_spesialis_meninggal = $request->dokter_spesialis_meninggal;
                $data->dokter_umum_meninggal = $request->dokter_umum_meninggal;
                $data->dokter_gigi_meninggal = $request->dokter_gigi_meninggal;
                $data->perawat_meninggal = $request->perawat_meninggal;
                $data->bidan_meninggal = $request->bidan_meninggal;
                $data->apoteker_meninggal = $request->apoteker_meninggal;
                $data->radiografer_meninggal = $request->radiografer_meninggal;
                $data->analis_lab_meninggal = $request->analis_lab_meninggal;
                $data->nakes_lainnya_meninggal = $request->nakes_lainnya_meninggal;
                $data->co_ass_dirawat = $request->co_ass_dirawat;
                $data->co_ass_isoman = $request->co_ass_isoman;
                $data->co_ass_sembuh = $request->co_ass_sembuh;
                $data->residen_dirawat = $request->residen_dirawat;
                $data->residen_isoman = $request->residen_isoman;
                $data->residen_sembuh = $request->residen_sembuh;
                $data->intership_dirawat = $request->intership_dirawat;
                $data->intership_isoman = $request->intership_isoman;
                $data->intership_sembuh = $request->intership_sembuh;
                $data->dokter_spesialis_dirawat = $request->dokter_spesialis_dirawat;
                $data->dokter_spesialis_isoman = $request->dokter_spesialis_isoman;
                $data->dokter_spesialis_sembuh = $request->dokter_spesialis_sembuh;
                $data->dokter_umum_dirawat = $request->dokter_umum_dirawat;
                $data->dokter_umum_isoman = $request->dokter_umum_isoman;
                $data->dokter_umum_sembuh = $request->dokter_umum_sembuh;
                $data->dokter_gigi_dirawat = $request->dokter_gigi_dirawat;
                $data->dokter_gigi_isoman = $request->dokter_gigi_isoman;
                $data->dokter_gigi_sembuh = $request->dokter_gigi_sembuh;
                $data->bidan_dirawat = $request->bidan_dirawat;
                $data->bidan_isoman = $request->bidan_isoman;
                $data->bidan_sembuh = $request->bidan_sembuh;
                $data->apoteker_dirawat = $request->apoteker_dirawat;
                $data->apoteker_isoman = $request->apoteker_isoman;
                $data->apoteker_sembuh = $request->apoteker_sembuh;
                $data->radiografer_dirawat = $request->radiografer_dirawat;
                $data->radiografer_isoman = $request->radiografer_isoman;
                $data->radiografer_sembuh = $request->radiografer_sembuh;
                $data->analis_lab_dirawat = $request->analis_lab_dirawat;
                $data->analis_lab_isoman = $request->analis_lab_isoman;
                $data->analis_lab_sembuh = $request->analis_lab_sembuh;
                $data->nakes_lainnya_dirawat = $request->nakes_lainnya_dirawat;
                $data->nakes_lainnya_isoman = $request->nakes_lainnya_isoman;
                $data->nakes_lainnya_sembuh = $request->nakes_lainnya_sembuh;
                $data->perawat_dirawat = $request->perawat_dirawat;
                $data->perawat_isoman = $request->perawat_isoman;
                $data->perawat_sembuh = $request->perawat_sembuh;
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
                $url = config('custom.url_api').'Pasien/harian_nakes_terinfeksi';
                $response = Http::withHeaders($headers)->get($url);
    
                $obj = $response->object()->HarianNakesTerinfeksi;
                foreach($obj as $data) {
                    if(isset($data->message)) {
                        continue;
                    }
                    NakesTerinfeksi::updateOrCreate([
                        'tanggal' => $data->tanggal
                    ],[
                        'tanggal' => $data->tanggal,
                        'co_ass' => $data->co_ass,
                        'residen' => $data->residen,
                        'intership' => $data->intership,
                        'dokter_spesialis' => $data->dokter_spesialis,
                        'dokter_umum' => $data->dokter_umum,
                        'dokter_gigi' => $data->dokter_gigi,
                        'perawat' => $data->perawat,
                        'bidan' => $data->bidan,
                        'apoteker' => $data->apoteker,
                        'radiografer' => $data->radiografer,
                        'analis_lab' => $data->analis_lab,
                        'nakes_lainnya' => $data->nakes_lainnya,
                        'co_ass_meninggal' => $data->co_ass_meninggal,
                        'residen_meninggal' => $data->residen_meninggal,
                        'intership_meninggal' => $data->intership_meninggal,
                        'dokter_spesialis_meninggal' => $data->dokter_spesialis_meninggal,
                        'dokter_umum_meninggal' => $data->dokter_umum_meninggal,
                        'dokter_gigi_meninggal' => $data->dokter_gigi_meninggal,
                        'perawat_meninggal' => $data->perawat_meninggal,
                        'bidan_meninggal' => $data->bidan_meninggal,
                        'apoteker_meninggal' => $data->apoteker_meninggal,
                        'radiografer_meninggal' => $data->radiografer_meninggal,
                        'analis_lab_meninggal' => $data->analis_lab_meninggal,
                        'nakes_lainnya_meninggal' => $data->nakes_lainnya_meninggal,
                        'co_ass_dirawat' => $data->co_ass_dirawat,
                        'co_ass_isoman' => $data->co_ass_isoman,
                        'co_ass_sembuh' => $data->co_ass_sembuh,
                        'residen_dirawat' => $data->residen_dirawat,
                        'residen_isoman' => $data->residen_isoman,
                        'residen_sembuh' => $data->residen_sembuh,
                        'intership_dirawat' => $data->intership_dirawat,
                        'intership_isoman' => $data->intership_isoman,
                        'intership_sembuh' => $data->intership_sembuh,
                        'dokter_spesialis_dirawat' => $data->dokter_spesialis_dirawat,
                        'dokter_spesialis_isoman' => $data->dokter_spesialis_isoman,
                        'dokter_spesialis_sembuh' => $data->dokter_spesialis_sembuh,
                        'dokter_umum_dirawat' => $data->dokter_umum_dirawat,
                        'dokter_umum_isoman' => $data->dokter_umum_isoman,
                        'dokter_umum_sembuh' => $data->dokter_umum_sembuh,
                        'dokter_gigi_dirawat' => $data->dokter_gigi_dirawat,
                        'dokter_gigi_isoman' => $data->dokter_gigi_isoman,
                        'dokter_gigi_sembuh' => $data->dokter_gigi_sembuh,
                        'bidan_dirawat' => $data->bidan_dirawat,
                        'bidan_isoman' => $data->bidan_isoman,
                        'bidan_sembuh' => $data->bidan_sembuh,
                        'apoteker_dirawat' => $data->apoteker_dirawat,
                        'apoteker_isoman' => $data->apoteker_isoman,
                        'apoteker_sembuh' => $data->apoteker_sembuh,
                        'radiografer_dirawat' => $data->radiografer_dirawat,
                        'radiografer_isoman' => $data->radiografer_isoman,
                        'radiografer_sembuh' => $data->radiografer_sembuh,
                        'analis_lab_dirawat' => $data->analis_lab_dirawat,
                        'analis_lab_isoman' => $data->analis_lab_isoman,
                        'analis_lab_sembuh' => $data->analis_lab_sembuh,
                        'nakes_lainnya_dirawat' => $data->nakes_lainnya_dirawat,
                        'nakes_lainnya_isoman' => $data->nakes_lainnya_isoman,
                        'nakes_lainnya_sembuh' => $data->nakes_lainnya_sembuh,
                        'perawat_dirawat' => $data->perawat_dirawat,
                        'perawat_isoman' => $data->perawat_isoman,
                        'perawat_sembuh' => $data->perawat_sembuh,
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

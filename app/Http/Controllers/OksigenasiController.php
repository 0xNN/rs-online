<?php

namespace App\Http\Controllers;

use App\Models\Oksigenasi;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OksigenasiController extends Controller
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
    
            $url =  config('custom.url_api').'Logistik/oksigen';
            $response = Http::withHeaders($headers)->get($url);

            $obj = $response->object()->Oksigenasi;
            foreach($obj as $data) {
                if(isset($data->message)) {
                    continue;
                } else {
                    Oksigenasi::updateOrCreate([
                        'tanggal' => $data->tanggal
                    ],[
                        'tanggal' => $data->tanggal,
                        'p_cair' => $data->p_cair,
                        'p_tabung_kecil' => $data->p_tabung_kecil,
                        'p_tabung_sedang' => $data->p_tabung_sedang,
                        'p_tabung_besar' => $data->p_tabung_besar,
                        'k_isi_cair' => $data->k_isi_cair,
                        'k_isi_tabung_kecil' => $data->k_isi_tabung_kecil,
                        'k_isi_tabung_sedang' => $data->k_isi_tabung_sedang,
                        'k_isi_tabung_besar' => $data->k_isi_tabung_besar,
                        'status_sinkron' => 1,
                        'tanggal_input' => date('Y-m-d'),
                        'tanggal_sinkron' => date('Y-m-d')
                    ]);
                }
            }
        }

        if($request->ajax()) {
            $model = Oksigenasi::orderBy('tanggal','desc');
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
                ->editColumn('p_cair', function($row) {
                    return number_format($row->p_cair, 3, '.','');
                })
                ->editColumn('p_tabung_kecil', function($row) {
                    return number_format($row->p_tabung_kecil, 2, '.','');
                })
                ->editColumn('p_tabung_sedang', function($row) {
                    return number_format($row->p_tabung_sedang, 2, '.','');
                })
                ->editColumn('p_tabung_besar', function($row) {
                    return number_format($row->p_tabung_besar, 2, '.','');
                })
                ->editColumn('k_isi_cair', function($row) {
                    return number_format($row->k_isi_cair, 3, '.','');
                })
                ->editColumn('k_isi_tabung_kecil', function($row) {
                    return number_format($row->k_isi_tabung_kecil, 2, '.','');
                })
                ->editColumn('k_isi_tabung_sedang', function($row) {
                    return number_format($row->k_isi_tabung_sedang, 2, '.','');
                })
                ->editColumn('k_isi_tabung_besar', function($row) {
                    return number_format($row->k_isi_tabung_besar, 2, '.','');
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
        return view('sinkron.oksigenasi.index');
    }

    public function show($id)
    {
        $data = Oksigenasi::find($id);
        return response()->json($data);
    }

    public function create()
    {

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

    public function sinkronisasi(Request $request)
    {
        $headers = config('custom.headers');
        $url = config('custom.url_api').'Logistik/oksigen';

        $p_cair = $this->konversi($request->p_cair, $request->satuan_p_cair);
        $k_isi_cair = $this->konversi($request->k_isi_cair, $request->satuan_k_isi_cair);

        $postDataArr = array(
            'tanggal' => $request->tanggal,
            'p_cair' => $p_cair,
            'p_tabung_kecil' => $request->p_tabung_kecil,
            'p_tabung_sedang' => $request->p_tabung_sedang,
            'p_tabung_besar' => $request->p_tabung_besar,
            'k_isi_cair' => $k_isi_cair,
            'k_isi_tabung_kecil' => $request->k_isi_tabung_kecil,
            'k_isi_tabung_sedang' => $request->k_isi_tabung_sedang,
            'k_isi_tabung_besar' => $request->k_isi_tabung_besar,
        );

        $response = Http::withHeaders($headers)
                    ->post($url,$postDataArr);

        if($response->status() == 200) {
            $obj = $response->object()->Oksigenasi;
            if($obj[0]->status == 200) {
                $data = Oksigenasi::find($request->id);
                $data->p_cair = $p_cair;
                $data->p_tabung_kecil = $request->p_tabung_kecil;
                $data->p_tabung_sedang = $request->p_tabung_sedang;
                $data->p_tabung_besar = $request->p_tabung_besar;
                $data->k_isi_cair = $k_isi_cair;
                $data->k_isi_tabung_kecil = $request->k_isi_tabung_kecil;
                $data->k_isi_tabung_sedang = $request->k_isi_tabung_sedang;
                $data->k_isi_tabung_besar = $request->k_isi_tabung_besar;
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
}


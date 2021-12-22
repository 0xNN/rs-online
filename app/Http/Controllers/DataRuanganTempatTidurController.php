<?php

namespace App\Http\Controllers;

use App\Imports\DataRuanganTempatTidurImport;
use App\Models\DataRuanganTempatTidur;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;

class DataRuanganTempatTidurController extends Controller
{
    public function index(Request $request)
    {
        $headers = config('custom.headers');
        $url = config('custom.url_api').'Fasyankes';
        $response = Http::withHeaders($headers)->get($url);

        $obj = $response->object()->fasyankes;
        if(isset($obj[0]->message)) {
            if(json_decode($obj[0]->message)->response == "Timestamp expired") {
                $now = new DateTime();
                $now->format('Y-m-d H:i:s');
                $headers = [
                    'X-rs-id' => $headers['X-rs-id'],
                    'X-Timestamp' => $now->getTimestamp(),
                    'X-pass' => $headers['X-pass']
                ];
                $url = config('custom.url_api').'Fasyankes';
                $response = Http::withHeaders($headers)->get($url);
                $obj = $response->object()->fasyankes;
            }
        }

        // dd($obj);
        foreach($obj as $data) {
            DataRuanganTempatTidur::updateOrCreate([
                'id_tt' => $data->id_tt,
                'tt' => $data->tt,
                'ruang' => $data->ruang,
            ],[
                'id_tt' => $data->id_tt,
                'id_t_tt' => $data->id_t_tt,
                'tt' => $data->tt,
                'ruang' => $data->ruang,
                'jumlah_ruang' => $data->jumlah_ruang,
                'jumlah' => $data->jumlah,
                'terpakai' => $data->terpakai,
                'antrian' => $data->antrian,
                'prepare' => $data->prepare,
                'prepare_plan' => $data->prepare_plan,
                'covid' => $data->covid,
                'status_sinkron' => 1,
                'tanggal_input' => date('Y-m-d'),
                'tanggal_sinkron' => date('Y-m-d')
            ]);
        }

        if($request->ajax()) {
            $role = auth()->user()->menuroles;
            if(strlen($role) == 4) {
                $model = DataRuanganTempatTidur::where('covid', 0)
                                                ->orderBy('id','desc')->get();
            } else if(strlen($role) > 4) {
                $model = DataRuanganTempatTidur::where('covid', 1)
                                                ->orderBy('id','desc')->get();
            }
            return datatables()
                ->of($model)
                ->addIndexColumn()
                ->editColumn('action', function($row) {
                    $button = '<div class="btn-group" role="group">';
                    $button .= '<button data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Sinkron" class="sinkron btn btn-info btn-sm sinkron-post"><i class="cil-loop-circular"></i></button>';
                    $button .= '<button data-toggle="tooltip" data-id_tt="'.$row->id_t_tt.'" data-id="'.$row->id.'" data-original-title="Delete" class="delete btn btn-danger btn-sm delete-post"><i class="cil-trash"></i></button>';
                    $button .= '</div>';
                    return $button;
                    // if($row->status_sinkron == 0) {
                    // } else {
                    //     return '<span class="badge badge-success"><i class="cil-check-alt"></i></span>';
                    // }
                })
                ->editColumn('covid', function($row) {
                    if($row->covid == 1) {
                        return '<span class="badge badge-danger">Covid</span>';
                    } else {
                        return '<span class="badge badge-info">Non Covid</span>';
                    }
                })
                ->editColumn('status_sinkron', function($row) {
                    if($row->status_sinkron == 0) {
                        $status = '<i class="cil-warning" style="color: red"></i>';
                    } else {
                        $status = '<i class="cil-check" style="color: green"></i>';
                    }
                    return $status;
                })
                ->escapeColumns([])
                ->make(true);
        }
        return view('sinkron.data-ruangan-tempat-tidur.index');
    }

    public function create()
    {
        $headers = config('custom.headers');
        $url = config('custom.url_api').'Referensi/tempat_tidur';
        $response = Http::withHeaders($headers)->get($url);

        $obj = $response->object()->tempat_tidur;
        if(json_decode($obj[0]->message)->response == "Timestamp expired") {
            $now = new DateTime();
            $now->format('Y-m-d H:i:s');
            $headers = [
                'X-rs-id' => $headers['X-rs-id'],
                'X-Timestamp' => $now->getTimestamp(),
                'X-pass' => $headers['X-pass']
            ];
            $url = config('custom.url_api').'Referensi/tempat_tidur';
            $response = Http::withHeaders($headers)->get($url);
            $obj = $response->object()->tempat_tidur;
        }
        
        return view('sinkron.data-ruangan-tempat-tidur.create', compact(
            'obj'
        ));
    }

    public function store()
    {
        // dd(request()->all());
        if(request()->has('proses')) {
            $tt = request()->nama_master_tt;
            $id_tt = request()->kode_master_tt;
            try {
                Excel::import(new DataRuanganTempatTidurImport($id_tt, $tt), request()->file('file'));
            } catch(Exception $e) {
                return back()->withError($e->getMessage());
            }
            return redirect()->route('data-ruangan-tempat-tidur.index')->withMessage('Upload berhasil!');
        }
        if(request()->has('contoh_format')) {
            if(file_exists(storage_path('FormatRuangTempatTidur.xlsx'))) {
                return response()->download(storage_path('FormatRuangTempatTidur.xlsx'));
            } else {
                return back()->withError('File tidak ditemukan!');
            }
        }
    }

    public function show($id)
    {
        $data = DataRuanganTempatTidur::find($id);
        return response()->json($data);
    }

    public function sinkronisasi(Request $request)
    {
        $headers = config('custom.headers');
        $url = config('custom.url_api').'Fasyankes';
        // dd($request->all());
        $postDataArr = array(
            "id_tt" => $request->id_tt,
            "ruang" => $request->ruang,
            "jumlah_ruang" => $request->jumlah_ruang,
            "jumlah" => $request->jumlah,
            "terpakai" => $request->terpakai,
            "antrian" => $request->antrian,
            "prepare" => $request->prepare,
            "prepare_plan" => $request->prepare_plan,
            "covid" => $request->covid,
        );

        $now =  new DateTime();
        $now->format('Y-m-d H:i:s');
        $headers = [
            'X-rs-id' => $headers['X-rs-id'],
            'X-Timestamp' => $now->getTimestamp(),
            'X-pass' => $headers['X-pass']
        ];

        // dd($postDataArr);
        $cek = DataRuanganTempatTidur::find($request->id);
        if($cek->status_sinkron == 0) {
            // Proses Simpan (POST)
            $response = Http::withHeaders($headers)
                        ->post($url,$postDataArr);
            // dd($response->object());
            if($response->status() == 200) {
                $obj = $response->object()->fasyankes;
                if($obj[0]->status == 200) {
                    $data = DataRuanganTempatTidur::find($request->id);
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
        } else {
            // Proses Ubah (PUT)
            $response = Http::withHeaders($headers)
                        ->put($url,$postDataArr);

            if($response->status() == 200) {
                $obj = $response->object()->fasyankes;
                if($obj[0]->status == 200) {
                    $data = DataRuanganTempatTidur::find($request->id);
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
    }

    public function destroy($id)
    {
        $model = DataRuanganTempatTidur::where('id', $id)->first();

        $headers = config('custom.headers');
        $now = new DateTime();
        $now->format('Y-m-d H:i:s');
        $headers = [
            'X-rs-id' => $headers['X-rs-id'],
            'X-Timestamp' => $now->getTimestamp(),
            'X-pass' => $headers['X-pass']
        ];
        $url = config('custom.url_api').'Fasyankes';

        $deleteData = array(
            'id_t_tt' => $model->id_t_tt
        );

        $response = Http::withHeaders($headers)->delete($url,$deleteData);

        // dd($response->object());
        if($response->status() == 200) {
            // PasienMasuk::where('id', $id)->delete();
            $model = DataRuanganTempatTidur::find($id);
            $model->status_sinkron = 0;
            $model->delete();
            return response()->json([
                'code' => 200,
                'message' => 'Berhasil dihapus.'
            ],200);
        } else {
            return response()->json([
                'code' => 401,
                'message' => 'Kesalahan Server!'
            ],401);
        }
    }
}

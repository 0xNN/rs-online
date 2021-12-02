<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\DataApdImport;
use App\Models\DataApd;
use DateTime;
use Exception;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;

class DataApdController extends Controller
{
    public function index(Request $request)
    {
        $headers = config('custom.headers');
        $url = config('custom.url_api').'Fasyankes/apd';
        $response = Http::withHeaders($headers)->get($url);

        $obj = $response->object()->apd;
        if(json_decode($obj[0]->message)->response == "Timestamp expired") {
            $now = new DateTime();
            $now->format('Y-m-d H:i:s');
            $headers = [
                'X-rs-id' => $headers['X-rs-id'],
                'X-Timestamp' => $now->getTimestamp(),
                'X-pass' => $headers['X-pass']
            ];
            $url = config('custom.url_api').'Fasyankes/apd';
            $response = Http::withHeaders($headers)->get($url);
            $obj = $response->object()->apd;
        }

        foreach($obj as $data) {
            DataApd::updateOrCreate([
                'id_kebutuhan' => $data->id_kebutuhan
            ],[
                'id_kebutuhan' => $data->id_kebutuhan,
                'kebutuhan' => $data->kebutuhan,
                'jumlah_eksisting' => $data->jumlah_eksisting,
                'jumlah' => $data->jumlah,
                'jumlah_diterima' => $data->jumlah_diterima,
                'status_sinkron' => 1,
                'tanggal_input' => date('Y-m-d'),
                'tanggal_sinkron' => date('Y-m-d')
            ]);
        }

        if($request->ajax()) {
            $model = DataApd::orderBy('id','desc')->get();
            return datatables()
                ->of($model)
                ->addIndexColumn()
                ->editColumn('action', function($row) {
                    $button = '<div class="btn-group" role="group">';
                    $button .= '<button data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Sinkron" class="sinkron btn btn-info btn-sm sinkron-post"><i class="cil-loop-circular"></i></button>';
                    $button .= '<button data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" class="delete btn btn-danger btn-sm delete-post"><i class="cil-trash"></i></button>';
                    $button .= '</div>';
                    return $button;
                    // if($row->status_sinkron == 0) {
                    // } else {
                    //     return '<span class="badge badge-success"><i class="cil-check-alt"></i></span>';
                    // }
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
        return view('sinkron.data-apd.index');
    }

    public function create()
    {
        $headers = config('custom.headers');
        $url = config('custom.url_api').'Referensi/kebutuhan_apd';
        $response = Http::withHeaders($headers)->get($url);

        $obj = $response->object()->kebutuhan_apd;
        if(json_decode($obj[0]->message)->response == "Timestamp expired") {
            $now = new DateTime();
            $now->format('Y-m-d H:i:s');
            $headers = [
                'X-rs-id' => $headers['X-rs-id'],
                'X-Timestamp' => $now->getTimestamp(),
                'X-pass' => $headers['X-pass']
            ];
            $url = config('custom.url_api').'Referensi/kebutuhan_apd';
            $response = Http::withHeaders($headers)->get($url);
            $obj = $response->object()->kebutuhan_apd;
        }
        
        return view('sinkron.data-apd.create', compact(
            'obj'
        ));
    }

    public function store()
    {
        if(request()->has('proses')) {
            $id_kebutuhan = request()->master_id_kebutuhan;
            try {
                Excel::import(new DataApdImport($id_kebutuhan), request()->file('file'));
            } catch(Exception $e) {
                return back()->withError($e->getMessage());
            }
            return redirect()->route('data-apd.index')->withMessage('Upload berhasil!');
        }
        if(request()->has('contoh_format')) {
            if(file_exists(storage_path('FormatAPD.xlsx'))) {
                return response()->download(storage_path('FormatAPD.xlsx'));
            } else {
                return back()->withError('File tidak ditemukan!');
            }
        }
    }

    public function show($id)
    {
        $data = DataApd::find($id);
        return response()->json($data);
    }

    public function sinkronisasi(Request $request)
    {
        $headers = config('custom.headers');
        $url = config('custom.url_api').'Fasyankes/apd';
        // dd($request->all());
        $postDataArr = array(
            "id_kebutuhan" => $request->id_kebutuhan,
            "jumlah_eksisting" => $request->jumlah_eksisting,
            "jumlah" => $request->jumlah,
            "jumlah_diterima" => $request->jumlah_diterima,
        );

        $now =  new DateTime();
        $now->format('Y-m-d H:i:s');
        $headers = [
            'X-rs-id' => $headers['X-rs-id'],
            'X-Timestamp' => $now->getTimestamp(),
            'X-pass' => $headers['X-pass']
        ];

        // dd($postDataArr);
        $cek = DataApd::find($request->id);
        if($cek->status_sinkron == 0) {
            // Proses Simpan (POST)
            $response = Http::withHeaders($headers)
                        ->post($url,$postDataArr);
            // dd($response->object());
            if($response->status() == 200) {
                $obj = $response->object()->apd;
                if($obj[0]->status == 200) {
                    $data = DataApd::find($request->id);
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
            if(substr($response->object()->apd[0]->message, -4) == "POST") {
                $response = Http::withHeaders($headers)
                            ->post($url,$postDataArr);
                // dd($response->object());
                if($response->status() == 200) {
                    $obj = $response->object()->apd;
                    if($obj[0]->status == 200) {
                        $data = DataApd::find($request->id);
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
            if($response->status() == 200) {
                $obj = $response->object()->apd;
                if($obj[0]->status == 200) {
                    $data = DataApd::find($request->id);
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
        $model = DataApd::where('id', $id)->first();

        $headers = config('custom.headers');
        $now = new DateTime();
        $now->format('Y-m-d H:i:s');
        $headers = [
            'X-rs-id' => $headers['X-rs-id'],
            'X-Timestamp' => $now->getTimestamp(),
            'X-pass' => $headers['X-pass'],
            'Id_kebutuhan' => $model->id_kebutuhan
        ];
        $url = config('custom.url_api').'Fasyankes/apd';

        $deleteData = array(
            'id_kebutuhan' => $model->id_kebutuhan
        );

        $response = Http::withHeaders($headers)->delete($url,null);

        // dd($response->object());
        if($response->status() == 200) {
            // PasienMasuk::where('id', $id)->delete();
            $model = DataApd::find($id);
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

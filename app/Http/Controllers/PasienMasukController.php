<?php

namespace App\Http\Controllers;

use App\Models\PasienMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Imports\PasienMasukImport;
use Carbon\Carbon;
use Exception;
use Maatwebsite\Excel\Facades\Excel;

class PasienMasukController extends Controller
{
    public function index(Request $request)
    {
        $headers = config('custom.headers');
        $url = config('custom.url_api_v2').'PasienMasuk';
        $response = Http::withHeaders($headers)->get($url);

        $obj = $response->object()->RekapPasienMasuk;
        foreach($obj as $data) {
            PasienMasuk::updateOrCreate([
                'tanggal' => $data->tanggal
            ],[
                'tanggal' => $data->tanggal,
                'igd_suspect_l' => $data->igd_suspect_l,
                'igd_suspect_p' => $data->igd_suspect_p,
                'igd_confirm_l' => $data->igd_confirm_l,
                'igd_confirm_p' => $data->igd_confirm_p,
                'rj_suspect_l' => $data->rj_suspect_l,
                'rj_suspect_p' => $data->rj_suspect_p,
                'rj_confirm_l' => $data->rj_confirm_l,
                'rj_confirm_p' => $data->rj_confirm_p,
                'ri_suspect_l' => $data->ri_suspect_l,
                'ri_suspect_p' => $data->ri_suspect_p,
                'ri_confirm_l' => $data->ri_confirm_l,
                'ri_confirm_p' => $data->ri_confirm_p,
                'status_sinkron' => 1,
                'tanggal_input' => date('Y-m-d'),
                'tanggal_sinkron' => date('Y-m-d')
            ]);
        }

        if($request->ajax()) {
            $model = PasienMasuk::orderBy('tanggal','desc')->get();
            return datatables()
                ->of($model)
                ->addIndexColumn()
                ->editColumn('action', function($row) {
                    $button = '<div class="btn-group" role="group">';
                    $button .= '<button data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Sinkron" class="sinkron btn btn-info btn-sm sinkron-post"><i class="cil-loop-circular"></i></button>';
                    $button .= '<button data-toggle="tooltip" data-tanggal="'.$row->tanggal.'" data-id="'.$row->id.'" data-original-title="Delete" class="delete btn btn-danger btn-sm delete-post"><i class="cil-trash"></i></button>';
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
        return view('sinkron.pasien-masuk.index');
    }

    public function create()
    {
        return view('sinkron.pasien-masuk.create');
    }

    public function store()
    {
        if(request()->has('proses')) {
            try {
                Excel::import(new PasienMasukImport, request()->file('file'));
            } catch(Exception $e) {
                return back()->withError('Terjadi kesalahan!');
            }
            return redirect()->route('pasien-masuk.index')->withMessage('Upload berhasil!');
        }
        if(request()->has('contoh_format')) {
            return response()->download(storage_path('FormatPasienMasuk.xlsx'));
        }
    }

    public function show($id)
    {
        $data = PasienMasuk::find($id);
        return response()->json($data);
    }

    public function sinkronisasi(Request $request)
    {
        $headers = config('custom.headers');
        $url = config('custom.url_api_v2').'PasienMasuk';

        $postDataArr = array(
            'tanggal' => $request->tanggal,
            'igd_suspect_l' => $request->igd_suspect_l,
            'igd_suspect_p' => $request->igd_suspect_p,
            'igd_confirm_l' => $request->igd_confirm_l,
            'igd_confirm_p' => $request->igd_confirm_p,
            'rj_suspect_l' => $request->rj_suspect_l,
            'rj_suspect_p' => $request->rj_suspect_p,
            'rj_confirm_l' => $request->rj_confirm_l,
            'rj_confirm_p' => $request->rj_confirm_p,
            'ri_suspect_l' => $request->ri_suspect_l,
            'ri_suspect_p' => $request->ri_suspect_p,
            'ri_confirm_l' => $request->ri_confirm_l,
            'ri_confirm_p' => $request->ri_confirm_p,
        );
        $response = Http::withHeaders($headers)
                    ->post($url,$postDataArr);

        if($response->status() == 200) {
            $obj = $response->object()->RekapPasienMasuk;
            if($obj[0]->status == 200) {
                $data = PasienMasuk::find($request->id);
                $data->igd_suspect_l = $request->igd_suspect_l;
                $data->igd_suspect_p = $request->igd_suspect_p;
                $data->igd_confirm_l = $request->igd_confirm_l;
                $data->igd_confirm_p = $request->igd_confirm_p;
                $data->rj_suspect_l = $request->rj_suspect_l;
                $data->rj_suspect_p = $request->rj_suspect_p;
                $data->rj_confirm_l = $request->rj_confirm_l;
                $data->rj_confirm_p = $request->rj_confirm_p;
                $data->ri_suspect_l = $request->ri_suspect_l;
                $data->ri_suspect_p = $request->ri_suspect_p;
                $data->ri_confirm_l = $request->ri_confirm_l;
                $data->ri_confirm_p = $request->ri_confirm_p;
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

    public function destroy($id)
    {
        $model = PasienMasuk::where('id', $id)->first();

        $headers = config('custom.headers');
        $url = config('custom.url_api_v2').'PasienMasuk';

        $deleteData = array(
            'tanggal' => $model->tanggal
        );

        $response = Http::withHeaders($headers)->delete($url,$deleteData);

        // dd($response->object());
        if($response->status() == 200) {
            // PasienMasuk::where('id', $id)->delete();
            $model = PasienMasuk::find($id);
            $model->status_sinkron = 0;
            $model->save();
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

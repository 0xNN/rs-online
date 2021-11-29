<?php

namespace App\Http\Controllers;

use App\Imports\PasienDirawatNonKomorbidImport;
use App\Models\PasienDirawatNonKomorbid;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;

class PasienDirawatNonKomorbidController extends Controller
{
    public function index(Request $request)
    {
        $headers = config('custom.headers');
        $url = config('custom.url_api_v2').'PasienDirawatTanpaKomorbid';
        $response = Http::withHeaders($headers)->get($url);

        $obj = $response->object()->RekapPasienDirawatTanpaKomorbid;
        
        foreach($obj as $data) {
            PasienDirawatNonKomorbid::updateOrCreate([
                'tanggal' => $data->tanggal
            ],[
                'tanggal' => $data->tanggal,
                'icu_dengan_ventilator_suspect_l' => $data->icu_dengan_ventilator_suspect_l,
                'icu_dengan_ventilator_suspect_p' => $data->icu_dengan_ventilator_suspect_p,
                'icu_dengan_ventilator_confirm_l' => $data->icu_dengan_ventilator_confirm_l,
                'icu_dengan_ventilator_confirm_p' => $data->icu_dengan_ventilator_confirm_p,
                'icu_tanpa_ventilator_suspect_l' => $data->icu_tanpa_ventilator_suspect_l,
                'icu_tanpa_ventilator_suspect_p' => $data->icu_tanpa_ventilator_suspect_p,
                'icu_tanpa_ventilator_confirm_l' => $data->icu_tanpa_ventilator_confirm_l,
                'icu_tanpa_ventilator_confirm_p' => $data->icu_tanpa_ventilator_confirm_p,
                'icu_tekanan_negatif_dengan_ventilator_suspect_l' => $data->icu_tekanan_negatif_dengan_ventilator_suspect_l,
                'icu_tekanan_negatif_dengan_ventilator_suspect_p' => $data->icu_tekanan_negatif_dengan_ventilator_suspect_p,
                'icu_tekanan_negatif_dengan_ventilator_confirm_l' => $data->icu_tekanan_negatif_dengan_ventilator_confirm_l,
                'icu_tekanan_negatif_dengan_ventilator_confirm_p' => $data->icu_tekanan_negatif_dengan_ventilator_confirm_p,
                'icu_tekanan_negatif_tanpa_ventilator_suspect_l' => $data->icu_tekanan_negatif_tanpa_ventilator_suspect_l,
                'icu_tekanan_negatif_tanpa_ventilator_suspect_p' => $data->icu_tekanan_negatif_tanpa_ventilator_suspect_p,
                'icu_tekanan_negatif_tanpa_ventilator_confirm_l' => $data->icu_tekanan_negatif_tanpa_ventilator_confirm_l,
                'icu_tekanan_negatif_tanpa_ventilator_confirm_p' => $data->icu_tekanan_negatif_tanpa_ventilator_confirm_p,
                'isolasi_tekanan_negatif_suspect_l' => $data->isolasi_tekanan_negatif_suspect_l,
                'isolasi_tekanan_negatif_suspect_p' => $data->isolasi_tekanan_negatif_suspect_p,
                'isolasi_tekanan_negatif_confirm_l' => $data->isolasi_tekanan_negatif_confirm_l,
                'isolasi_tekanan_negatif_confirm_p' => $data->isolasi_tekanan_negatif_confirm_p,
                'isolasi_tanpa_tekanan_negatif_suspect_l' => $data->isolasi_tanpa_tekanan_negatif_suspect_l,
                'isolasi_tanpa_tekanan_negatif_suspect_p' => $data->isolasi_tanpa_tekanan_negatif_suspect_p,
                'isolasi_tanpa_tekanan_negatif_confirm_l' => $data->isolasi_tanpa_tekanan_negatif_confirm_l,
                'isolasi_tanpa_tekanan_negatif_confirm_p' => $data->isolasi_tanpa_tekanan_negatif_confirm_p,
                'nicu_khusus_covid_suspect_l' => $data->nicu_khusus_covid_suspect_l,
                'nicu_khusus_covid_suspect_p' => $data->nicu_khusus_covid_suspect_p,
                'nicu_khusus_covid_confirm_l' => $data->nicu_khusus_covid_confirm_l,
                'nicu_khusus_covid_confirm_p' => $data->nicu_khusus_covid_confirm_p,
                'picu_khusus_covid_suspect_l' => $data->picu_khusus_covid_suspect_l,
                'picu_khusus_covid_suspect_p' => $data->picu_khusus_covid_suspect_p,
                'picu_khusus_covid_confirm_l' => $data->picu_khusus_covid_confirm_l,
                'picu_khusus_covid_confirm_p' => $data->picu_khusus_covid_confirm_p,
                'status_sinkron' => 1,
                'tanggal_input' => date('Y-m-d'),
                'tanggal_sinkron' => date('Y-m-d')
            ]);
        }

        if($request->ajax()) {
            $model = PasienDirawatNonKomorbid::orderBy('tanggal','desc');
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
        return view('sinkron.pasien-dirawat-tanpa-komorbid.index');
    }

    public function create()
    {
        return view('sinkron.pasien-dirawat-tanpa-komorbid.create');
    }

    public function store()
    {
        try {
            Excel::import(new PasienDirawatNonKomorbidImport, request()->file('file'));
        } catch(Exception $e) {
            return back()->withError($e->getMessage());
        }

        return redirect()->route('pasien-dirawat-tanpa-komorbid.index')->withMessage('Upload berhasil!');
    }

    public function show($id)
    {
        $data = PasienDirawatNonKomorbid::find($id);
        return response()->json($data);
    }

    public function sinkronisasi(Request $request)
    {
        $headers = config('custom.headers');
        $url = config('custom.url_api_v2').'PasienDirawatTanpaKomorbid';

        $postDataArr = array(
            'tanggal' => $request->tanggal,
            'icu_dengan_ventilator_suspect_l' => $request->icu_dengan_ventilator_suspect_l,
            'icu_dengan_ventilator_suspect_p' => $request->icu_dengan_ventilator_suspect_p,
            'icu_dengan_ventilator_confirm_l' => $request->icu_dengan_ventilator_confirm_l,
            'icu_dengan_ventilator_confirm_p' => $request->icu_dengan_ventilator_confirm_p,
            'icu_tanpa_ventilator_suspect_l' => $request->icu_tanpa_ventilator_suspect_l,
            'icu_tanpa_ventilator_suspect_p' => $request->icu_tanpa_ventilator_suspect_p,
            'icu_tanpa_ventilator_confirm_l' => $request->icu_tanpa_ventilator_confirm_l,
            'icu_tanpa_ventilator_confirm_p' => $request->icu_tanpa_ventilator_confirm_p,
            'icu_tekanan_negatif_dengan_ventilator_suspect_l' => $request->icu_tekanan_negatif_dengan_ventilator_suspect_l,
            'icu_tekanan_negatif_dengan_ventilator_suspect_p' => $request->icu_tekanan_negatif_dengan_ventilator_suspect_p,
            'icu_tekanan_negatif_dengan_ventilator_confirm_l' => $request->icu_tekanan_negatif_dengan_ventilator_confirm_l,
            'icu_tekanan_negatif_dengan_ventilator_confirm_p' => $request->icu_tekanan_negatif_dengan_ventilator_confirm_p,
            'icu_tekanan_negatif_tanpa_ventilator_suspect_l' => $request->icu_tekanan_negatif_tanpa_ventilator_suspect_l,
            'icu_tekanan_negatif_tanpa_ventilator_suspect_p' => $request->icu_tekanan_negatif_tanpa_ventilator_suspect_p,
            'icu_tekanan_negatif_tanpa_ventilator_confirm_l' => $request->icu_tekanan_negatif_tanpa_ventilator_confirm_l,
            'icu_tekanan_negatif_tanpa_ventilator_confirm_p' => $request->icu_tekanan_negatif_tanpa_ventilator_confirm_p,
            'isolasi_tekanan_negatif_suspect_l' => $request->isolasi_tekanan_negatif_suspect_l,
            'isolasi_tekanan_negatif_suspect_p' => $request->isolasi_tekanan_negatif_suspect_p,
            'isolasi_tekanan_negatif_confirm_l' => $request->isolasi_tekanan_negatif_confirm_l,
            'isolasi_tekanan_negatif_confirm_p' => $request->isolasi_tekanan_negatif_confirm_p,
            'isolasi_tanpa_tekanan_negatif_suspect_l' => $request->isolasi_tanpa_tekanan_negatif_suspect_l,
            'isolasi_tanpa_tekanan_negatif_suspect_p' => $request->isolasi_tanpa_tekanan_negatif_suspect_p,
            'isolasi_tanpa_tekanan_negatif_confirm_l' => $request->isolasi_tanpa_tekanan_negatif_confirm_l,
            'isolasi_tanpa_tekanan_negatif_confirm_p' => $request->isolasi_tanpa_tekanan_negatif_confirm_p,
            'nicu_khusus_covid_suspect_l' => $request->nicu_khusus_covid_suspect_l,
            'nicu_khusus_covid_suspect_p' => $request->nicu_khusus_covid_suspect_p,
            'nicu_khusus_covid_confirm_l' => $request->nicu_khusus_covid_confirm_l,
            'nicu_khusus_covid_confirm_p' => $request->nicu_khusus_covid_confirm_p,
            'picu_khusus_covid_suspect_l' => $request->picu_khusus_covid_suspect_l,
            'picu_khusus_covid_suspect_p' => $request->picu_khusus_covid_suspect_p,
            'picu_khusus_covid_confirm_l' => $request->picu_khusus_covid_confirm_l,
            'picu_khusus_covid_confirm_p' => $request->picu_khusus_covid_confirm_p,
        );
        $response = Http::withHeaders($headers)
                    ->post($url,$postDataArr);

        if($response->status() == 200) {
            $obj = $response->object()->RekapPasienDirawatTanpaKomorbid;
            if($obj[0]->status == 200) {
                $data = PasienDirawatNonKomorbid::find($request->id);
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
        $model = PasienDirawatNonKomorbid::where('id', $id)->first();

        $headers = config('custom.headers');
        $url = config('custom.url_api_v2').'PasienDirawatTanpaKomorbid';

        $deleteData = array(
            'tanggal' => $model->tanggal
        );

        $response = Http::withHeaders($headers)->delete($url,$deleteData);

        // dd($response->object());
        if($response->status() == 200) {
            // PasienMasuk::where('id', $id)->delete();
            $model = PasienDirawatNonKomorbid::find($id);
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

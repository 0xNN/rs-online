<?php

namespace App\Http\Controllers;

use App\Imports\PasienDirawatKomorbidImport;
use App\Models\PasienDirawatKomorbid;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;

class PasienDirawatKomorbidController extends Controller
{
    public function index(Request $request)
    {
        $headers = config('custom.headers');
        $url = config('custom.url_api_v2').'PasienDirawatKomorbid';
        $response = Http::withHeaders($headers)->get($url);

        $obj = $response->object()->RekapPasienDirawatKomorbid;
        
        foreach($obj as $data) {
            PasienDirawatKomorbid::updateOrCreate([
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
            $model = PasienDirawatKomorbid::orderBy('tanggal','desc');
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
        return view('sinkron.pasien-dirawat-komorbid.index');
    }

    public function create()
    {
        return view('sinkron.pasien-dirawat-komorbid.create');
    }

    public function store()
    {
        try {
            Excel::import(new PasienDirawatKomorbidImport, request()->file('file'));
        } catch(Exception $e) {
            return back()->withError($e->getMessage());
        }

        return redirect()->route('pasien-keluar.index')->withMessage('Upload berhasil!');
    }

    public function show($id)
    {
        $data = PasienDirawatKomorbid::find($id);
        return response()->json($data);
    }
}

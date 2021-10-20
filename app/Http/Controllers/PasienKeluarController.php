<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Imports\PasienKeluarImport;
use App\Models\PasienKeluar;
use Carbon\Carbon;
use Exception;
use Maatwebsite\Excel\Facades\Excel;


class PasienKeluarController extends Controller
{
    public function index(Request $request)
    {
        $headers = config('custom.headers');
        $url = config('custom.url_api_v2').'PasienKeluar';
        $response = Http::withHeaders($headers)->get($url);

        $obj = $response->object()->RekapPasienKeluar;
        
        foreach($obj as $data) {
            PasienKeluar::updateOrCreate([
                'tanggal' => $data->tanggal
            ],[
                'tanggal' => $data->tanggal,
                'sembuh' => $data->sembuh,
                'discarded' => $data->discarded,
                'meninggal_komorbid' => $data->meninggal_komorbid,
                'meninggal_tanpa_komorbid' => $data->meninggal_tanpa_komorbid,
                'meninggal_prob_pre_komorbid' => $data->meninggal_prob_pre_komorbid,
                'meninggal_prob_neo_komorbid' => $data->meninggal_prob_neo_komorbid,
                'meninggal_prob_bayi_komorbid' => $data->meninggal_prob_bayi_komorbid,
                'meninggal_prob_balita_komorbid' => $data->meninggal_prob_balita_komorbid,
                'meninggal_prob_anak_komorbid' => $data->meninggal_prob_anak_komorbid,
                'meninggal_prob_remaja_komorbid' => $data->meninggal_prob_remaja_komorbid,
                'meninggal_prob_dws_komorbid' => $data->meninggal_prob_dws_komorbid,
                'meninggal_prob_lansia_komorbid' => $data->meninggal_prob_lansia_komorbid,
                'meninggal_prob_pre_tanpa_komorbid' => $data->meninggal_prob_pre_tanpa_komorbid,
                'meninggal_prob_neo_tanpa_komorbid' => $data->meninggal_prob_neo_tanpa_komorbid,
                'meninggal_prob_bayi_tanpa_komorbid' => $data->meninggal_prob_bayi_tanpa_komorbid,
                'meninggal_prob_balita_tanpa_komorbid' => $data->meninggal_prob_balita_tanpa_komorbid,
                'meninggal_prob_anak_tanpa_komorbid' => $data->meninggal_prob_anak_tanpa_komorbid,
                'meninggal_prob_remaja_tanpa_komorbid' => $data->meninggal_prob_remaja_tanpa_komorbid,
                'meninggal_prob_dws_tanpa_komorbid' => $data->meninggal_prob_dws_tanpa_komorbid,
                'meninggal_prob_lansia_tanpa_komorbid' => $data->meninggal_prob_lansia_tanpa_komorbid,
                'meninggal_discarded_komorbid' => $data->meninggal_discarded_komorbid,
                'meninggal_discarded_tanpa_komorbid' => $data->meninggal_discarded_tanpa_komorbid,
                'dirujuk' => $data->dirujuk,
                'isman' => $data->isman,
                'aps' => $data->aps,
                'status_sinkron' => 1,
                'tanggal_input' => date('Y-m-d'),
                'tanggal_sinkron' => date('Y-m-d')
            ]);
        }

        if($request->ajax()) {
            $model = PasienKeluar::orderBy('tanggal','desc');
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
        return view('sinkron.pasien-keluar.index');
    }

    public function create()
    {
        return view('sinkron.pasien-keluar.create');
    }

    public function store()
    {
        try {
            Excel::import(new PasienKeluarImport, request()->file('file'));
        } catch(Exception $e) {
            return back()->withError($e->getMessage());
        }

        return redirect()->route('pasien-keluar.index')->withMessage('Upload berhasil!');
    }

    public function show($id)
    {
        $data = PasienKeluar::find($id);
        return response()->json($data);
    }

    public function sinkronisasi(Request $request)
    {
        $headers = config('custom.headers');
        $url = config('custom.url_api_v2').'PasienKeluar';

        $postDataArr = array(
            'tanggal' => $request->tanggal,
            'sembuh' => $request->sembuh,
            'discarded' => $request->discarded,
            'meninggal_komorbid' => $request->meninggal_komorbid,
            'meninggal_tanpa_komorbid' => $request->meninggal_tanpa_komorbid,
            'meninggal_prob_pre_komorbid' => $request->meninggal_prob_pre_komorbid,
            'meninggal_prob_neo_komorbid' => $request->meninggal_prob_neo_komorbid,
            'meninggal_prob_bayi_komorbid' => $request->meninggal_prob_bayi_komorbid,
            'meninggal_prob_balita_komorbid' => $request->meninggal_prob_balita_komorbid,
            'meninggal_prob_anak_komorbid' => $request->meninggal_prob_anak_komorbid,
            'meninggal_prob_remaja_komorbid' => $request->meninggal_prob_remaja_komorbid,
            'meninggal_prob_dws_komorbid' => $request->meninggal_prob_dws_komorbid,
            'meninggal_prob_lansia_komorbid' => $request->meninggal_prob_lansia_komorbid,
            'meninggal_prob_pre_tanpa_komorbid' => $request->meninggal_prob_pre_tanpa_komorbid,
            'meninggal_prob_neo_tanpa_komorbid' => $request->meninggal_prob_neo_tanpa_komorbid,
            'meninggal_prob_bayi_tanpa_komorbid' => $request->meninggal_prob_bayi_tanpa_komorbid,
            'meninggal_prob_balita_tanpa_komorbid' => $request->meninggal_prob_balita_tanpa_komorbid,
            'meninggal_prob_anak_tanpa_komorbid' => $request->meninggal_prob_anak_tanpa_komorbid,
            'meninggal_prob_remaja_tanpa_komorbid' => $request->meninggal_prob_remaja_tanpa_komorbid,
            'meninggal_prob_dws_tanpa_komorbid' => $request->meninggal_prob_dws_tanpa_komorbid,
            'meninggal_prob_lansia_tanpa_komorbid' => $request->meninggal_prob_lansia_tanpa_komorbid,
            'meninggal_discarded_komorbid' => $request->meninggal_discarded_komorbid,
            'meninggal_discarded_tanpa_komorbid' => $request->meninggal_discarded_tanpa_komorbid,
            'dirujuk' => $request->dirujuk,
            'isman' => $request->isman,
            'aps' => $request->aps,
        );
        $response = Http::withHeaders($headers)
                    ->post($url,$postDataArr);

        if($response->status() == 200) {
            $obj = $response->object()->RekapPasienKeluar;
            if($obj[0]->status == 200) {
                $data = PasienKeluar::find($request->id);
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
        $model = PasienKeluar::where('id', $id)->first();

        $headers = config('custom.headers');
        $url = config('custom.url_api_v2').'PasienKeluar';

        $deleteData = array(
            'tanggal' => $model->tanggal
        );

        $response = Http::withHeaders($headers)->delete($url,$deleteData);

        // dd($response->object());
        if($response->status() == 200) {
            // PasienMasuk::where('id', $id)->delete();
            $model = PasienKeluar::find($id);
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

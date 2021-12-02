<?php

namespace App\Http\Controllers;

use App\Models\IgdTriase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Imports\IgdTriaseImport;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Exception;
use Maatwebsite\Excel\Facades\Excel;

class IgdTriaseController extends Controller
{
    public function index(Request $request)
    {
        // $headers = config('custom.headers');
        $now = new DateTime();
        $now->format('Y-m-d H:i:s');
        $headers = [
            'X-rs-id' => '1671347',
            'X-timestamp' => $now->getTimestamp(),
            'X-pass' => '112233',
            'X-tanggal' => date('Y-m-d',(strtotime('-7 day', strtotime(date('Y-m-d')))))
        ];
        $url = config('custom.url_api').'Pasien/igd_triase';
        $response = Http::withHeaders($headers)->get($url);

        $obj = $response->object()->IGDTriase;
        foreach($obj as $data) {
            IgdTriase::updateOrCreate([
                'tanggal' => $data->tanggal
            ],[
                'tanggal' => $data->tanggal,
                'igd_suspek' => $data->igd_suspek,
                'igd_konfirmasi' => $data->igd_konfirmasi,
                'g_ringan_murni_covid' => $data->g_ringan_murni_covid,
                'g_ringan_komorbid' => $data->g_ringan_komorbid,
                'g_ringan_koinsiden' => $data->g_ringan_koinsiden,
                'g_sedang' => $data->g_sedang,
                'g_berat' => $data->g_berat,
                'igd_dirujuk' => $data->igd_dirujuk,
                'status_sinkron' => 1,
                'tanggal_input' => date('Y-m-d'),
                'tanggal_sinkron' => date('Y-m-d')
            ]);
        }

        if($request->ajax()) {
            $model = IgdTriase::orderBy('tanggal','desc')->get();
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
        return view('sinkron.igd-triase.index');
    }

    public function create()
    {
        return view('sinkron.igd-triase.create');
    }

    public function store()
    {
        if(request()->has('proses')) {
            try {
                Excel::import(new IgdTriaseImport, request()->file('file'));
            } catch(Exception $e) {
                return back()->withError($e->getMessage());
            }
            return redirect()->route('igd-triase.index')->withMessage('Upload berhasil!');
        }
        if(request()->has('contoh_format')) {
            if(file_exists(storage_path('FormatIGDTriase.xlsx'))) {
                return response()->download(storage_path('FormatIGDTriase.xlsx'));
            } else {
                return back()->withError('File tidak ditemukan!');
            }
        }
    }

    public function show($id)
    {
        $data = IgdTriase::find($id);
        return response()->json($data);
    }

    public function sinkronisasi(Request $request)
    {
        $headers = config('custom.headers');
        $url = config('custom.url_api').'Pasien/igd_triase';

        $postDataArr = array(
            'tanggal' => $request->tanggal,
            'igd_suspek' => $request->igd_suspek,
            'igd_konfirmasi' => $request->igd_konfirmasi,
            'g_ringan_murni_covid' => $request->g_ringan_murni_covid,
            'g_ringan_komorbid' => $request->g_ringan_komorbid,
            'g_ringan_koinsiden' => $request->g_ringan_koinsiden,
            'g_sedang' => $request->g_sedang,
            'g_berat' => $request->g_berat,
            'igd_dirujuk' => $request->igd_dirujuk
        );

        $response = Http::withHeaders($headers)
                    ->post($url,$postDataArr);

        if($response->status() == 200) {
            $obj = $response->object()->IGDTriase;
            if($obj[0]->status == 200) {
                $data = IgdTriase::find($request->id);
                $data->igd_suspek = $request->igd_suspek;
                $data->igd_konfirmasi = $request->igd_konfirmasi;
                $data->g_ringan_murni_covid = $request->g_ringan_murni_covid;
                $data->g_ringan_komorbid = $request->g_ringan_komorbid;
                $data->g_ringan_koinsiden = $request->g_ringan_koinsiden;
                $data->g_sedang = $request->g_sedang;
                $data->g_berat = $request->g_berat;
                $data->igd_dirujuk = $request->igd_dirujuk;
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
        $model = IgdTriase::where('id', $id)->first();

        // $headers = config('custom.headers');
        $url = config('custom.url_api').'Pasien/igd_triase';

        $now = new DateTime();
        $now->format('Y-m-d H:i:s');

        $headers = [
            'X-rs-id' => '1671347',
            'X-timestamp' => $now->getTimestamp(),
            'X-pass' => '112233',
            'X-tanggal' => '2021-08-01'
        ];

        $deleteData = array(
            'tanggal' => $model->tanggal
        );

        $response = Http::withHeaders($headers)->delete($url,null);

        // dd($response->object());
        if($response->status() == 200) {
            // PasienMasuk::where('id', $id)->delete();
            $model = IgdTriase::find($id);
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
                $url = config('custom.url_api').'Pasien/igd_triase';
                $response = Http::withHeaders($headers)->get($url);
    
                $obj = $response->object()->IGDTriase;
                foreach($obj as $data) {
                    if(isset($data->message)) {
                        continue;
                    }
                    IgdTriase::updateOrCreate([
                        'tanggal' => $data->tanggal
                    ],[
                        'tanggal' => $data->tanggal,
                        'igd_suspek' => $data->igd_suspek,
                        'igd_konfirmasi' => $data->igd_konfirmasi,
                        'g_ringan_murni_covid' => $data->g_ringan_murni_covid,
                        'g_ringan_komorbid' => $data->g_ringan_komorbid,
                        'g_ringan_koinsiden' => $data->g_ringan_koinsiden,
                        'g_sedang' => $data->g_sedang,
                        'g_berat' => $data->g_berat,
                        'igd_dirujuk' => $data->igd_dirujuk,
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

    /**
     * # Contoh 1
     * date_range("2014-01-01", "2014-01-20", "+1 day", "m/d/Y");
     * # Contoh 2
     * date_range("01:00:00", "23:00:00", "+1 hour", "H:i:s");
     */
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

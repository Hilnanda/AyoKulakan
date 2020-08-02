<?php

namespace App\Http\Controllers\API\Master;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;


use App\Models\User;
use App\Models\Master\WilayahNegara;
use App\Models\Master\WilayahProvinsi;
use App\Models\Master\WilayahKota;
use App\Models\Master\WilayahKecamatan;


class WilayahController extends Controller
{
    public function index(Request $request)
    {
        $data = new QueryBuilder(new WilayahNegara, $request);
        $data = $data->build()->get();
        // $data = collect($data);
        // $data->map(function ($item) {
        //     $item['type'] = $item->statusLabel();
        // });

        return response()->json([
            'status' => true,
            'data' => $data,
            'total' => $data->count()
        ]);
    }

    public function provinsi(Request $request)
    {
        $data = new QueryBuilder(new WilayahProvinsi, $request);
        $data = $data->build()->get();
        // $data = collect($data);
        // $data->map(function ($item) {
        //     $item['type'] = $item->statusLabel();
        // });

        return response()->json([
            'status' => true,
            'data' => $data,
            'total' => $data->count()
        ]);
    }

     public function kota(Request $request)
    {
        $data = new QueryBuilder(new WilayahKota, $request);
        $data = $data->build()->get();
        // $data = collect($data);
        // $data->map(function ($item) {
        //     $item['type'] = $item->statusLabel();
        // });

        return response()->json([
            'status' => true,
            'data' => $data,
            'total' => $data->count()
        ]);
    }

     public function kecamatan(Request $request)
    {
        $data = new QueryBuilder(new WilayahKecamatan, $request);
        $data = $data->build()->get();
        // $data = collect($data);
        // $data->map(function ($item) {
        //     $item['type'] = $item->statusLabel();
        // });

        return response()->json([
            'status' => true,
            'data' => $data,
            'total' => $data->count()
        ]);
    }

    // SHOW

    public function showNegara($id)
    {
        if($id){
            $data = WilayahNegara::with('creator')->find($id);
                if($data == true){
                    return $this->messageApiJsonObject('true',$data);
                }else{
                    return $this->messageApiJsonObject();
                }
        }else{
            return response()->json([
                  'status' => false,
                  'message' => 'Data Tidak Ditemukan'
            ]);
        }
    }

    public function showProvinsi($id)
    {
        if($id){
            $data = WilayahProvinsi::with('negara','creator')->find($id);
                if($data == true){
                    return $this->messageApiJsonObject('true',$data);
                }else{
                    return $this->messageApiJsonObject();
                }
        }else{
            return response()->json([
                  'status' => false,
                  'message' => 'Data Tidak Ditemukan'
            ]);
        }
    }

    public function showKota($id)
    {
        if($id){
            $data = WilayahKota::with('negara','provinsi','creator')->find($id);
                if($data == true){
                    return $this->messageApiJsonObject('true',$data);
                }else{
                    return $this->messageApiJsonObject();
                }
        }else{
            return response()->json([
                  'status' => false,
                  'message' => 'Data Tidak Ditemukan'
            ]);
        }
    }

    public function showKecamatan($id)
    {
        if($id){
            $data = WilayahKecamatan::with('negara','provinsi','kota','creator')->find($id);
                if($data == true){
                    return $this->messageApiJsonObject('true',$data);
                }else{
                    return $this->messageApiJsonObject();
                }
        }else{
            return response()->json([
                  'status' => false,
                  'message' => 'Data Tidak Ditemukan'
            ]);
        }
    }

     public function currentKota(Request $request)
    {
        $data = WilayahKota::where('kota','like', '%'.$request->kota.'%')->get();
        // $data = collect($data);
        // $data->map(function ($item) {
        //     $item['type'] = $item->statusLabel();
        // });

        return response()->json([
            'status' => true,
            'data' => $data,
            'total' => $data->count()
        ]);
    }
}

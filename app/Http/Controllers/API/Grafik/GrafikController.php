<?php

namespace App\Http\Controllers\API\Grafik;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;

use App\Models\Users;
use App\Models\TransaksiAmpas\TransaksiAmpaseBarangDetail;

use App\Models\Barang\LapakBarang;
use App\Models\Rental\Rental;

class GrafikController extends Controller
{
    public function index(Request $request)
    {
        if(isset($request->date_first) || isset($request->date_second)){
          $data = Users::whereBetween('created_at',[$request->date_first,$request->date_second])->get();        
        }else{
          $data = Users::get();        
        }

        return response()->json([
            'status' => true,
            'total' => $data->count(),
            'data' => $data,
        ]);
    }


    public function kurir(Request $request)
    {
        if(isset($request->date_first) || isset($request->date_second)){
          $data = Users::has('kurir')->whereBetween('created_at',[$request->date_first,$request->date_second])->get();        
        }else{
          $data = Users::has('kurir')->get();        
        }

        return response()->json([
            'status' => true,
            'total' => $data->count(),
            'data' => $data,
        ]);
    }

    public function rental(Request $request)
    {
        if(isset($request->date_first) || isset($request->date_second)){
          $data = Users::has('rental')->whereBetween('created_at',[$request->date_first,$request->date_second])->get();        
        }else{
          $data = Users::has('rental')->get();        
        }

        return response()->json([
            'status' => true,
            'total' => $data->count(),
            'data' => $data,
        ]);
    }

    public function kakilima(Request $request)
    {
        if(isset($request->date_first) || isset($request->date_second)){
          $data = Users::has('kakilima')->whereBetween('created_at',[$request->date_first,$request->date_second])->get();        
        }else{
          $data = Users::has('kakilima')->get();        
        }

        return response()->json([
            'status' => true,
            'total' => $data->count(),
            'data' => $data,
        ]);
    }

    public function barang(Request $request)
    {
        if(isset($request->date_first) || isset($request->date_second)){
          $data = LapakBarang::whereBetween('created_at',[$request->date_first,$request->date_second])->get();        
        }else{
          $data = LapakBarang::get();        
        }

        return response()->json([
            'status' => true,
            'total' => $data->count(),
            'data' => $data,
        ]);
    }

    public function sewa(Request $request)
    {
        if(isset($request->date_first) || isset($request->date_second)){
          $data = Rental::whereBetween('created_at',[$request->date_first,$request->date_second])->get();        
        }else{
          $data = Rental::get();        
        }

        return response()->json([
            'status' => true,
            'total' => $data->count(),
            'data' => $data,
        ]);
    }
}

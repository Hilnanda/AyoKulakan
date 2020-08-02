<?php

namespace App\Http\Controllers\API\Grafik;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;

use App\Models\Users;
use App\Models\TransaksiAmpas\TransaksiAmpaseBarangDetail;
use App\Models\TransaksiAmpas\TransaksiAmpaseKereta;
use App\Models\HajiUmroh\HajiAngsuran;


class GrafikDataPenjualanController extends Controller
{
    public function index(Request $request)
    {
        if(isset($request->date_first) || isset($request->date_second)){
          $data = TransaksiAmpaseBarangDetail::where('form_type','img_barang')->whereBetween('created_at',[$request->date_first,$request->date_second])->get();        
        }else{
          $data = TransaksiAmpaseBarangDetail::where('form_type','img_barang')->get();        
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
          $data = TransaksiAmpaseBarangDetail::where('form_type','img_rental')->whereBetween('created_at',[$request->date_first,$request->date_second])->get();        
        }else{
          $data = TransaksiAmpaseBarangDetail::where('form_type','img_rental')->get();        
        }

        return response()->json([
            'status' => true,
            'total' => $data->count(),
            'data' => $data,
        ]);
    }

    public function haji(Request $request)
    {
        if(isset($request->date_first) || isset($request->date_second)){
          $data = HajiAngsuran::whereBetween('created_at',[$request->date_first,$request->date_second])->get();        
        }else{
          $data = HajiAngsuran::get();        
        }

        return response()->json([
            'status' => true,
            'total' => $data->count(),
            'data' => $data,
        ]);
    }

    public function ppob(Request $request)
    {
        if(isset($request->date_first) || isset($request->date_second)){
          $data = TransaksiAmpaseBarangDetail::whereNotIn('form_type',['img_rental','img_barang'])->whereBetween('created_at',[$request->date_first,$request->date_second])->get();        
        }else{
          $data = TransaksiAmpaseBarangDetail::whereNotIn('form_type',['img_rental','img_barang'])->get();        
        }

        return response()->json([
            'status' => true,
            'total' => $data->count(),
            'data' => $data,
        ]);
    }

    public function kereta(Request $request)
    {
        if(isset($request->date_first) || isset($request->date_second)){
          $data = TransaksiAmpaseKereta::whereBetween('created_at',[$request->date_first,$request->date_second])->get();        
        }else{
          $data = TransaksiAmpaseKereta::get();        
        }

        return response()->json([
            'status' => true,
            'total' => $data->count(),
            'data' => $data,
        ]);
    }


}

<?php

namespace App\Http\Controllers\API\HajiUmroh;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Unlu\Laravel\Api\QueryBuilder;


use App\Models\User;
use App\Models\Roles;
use App\Models\HajiUmroh\HajiAngsuran;
use App\Models\HajiUmroh\HajiPaket;
use App\Http\Requests\HajiUmroh\HajiAngsuranRequest;

use DataTables;
use Zipper;
use Carbon\Carbon;

class HajiAngsuranController extends Controller
{
  public function index(Request $request)
  {
    $data = new QueryBuilder(new HajiAngsuran, $request);
       $data = $data->build()->get();
        return response()->json([
            'status' => true,
            'data' => $data,
            'total' => $data->count()
        ]);
  }

  public function show($id)
  {
      if($id){
          $data = HajiAngsuran::with('creator')->find($id);
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
  public function store(Request $request)
  {
    try {
        $data = HajiAngsuran::saveData($request);
        $data->created_by = $request->created_by;
        $data->save();
    }catch (\Exception $e) {
      return response([
        'status' => 'error',
        'message' => $e,
      ], 500);
    }

    return response([
      'status' => true,
      'message' => 'Data Sukses Di Buat'
    ]);
  }

  public function update(Request $request, $id)
  {

    if(!isset($request->created_by)){
        return response()->json([
              'status' => false,
              'message' => 'Masukan Id User Pembuat'
        ]);
    }

    if(!isset($id)){
        return response()->json([
              'status' => false,
              'message' => 'Masukan Id Untuk Mengupdate'
        ]);
    }

    $request['id'] = $id;
    try {
      $data = HajiAngsuran::saveData($request);
    }catch (\Exception $e) {
      return response([
        'status' => 'error',
        'message' => $e,
      ], 500);
    }

    return response([
      'status' => true,
      'message' => 'Data Sukses Di Update'
    ]);
  }


  public function destroy(Request $request, $id)
  {
     if(!isset($id)){
        return response()->json([
              'status' => false,
              'message' => 'Masukan Id Data Untuk Menghapus'
        ]);
    }

    try {
       $hapus = HajiAngsuran::destroy($id);
       if($hapus == true){
        return response([
          'status' => true,
          'message' => 'Data Sukses Di Hapus'
        ]);
       }else{
        return response()->json([
              'status' => false,
              'message' => 'Gagal Menghapus, Id Tidak Ditemukan'
        ]);
       }
    }catch (\Exception $e) {
      return response([
        'status' => 'error',
        'message' => $e,
      ], 500);
    }
    
  }
}

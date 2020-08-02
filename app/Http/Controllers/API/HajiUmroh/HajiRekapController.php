<?php

namespace App\Http\Controllers\API\HajiUmroh;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Unlu\Laravel\Api\QueryBuilder;


use App\Models\User;
use App\Models\Roles;
use App\Models\HajiUmroh\HajiRekap;
use App\Models\HajiUmroh\HajiPaket;
use App\Http\Requests\HajiUmroh\HajiRekapRequest;

use DataTables;
use Zipper;
use Carbon\Carbon;

class HajiRekapController extends Controller
{
  public function index(Request $request)
  {
    $data = new QueryBuilder(new HajiRekap, $request);
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
          $data = HajiRekap::with('creator')->find($id);
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
    $this->validate($request, [
        'attachment.*' => 'required',
        'attachment.*'=>'max:500',
    ],[
      'attachment.*.max' => 'Gambar tidak boleh lebih dari 500 Kilobyte',
    ]);
    try {
        $data = HajiRekap::saveData($request);
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

    $c = $request->path;
    try {
      // if($request->file){
      //     $path = $request->file->store('uploads/gallery', 'public');
      //     $request->path = $path;
      // }
      $data = HajiRekap::saveData($request);
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
       $hapus = HajiRekap::destroy($id);
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

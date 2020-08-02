<?php

namespace App\Http\Controllers\API\HajiUmroh;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Roles;
use App\Models\HajiUmroh\BeritaTerbaru;
use App\Http\Requests\HajiUmroh\BeritaTerbaruRequest;

use DataTables;
use Zipper;
use Carbon\Carbon;

class BeritaTerbaruController extends Controller
{

  public function index(Request $request)
  {

   $data = new QueryBuilder(new BeritaTerbaru, $request);
   $data = $data->build()->get();
   $data = $this->paginate($data);
    return response()->json([
        'status' => true,
        'total' => $data->count(),
        'data' => $data,
    ]);
  }

  public function show($id)
  {
      if($id){
          $data = BeritaTerbaru::with('creator','attachments')->find($id);
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
        $data = BeritaTerbaru::saveData($request);
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
      $data = BeritaTerbaru::saveData($request);
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
       $hapus = BeritaTerbaru::destroy($id);
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

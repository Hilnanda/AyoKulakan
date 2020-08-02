<?php

namespace App\Http\Controllers\API\Barang;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Lapak\Lapak;
use App\Models\Barang\LapakBarang;
use App\Models\Barang\FavoritBarang;


class FavoritBarangController extends Controller
{
    public function index(Request $request)
    {
        $data = new QueryBuilder(new FavoritBarang, $request);
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

    public function show($id)
    {
        if($id){
            $data = FavoritBarang::with('form','creator','form.attachments')->find($id);
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
        if(!isset($request->created_by)){
            return response()->json([
                  'status' => false,
                  'message' => 'Masukan Id User'
            ]);
        }

        if(!isset($request->id_barang)){
            return response()->json([
                  'status' => false,
                  'message' => 'Masukan Id Barang'
            ]);
        }

        try {
            $record = FavoritBarang::where('user_id',$request->created_by)->where('id_barang',$request->id_barang)->first();
            if($record){
              $record->jumlah_barang = $record->jumlah_barang + $request->jumlah_barang;
              $record->save();
            }else{
              $data = FavoritBarang::saveData($request);
            }
        }catch (\Exception $e) {
          return response([
            'status' => 'error',
            'message' => $e,
          ], 500);
        }

        return response([
          'status' => true,
          'message' => 'Sukses'
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
                  'message' => 'Masukan Id Cart Barang Untuk Mengupdate'
            ]);
        }

      
        $request['id'] = $id;

        try {
            $data = FavoritBarang::saveData($request);
        }catch (\Exception $e) {
          return response([
            'status' => 'error',
            'message' => $e,
          ], 500);
        }

          return response([
            'status' => true,
            'message' => 'Data Favorit / Cart Barang Sukses Di Update'
          ]);
      }

    public function destroys($id)
      {
        if(!isset($id)){
            return response()->json([
                  'status' => false,
                  'message' => 'Masukan Id Data Favorit / Cart Barang Untuk Menghapus'
            ]);
        }

        try {
           $hapus = FavoritBarang::destroy($id);
           if($hapus == true){
            return response([
              'status' => true,
              'message' => 'Barang Sukses Di Hapus'
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

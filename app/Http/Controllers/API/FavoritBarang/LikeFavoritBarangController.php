<?php

namespace App\Http\Controllers\API\FavoritBarang;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;


use App\Models\User;
use App\Models\Berita\Berita;
use App\Models\Barang\LapakBarang;
use App\Models\Favorit\LikeFavoritBarang;


class LikeFavoritBarangController extends Controller
{
    public function index(Request $request)
    {
        $data = new QueryBuilder(new LikeFavoritBarang, $request);
        $data = $data->build()->get();     
        return response()->json([
            'status' => true,
            'data' => $data,
            'total' => $data->count()
        ]);
    }

    public function store(Request $request)
      {
            $record = LapakBarang::find($request->id_barang);
            $cek = LikeFavoritBarang::where('user_id',$request->user_id)->where('id_barang',$record->id)->first();

            if(!isset($cek)){
                $save = new LikeFavoritBarang;
                $saveRecord['user_id'] = $request->user_id;
                $saveRecord['id_barang'] = $record->id;
                $saveRecord['form_id'] = $record->id;
                $saveRecord['form_type'] = 'img_barang';
                $save->fill($saveRecord);
                $save->save();
                return response([
                  'status' => true,
                  'message' => 'Sukses Di Buat'
                ]);
            }
      }

    public function show($id){
        if($id){
            $data = LikeFavoritBarang::with('form')->find($id);
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

    public function destroy($id)
      {
        if(!isset($id)){
            return response()->json([
                  'status' => false,
                  'message' => 'Masukan Id Untuk Menghapus'
            ]);
        }

        try {
           $hapus = LikeFavoritBarang::destroy($id);
           if($hapus == true){
            return response([
              'status' => true,
              'message' => ' Sukses Di Hapus'
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

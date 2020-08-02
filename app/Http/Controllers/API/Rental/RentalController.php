<?php

namespace App\Http\Controllers\API\Rental;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Rental\Rental;
use App\Http\Requests\APIRequest\RentalRequest;


class RentalController extends Controller
{
    public function index(Request $request)
    {
        $data = new QueryBuilder(new Rental, $request);
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
            $data = Rental::with('kategori','sub_kategori','user','attachments')->find($id);
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

    public function store(RentalRequest $request)
      {
        if(!isset($request->created_by)){
            return response()->json([
                  'status' => false,
                  'message' => 'Masukan Id User Pembuat'
            ]);
        }

        try {
            $harga_sewa = str_replace(".", "", $request->harga_sewa);
            $request['harga_sewa'] = $harga_sewa;
            $data = Rental::saveData($request);
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
          'message' => 'Rental Sukses Di Buat'
        ]);
      }

    public function update(RentalRequest $request, $id)
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
                  'message' => 'Masukan Id Rental Untuk Mengupdate'
            ]);
        }

        $request['id'] = $id;
        try {
            $data = Rental::saveData($request);
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
          'message' => 'Rental Sukses Di Update'
        ]);
      }

    public function destroys($id)
      {
        if(!isset($id)){
            return response()->json([
                  'status' => false,
                  'message' => 'Masukan Id Rental Untuk Menghapus'
            ]);
        }

        try {
           $hapus = Rental::destroy($id);
           if($hapus == true){
            return response([
              'status' => true,
              'message' => 'Rental Sukses Di Hapus'
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

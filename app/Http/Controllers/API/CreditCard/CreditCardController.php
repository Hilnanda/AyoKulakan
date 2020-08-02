<?php

namespace App\Http\Controllers\API\CreditCard;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\CreditCard\CreditCard;


class CreditCardController extends Controller
{
    public function index(Request $request)
    {
        // $record = LapakBarang::with('attachments','kategoriBarang','subKategoriBarang','childKategoriBarang');
        $data = new QueryBuilder(new CreditCard, $request);
        
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
            $data = CreditCard::with('creator')->find($id);
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
                  'message' => 'Masukan Id User Pembuat'
            ]);
        }

            try {
                $data = CreditCard::saveData($request);
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
            $data = CreditCard::saveData($request);
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

    public function destroys($id)
      {
        if(!isset($id)){
            return response()->json([
                  'status' => false,
                  'message' => 'Masukan Id Data Untuk Menghapus'
            ]);
        }

        try {
           $hapus = CreditCard::destroy($id);
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

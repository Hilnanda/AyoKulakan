<?php

namespace App\Http\Controllers\API\Lapak;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Lapak\Lapak;

use App\Http\Requests\APIRequest\LapakRequest;

class LapakController extends Controller
{
     public function index(Request $request)
    {
        $data = new QueryBuilder(new Lapak, $request);

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
            $data = Lapak::with('attachments','negara','provinsi','kota','kecamatan')->find($id);
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

    public function store(LapakRequest $request)
      {
        if(!isset($request->created_by)){
            return response()->json([
                  'status' => false,
                  'message' => 'Masukan Id User Pembuat'
            ]);
        }
        $cekLapaks = Lapak::where('created_by',$request->created_by)->first();
        if($cekLapaks == true){
            return response([
              'status' => false,
              'message' => 'Anda Sudah Mempunyai Lapak Silahkan Perbaharui Lapak Anda'
            ]);
        }else{
            try {
                $data = Lapak::saveData($request);
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
              'message' => 'Lapak Sukses Di Buat'
            ]);
        }

      }

    public function update(LapakRequest $request, $id){
      // dd($request->all());
        if(!isset($request->created_by)){
            return response()->json([
                  'status' => false,
                  'message' => 'Masukan Id User Pembuat'
            ]);
        }

        if(!isset($id)){
            return response()->json([
                  'status' => false,
                  'message' => 'Masukan Id Lapak Untuk Mengupdate'
            ]);
        }
        $request['id'] = $id;
        try {
            $data = Lapak::saveData($request);
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
          'message' => 'Lapak Sukses Di Update'
        ]);
      }

    public function destroy($id)
      {
        // dd($id);
        if(!isset($id)){
            return response()->json([
                  'status' => false,
                  'message' => 'Masukan Id Lapak Untuk Menghapus'
            ]);
        }

        try {
           $hapus = Lapak::destroy($id);
           if($hapus == true){
            return response([
              'status' => true,
              'message' => 'Lapak Sukses Di Hapus'
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

<?php

namespace App\Http\Controllers\API\Barang;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Lapak\Lapak;
use App\Models\Barang\LapakBarang;
use App\Http\Requests\APIRequest\BarangRequest;


class BarangController extends Controller
{
    public function index(Request $request)
    {
        // $data = [];
        // $id_kota = [];
        // if(isset($request->id_kota)){
        //   $id_kota = $request->id_kota;
        //   unset($request['id_kota']);
        //   // $request = $this->array_slice_keys( $request->all(), array('id_kota') );
        // }
        // dd($request->all());
        // $record = LapakBarang::with('attachments','kategoriBarang','subKategoriBarang','childKategoriBarang');
        $data = new QueryBuilder(new LapakBarang, $request);
        $data = $data->build()->get();
        // $data = collect($data);
        // $data->map(function ($item) {
        //     $item['type'] = $item->statusLabel();
        // });
        // if($id_kota){
        //   if($data->count() > 0){
        //     foreach ($data as $k => $value) {
        //       if($value->lapak->id_kota == $id_kota){
        //         $data[$k][] = $value; 
        //       }
        //     }
        //   }
        // }
        // dd($data);
        return response()->json([
            'status' => true,
            'data' => $data,
            'total' => $data->count()
        ]);
    }

    public function show($id)
    {
        if($id){
            $data = LapakBarang::with('attachments','kategoriBarang','subKategoriBarang','childKategoriBarang')->find($id);
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

    public function showCurrentLocation($id)
    {
        if($id){
            $data = LapakBarang::with('attachments','kategoriBarang','subKategoriBarang','childKategoriBarang')->whereHas('lapak',function($q) use($id){
                $q->where('id_kota',$id);
            })->get();
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

    public function store(BarangRequest $request)
      {
        if(!isset($request->created_by)){
            return response()->json([
                  'status' => false,
                  'message' => 'Masukan Id User Pembuat'
            ]);
        }

        if(!isset($request->id_lapak)){
            return response()->json([
                  'status' => false,
                  'message' => 'Masukan Id Lapak Anda'
            ]);
        }

        $cekLapaks = Lapak::where('created_by',$request->created_by)->where('id',$request->id_lapak)->first();
        if($cekLapaks != true){
            return response([
              'status' => false,
              'message' => 'Anda Belum Mempunyai Lapak Silahkan Atur Lapak Anda Terlebih Dahulu'
            ]);
        }else{
            try {
                $data = LapakBarang::saveData($request);
                $data->created_by = $request->created_by;
                $data->id_trans_lapak = $request->id_lapak;
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

    public function update(BarangRequest $request, $id)
      {

        if($request->attachment){
          if(is_file($request->attachment[0])){
            foreach ($request->attachment as $value) {
              if(checkMime($value->getClientOriginalExtension()) == false){
                return response([
                  'status' => false,
                  'message' => 'Img extension harus berupa Jpg, jpeg, png, tiff'
                ],412);
              }else if($value->getSize() > 5000){
                return response([
                  'status' => false,
                  'message' => 'Ukuran Img Terlalu Besar'
                ],412);
              }
            }
          }
        }
        if(!isset($request->created_by)){
            return response()->json([
                  'status' => false,
                  'message' => 'Masukan Id User Pembuat'
            ]);
        }

        if(!isset($id)){
            return response()->json([
                  'status' => false,
                  'message' => 'Masukan Id Barang Untuk Mengupdate'
            ]);
        }

        if(!isset($request->id_lapak)){
            return response()->json([
                  'status' => false,
                  'message' => 'Masukan Id Lapak Anda'
            ]);
        }
        $request['id'] = $id;

        $cekLapaks = Lapak::where('created_by',$request->created_by)->where('id',$request->id_lapak)->first();
        if($cekLapaks != true){
            return response([
              'status' => false,
              'message' => 'Anda Belum Mempunyai Lapak Silahkan Atur Lapak Anda Terlebih Dahulu'
            ]);
        }else{
          try {
              $data = LapakBarang::saveData($request);
              $data->created_by = $request->created_by;
              $data->id_trans_lapak = $request->id_lapak;
              $data->save();
          }catch (\Exception $e) {
            return response([
              'status' => 'error',
              'message' => $e,
            ], 500);
          }

          return response([
            'status' => true,
            'message' => 'Barang Sukses Di Update'
          ]);
        }
      }

    public function destroys($id)
      {
        if(!isset($id)){
            return response()->json([
                  'status' => false,
                  'message' => 'Masukan Id Barang Untuk Menghapus'
            ]);
        }

        try {
           $hapus = LapakBarang::destroy($id);
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

<?php

namespace App\Http\Controllers\API\KakiLima;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\KakiLima\KakiLima;


class KakiLimaController extends Controller
{
    public function index(Request $request)
    {
        $data = new QueryBuilder(new KakiLima, $request);
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
            $data = KakiLima::with('user','attachments')->find($id);
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
            $data = KakiLima::saveData($request);
            $data->created_by = $request->user_id;
            $data->save();
            $this->sendMailGlobal(
              isset($data->creator->email) ? $data->creator->email : '',
              $data,
              'Selamat anda telah terdaftar sebagai kaki lima ayokulakan',
              'Hai kepada saudara '.isset($data->creator->nama) ? $data->creator->nama : ''.' selamat bergabung, silahkan baca & taati, kebijakan & aturan dari ayokulakan',
              'https://ayokulakan.com/kaki-lima',
              'Kebijakan Privasi',
              'mails.global-mail'
            );
        }catch (\Exception $e) {
          return response([
            'status' => 'error',
            'message' => $e,
          ], 500);
        }

        return response([
          'status' => true,
          'message' => 'KakiLima Sukses Di Update'
        ]);
      }

    public function update(Request $request, $id)
      {

        if(!isset($id)){
            return response()->json([
                  'status' => false,
                  'message' => 'Masukan Id KakiLima Untuk Mengupdate'
            ]);
        }

        $request['id'] = $id;
        try {
            $data = KakiLima::saveData($request);
            $data->created_by = $request->user_id;
            $data->save();
        }catch (\Exception $e) {
          return response([
            'status' => 'error',
            'message' => $e,
          ], 500);
        }

        return response([
          'status' => true,
          'message' => 'KakiLima Sukses Di Update'
        ]);
      }

    public function destroys($id)
      {
        if(!isset($id)){
            return response()->json([
                  'status' => false,
                  'message' => 'Masukan Id KakiLima Untuk Menghapus'
            ]);
        }

        try {
           $hapus = KakiLima::destroy($id);
           if($hapus == true){
            return response([
              'status' => true,
              'message' => 'KakiLima Sukses Di Hapus'
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

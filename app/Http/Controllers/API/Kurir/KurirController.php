<?php

namespace App\Http\Controllers\API\Kurir;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Kurir\Kurir;
use App\Http\Requests\APIRequest\KurirRequest;
use Validator;
class KurirController extends Controller
{ 
    public function index(Request $request)
    {
        $data = new QueryBuilder(new Kurir, $request);
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
            $data = Kurir::with('user','attachments')->find($id);
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

    public function store(KurirRequest $request)
      {
        if(!isset($request->user_id)){
            return response()->json([
                  'status' => false,
                  'message' => 'Masukan Id User Pembuat'
            ]);
        }

        try {
            $request['user_id'] = $request->user_id;
            $data = Kurir::saveData($request);
            $data->created_by = $request->user_id;
            $data->fotoSim = ($request->file('fotoSim')) ? $request->file('fotoSim')->store($data->filesMorphClass(), 'public') : '';
            $data->fotoKtp = ($request->file('fotoKtp')) ? $request->file('fotoKtp')->store($data->filesMorphClass(), 'public') : '';
            $data->swafoto = ($request->file('swafoto')) ? $request->file('swafoto')->store($data->filesMorphClass(), 'public') : '';
            $data->fotocopyKK = ($request->file('fotocopyKK')) ? $request->file('fotocopyKK')->store($data->filesMorphClass(), 'public') : '';
            $data->save();

            $this->sendMailGlobal(
              isset($data->creator->email) ? $data->creator->email : '',
              $data,
              'Selamat anda telah terdaftar sebagai kurir ayokulakan',
              'Hai kepada saudara '.isset($data->creator->nama) ? $data->creator->nama : ''.' selamat bergabung, silahkan baca & taati, kebijakan & aturan dari ayokulakan',
              'https://ayokulakan.com/fitur/kurir/panduan-kurir',
              'Kebijakan Privasi',
              'mails.global-mail'
            );
        }catch (\Exception $e) {
          return response([
            'status' => 'error',
            'message' => $e->getMessage(),
          ], 500);
        }

        return response([
          'status' => true,
          'message' => 'Kurir Sukses Di Buat'
        ]);
      }

    public function update(KurirRequest $request, $id)
      {
        dd($request->all());
        if(!isset($request->user_id)){
            return response()->json([
                  'status' => false,
                  'message' => 'Masukan Id User Pembuat'
            ]);
        }

        if(!isset($id)){
            return response()->json([
                  'status' => false,
                  'message' => 'Masukan Id Kurir Untuk Mengupdate'
            ]);
        }

        try {
            $request['id'] = $id;

            $request['user_id'] = $request->user_id;
            $request['fotoSim'] = ($request->file('fotoSim')) ? $request->file('fotoSim')->store('img_kurir', 'public') : '';
            $request['fotoKtp'] = ($request->file('fotoKtp')) ? $request->file('fotoKtp')->store('img_kurir', 'public') : '';
            $request['swafoto'] = ($request->file('swafoto')) ? $request->file('swafoto')->store('img_kurir', 'public') : '';
            $request['fotocopyKK'] = ($request->file('fotocopyKK')) ? $request->file('fotocopyKK')->store('img_kurir', 'public') : '';

            $data = Kurir::saveData($request);
            $data->created_by = $request->user_id;
            $data->save();
        }catch (\Exception $e) {
          return response([
            'status' => 'error',
            'message' => $e->getMessage(),
          ], 500);
        }

        return response([
          'status' => true,
          'message' => 'Kurir Sukses Di Update'
        ]);
      }

    public function destroys($id)
      {
        if(!isset($id)){
            return response()->json([
                  'status' => false,
                  'message' => 'Masukan Id Kurir Untuk Menghapus'
            ]);
        }

        try {
           $hapus = Kurir::destroy($id);
           if($hapus == true){
            return response([
              'status' => true,
              'message' => 'Kurir Sukses Di Hapus'
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

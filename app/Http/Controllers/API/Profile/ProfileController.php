<?php

namespace App\Http\Controllers\API\Profile;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;


use App\Models\Users;
use App\Models\Master\AplikasiTentang;
use App\Models\Master\AplikasiPanduan;
use App\Models\Master\AplikasiSosial;
use App\Http\Requests\APIRequest\ProfileRequest;


class ProfileController extends Controller
{
    public function show($id)
    {
        if($id){
            $data = Users::with('creator','pictureusers','negara','provinsi','kota','kecamatan','lapak')->find($id);
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


    public function update(ProfileRequest $request, $id)
      {
        try {
            $request['id'] = $id;
            if(isset($request->password)){
                 $cekPass = bcrypt($request->password);
                $request['password'] = $cekPass;
            }
            $data = Users::saveData($request);
            // $data->created_by = $id;
            // $data->save();
        }catch (\Exception $e) {
          return response([
            'status' => 'error',
            'message' => $e,
          ], 500);
        }

        return response([
          'status' => true,
          'message' => 'Data Sukses Di Ubah'
        ]);
      }
}

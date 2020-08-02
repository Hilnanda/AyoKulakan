<?php

namespace App\Http\Controllers\API\PPOB;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Master\PPOBPdam;


class PPOBPdamController extends Controller
{
    public function index(Request $request)
    {
        $data = new QueryBuilder(new PPOBPdam, $request);
        $data = $data->build()->get();     
        return response()->json([
            'status' => true,
            'total' => $data->count(),
            'data' => $data,
        ]);
    }

    public function show($id)
    {
        if($id){
            $data = PPOBPdam::find($id);
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

}

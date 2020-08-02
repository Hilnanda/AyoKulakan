<?php

namespace App\Http\Controllers\API\Berita;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;


use App\Models\User;
use App\Models\Berita\Berita;


class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $data = new QueryBuilder(new Berita, $request);
        $data = $data->build()->get();     
        return response()->json([
            'status' => true,
            'data' => $data,
            'total' => $data->count()
        ]);
    }

    public function show($id){
        if($id){
            $data = Berita::with('attachments')->find($id);
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

<?php

namespace App\Http\Controllers\API\Master;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;


use App\Models\User;
use App\Models\Master\TicketingPelni;
use App\Models\Master\AplikasiPanduan;
use App\Models\Master\AplikasiSosial;


class PelniController extends Controller
{
    public function index(Request $request)
    {
        $data = new QueryBuilder(new TicketingPelni, $request);
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
            $data = TicketingPelni::find($id);
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

<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\WilayahNegara;
use App\Models\Master\WilayahProvinsi;

class WilayahController extends Controller
{
    protected function showResponse($data)
    {
        return response()->json([
            'took' => round(microtime(true) - LARAVEL_START, 2),
            'status' => true,
            'message' => 'Success',
            'total' => $data->count(),
            'data' => $data
        ]);
    }

    public function getCountry()
    {
        $data = WilayahNegara::get();
        return $this->showResponse($data);
    }

    public function getProvince($id)
    {
        $data = WilayahProvinsi::where('id_negara', $id)->get();
        return $this->showResponse($data);
    }
}

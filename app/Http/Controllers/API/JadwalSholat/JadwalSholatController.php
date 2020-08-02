<?php

namespace App\Http\Controllers\API\JadwalSholat;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;


use App\Models\User;



class JadwalSholatController extends Controller
{
    public function index(Request $request)
    {

        $url = "https://muslimsalat.com/indonesia/daily.json?key=950dab1938575ff94c7bcd66f702a14a";

        $ch  = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $data = curl_exec($ch);
        curl_close($ch);

        // return $data;

        return response()->json([
            'status' => true,
            'data' => json_decode($data),
        ]);

    }
    
}

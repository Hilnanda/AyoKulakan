<?php

namespace App\Http\Controllers\API\Location;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;
use App\Models\User;


class LocationController extends Controller
{
    public function index(Request $request)
    {
        $url = "https://api.opencagedata.com/geocode/v1/json?q=".$request->lat.",".$request->lng."&key=1c7f8d08012f4247b671f66d27acb0ac&language=id";
        // dd($url);
        $ch  = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        // curl_setopt($ch, CURLOPT_USERAGENT, "twh:[33315199];[Ayokulakans];");
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_FAILONERROR, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $data = curl_exec($ch);
        curl_close($ch);
        // dd($data);
        // return $data;

        return response()->json([
            'status' => true,
            'data' => json_decode($data),
        ]);
    }

    public function state(Request $request)
    {
        $url = "https://api.opencagedata.com/geocode/v1/json?q=".$request->state."&key=1c7f8d08012f4247b671f66d27acb0ac&language=id";
        // dd($url);
        $ch  = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        // curl_setopt($ch, CURLOPT_USERAGENT, "twh:[33315199];[Ayokulakans];");
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_FAILONERROR, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $data = curl_exec($ch);
        curl_close($ch);
        // dd($data);
        // return $data;

        return response()->json([
            'status' => true,
            'data' => json_decode($data),
        ]);
    }
}

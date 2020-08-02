<?php

namespace App\Http\Controllers\API\MobilPulsa;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;

use App\Models\User;


class MobilPulsaController extends Controller
{
    public function callback(Request $request)
    {
        $file = fopen("testMobilPulsa.txt","w");
        fwrite($file,json_encode($request->all()));
        fclose($file);
    }
}

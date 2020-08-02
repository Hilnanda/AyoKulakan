<?php

namespace App\Http\Controllers\API\XampleMail;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\XampleMail;
use URL;
use Mail;

class XampleMailController extends Controller
{
    public function index(Request $request)
    {
        $urls = '';
        $email = json_decode(json_encode($request->all()));
        Mail::to($email->email)->send(new XampleMail(json_decode(json_encode($request->all())),$request->pesan,$urls));

        return response()->json([
            'status' => true,
        ]);
    }

}

<?php

namespace App\Http\Controllers\API\ResetPassword;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;
use App\Models\User;



class ResetPasswordController extends Controller
{
    public function index(Request $request)
    {

        $user = User::whereRaw("upper(email) = '".strtoupper($request->email)."'")->first();
        if($user){
           $user->sendMailReset(); 
           return response()->json([
            'status' => true,
            ]);
        }else{
            return response()->json([
            'status' => false,
            ]);

        }
    }

    public function store(Request $request)
    {

        $user = User::whereRaw("upper(email) = '".strtoupper($request->email)."'")->first();
        if($user){
           $user->password = bcrypt($request->password);
           $user->save();
           return response()->json([
            'status' => true,
            ]);
        }else{
            return response()->json([
            'status' => false,
            ]);

        }
    }
    
}

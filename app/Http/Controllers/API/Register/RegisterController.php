<?php

namespace App\Http\Controllers\API\Register;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Laravel\Socialite\Facades\Socialite;

use Carbon\Carbon;
use App\Models\User;
use Auth;

class RegisterController extends Controller
{
    use RegistersUsers;

    public function index(Request $request)
    {

        if(!isset($request->username)){
            return response()->json([
              'status' => false,
              'message' => 'Username Tidak Boleh Kosong'
            ]);
        }

        if(!isset($request->nama)){
            return response()->json([
              'status' => false,
              'message' => 'Nama Tidak Boleh Kosong'
            ]);
        }

        if(!isset($request->password)){
            return response()->json([
              'status' => false,
              'message' => 'Password Tidak Boleh Kosong'
            ]);
        }

        if(!isset($request->email)){
            return response()->json([
              'status' => false,
              'message' => 'Email Tidak Boleh Kosong'
            ]);
        }

        $record = User::where('username',$request->username)->orWhere('email',$request->email)->first();
        if($record == true){
            return response()->json([
              'status' => false,
              'message' => 'Username / Email Sudah Tersedia'
            ]);
        }else{
            try {
                $user = User::create ([
                    'username'      => $request->username,
                    'nama'      => $request->nama,
                    'email'         => $request->email,
                    'password' => bcrypt($request->password),
                    'last_activity' => Carbon::now()->toDateTimeString(), 
                    'status'         => 1013, 
                ]);
                if($user == true){
                    $this->guard()->login($user);
                    return response()->json([
                          'status' => true,
                          'data' => $user
                    ]);
                }else{
                    return response()->json([
                      'status' => false,
                      'message' => 'Gagal Mendaftarkan Terjadi Masalah'
                    ]);
                }
                
            }catch (\Exception $e) {
              return response([
                'status' => 'error',
                'message' => $e,
              ], 500);
            }
        }
        
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
   
    public function handleProviderCallback(Request $request)
    {
        $errors = [];
        if (!$request->has('code') || $request->has('denied')) {
            return redirect('/');
        }
        // session()->put('state', request()->input('state'));
        $socialUser = Socialite::driver($request->provider)->user();
        
        $user = User::where('email', $socialUser->getEmail())->first();
        if($user == true){
            $this->guard()->login($user);
                return redirect(url('/dashboard'));
        }else{
            $user = User::where('provider_id', $socialUser->getID())->where('provider',$request->provider)->first();

            if(!$user){

                $user = User::create ([
                    'username'      => $socialUser->getName(),
                    'nama'      => $socialUser->getName(),
                    'email'         => $socialUser->getEmail(), 
                    'provider'         => $request->provider, 
                    'provider_id'         => $socialUser->getID(), 
                    'status'         => 1013, 
                ]);

                $this->guard()->login($user);
                return redirect ('/dashboard');
            }else{
                $errors = ['Akun' => 'Akun Tidak Diketahui'];

                if ($request->expectsJson()) {
                    return response()->json($errors, 422);
                }

                $this->incrementLoginAttempts($request);

                return redirect('/login')->withInput($request->only($this->username(), 'remember'))->withErrors($errors);
            }
        }
    }
    
}

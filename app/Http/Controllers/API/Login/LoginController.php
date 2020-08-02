<?php

namespace App\Http\Controllers\API\Login;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Models\User;
use App\Models\Users;
use Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function index(Request $request)
    {
        $usernameCheck = Users::with('creator','pictureusers','negara','provinsi','kota','kecamatan','lapak')->where('email', $request->email)->first();

        if($usernameCheck)
        {
          if(\Hash::check($request->password, $usernameCheck->password))
            {
                    $this->guard()->login($usernameCheck);
                    return response()->json([
                              'status' => true,
                              'data' => $usernameCheck
                        ]);
            }else{
                return response()->json([
                              'status' => false,
                              'message' => 'Password Salah'
                        ]);
            }
        }else{
            return response()->json([
                  'status' => false,
                  'message' => 'Akun Tidak Ditemukan'
            ]);
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

    public function loginProviders(Request $request){
        $usernameCheck = User::where('email', $request->email)->first();
        if($usernameCheck){
            return response()->json([
                'status' => true,
                'data' => $usernameCheck
            ]);
        }else{
            $user = User::create ([
                'username'      => $request->username,
                'nama'      => $request->nama,
                'email'         => $request->email, 
                'provider'         => $request->provider, 
                'status'         => 1013, 
            ]);
            // dd($user);
            $findUser = User::find($user->id);
            // dd($findUser);
            return response()->json([
                'status' => true,
                'data' => $findUser
            ]);
        }
    }

    public function createLoginProvider(Request $request){
        try {
            $user = User::create ([
                'username'      => $request->username,
                'nama'      => $request->nama,
                'email'         => $request->email, 
                'provider'         => $request->provider, 
                'provider_id'         => $request->provider_id, 
                'status'         => 1013, 
            ]);

            return response()->json([
                'status' => true,
                'data' => $user
            ]);
        } catch (\Exception $e) {
          return response([
            'status' => 'error',
            'message' => $e,
          ], 500);
        }
        
    }
    
    public function loginPhone(Request $request){
        $user = Users::with('creator','pictureusers','negara','provinsi','kota','kecamatan','lapak')->where('hp', $this->phoneNumber($request->phone))->first();

        if (!is_null($user)) {
            return response([
                'status' => true,
                'message' => 'Sukses Login',
                'data' => $user,
            ]);
        } else {
            $errors = ['error' => 'Akun Tidak Diketahui'];
            return $errors;
        }
    }

    private function phoneNumber($phoneNumber, $firebase = false)
    {
        // kadang ada penulisan no hp 0811 239 345
        $phoneNumber = str_replace(" ", "", $phoneNumber);
        // kadang ada penulisan no hp (0274) 778787
        $phoneNumber = str_replace("(", "", $phoneNumber);
        // kadang ada penulisan no hp (0274) 778787
        $phoneNumber = str_replace(")", "", $phoneNumber);
        // kadang ada penulisan no hp 0811.239.345
        $phoneNumber = str_replace(".", "", $phoneNumber);

        // cek apakah no hp mengandung karakter + dan 0-9
        if (!preg_match('/[^+0-9]/', trim($phoneNumber))) {

            if ($firebase) {
                if (substr(trim($phoneNumber), 0, 3) == '+62') {
                    $phoneNumber = $phoneNumber;
                } elseif (substr(trim($phoneNumber), 0, 1) == '0') {
                    $phoneNumber = '+62' . substr(trim($phoneNumber), 1);
                }
            } else {
                if (substr(trim($phoneNumber), 0, 3) == '+62') {
                    $phoneNumber = '0' . substr(trim($phoneNumber), 3);
                } else if (substr(trim($phoneNumber), 0, 2) == '62') {
                    $phoneNumber = '0' . substr(trim($phoneNumber), 2);
                }
            }
        } else {
            $phoneNumber = 'Invalidate Format Number';
        }

        return $phoneNumber;
    }
}

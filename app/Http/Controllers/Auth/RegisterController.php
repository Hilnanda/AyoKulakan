<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Laravel\Socialite\Facades\Socialite;

use Carbon\Carbon;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('checkAuth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:sys_users',
            'email' => 'required|string|email|max:255|unique:sys_users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'nama' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'last_activity' => Carbon::now()->toDateTimeString(),
            'status' => 1013,
        ]);
        $user->sendMails();
        return $user;
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    /**
     * Obtain the user information from provider.  Check if the user already exists in our
     * database by looking up their provider_id in the database.
     * If the user exists, log them in. Otherwise, create a new user then log them in. After that
     * redirect them to the authenticated users homepage.
     *
     * @return Response
     */
    public function handleProviderCallback(Request $request)
    {
        $errors = [];
        if (!$request->has('code') || $request->has('denied')) {
            return redirect('/');
        }
        session()->put('state', request()->input('state'));
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
                $user->sendMails();
                $this->guard()->login($user);
                return redirect ('/dashboard');
            }else{
                $errors = ['Akun' => 'Akun Tidak Diketahui'];

                if ($request->expectsJson()) {
                    return response()->json($errors, 422);
                }

                $this->incrementLoginAttempts($request);

                return redirect('/register')->withInput($request->only($this->username(), 'remember'))->withErrors($errors);
            }
        }

        
    }
}

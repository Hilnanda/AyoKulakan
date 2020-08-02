<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

use App\Models\User;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
    * Where to redirect users after login.
    *
    * @var string
    */
    protected $redirectTo = '/';

    public function username()
    {
        return 'email';
    }

    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('checkAuth');
    }

    public function login(Request $request)
    {
         $this->validateLogin($request);

         // If the class is using the ThrottlesLogins trait, we can automatically throttle
         // the login attempts for this application. We'll key this by the username and
         // the IP address of the client making these requests into this application.
         if ($this->hasTooManyLoginAttempts($request)) {
                 $this->fireLockoutEvent($request);

                 return $this->sendLockoutResponse($request);
         }

        $usernameCheck = User::where('email', $request->email)->first();

        if($usernameCheck)
        {
            if(\Hash::check($request->password, $usernameCheck->password))
            {
                $this->guard()->login($usernameCheck);
                return redirect(url('/'));
            }else{
                $errors = ['password' => trans('auth.password')];
            }
        }else{
            $errors = [$this->username() => trans('auth.user_name')];
        }

        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }

        $this->incrementLoginAttempts($request);

        return redirect()->back()
                     ->withInput($request->only($this->username(), 'remember'))
                     ->withErrors($errors);
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
            // dd('True');
            $this->guard()->login($user);
                return redirect(url('/'));
        }else{
            // dd('False',$socialUser);

            $user = User::where('provider_id', $socialUser->getID())->where('provider',$request->provider)->first();

            if(!$user){

                $user = User::create([
                    'username'    => is_null($socialUser->getEmail()) ? str_slug($socialUser->getName()) : $socialUser->getEmail(),
                    'nama'        => $socialUser->getName(),
                    'email'       => is_null($socialUser->getEmail()) ? str_slug($socialUser->getName()) . '@mail.com' : $socialUser->getEmail(),
                    'provider'    => $request->provider,
                    'provider_id' => $socialUser->getID(),
                    'status'      => 1013,
                ]);

                $this->guard()->login($user);
                return redirect ('/');
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

    /**
    * Validate the user login request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return void
    */

    protected function sendLoginResponse(Request $request)
    {
         $request->session()->regenerate();
         $this->clearLoginAttempts($request);
         return $this->authenticated($request, $this->guard()->user())
                         ?: redirect()->intended($this->redirectPath());
    }
}

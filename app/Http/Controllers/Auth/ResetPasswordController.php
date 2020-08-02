<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Mail\ResetPasswordMail;
use URL;
use Mail;
use App\Models\User;
class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $link = 'password/';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('checkAuth');
        $this->setLink($this->link);
    }

    public function index(){
        return $this->render('auth.passwords.reset');
    }
    // edit buat forgot passwpd
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password'=>  'required|confirmed',
        ]);
        $user = User::whereRaw("upper(email) = '".$request->email."'")->first();
        if ($user) {
            $user->password = bcrypt($request->password);
            $user->save();
            return redirect('/login')->withErrors(['all' => 'succes merubah password silahkan login']);
        }else {
            return redirect('/password/reset')->withErrors(['all' => 'gagal mereset password, email anda belum terdaftar']);
        }
    }
    public function sendMail(Request $request){
        $user = User::whereRaw("upper(email) = '".strtoupper($request->email)."'")->first();
        if($user){
           $user->password = bcrypt($request->password);
           $user->save();
           return redirect('/password/reset')->withErrors(['all' => 'Sukses Merubah Password!']);
        }else{
            return redirect('/password/reset')->withErrors(['all' => 'Gagal Merubah Password, Email Tidak Ditemukan']);
        }
        
    }

    public function change(Request $request){
        return $this->render('auth.passwords.reset',['errors' => []]);
    }
}

<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;

class LoginPhoneController extends Controller
{
    /**
     * Menampilkan halaman Login via Phone
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.phone');
    }

    public function checkPhoneNumber(Request $request)
    {
        $user = Users::where('hp', $this->phoneNumber($request->phone))->first();

        if (!is_null($user)) {
            return $this->phoneNumber($request->phone, true);
        } else {
            $errors = ['error' => 'Akun Tidak Diketahui'];
            return $errors;
        }
    }

    /**
     * Membuat credentials login
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function checkCredentials(Request $request)
    {
        $user = Users::where('hp', $this->phoneNumber($request->phone))->first();
        Auth::loginUsingId($user->id, true);
        return 'Ok';
    }

    /**
     * Mengecek inputan nomor handphone
     *
     * @param string $phoneNumber
     * @return string
     */
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

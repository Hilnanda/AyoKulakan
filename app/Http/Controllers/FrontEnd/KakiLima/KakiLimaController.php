<?php

namespace App\Http\Controllers\FrontEnd\KakiLima;

use Auth;
use QrCode;
use Zipper;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Users;
use Illuminate\Http\Request;

use App\Models\KakiLima\KakiLima;
use App\Http\Controllers\Controller;
use App\Models\Master\WilayahNegara;
use Intervention\Image\Facades\Image;
use App\Models\Master\AplikasiPanduan;
use App\Http\Requests\KakiLima\KakiLimaRequest;

class KakiLimaController extends Controller
{
  //
  protected $link = 'kaki-lima/';

  function __construct()
  {
    $this->setLink($this->link);
    $this->setTitle("Kaki Lima");
    $this->setGroup("Kaki Lima");
    $this->setModalSize("lg");
    $this->setBreadcrumb(['Kaki Lima' => '#']);
  }

  public function index()
  {
    $img = Image::make(public_path('new-temp.jpg'))->insert(public_path('img/loggo.png'));
    $record = AplikasiPanduan::where('kategori', 'Panduan Kaki Lima')->first();
    $recordKurir = [];
    if (Auth::check()) {
      $recordKurir = KakiLima::where('user_id', auth()->user()->id)->first();
    }
    // dd(QrCode::size(300)->generate('A basic example of QR code!'));
    return $this->render('frontend.kaki-lima.index', [
      'mockup' => false,
      'record' => $record,
      'recordKurir' => $recordKurir,
      'img' => $img
    ]);
  }

  public function tentang()
  {
    return $this->render('frontend.kaki-lima.tentang');
  }

  public function create()
  {
    $record = [];
    if (Auth::check()) {
      $record = Users::find(auth()->user()->id);
      return $this->render('frontend.kaki-lima.create', [
        'mockup' => false,
        'record' => $record
      ]);
    } else {
      return redirect('login');
    }
  }

  public function store(KakiLimaRequest $request)
  {
    // $this->validate($request, [
    //   'attachment.*' => 'required',
    //   'attachment.*' => 'max:500',
    // ], [
    //   'attachment.*.max' => 'Lampiran tidak boleh lebih dari 500 Kilobyte',
    // ]);
    try {
      $request['user_id'] = auth()->user()->id;
      $request['skck'] = $request->file('foto_usaha')->store('public/kurir_files');
      $request['ktp'] = $request->file('foto_ktp')->store('public/kurir_files');
      $request['swafoto'] = $request->file('swa_foto')->store('public/kurir_files');

      $data = KakiLima::saveData($request);

      $this->sendMailGlobal(
        isset(auth()->user()->email) ? auth()->user()->email : '',
        $data,
        'Selamat anda telah terdaftar sebagai kaki lima ayokulakan',
        'Hai kepada saudara ' . isset(auth()->user()->nama) ? auth()->user()->nama : '' . ' selamat bergabung, silahkan baca & taati, kebijakan & aturan dari ayokulakan',
        'https://ayokulakan.com/kaki-lima',
        'Kebijakan Privasi',
        'mails.global-mail'
      );
    } catch (\Exception $e) {
      return response([
        'status' => 'error',
        'message' => $e,
      ], 500);
    }

    return response([
      'status' => true,
      'url' => true
    ]);
  }

  public function notFoundPage()
  {
    return $this->render('failed.page', ['mockup' => false]);
  }
}

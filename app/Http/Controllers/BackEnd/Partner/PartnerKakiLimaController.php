<?php

namespace App\Http\Controllers\BackEnd\Partner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Roles;
use App\Http\Requests\KakiLima\KakiLimaRequest;

use App\Models\KakiLima\KakiLima;
use App\Models\Kurir\Kurir;

use DataTables;
use Zipper;
use Carbon\Carbon;
use Auth;

class PartnerKakiLimaController extends Controller
{
  //
  protected $link = 'partner/partner-kaki-lima/';

  function __construct()
  {
    $this->setLink($this->link);
    $this->setTitle("Partner");
    // $this->setGroup("Master");
    // $this->setSubGroup("Aplikasi");
    $this->setModalSize("lg");
    $this->setBreadcrumb(['Partner' => '#', 'Partner Kaki Lima' => '#']);
  }

  public function index()
  {
      $record = [];
    if(Auth::check()){
      $recordKaki = KakiLima::where('user_id',auth()->user()->id)->first();
    }
    return $this->render('backend.partner.partner-kaki-lima.index', [
      'mockup' => false,
      'recordKaki' => $recordKaki,
    ]);
  }

  public function update(KakiLimaRequest $request, $id)
  {
    $this->validate($request, [
        'attachment.*' => 'required',
        'attachment.*'=>'max:500',
    ],[
      'attachment.*.max' => 'Gambar tidak boleh lebih dari 500 Kilobyte',
    ]);
    try {
        $data = KakiLima::saveData($request);
    }catch (\Exception $e) {
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

}

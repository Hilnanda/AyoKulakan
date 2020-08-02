<?php

namespace App\Http\Controllers\BackEnd\Partner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Roles;
use App\Http\Requests\Kurir\KurirRequest;


use App\Models\KakiLima\KakiLima;
use App\Models\Kurir\Kurir;

use DataTables;
use Zipper;
use Carbon\Carbon;
use Auth;

class PartnerKurirController extends Controller
{
  //
  protected $link = 'partner/partner-kurir/';

  function __construct()
  {
    $this->setLink($this->link);
    $this->setTitle("Partner");
    $this->setModalSize("lg");
    $this->setBreadcrumb(['Partner' => '#', 'Partner Kurir' => '#']);
  }

  public function index()
  {
      $record = [];
    if(Auth::check()){
      $recordKurir = Kurir::where('user_id',auth()->user()->id)->first();
    }
    return $this->render('backend.partner.partner-kurir.index', [
      'mockup' => false,
      'recordKurir' => $recordKurir,
    ]);
  }

  public function update(KurirRequest $request, $id)
  {
    $this->validate($request, [
        'attachment.*' => 'required',
        'attachment.*'=>'max:500',
    ],[
      'attachment.*.max' => 'Gambar tidak boleh lebih dari 500 Kilobyte',
    ]);
    try {
        $data = Kurir::saveData($request);
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

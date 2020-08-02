<?php

namespace App\Http\Controllers\BackEnd\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Users;
use App\Models\Roles;
use App\Models\Lapak\Lapak;
use App\Models\Barang\LapakBarang;
use App\Models\Barang\LapakKategoriBarang;

use App\Http\Requests\Profile\ProfileRequest;

use DataTables;
use Zipper;
use Carbon\Carbon;
use Auth;

class ProfileController extends Controller
{
  //
  protected $link = 'myprofile/';

  function __construct()
  {
    $this->setLink($this->link);
    $this->setTitle('');
    // $this->setGroup("Master");
    // $this->setSubGroup("Aplikasi");
    $this->setModalSize("lg");
    $this->setBreadcrumb(['Setting Profile' => 'myprofile']);
  }

  public function index()
  {
    $record = [];
    if (Auth::check()) {
      $record = Users::find(auth()->user()->id);
    }
    return $this->render('backend.profile.index', [
      'mockup' => false,
      'record' => $record
    ]);
  }

  public function create()
  {
    return $this->render('backend.profile.create');
  }

  public function store(Request $request)
  {
    if (!is_null($request->foto_users[0])) {
      $this->validate($request, [
        'attachment.*' => 'max:5120',
        'attachment.*' => 'image|mimes:jpg,png,jpeg',
        "attachment.*" => "mimes:jpg,png,jpeg,gif"
      ], [
        'attachment.*.max' => 'Gambar tidak boleh lebih dari 5 MB',
        'attachment.*.mimes' => 'File Harus Berupa png, jpg, jpeg, gif',
        'attachment.*.dimensions' => 'Ukuran Kurang Gambar Harus 1070 X 490',
      ]);
    }
    try {
      $data = Users::saveData($request);
    } catch (\Exception $e) {
      return response([
        'status' => 'error',
        'message' => $e,
      ], 500);
    }

    return response([
      'status' => true,
      'url' => $this->link

    ]);
  }

  public function edit($id)
  {
    if (Auth::check()) {
      $record = Users::find(auth()->user()->id);
      if ($record) {
        // dd($record);
        return $this->render('backend.profile.edit', [
          'record' => Users::find($id),
        ]);
      }
    }
  }

  public function update(ProfileRequest $request, $id)
  {

    if (!is_null($request->foto_users[0])) {
      $this->validate($request, [
        'attachment.*' => 'max:5120',
        'attachment.*' => 'image|mimes:jpg,png,jpeg',
        "attachment.*" => "mimes:jpg,png,jpeg,gif"
      ], [
        'attachment.*.max' => 'Gambar tidak boleh lebih dari 5 MB',
        'attachment.*.mimes' => 'File Harus Berupa png, jpg, jpeg, gif',
        'attachment.*.dimensions' => 'Ukuran Kurang Gambar Harus 1070 X 490',
      ]);
    }
    if (isset($request->password)) {
      $this->validate($request, [
        'password' => 'string|min:6|confirmed',
      ]);
      $cekPass = bcrypt($request->password);
      $request['password'] = $cekPass;
    } else {
      unset($request['password']);
    }
    // dd($request->all());
    $this->validate($request, [
      'attachment.*' => 'max:500',
    ], [
      'attachment.*.max' => 'Gambar tidak boleh lebih dari 500 Kilobyte',
    ]);
    try {
      $data = Users::saveData($request);
    } catch (\Exception $e) {
      return response([
        'status' => 'error',
        'message' => 'An error occurred!',
      ], 500);
    }

    return response([
      'status' => true,
      'url' => true
    ]);
  }

  public function show($id)
  {
    // dd($id);
    return $this->render('backend.profile.show', [
      'record' => Lapak::find($id),
    ]);
  }

  public function destroy(Request $request, $id)
  {
    try {
      Lapak::destroy($id);
    } catch (\Exception $e) {
      return response([
        'status' => 'error',
        'message' => 'An error occurred!',
      ], 500);
    }

    return response([
      'status' => true,
      'url' => 'asdas'
    ]);
  }
}

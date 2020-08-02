<?php

namespace App\Http\Controllers\BackEnd\Lapak;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\User;
use App\Models\Roles;
use App\Models\Lapak\Lapak;
use App\Models\Barang\LapakBarang;
use App\Models\Barang\LapakKategoriBarang;
use App\Http\Requests\Lapak\LapakRequest;
use App\Http\Requests\Lapak\LapakBarangRequest;
Use App\Models\Master\KategoriBarang;
use App\Models\Master\KategoriBarangSub;
use DataTables;
use Zipper;
use Carbon\Carbon;
use Auth;

class SettingLapakController extends Controller
{
  //
  protected $link = 'settings-lapak/';

  function __construct()
  {
    $this->setLink($this->link);
    $this->setTitle("Setting Lapak");
    // $this->setGroup("Master");
    // $this->setSubGroup("Aplikasi");
    $this->setModalSize("lg");
    $this->setBreadcrumb(['Setting Lapak' => 'settings-lapak']);
  }

  public function index()
  {
    $record = [];
    if(Auth::check()){
      $record = Lapak::where('created_by',auth()->user()->id)->first();
      $records = KategoriBarang::with('subkategori')->orderBy('kat_nama','asc')->get();
    }
    return $this->render('backend.lapak.index', [
      'mockup' => false,
      'record' => $record,
      'records' => $records,
    ]);
  }
  public function add()
  {
    $this->render('backend.lapak.barang.create');
  }
  public function create()
  {
    return $this->render('backend.lapak.create');
  }

  public function store(LapakRequest $request)
  {
    $this->validate($request, [
        'attachment.*' => 'required',
        'attachment.*'=>'max:5000',
        "attachment.*"=>"mimes:jpg,png,jpeg,gif"
    ],[
      'attachment.*.max' => 'Gambar tidak boleh lebih dari 5MB',
    ]);
    try {
        $data = Lapak::saveData($request);
    }catch (\Exception $e) {
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
    return $this->render('backend.lapak.edit',[
        'record' => Lapak::find($id),
    ]);
  }

  public function update(LapakRequest $request, $id)
  {
    if(!is_null($request->attachment[0])){
      $this->validate($request, [
          'attachment.*'=>'max:5120',
          'attachment.*' => 'image|mimes:jpg,png,jpeg',
          "attachment.*"=>"mimes:jpg,png,jpeg,gif"
      ],[
        'attachment.*.max' => 'Gambar tidak boleh lebih dari 5 MB',
        'attachment.*.mimes' => 'File Harus Berupa png, jpg, jpeg, gif',
        'attachment.*.dimensions' => 'Ukuran Kurang Gambar Harus 1070 X 490',
      ]);
    }
    try {
       $data = Lapak::saveData($request);
    }catch (\Exception $e) {
      return response([
        'status' => 'error',
        'message' => 'An error occurred!',
      ], 500);
    }

    return response([
      'status' => true,
      'url' => url('/')
    ]);
  }

  public function show($id)
  {
    // dd($id);
    return $this->render('backend.lapak.show',[
        'record' => Lapak::find($id),
    ]);
  }

  public function destroy(Request $request, $id)
  {
    try {
      Lapak::destroy($id);
    }catch (\Exception $e) {
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

  // BARANG
  public function showBarang(Request $request)
  {
    $length = 15;
    if(isset($request->length)){
      if($request->length != 'Tampilkan'){
        $length = $request->length;
      }
    }
    $record = LapakBarang::where('id_trans_lapak',$request->id_lapak)->select('*');

    if ($name = $request->judul) {
      $record->where('nama_barang', 'like', '%'.$name.'%' );
    }

    if ($order = $request->order) {
        if($order == 'date'){
          $record->orderBy('created_at', 'desc');
        }else if($order == 'price'){
          $record->orderBy('harga_barang', 'asc');
        }else if($order == 'price-desc'){
          $record->orderBy('harga_barang', 'desc');
        }
    }
    $record = $record->paginate($length);


    return $this->render('backend.lapak.barang.show-barang',[
      'records' => $record
    ]);
  }

  public function addBarang(Request $request)
  {
    return $this->render('backend.lapak.barang.create',[
        'id_lapak' => $request->id,
        'titleModal' => 'Jual Barang'
    ]);
  }
  public function addJasa(Request $request)
  {
    $sub = KategoriBarangSub::where('id_kategori',14)->get();
    return $this->render('backend.lapak.barang.jasa',[
      'id_lapak' => $request->id,
      'sub'     => $sub,
      'titleModal' => 'Pasang Jasa'
  ]);
  }
  public function addLowongan(Request $request, $id)
  {
    $record = Lapak::where('created_by',auth()->user()->id)->first();
    $sub = KategoriBarangSub::with('kategori')->where('id', $id)->first();
    return $this->render('backend.lapak.barang.lowongan',[
      'record' => $record,
      'sub'     => $sub,
      'titleModal' => 'Pasang iklan Anda'
  ]);
  }
  public function storeJasa(Request $request)
  {
  //   $this->validate($request, [
  //     'attachment.*' => 'required',
  //     'attachment.*'=>'max:500',
  // ],[
  //   'attachment.*.max' => 'Gambar tidak boleh lebih dari 500 Kilobyte',
  // ]);

  try {
      $harga_barang = str_replace(".", "", $request->harga_barang);
      $request['harga_barang'] = $harga_barang;

      $data = LapakBarang::saveData($request);
      // $dataKategori = LapakKategoriBarang::saveData($request);
  }catch (\Exception $e) {
    return response([
      'status' => 'error',
      'message' => $e,
    ], 500);
  }

  return response([
    'status' => true,
    'url' => 'settings-lapak'

  ]);
  }
  public function storeLowongan(Request $request)
  {
  //   $this->validate($request, [
  //     'attachment.*' => 'required',
  //     'attachment.*'=>'max:500',
  // ],[
  //   'attachment.*.max' => 'Gambar tidak boleh lebih dari 500 Kilobyte',
  // ]);

  try {
      $harga_barang = str_replace(".", "", $request->harga_barang);
      $request['harga_barang'] = $harga_barang;

      $data = LapakBarang::saveData($request);
      // $dataKategori = LapakKategoriBarang::saveData($request);
  }catch (\Exception $e) {
    return response([
      'status' => 'error',
      'message' => $e,
    ], 500);
  }

  return response([
    'status' => true,
    'url' => 'settings-lapak'

  ]);
  }
  public function storeBarang(LapakBarangRequest $request)
  {
    $this->validate($request, [
        'attachment.*' => 'required',
        'attachment.*'=>'max:500',
    ],[
      'attachment.*.max' => 'Gambar tidak boleh lebih dari 500 Kilobyte',
    ]);

    try {
        $harga_barang = str_replace(".", "", $request->harga_barang);
        $request['harga_barang'] = $harga_barang;

        $data = LapakBarang::saveData($request);
        // $dataKategori = LapakKategoriBarang::saveData($request);
    }catch (\Exception $e) {
      return response([
        'status' => 'error',
        'message' => $e,
      ], 500);
    }

    return response([
      'status' => true,
      'url' => 'settings-lapak'

    ]);
  }

  public function editBarang($id)
  {
    return $this->render('backend.lapak.barang.edit',[
        'record' => LapakBarang::find($id),
    ]);
  }

  public function updateBarang(LapakBarangRequest $request, $id)
  {
    // dd($request->all());
    $this->validate($request, [
        'attachment.*'=>'max:500',
    ],[
      'attachment.*.max' => 'Gambar tidak boleh lebih dari 500 Kilobyte',
    ]);

    try {
         $harga_barang = str_replace(".", "", $request->harga_barang);
        $request['harga_barang'] = $harga_barang;
        $data = LapakBarang::saveData($request);
        // $dataKategori = LapakKategoriBarang::saveData($request);
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

  public function hapusBarang(Request $request)
  {
    try {
      LapakBarang::destroy($request->id);
    }catch (\Exception $e) {
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

  public function showFeedback($id)
  {
    // dd($id);
    return $this->render('backend.lapak.barang.show-feedback',[
        'record' => LapakBarang::find($id),
    ]);
  }
}

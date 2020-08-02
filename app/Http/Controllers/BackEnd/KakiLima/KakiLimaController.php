<?php

namespace App\Http\Controllers\BackEnd\KakiLima;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Roles;
use App\Models\KakiLima\KakiLima;
use App\Http\Requests\KakiLima\KakiLimaRequest;


use DataTables;
use Zipper;
use Carbon\Carbon;

class KakiLimaController extends Controller
{
  //
  protected $link = 'list-kaki-lima/';

  function __construct()
  {
    // $this->middleware('roleAdministration');
    $this->setLink($this->link);
    $this->setTitle("Data Keseluruhan Kaki Lima");
    // $this->setGroup("Master");
    // $this->setSubGroup("Aplikasi");
    $this->setModalSize("lg");
    $this->setBreadcrumb(['Data Keseluruhan Kaki Lima' => 'list-kaki-lima/']);

    // Header Grid Datatable
    $this->setTableStruct([
      [
        'data' => 'num',
        'name' => 'num',
        'label' => '#',
        'orderable' => false,
        'searchable' => false,
        'className' => "text-center text-nowrap",
        'width' => '40px',
      ],
      /* --------------------------- */
      [
        'data' => 'user_id',
        'name' => 'user_id',
        'label' => 'Pemilik',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'nomor_telepon',
        'name' => 'nomor_telepon',
        'label' => 'Nomor Telepon',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'email',
        'name' => 'email',
        'label' => 'Email',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'ktp',
        'name' => 'ktp',
        'label' => 'KTP',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'swafoto',
        'name' => 'swafoto',
        'label' => 'SWA FOTO',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'skck',
        'name' => 'skck',
        'label' => 'SKCK',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'name',
        'name' => 'name',
        'label' => 'Nama Toko',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'type_usaha',
        'name' => 'type_usaha',
        'label' => 'Tipe Toko',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'negara',
        'name' => 'negara',
        'label' => 'Negara',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'provinsi',
        'name' => 'provinsi',
        'label' => 'Provinsi',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'kota',
        'name' => 'kota',
        'label' => 'Kota',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'distrik',
        'name' => 'distrik',
        'label' => 'Kecamatan',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'kode_pos',
        'name' => 'kode_pos',
        'label' => 'Kode Pos',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'lat',
        'name' => 'lat',
        'label' => 'LAT',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'lng',
        'name' => 'lng',
        'label' => 'LNG',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'created_at',
        'name' => 'created_at',
        'label' => 'Created At',
        'searchable' => false,
        'sortable' => true,
        'width' => '100px',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'action',
        'name' => 'action',
        'label' => 'Aksi',
        'searchable' => false,
        'sortable' => false,
        'width' => '100px',
        'className' => "text-center text-nowrap",

      ]
    ]);
  }

  public function grid(Request $request)
  {
    $records = KakiLima::with('creator')->select('*');
    // dd($records);
    //Init Sort
    if (!isset(request()->order[0]['column'])) {
      // $records->->sort();
      $records->orderBy('created_at', 'desc');
    }
    //Filters
    if ($name = $request->nama) {
      $records->where('name', 'like', '%' . $name . '%');
    }
    //Filters
    return Datatables::of($records)
      ->addColumn('num', function ($record) use ($request) {
        return $request->get('start');
      })
      ->addColumn('user_id', function ($record) {
        $nama = '-';
        if (isset($record->user->nama)) {
          $nama = $record->user->nama;
        }

        return $nama;
        return $nama;
        return $nama;
      })
      ->addColumn('created_by', function ($record) {
        return $record->creatorName();
      })
      ->addColumn('action', function ($record) {
        $btn = '';
        //Edit
        $btn .= $this->makeButton([
          'type' => 'edit',
          'tooltip' => 'Ubah Data',
          'id'   => $record->id
        ]);
        // Delete
        $btn .= $this->makeButton([
          'type' => 'delete',
          'id'   => $record->id
        ]);

        return $btn;
      })
      ->rawColumns(['action', 'fullname', 'kendaraan', 'sim'])
      ->make(true);
  }

  public function index()
  {
    return $this->render('backend.all-kaki-lima.index', [
      'mockup' => false,
    ]);
  }

  public function create()
  {
    return $this->render('backend.all-kaki-lima.create');
  }

  public function store(KakiLimaRequest $request)
  {
    $this->validate($request, [
      'attachment.*' => 'required',
      'attachment.*' => 'max:5120',
      'attachment.*' => 'image|mimes:jpg,png,jpeg',
      "attachment.*" => "mimes:jpg,png,jpeg,gif"
    ], [
      'attachment.*.max' => 'Gambar tidak boleh lebih dari 5 MB',
      'attachment.*.mimes' => 'File Harus Berupa png, jpg, jpeg, gif',
      'attachment.*.dimensions' => 'Ukuran Kurang Gambar Harus 1070 X 490',
    ]);
    try {
      $data = KakiLima::saveData($request);
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
    return $this->render('backend.all-kaki-lima.edit', [
      'record' => KakiLima::find($id),
    ]);
  }

  public function update(KakiLimaRequest $request, $id)
  {
    if (!is_null($request->attachment[0])) {
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
      $data = KakiLima::saveData($request);
    } catch (\Exception $e) {
      return response([
        'status' => 'error',
        'message' => 'An error occurred!',
      ], 500);
    }

    return response([
      'status' => true
    ]);
  }

  public function show($id)
  {
    // dd($id);
    return $this->render('backend.all-kaki-lima.show', [
      'record' => KakiLima::find($id),
    ]);
  }

  public function destroy(Request $request, $id)
  {
    try {
      KakiLima::destroy($id);
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

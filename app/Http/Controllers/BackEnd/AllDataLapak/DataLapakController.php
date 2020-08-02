<?php

namespace App\Http\Controllers\BackEnd\AllDataLapak;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Roles;
use App\Models\Lapak\Lapak;
use App\Models\Barang\LapakBarang;
use App\Models\Barang\LapakKategoriBarang;
use App\Http\Requests\Lapak\LapakRequest;
use App\Http\Requests\Lapak\LapakBarangRequest;

use DataTables;
use Zipper;
use Carbon\Carbon;

class DataLapakController extends Controller
{
  //
  protected $link = 'data/data-lapak/';

  function __construct()
  {
    // $this->middleware('roleAdministration');
    $this->setLink($this->link);
    $this->setTitle("Data Keseluruhan Lapak");
    // $this->setGroup("Master");
    // $this->setSubGroup("Aplikasi");
    $this->setModalSize("lg");
    $this->setBreadcrumb(['Data Keseluruhan Lapak' => 'data/data-lapak/']);

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
        'data' => 'nama_lapak',
        'name' => 'nama_lapak',
        'label' => 'Nama Lapak',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'id_negara',
        'name' => 'id_negara',
        'label' => 'Negara',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'id_provinsi',
        'name' => 'id_provinsi',
        'label' => 'Provinsi',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'id_kota',
        'name' => 'id_kota',
        'label' => 'Kota',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'id_kecamatan',
        'name' => 'id_kecamatan',
        'label' => 'Kecamatan',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'created_by',
        'name' => 'created_by',
        'label' => 'Created By',
        'searchable' => false,
        'sortable' => true,
        'width' => '100px',
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
    $records = Lapak::with('creator')->select('*');
    // dd($records);
    //Init Sort
    if (!isset(request()->order[0]['column'])) {
      // $records->->sort();
      $records->orderBy('created_at', 'desc');
    }
    //Filters
    if ($name = $request->nama) {
      $records->where('nama_lapak', 'like', '%'.$name.'%' );
    }
    //Filters
    return Datatables::of($records)
    ->addColumn('num', function ($record) use ($request) {
      return $request->get('start');
    })
    ->addColumn('deskripsi', function ($record) {
        return '<span class="ccount more" data-ccount="80">'.readMoreText(strip_tags($record->deskripsi),150).'</span>';
    })
    ->addColumn('id_negara', function ($record) {
      return $record->negara->negara;
    })
    ->addColumn('id_provinsi', function ($record) {
      return $record->provinsi->provinsi;
    })
    ->addColumn('id_kota', function ($record) {
      return $record->kota->kota;
    })
    ->addColumn('id_kecamatan', function ($record) {
      return $record->kecamatan->kecamatan;
    })
    ->addColumn('created_at', function ($record) {
      return $record->creationDate();
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
    ->rawColumns(['action','deskripsi'])
    ->make(true);
  }

  public function index()
  {
    return $this->render('backend.all-lapak.index', [
      'mockup' => false,
    ]);
  }

  public function create()
  {
    return $this->render('backend.all-lapak.create');
  }

  public function store(LapakRequest $request)
  {
    $this->validate($request, [
        'attachment.*' => 'required',
        'attachment.*'=>'max:5120',
        'attachment.*' => 'image|mimes:jpg,png,jpeg',
        "attachment.*"=>"mimes:jpg,png,jpeg,gif"
    ],[
      'attachment.*.max' => 'Gambar tidak boleh lebih dari 5 MB',
      'attachment.*.mimes' => 'File Harus Berupa png, jpg, jpeg, gif',
      'attachment.*.dimensions' => 'Ukuran Kurang Gambar Harus 1070 X 490',
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
    return $this->render('backend.all-lapak.edit',[
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
      'status' => true
    ]);
  }

  public function show($id)
  {
    // dd($id);
    return $this->render('backend.all-lapak.show',[
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

}

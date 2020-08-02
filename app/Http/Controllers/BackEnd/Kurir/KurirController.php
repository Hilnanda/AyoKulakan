<?php

namespace App\Http\Controllers\BackEnd\Kurir;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Roles;
use App\Models\Kurir\Kurir;
use App\Http\Requests\Kurir\KurirRequest;


use DataTables;
use Zipper;
use Carbon\Carbon;

class KurirController extends Controller
{
  //
  protected $link = 'list-kurir/';

  function __construct()
  {
    // $this->middleware('roleAdministration');
    $this->setLink($this->link);
    $this->setTitle("Data Keseluruhan kurir");
    // $this->setGroup("Master");
    // $this->setSubGroup("Aplikasi");
    $this->setModalSize("lg");
    $this->setBreadcrumb(['Data Keseluruhan kurir' => 'list-kurir/']);

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
        'data' => 'fullname',
        'name' => 'fullname',
        'label' => 'Nama Kurir',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'nik',
        'name' => 'nik',
        'label' => 'NIK',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      // [
      //   'data' => 'kendaraan',
      //   'name' => 'kendaraan',
      //   'label' => 'Kendaraan',
      //   'searchable' => false,
      //   'sortable' => true,
      //   'width' => '20%',
      //   'className' => "text-center text-nowrap",

      // ],
      // [
      //   'data' => 'sim',
      //   'name' => 'sim',
      //   'label' => 'SIM',
      //   'searchable' => false,
      //   'sortable' => true,
      //   'width' => '20%',
      //   'className' => "text-center text-nowrap",

      // ],
      // [
      //   'data' => 'km',
      //   'name' => 'km',
      //   'label' => 'KM',
      //   'searchable' => false,
      //   'sortable' => true,
      //   'width' => '20%',
      //   'className' => "text-center text-nowrap",

      // ],
      // [
      //   'data' => 'kg',
      //   'name' => 'kg',
      //   'label' => 'KG',
      //   'searchable' => false,
      //   'sortable' => true,
      //   'width' => '100px',
      //   'className' => "text-center text-nowrap",

      // ],
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
    $records = Kurir::with('creator')->select('*');
    // dd($records);
    //Init Sort
    if (!isset(request()->order[0]['column'])) {
      // $records->->sort();
      $records->orderBy('created_at', 'desc');
    }
    //Filters
    if ($name = $request->nama) {
      $records->where('nik', 'like', '%'.$name.'%' );
    }
    //Filters
    return Datatables::of($records)
    ->addColumn('num', function ($record) use ($request) {
      return $request->get('start');
    })
    ->addColumn('fullname', function ($record) {
      $nama = '-';
      if(isset($record->user->nama)){
        $nama = $record->user->nama;
      }

      return $nama;
    })
    // ->addColumn('sim', function ($record) {
    //   return $record->getSim();
    // })
    // ->addColumn('kendaraan', function ($record) {
    //   return $record->getKendaraan();
    // })

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
    ->rawColumns(['action','fullname','kendaraan','sim'])
    ->make(true);
  }

  public function index()
  {
    return $this->render('backend.kurir.index', [
      'mockup' => false,
    ]);
  }

  public function create()
  {
    return $this->render('backend.kurir.create');
  }

  public function store(KurirRequest $request)
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
        $data = Kurir::saveData($request);
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
    return $this->render('backend.kurir.edit',[
        'record' => Kurir::find($id),
    ]);
  }

  public function update(KurirRequest $request, $id)
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
       $data = Kurir::saveData($request);
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
    return $this->render('backend.kurir.show',[
        'record' => Kurir::find($id),
    ]);
  }

  public function destroy(Request $request, $id)
  {
    try {
      Kurir::destroy($id);
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

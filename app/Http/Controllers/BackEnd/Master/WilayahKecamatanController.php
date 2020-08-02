<?php

namespace App\Http\Controllers\BackEnd\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Roles;
use App\Models\Master\WilayahKecamatan;
use App\Http\Requests\Master\WilayahKecamatanRequest;

use DataTables;
use Zipper;
use Carbon\Carbon;

class WilayahKecamatanController extends Controller
{
  //
  protected $link = 'master/wilayah/kecamatan/';

  function __construct()
  {
    $this->setLink($this->link);
    $this->setTitle("Kecamatan");
    $this->setGroup("Master");
    $this->setSubGroup("Wilayah");
    $this->setModalSize("lg");
    $this->setBreadcrumb(['Master' => '#', 'Wilayah' => '#' , 'Kecamatan' => 'master/wilayah/kecamatan/']);

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
        'data' => 'id_negara',
        'name' => 'id_negara',
        'label' => 'Negara',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],[
        'data' => 'id_provinsi',
        'name' => 'id_provinsi',
        'label' => 'Provinsi',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],[
        'data' => 'id_kota',
        'name' => 'id_kota',
        'label' => 'Kabupaten / Kota',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'kecamatan',
        'name' => 'kecamatan',
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
    $records = WilayahKecamatan::with('creator')->select('*');
    // dd($records);
    //Init Sort
    if (!isset(request()->order[0]['column'])) {
      // $records->->sort();
      $records->orderBy('created_at', 'desc');
    }
    //Filters
    if ($name = $request->nama) {
      $records->where('kecamatan', 'like', '%'.$name.'%' );
    }
    //Filters
    return Datatables::of($records)
    ->addColumn('num', function ($record) use ($request) {
      return $request->get('start');
    })

    ->addColumn('created_at', function ($record) {
      return $record->creationDate();
    })
    ->addColumn('id_negara', function ($record) {
      return isset($record->negara->negara) ? $record->negara->negara : '';
    })
    ->addColumn('id_provinsi', function ($record) {
      return isset($record->provinsi->provinsi) ? $record->provinsi->provinsi :'';
    })
    ->addColumn('id_kota', function ($record) {
      return isset($record->kota->kota) ? $record->kota->kota : '';
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
    ->rawColumns(['action'])
    ->make(true);
  }

  public function index()
  {
    return $this->render('backend.master.wilayah-kecamatan.index', [
      'mockup' => false,
    ]);
  }

  public function create()
  {
    return $this->render('backend.master.wilayah-kecamatan.create');
  }

  public function store(WilayahKecamatanRequest $request)
  {
    try {
        $data = WilayahKecamatan::saveData($request);
    }catch (\Exception $e) {
      return response([
        'status' => 'error',
        'message' => $e,
      ], 500);
    }

    return response([
      'status' => true,
      'url' => 'asdas'
      
    ]);
  }

  public function edit($id)
  {
    return $this->render('backend.master.wilayah-kecamatan.edit',[
        'record' => WilayahKecamatan::find($id),
    ]);
  }

  public function update(WilayahKecamatanRequest $request, $id)
  {
    
    try {
       $data = WilayahKecamatan::saveData($request);
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
    return $this->render('backend.master.wilayah-kecamatan.show',[
        'record' => WilayahKecamatan::find($id),
    ]);
  }

  public function destroy(Request $request, $id)
  {
    try {
      WilayahKecamatan::destroy($id);
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

<?php

namespace App\Http\Controllers\BackEnd\HajiUmroh;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Roles;
use App\Models\HajiUmroh\HajiJadwal;
use App\Http\Requests\HajiUmroh\HajiJadwalRequest;

use DataTables;
use Zipper;
use Carbon\Carbon;

class HajiJadwalController extends Controller
{
  //
  protected $link = 'haji-umroh/haji-jadwal/';

  function __construct()
  {
    $this->setLink($this->link);
    $this->setTitle("Jadwal Haji");
    $this->setGroup("Haji & Umroh");
    $this->setModalSize("lg");
    $this->setBreadcrumb(['Haji & Umroh' => '#' , 'Jadwal Haji' => 'haji-umroh/haji-jadwal/']);

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
        'data' => 'paket_id',
        'name' => 'paket_id',
        'label' => 'Paket',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'judul',
        'name' => 'judul',
        'label' => 'Judul',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'tgl_berangkat',
        'name' => 'tgl_berangkat',
        'label' => 'Berangkat',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'tgl_pulang',
        'name' => 'tgl_pulang',
        'label' => 'Pulang',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'total_hari',
        'name' => 'total_hari',
        'label' => 'Hari',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      
       [
        'data' => 'harga',
        'name' => 'harga',
        'label' => 'Harga',
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
    $records = HajiJadwal::with('creator')->select('*');
    // dd($records);
    //Init Sort
    if (!isset(request()->order[0]['column'])) {
      // $records->->sort();
      $records->orderBy('created_at', 'desc');
    }
    //Filters
    if ($name = $request->nama) {
      $records->where('judul', 'like', '%'.$name.'%' );
    }
    //Filters
    return Datatables::of($records)
    ->addColumn('num', function ($record) use ($request) {
      return $request->get('start');
    })
    
    ->addColumn('created_at', function ($record) {
      return $record->creationDate();
    })
    ->addColumn('paket_id', function ($record) {
      return ($record->paket) ? $record->paket->type_paket : '';
    })
    ->addColumn('harga', function ($record) {
      return '$ '.$record->harga;
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
    return $this->render('backend.haji-umroh.haji-jadwal.index', [
      'mockup' => false,
    ]);
  }

  public function create()
  {
    return $this->render('backend.haji-umroh.haji-jadwal.create');
  }

  public function store(HajiJadwalRequest $request)
  {
    try {
        $data = HajiJadwal::saveData($request);
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
    return $this->render('backend.haji-umroh.haji-jadwal.edit',[
        'record' => HajiJadwal::find($id),
    ]);
  }

  public function update(HajiJadwalRequest $request, $id)
  {
    try {
       $data = HajiJadwal::saveData($request);
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
    return $this->render('backend.haji-umroh.haji-jadwal.show',[
        'record' => HajiJadwal::find($id),
    ]);
  }

  public function destroy(Request $request, $id)
  {
    try {
      HajiJadwal::destroy($id);
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

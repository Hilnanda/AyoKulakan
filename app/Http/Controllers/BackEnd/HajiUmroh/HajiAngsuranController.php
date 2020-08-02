<?php

namespace App\Http\Controllers\BackEnd\HajiUmroh;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Roles;
use App\Models\HajiUmroh\HajiAngsuran;
use App\Models\HajiUmroh\HajiPaket;
use App\Http\Requests\HajiUmroh\HajiAngsuranRequest;

use DataTables;
use Zipper;
use Carbon\Carbon;

class HajiAngsuranController extends Controller
{
  //
  protected $link = 'haji-umroh/haji-angsuran/';

  function __construct()
  {
    $this->setLink($this->link);
    $this->setTitle("Angsuran Haji");
    $this->setGroup("Haji & Umroh");
    $this->setModalSize("lg");
    $this->setBreadcrumb(['Haji & Umroh' => '#' , 'Angsuran Haji' => 'haji-umroh/haji-angsuran/']);

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
        'data' => 'order_id',
        'name' => 'order_id',
        'label' => 'Order Id',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'user_id',
        'name' => 'user_id',
        'label' => 'Pengansur Haji / Umroh',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'nama',
        'name' => 'nama',
        'label' => 'Nama',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
       [
        'data' => 'umur',
        'name' => 'umur',
        'label' => 'Umur',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
       [
        'data' => 'id_paket',
        'name' => 'id_paket',
        'label' => 'Paket',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
       [
        'data' => 'id_jadwal',
        'name' => 'id_jadwal',
        'label' => 'Jadwal',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'status',
        'name' => 'status',
        'label' => 'Status',
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
    $records = HajiAngsuran::with('creator')->select('*');
    // dd($records);
    //Init Sort
    if (!isset(request()->order[0]['column'])) {
      // $records->->sort();
      $records->orderBy('created_at', 'desc');
    }
    //Filters
    if ($name = $request->nama) {
      $records->where('name', 'like', '%'.$name.'%' );
    }
    //Filters
    return Datatables::of($records)
    ->addColumn('num', function ($record) use ($request) {
      return $request->get('start');
    })
    ->addColumn('keterangan_penyakit', function ($record) {
        return '<span class="ccount more" data-ccount="80">'.readMoreText(strip_tags($record->keterangan_penyakit),150).'</span>';
    })
    
    ->addColumn('order_id', function ($record) {
      $hasil = $record->user->id+000;
      return 'AyoHU'.$hasil;
    })
    ->addColumn('user_id', function ($record) {
      return $record->user->nama;
    })
    ->addColumn('id_paket', function ($record) {
      return isset($record->paket->type_paket) ? $record->paket->type_paket : '-' ;
    })
    ->addColumn('id_jadwal', function ($record) {
      return isset($record->jadwal->judul) ? $record->jadwal->judul : '-' ;
    })
    ->addColumn('created_by', function ($record) {
      return $record->creatorName();
    })
    ->addColumn('status', function ($record) {
      $status = '';
      $status .= $record->statusLabel();
      return $status;
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
    ->rawColumns(['action','status'])
    ->make(true);
  }

  public function index()
  {
    return $this->render('backend.haji-umroh.haji-angsuran.index', [
      'mockup' => false,
    ]);
  }

  public function create()
  {
    return $this->render('backend.haji-umroh.haji-angsuran.create');
  }

  public function store(HajiAngsuranRequest $request)
  {
    try {
        $data = HajiAngsuran::saveData($request);
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
    return $this->render('backend.haji-umroh.haji-angsuran.edit',[
        'record' => HajiAngsuran::find($id),
    ]);
  }

  public function update(HajiAngsuranRequest $request, $id)
  {
    try {
       $data = HajiAngsuran::saveData($request);
    }catch (\Exception $e) {
      return response([
        'status' => 'error',
        'message' => 'An error occurred! ',
      ], 500);
    }

    return response([
      'status' => true
    ]);
  }

  public function show($id)
  {
    // dd($id);
    return $this->render('backend.haji-umroh.haji-angsuran.show',[
        'record' => HajiAngsuran::find($id),
    ]);
  }

  public function destroy(Request $request, $id)
  {
    try {
      HajiAngsuran::destroy($id);
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

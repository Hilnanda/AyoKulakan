<?php

namespace App\Http\Controllers\BackEnd\HajiUmroh;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Roles;
use App\Models\HajiUmroh\HajiRekap;
use App\Models\HajiUmroh\HajiPaket;
use App\Http\Requests\HajiUmroh\HajiRekapRequest;

use DataTables;
use Zipper;
use Carbon\Carbon;

class HajiRekapController extends Controller
{
  //
  protected $link = 'haji-umroh/haji-rekap/';

  function __construct()
  {
    $this->setLink($this->link);
    $this->setTitle("Rekap Haji");
    $this->setGroup("Haji & Umroh");
    $this->setModalSize("lg");
    $this->setBreadcrumb(['Haji & Umroh' => '#' , 'Rekap Haji' => 'haji-umroh/haji-rekap/']);

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
        'data' => 'tgl_pembayaran',
        'name' => 'tgl_pembayaran',
        'label' => 'Tanggal Pembayaran',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
       [
        'data' => 'uang_pembayaran',
        'name' => 'uang_pembayaran',
        'label' => 'Uang Pembayaran',
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
    $records = HajiRekap::with('creator')->select('*');
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
    ->addColumn('tgl_pembayaran', function ($record) {
      return isset($record->tgl_pembayaran) ? $record->tgl_pembayaran : '-' ;
    })
    ->addColumn('uang_pembayaran', function ($record) {
      return isset($record->uang_pembayaran) ? $record->uang_pembayaran : '-' ;
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
    return $this->render('backend.haji-umroh.haji-rekap.index', [
      'mockup' => false,
    ]);
  }

  public function create()
  {
    return $this->render('backend.haji-umroh.haji-rekap.create');
  }

  public function store(HajiRekapRequest $request)
  {
    try {
        $data = HajiRekap::saveData($request);
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
    return $this->render('backend.haji-umroh.haji-rekap.edit',[
        'record' => HajiRekap::find($id),
    ]);
  }

  public function update(HajiRekapRequest $request, $id)
  {
    try {
       $data = HajiRekap::saveData($request);
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
    return $this->render('backend.haji-umroh.haji-rekap.show',[
        'record' => HajiRekap::find($id),
    ]);
  }

  public function destroy(Request $request, $id)
  {
    try {
      HajiRekap::destroy($id);
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

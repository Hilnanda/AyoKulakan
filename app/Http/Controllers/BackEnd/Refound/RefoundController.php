<?php

namespace App\Http\Controllers\BackEnd\Refound;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Roles;
use App\Models\Refound\Refound;
use App\Http\Requests\Refound\RefoundRequest;


use DataTables;
use Zipper;
use Carbon\Carbon;

class RefoundController extends Controller
{
  //
  protected $link = 'refounds/';

  function __construct()
  {
    // $this->middleware('roleAdministration');
    $this->setLink($this->link);
    $this->setTitle("Data Refound");
    // $this->setGroup("Master");
    // $this->setSubGroup("Aplikasi");
    $this->setModalSize("lg");
    $this->setBreadcrumb(['Data Refound' => 'refounds/']);

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
        'data' => 'lapak',
        'name' => 'lapak',
        'label' => 'Nama Lapak',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'barang',
        'name' => 'barang',
        'label' => 'Nama Barang',
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
        'data' => 'created_at',
        'name' => 'created_at',
        'label' => 'Dibuat Pada',
        'searchable' => false,
        'sortable' => true,
        'width' => '100px',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'created_by',
        'name' => 'created_by',
        'label' => 'Dibuat Oleh',
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
    $records = Refound::with('creator')->select('*');
    // dd($records);
    //Init Sort
    if (!isset(request()->order[0]['column'])) {
      // $records->->sort();
      $records->orderBy('created_at', 'desc');
    }
    //Filters
    if ($order_id = $request->order_id) {
      $records->whereHas('transaksi',function($q) use($order_id){
        $q->where('order_id', 'like', '%'.$order_id.'%' );
      });        
    }

    if ($lapak = $request->lapak) {
      $records->whereHas('lapak',function($q) use($lapak){
        $q->where('nama_lapak','like', '%'.$lapak.'%' );
      });        
    }

     if ($barang = $request->barang) {
      $records->whereHas('form',function($q) use($barang){
        $q->where('nama_barang','like', '%'.$barang.'%' )->orWhere(function ($pic) use($barang){
            $pic->where('judul', 'like', '%'.$barang.'%' );
          });        
        });        
    }

    if ($created_at = $request->created_at) {
      $records->whereDate('created_at',$created_at);        
    }
    //Filters
    return Datatables::of($records)
    ->addColumn('num', function ($record) use ($request) {
      return $request->get('start');
    })
    ->addColumn('order_id', function ($record) {
      return $record->transaksi->order_id;
    })
    ->addColumn('lapak', function ($record) {
        return $record->lapak->nama_lapak;
    })
    ->addColumn('barang', function ($record) {
      $lapak = $record->form->nama_barang;
      if($record->form_type == 'img_rental'){
        $lapak = $record->form->judul;
      }
      return $lapak;
    })
    ->addColumn('created_at', function ($record) {
      return $record->created_at->format('Y-m-d');
    })
    ->addColumn('status', function ($record) {
      $status = '';
      $status .= '<span class="badge badge-pill badge-primary">'.$record->status.'</span>';
      return $status;
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
    ->rawColumns(['action','order_id','lapak','barang', 'status'])
    ->make(true);
  }

  public function index()
  {
    return $this->render('backend.refound.index', [
      'mockup' => false,
    ]);
  }

  public function create()
  {
    return $this->render('backend.refound.create');
  }

  public function store(RefoundRequest $request)
  {
   
    try {
        $data = Refound::saveData($request);
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
    return $this->render('backend.refound.edit',[
        'record' => Refound::find($id),
    ]);
  }

  public function update(RefoundRequest $request, $id)
  {
   
    try {
       $data = Refound::saveData($request);
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
    return $this->render('backend.refound.show',[
        'record' => Refound::find($id),
    ]);
  }

  public function destroy(Request $request, $id)
  {
    try {
      Refound::destroy($id);
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

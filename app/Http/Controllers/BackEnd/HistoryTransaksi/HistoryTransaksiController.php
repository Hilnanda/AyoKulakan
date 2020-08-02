<?php

namespace App\Http\Controllers\BackEnd\HistoryTransaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Roles;
use App\Models\Barang\LapakBarang;
use App\Models\Barang\FavoritBarang;
use App\Models\TransaksiAmpas\TransaksiAmpase;
use App\Models\TransaksiAmpas\TransaksiAmpaseBarangDetail;

use DataTables;
use Zipper;
use Carbon\Carbon;
use Auth;
use DB;

class HistoryTransaksiController extends Controller
{
  //
  protected $link = 'history-trans/';

  function __construct()
  {
    $this->setLink($this->link);
    $this->setTitle("History Transaksi");
    // $this->setGroup("Master");
    // $this->setSubGroup("Aplikasi");
    $this->setModalSize("lg");
    $this->setBreadcrumb(['History Transaksi' => 'history-trans']);
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
        'label' => 'Nama Pembeli ',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
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
        'data' => 'status',
        'name' => 'status',
        'label' => 'Status Order',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'created_at',
        'name' => 'created_at',
        'label' => 'Tanggal Order',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
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
    
    if(isset(auth()->user()->status) && auth()->user()->status == '1010'){
      $records = TransaksiAmpase::select('*');
    }else{
      $records = TransaksiAmpase::where('created_by',auth()->user()->id)->select('*');
    }

    if (!isset(request()->order[0]['column'])) {
      $records->orderBy('created_at', 'desc');
    }
    //Filters
    if ($name = $request->nama) {
      $records->where('order_id', 'like', '%'.$name.'%' );
    }
    //Filters
    return Datatables::of($records)
    ->addColumn('num', function ($record) use ($request) {
      return $request->get('start');
    })
    ->addColumn('user_id', function ($record) {
      return $record->user->nama;
    })
    ->addColumn('status', function ($record) {
        $status = '';
      
        $status .= '<span class="badge badge-pill badge-warning">'.$record->status.'</span>';
        return $status;
    })
    ->addColumn('action', function ($record) {
      $btn = '';
      //Edit
        $btn .= $this->makeButton([
          'type' => 'detail',
          'tooltip' => 'Lihat Data',
          'id'   => $record->id
        ]);
        // Delete
        // $btn .= $this->makeButton([
        //   'type' => 'delete',
        //   'id'   => $record->id
        // ]);

      return $btn;
    })
    ->rawColumns(['action','harga_barang','status'])
    ->make(true);
  }

  public function index()
  {
    return $this->render('backend.history-transaksi.index', [
      'mockup' => false,
    ]);
  }
  
  public function show($id)
  {
    // dd($id);
    $record = TransaksiAmpase::find($id);
   
    return $this->render('backend.history-transaksi.show',[
        'record' => $record,
    ]);
  }

}

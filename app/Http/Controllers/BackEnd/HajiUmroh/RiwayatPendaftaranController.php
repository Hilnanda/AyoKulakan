<?php

namespace App\Http\Controllers\BackEnd\HajiUmroh;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Roles;
use App\Models\HajiUmroh\HajiDaftar;
use App\Models\HajiUmroh\HajiPaket;
use App\Http\Requests\HajiUmroh\HajiDaftarRequest;

use DataTables;
use Zipper;
use Carbon\Carbon;

class RiwayatPendaftaranController extends Controller
{
  //
  protected $link = 'haji-umroh/riwayat-pendaftaran/';

  function __construct()
  {
    $this->setLink($this->link);
    $this->setTitle("Riwayat Daftar Haji");
    $this->setGroup("Haji & Umroh");
    $this->setModalSize("lg");
    $this->setBreadcrumb(['Haji & Umroh' => '#' , 'Riwayat Daftar Haji' => 'haji-umroh/riwayat-pendaftaran/']);

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
        'label' => 'Pemesan Haji / Umroh',
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
      [
        'data' => 'name',
        'name' => 'name',
        'label' => 'Nama',
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

    if(auth()->user()->status == 1010){
      $records = HajiDaftar::with('creator')->select('*');
    }else{
      $records = HajiDaftar::with('creator')->where('user_id',auth()->user()->id)->select('*');
    }
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
      return isset($record->jadwal) ? $record->jadwal->tgl_berangkat.' - '.$record->jadwal->tgl_pulang : '-' ;
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
          'datas' => [
            'titlemodal' => 'Ubah Data',
          ],
          'id'   => $record->id
        ]);
        if($record->status == 1){
          $btn .= $this->makeButton([
            'type' => 'approve',
            'tooltip' => 'Cancle Pendaftaran',
            'id'   => $record->id,
            'datas'   => [
              'status' => 4,
              'title' => 'Apa Anda Yakin',
              'text' => 'Ingin Membatalkan ?',
              'url' => url($this->link.'approve')
            ],
          ]);
        }

      return $btn;
    })
    ->rawColumns(['action','status'])
    ->make(true);
  }

  public function index()
  {
    return $this->render('backend.haji-umroh.riwayat-haji-daftar.index', [
      'mockup' => false,
      'record' => HajiDaftar::where('status',1)->get()
    ]);
  }

  public function create()
  {
    return $this->render('backend.haji-umroh.riwayat-haji-daftar.create');
  }

  public function store(HajiDaftarRequest $request)
  {
    try {
        $data = HajiDaftar::saveData($request);
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
    return $this->render('backend.haji-umroh.riwayat-haji-daftar.edit',[
        'record' => HajiDaftar::find($id),
    ]);
  }

  public function update(HajiDaftarRequest $request, $id)
  {
    try {
       $data = HajiDaftar::saveData($request);
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
    return $this->render('backend.haji-umroh.riwayat-haji-daftar.show',[
        'record' => HajiDaftar::find($id),
    ]);
  }

  public function destroy(Request $request, $id)
  {
    try {
      HajiDaftar::destroy($id);
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

  public function approve(Request $request){
    try {
        $data = HajiDaftar::saveData($request);
    }catch (\Exception $e) {
      return response([
        'status' => 'error',
        'message' => $e,
      ], 500);
    }

    return response([
      'status' => true,
    ]);
  }

}

<?php

namespace App\Http\Controllers\BackEnd\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Roles;
use App\Models\Master\Rajaongkir;
use App\Http\Requests\Master\AirportRequest;

use DataTables;
use Zipper;
use Carbon\Carbon;
use App\Helpers\HelpersPPOB;

class RajaongkirController extends Controller
{
  //
  protected $link = 'master/rajaongkir/';

  function __construct()
  {
    $this->setLink($this->link);
    $this->setTitle("Data Rajaongkir");
    $this->setGroup("Master");
    // $this->setSubGroup("PPOB");
    $this->setModalSize("lg");
    $this->setBreadcrumb(['Master' => '#','Data Rajaongkir' => 'master/rajaongkir/']);

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
        'data' => 'nama',
        'name' => 'nama',
        'label' => 'Name',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'code',
        'name' => 'code',
        'label' => ' Code',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'img',
        'name' => 'img',
        'label' => ' Img',
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
    $records = Rajaongkir::with('creator')->select('*');
    // dd($records);
    //Init Sort
    if (!isset(request()->order[0]['column'])) {
      // $records->->sort();
      $records->orderBy('created_at', 'desc');
    }
    //Filters
    if ($airport_name = $request->airport_name) {
      $records->where('nama', 'like', '%'.$airport_name.'%' );
    }

    if ($airport_code = $request->airport_code) {
      $records->where('code', 'like', '%'.$airport_code.'%' );
    }
    //Filters
    return Datatables::of($records)
    ->addColumn('num', function ($record) use ($request) {
      return $request->get('start');
    })
    ->addColumn('img', function ($record) {
      $gambar = ($record->attachment) ? url('storage/'.$record->attachment->url) : url('img/no-images.png');
      $img = '';
      $img .= '<img src="'.$gambar.'" width="50">';
      return $img;
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
    ->rawColumns(['action','img'])
    ->make(true);
  }

  public function index()
  {
    // dd(HelpersPPOB::cekData('',''));
    return $this->render('backend.master.rajaongkir.index', [
      'mockup' => false,
    ]);
  }

  public function create()
  {
    return $this->render('backend.master.rajaongkir.create');
  }

  public function edit($id)
  {
    return $this->render('backend.master.rajaongkir.edit',[
        'record' => Rajaongkir::find($id),
    ]);
  }

  public function store(Request $request)
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
    // dd($request->attachment);
    try {
        $data = Rajaongkir::saveData($request);
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

  public function update(Request $request, $id)
  {
    
    try {
       $data = Rajaongkir::saveData($request);
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
    return $this->render('backend.master.rajaongkir.show',[
        'record' => Rajaongkir::find($id),
    ]);
  }

  public function destroy(Request $request, $id)
  {
    try {
      Rajaongkir::destroy($id);
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

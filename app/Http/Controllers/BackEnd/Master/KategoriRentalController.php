<?php

namespace App\Http\Controllers\BackEnd\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Roles;
use App\Models\Master\KategoriRental;

use DataTables;
use Zipper;
use Carbon\Carbon;

class KategoriRentalController extends Controller
{
  //
  protected $link = 'master/rental/kategori-rental/';

  function __construct()
  {
    // $this->middleware('roleAdministration');
    $this->setLink($this->link);
    $this->setTitle("Kategori Rental");
    $this->setGroup("Master");
    $this->setSubGroup("Rental");
    $this->setModalSize("lg");
    $this->setBreadcrumb(['Master' => '#', 'Rental' => '#' , 'Kategori Rental' => 'master/rental/kategori-rental/']);

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
        'label' => 'Nama Kategori',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'img',
        'name' => 'img',
        'label' => 'Icon',
        'searchable' => false,
        'sortable' => true,
        'width' => '100px',
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
    $records = KategoriRental::with('creator')->select('*');
    // dd($records);
    //Init Sort
    if (!isset(request()->order[0]['column'])) {
      // $records->->sort();
      $records->orderBy('created_at', 'desc');
    }
    //Filters
    if ($name = $request->nama) {
      $records->where('nama', 'like', '%'.$name.'%' );
    }
    //Filters
    return Datatables::of($records)
    ->addColumn('num', function ($record) use ($request) {
      return $request->get('start');
    })

    ->addColumn('created_at', function ($record) {
      return $record->creationDate();
    })
    ->addColumn('created_by', function ($record) {
      return $record->creatorName();
    })
    ->addColumn('img', function ($record) {
      $gambar = ($record->attachments) ? url('storage/'.$record->attachments->url) : url('img/no-images.png');
      $img = '';
      $img .= '<img src="'.$gambar.'" width="50">';
      return $img;
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
    return $this->render('backend.master.kategori-rental.index', [
      'mockup' => false,
    ]);
  }

  public function create()
  {
    return $this->render('backend.master.kategori-rental.create');
  }

  public function store(Request $request)
  {
    $this->validate($request, [
        'nama' => 'required',
    ]);
    try {
        $data = KategoriRental::saveData($request);
    }catch (\Exception $e) {
      return response([
        'status' => 'error',
        'message' => $e,
      ], 500);
    }

    return response([
      'status' => true
    ]);
  }

  public function edit($id)
  {
    return $this->render('backend.master.kategori-rental.edit',[
        'record' => KategoriRental::find($id),
    ]);
  }

  public function update(Request $request, $id)
  {
    $this->validate($request, [
        'nama' => 'required',
    ]);
    try {
       $data = KategoriRental::saveData($request);
    }catch (\Exception $e) {
      return response([
        'status' => 'error',
        'message' => 'An error occurred!',
      ], 500);
    }

  }

  public function show($id)
  {
    // dd($id);
    return $this->render('backend.master.kategori-rental.show',[
        'record' => KategoriRental::find($id),
    ]);
  }

  public function destroy(Request $request, $id)
  {
    try {
      KategoriRental::destroy($id);
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

}

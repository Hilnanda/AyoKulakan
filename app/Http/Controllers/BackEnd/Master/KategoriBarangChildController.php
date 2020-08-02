<?php

namespace App\Http\Controllers\BackEnd\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Roles;
use App\Models\Master\KategoriBarangChild;

use DataTables;
use Zipper;
use Carbon\Carbon;

class KategoriBarangChildController extends Controller
{
  //
  protected $link = 'master/barang/child-kategori-barang/';

  function __construct()
  {
    $this->setLink($this->link);
    $this->setTitle("Child Kategori Barang");
    $this->setGroup("Master");
    $this->setSubGroup("Barang");
    $this->setModalSize("lg");
    $this->setBreadcrumb(['Master' => '#', 'Barang' => '#' , 'Child Kategori Barang' => 'master/barang/child-kategori-barang/']);

    // Header Grid Datatable
    $this->setTableStruct([
      [
        'data' => 'num',
        'name' => 'num',
        'label' => '#',
        'orderable' => false,
        'searchable' => false,
        'className' => "text-center",
        'width' => '40px',
      ],
      /* --------------------------- */
      [
        'data' => 'id_kategori',
        'name' => 'id_kategori',
        'label' => 'Nama Kategori',
        'className' => "text-center",
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
      ],
      [
        'data' => 'id_sub_kategori',
        'name' => 'id_sub_kategori',
        'label' => 'Nama Sub Kategori',
        'className' => "text-center",
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
      ],
      [
        'data' => 'nama',
        'name' => 'nama',
        'label' => 'Nama Sub Kategori',
        'className' => "text-center",
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
      ],
      [
        'data' => 'created_by',
        'name' => 'created_by',
        'label' => 'Created By',
        'searchable' => false,
        'sortable' => true,
        'className' => "text-center",
        'width' => '100px',
      ],
      [
        'data' => 'created_at',
        'name' => 'created_at',
        'label' => 'Created At',
        'searchable' => false,
        'sortable' => true,
        'className' => "text-center",
        'width' => '100px',
      ],
      [
        'data' => 'action',
        'name' => 'action',
        'label' => 'Aksi',
        'searchable' => false,
        'sortable' => false,
        'className' => "text-center",
        'width' => '100px',
      ]
    ]);
  }

  public function grid(Request $request)
  {
    $records = KategoriBarangChild::with('creator')->select('*');
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
    ->addColumn('id_kategori', function ($record) {
      return $record->subkategori->kategori->nama;
    })
    ->addColumn('id_sub_kategori', function ($record) {
      return $record->subkategori->nama;
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
    return $this->render('backend.master.kategori-barang-child.index', [
      'mockup' => false,
    ]);
  }

  public function create()
  {
    return $this->render('backend.master.kategori-barang-child.create');
  }

  public function store(Request $request)
  {
    $this->validate($request, [
        'id_kategori' => 'required',
        'id_sub_kategori' => 'required',
        'nama' => 'required',
    ]);
    try {
        $data = KategoriBarangChild::saveData($request);
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
    return $this->render('backend.master.kategori-barang-child.edit',[
        'record' => KategoriBarangChild::find($id),
    ]);
  }

  public function update(Request $request, $id)
  {
    $this->validate($request, [
        'id_kategori' => 'required',
        'id_sub_kategori' => 'required',
        'nama' => 'required',
    ]);
    try {
       $data = KategoriBarangChild::saveData($request);
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
    return $this->render('backend.master.kategori-barang-child.show',[
        'record' => KategoriBarangChild::find($id),
    ]);
  }

  public function destroy(Request $request, $id)
  {
    try {
      KategoriBarangChild::destroy($id);
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

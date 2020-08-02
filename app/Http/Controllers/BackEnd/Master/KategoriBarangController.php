<?php

namespace App\Http\Controllers\BackEnd\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Roles;
use App\Models\Master\KategoriBarang;

use DataTables;
use Zipper;
use Carbon\Carbon;

class KategoriBarangController extends Controller
{
  //
  protected $link = 'master/barang/kategori-barang/';

  function __construct()
  {
    // $this->middleware('roleAdministration');
    $this->setLink($this->link);
    $this->setTitle("Kategori Barang");
    $this->setGroup("Master");
    $this->setSubGroup("Barang");
    $this->setModalSize("lg");
    $this->setBreadcrumb(['Master' => '#', 'Barang' => '#' , 'Kategori Barang' => 'master/barang/kategori-barang/']);

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
        'data' => 'kat_nama',
        'name' => 'kat_nama',
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
    $records = KategoriBarang::with('creator')->select('*');
    // dd($records);
    //Init Sort
    if (!isset(request()->order[0]['column'])) {
      // $records->->sort();
      $records->orderBy('created_at', 'desc');
    }
    //Filters
    if ($name = $request->nama) {
      $records->where('kat_nama', 'like', '%'.$name.'%' );
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
    return $this->render('backend.master.kategori-barang.index', [
      'mockup' => false,
    ]);
  }

  public function create()
  {
    return $this->render('backend.master.kategori-barang.create');
  }

  public function store(Request $request)
  {
    $this->validate($request, [
        'kat_nama' => 'required',
    ]);
    try {
        $request['kat_nama'] = $request->kat_nama;
        $data = KategoriBarang::saveData($request);
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
    return $this->render('backend.master.kategori-barang.edit',[
        'record' => KategoriBarang::find($id),
    ]);
  }
  public function update(Request $request, $id)
  {
    $this->validate($request, [
        'kat_nama' => 'required',
    ]);
    // if ($request->hasFile('image')) {
    //  $image =  $request->file('image')->store('kategori');
    // }
    // KategoriBarang::where('id',$id)->update(
    //   [
    //     'nama' => $request->nama,
    //     'image' => $image
    //   ]);
    //   return redirect()->back();
    
    try {
       $data = KategoriBarang::saveData($request);
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
    return $this->render('backend.master.kategori-barang.show',[
        'record' => KategoriBarang::find($id),
    ]);
  }

  public function destroy(Request $request, $id)
  {
    try {
      KategoriBarang::destroy($id);
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

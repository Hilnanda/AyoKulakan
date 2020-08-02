<?php

namespace App\Http\Controllers\BackEnd\AllDataBarang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Roles;
use App\Models\Lapak\Lapak;
use App\Models\Barang\LapakBarang;
use App\Models\Barang\LapakKategoriBarang;
use App\Http\Requests\Lapak\LapakRequest;
use App\Http\Requests\Lapak\LapakBarangRequest;

use DataTables;
use Zipper;
use Carbon\Carbon;

class AllDataBarangController extends Controller
{
  //
  protected $link = 'data/data-barang/';

  function __construct()
  {
    // $this->middleware('roleAdministration');
    $this->setLink($this->link);
    $this->setTitle("Data Keseluruhan Barang");
    // $this->setGroup("Master");
    // $this->setSubGroup("Aplikasi");
    $this->setModalSize("lg");
    $this->setBreadcrumb(['Data Keseluruhan Barang' => 'data/data-barang/']);

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
        'data' => 'id_trans_lapak',
        'name' => 'id_trans_lapak',
        'label' => 'Nama Lapak',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'nama_barang',
        'name' => 'nama_barang',
        'label' => 'Nama Barang',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'id_kategori',
        'name' => 'id_kategori',
        'label' => 'Kategori Barang',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'id_sub_kategori',
        'name' => 'id_sub_kategori',
        'label' => 'Sub Kategori',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'id_child_kategori',
        'name' => 'id_child_kategori',
        'label' => 'Child Kategori',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'harga_barang',
        'name' => 'harga_barang',
        'label' => 'Harga Barang',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'stock_barang',
        'name' => 'stock_barang',
        'label' => 'Stock Barang',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'barang_terjual',
        'name' => 'barang_terjual',
        'label' => 'Jumlah Barang Terjual',
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
    $records = LapakBarang::with('creator')->select('*');
    // dd($records);
    //Init Sort
    if (!isset(request()->order[0]['column'])) {
      // $records->->sort();
      $records->orderBy('created_at', 'desc');
    }
    //Filters
    if ($name = $request->nama) {
      $records->where('nama_barang', 'like', '%'.$name.'%' );
    }

    if ($nama_lapak = $request->nama_lapak) {
        $records->whereHas('lapak',function($q) use($nama_lapak){
          $q->where('nama_lapak', 'like', '%'.$nama_lapak.'%' );
        })->get();
    }

    if ($id_kategori = $request->id_kategori) {
      $records->where('id_kategori', 'like', '%'.$id_kategori.'%' );
    }

    if ($id_sub_kategori = $request->id_sub_kategori) {
      $records->where('id_sub_kategori', 'like', '%'.$id_sub_kategori.'%' );
    }

    if ($id_child_kategori = $request->id_child_kategori) {
      $records->where('id_child_kategori', 'like', '%'.$id_child_kategori.'%' );
    }
    //Filters
    return Datatables::of($records)
    ->addColumn('num', function ($record) use ($request) {
      return $request->get('start');
    })
    // ->addColumn('deskripsi', function ($record) {
    //     return '<span class="ccount more" data-ccount="80">'.readMoreText(strip_tags($record->deskripsi),150).'</span>';
    // })
    ->addColumn('id_trans_lapak', function ($record) {
      return isset($record->lapak->nama_lapak) ? $record->lapak->nama_lapak : '-';
    })
    ->addColumn('id_kategori', function ($record) {
      return isset($record->kategoriBarang->nama) ? $record->kategoriBarang->nama : '-';
    })
    ->addColumn('id_sub_kategori', function ($record) {
      return isset($record->subKategoriBarang->nama) ? $record->subKategoriBarang->nama : '-';
    })
    ->addColumn('id_child_kategori', function ($record) {
      return isset($record->childKategoriBarang->nama) ? $record->childKategoriBarang->nama : '-';
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
    ->rawColumns(['action','deskripsi'])
    ->make(true);
  }

  public function index()
  {
    return $this->render('backend.all-barang.index', [
      'mockup' => false,
    ]);
  }

  public function create()
  {
    return $this->render('backend.all-barang.create');
  }

  public function store(LapakRequest $request)
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
    try {
        $data = LapakBarang::saveData($request);
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
    return $this->render('backend.all-barang.edit',[
        'record' => LapakBarang::find($id),
    ]);
  }

  public function update(LapakBarangRequest $request, $id)
  {
    if(!is_null($request->attachment[0])){
      $this->validate($request, [
          'attachment.*'=>'max:5120',
          'attachment.*' => 'image|mimes:jpg,png,jpeg',
          "attachment.*"=>"mimes:jpg,png,jpeg,gif"
      ],[
        'attachment.*.max' => 'Gambar tidak boleh lebih dari 5 MB',
        'attachment.*.mimes' => 'File Harus Berupa png, jpg, jpeg, gif',
        'attachment.*.dimensions' => 'Ukuran Kurang Gambar Harus 1070 X 490',
      ]);
    }

    try {
        $data = LapakBarang::saveData($request);
        // $dataKategori = LapakKategoriBarang::saveData($request);
    }catch (\Exception $e) {
      return response([
        'status' => 'error',
        'message' => $e,
      ], 500);
    }

    return response([
      'status' => true,
      'url' => true
      
    ]);
  }

  public function show($id)
  {
    // dd($id);
    return $this->render('backend.all-barang.show',[
        'record' => LapakBarang::find($id),
    ]);
  }

  public function destroy(Request $request, $id)
  {
    try {
      LapakBarang::destroy($id);
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

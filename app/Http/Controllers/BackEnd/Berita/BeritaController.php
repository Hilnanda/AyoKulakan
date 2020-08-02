<?php

namespace App\Http\Controllers\BackEnd\Berita;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Roles;
use App\Models\Berita\Berita;
use App\Http\Requests\Berita\BeritaRequest;

use DataTables;
use Zipper;
use Carbon\Carbon;

class BeritaController extends Controller
{
  //
  protected $link = 'berita/';

  function __construct()
  {
    $this->setLink($this->link);
    $this->setTitle("Berita");
    $this->setModalSize("lg");
    $this->setBreadcrumb(['Berita' => 'berita/']);

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
        'data' => 'judul',
        'name' => 'judul',
        'label' => 'Judul',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      
      [
        'data' => 'kategori',
        'name' => 'kategori',
        'label' => 'Kategori',
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
        'data' => 'gambar',
        'name' => 'gambar',
        'label' => 'Gambar',
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
    $records = Berita::with('creator')->select('*');
    // dd($records);
    //Init Sort
    if (!isset(request()->order[0]['column'])) {
      // $records->->sort();
      $records->orderBy('created_at', 'desc');
    }
    //Filters
    if ($name = $request->nama) {
      $records->where('judul', 'like', '%'.$name.'%' );
    }
    //Filters
    return Datatables::of($records)
    ->addColumn('num', function ($record) use ($request) {
      return $request->get('start');
    })
    ->addColumn('deskripsi', function ($record) {
        return '<span class="ccount more" data-ccount="80">'.readMoreText(strip_tags($record->deskripsi),150).'</span>';
    })
    ->addColumn('created_at', function ($record) {
      return $record->creationDate();
    })
    ->addColumn('created_by', function ($record) {
      return $record->creatorName();
    })
    ->addColumn('gambar', function ($record) {
      $img = '';
      if($record->attachments->count() > 0){
        $img .= '<img width="120" src="'.url('storage/'.$record->attachments->first()->url).'">';
      }else{
        $img .= '<img width="120" src="'.asset('img/no-images.png').'">';
      }
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
    ->rawColumns(['action','deskripsi','gambar'])
    ->make(true);
  }

  public function index()
  {
    return $this->render('backend.berita.index', [
      'mockup' => false,
    ]);
  }

  public function create()
  {
    return $this->render('backend.berita.create');
  }

  public function store(BeritaRequest $request)
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
        $data = Berita::saveData($request);
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
    return $this->render('backend.berita.edit',[
        'record' => Berita::find($id),
    ]);
  }

  public function update(BeritaRequest $request, $id)
  {
    // dd($request->all());
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
       $data = Berita::saveData($request);
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
    return $this->render('backend.berita.show',[
        'record' => Berita::find($id),
    ]);
  }

  public function destroy(Request $request, $id)
  {
    try {
      Berita::destroy($id);
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

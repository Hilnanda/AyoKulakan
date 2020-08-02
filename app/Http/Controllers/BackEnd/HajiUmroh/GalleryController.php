<?php

namespace App\Http\Controllers\BackEnd\HajiUmroh;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Roles;
use App\Models\HajiUmroh\Gallery;
use App\Http\Requests\HajiUmroh\GalleryRequest;

use DataTables;
use Zipper;
use Carbon\Carbon;

class GalleryController extends Controller
{
  //
  protected $link = 'haji-umroh/gallery/';

  function __construct()
  {
    $this->setLink($this->link);
    $this->setTitle("Gallery Photo");
    $this->setGroup("Haji & Umroh");
    $this->setModalSize("lg");
    $this->setBreadcrumb(['Haji & Umroh' => '#' , 'Gallery Photo' => 'haji-umroh/gallery/']);

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
        'data' => 'path',
        'name' => 'path',
        'label' => 'Photo',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'deskripsi',
        'name' => 'deskripsi',
        'label' => 'Deskripsi',
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
    $records = Gallery::with('creator')->select('*');
    // dd($records);
    //Init Sort
    if (!isset(request()->order[0]['column'])) {
      // $records->->sort();
      $records->orderBy('created_at', 'desc');
    }
    //Filters
    if ($name = $request->nama) {
      $records->where('deskripsi', 'like', '%'.$name.'%' );
    }
    //Filters
    return Datatables::of($records)
    ->addColumn('num', function ($record) use ($request) {
      return $request->get('start');
    })
    ->addColumn('deskripsi', function ($record) {
      return '<span class="ccount more" data-ccount="80">'.readMoreText(strip_tags($record->deskripsi),150).'</span>';
    })
     ->addColumn('path', function ($record) {
        return ($record->attachments->count() > 0) ? '<img src="'.url("storage/".$record->attachments->first()->url).'" alt="" width="50px">' : '<img src="'.asset('img/no-images.png').'" alt="" width="50px">';
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
    ->rawColumns(['action','deskripsi','path'])
    ->make(true);
  }

  public function index()
  {
    return $this->render('backend.haji-umroh.gallery.index', [
      'mockup' => false,
    ]);
  }

  public function create()
  {
    return $this->render('backend.haji-umroh.gallery.create');
  }

  public function store(GalleryRequest $request)
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
        $data = Gallery::saveData($request);
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
    return $this->render('backend.haji-umroh.gallery.edit',[
      'record' => Gallery::find($id),
    ]);
  }

  public function update(GalleryRequest $request, $id)
  {
    $c = $request->path;
    try {
      if($request->file){
          $path = $request->file->store('uploads/gallery', 'public');
          $request->path = $path;
          // dd(['before' => $c, 'after' => $request->path]);
      }
      $data = Gallery::saveData($request);
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
    return $this->render('backend.haji-umroh.gallery.show',[
      'record' => Gallery::find($id),
    ]);
  }

  public function destroy(Request $request, $id)
  {
    try {
      Gallery::destroy($id);
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

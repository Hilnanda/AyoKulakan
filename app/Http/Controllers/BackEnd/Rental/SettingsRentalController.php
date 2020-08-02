<?php

namespace App\Http\Controllers\BackEnd\Rental;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Roles;
use App\Models\Master\KategoriRental;
use App\Models\Master\KategoriRentalSub;
use App\Models\Rental\Rental;
use App\Models\Lapak\Lapak;

use App\Http\Requests\Rental\RentalRequest;

use DataTables;
use Zipper;
use Carbon\Carbon;

class SettingsRentalController extends Controller
{
  //
  protected $link = 'settings-rental/';

  function __construct()
  {
    // $this->middleware('roleAdministration');
    $this->setLink($this->link);
    $this->setTitle("Sewa");
    $this->setGroup("Master");
    $this->setSubGroup("Sewa");
    $this->setModalSize("lg");
    $this->setBreadcrumb(['Sewa' => 'settings-rental/']);

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
        'label' => 'Nama Sewa',
        'searchable' => false,
        'sortable' => true,
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'kategori_id',
        'name' => 'kategori_id',
        'label' => 'Kategori Sewa',
        'searchable' => false,
        'sortable' => true,
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'sub_kategori_id',
        'name' => 'sub_kategori_id',
        'label' => 'Sub Kategori Sewa',
        'searchable' => false,
        'sortable' => true,
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'created_by',
        'name' => 'created_by',
        'label' => 'Created By',
        'searchable' => false,
        'sortable' => true,
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'created_at',
        'name' => 'created_at',
        'label' => 'Created At',
        'searchable' => false,
        'sortable' => true,
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'action',
        'name' => 'action',
        'label' => 'Aksi',
        'searchable' => false,
        'sortable' => false,
        'width' => '150px',
        'className' => "",

      ]
    ]);
  }

  public function grid(Request $request)
  {
    $records = Rental::with('creator')->where('created_by', auth()->user()->id)->select('*');
    // dd($records);
    //Init Sort
    if (!isset(request()->order[0]['column'])) {
      // $records->->sort();
      $records->orderBy('created_at', 'desc');
    }
    //Filters
    if ($name = $request->nama) {
      $records->where('judul', 'like', '%' . $name . '%');
    }
    //Filters
    return Datatables::of($records)
      ->addColumn('num', function ($record) use ($request) {
        return $request->get('start');
      })
      ->addColumn('kategori_id', function ($record) {
        return $record->kategori->nama;
      })
      ->addColumn('sub_kategori_id', function ($record) {
        return isset($record->sub_kategori->nama) ? $record->sub_kategori->nama : '';
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
        $btn .= $this->makeButton([
          'type' => 'detail',
          'tooltip' => 'Detail',
          'id'   => $record->id,
          'datas'   => array('name' => 'feedback', 'titlemodal' => 'Detail'),
          'label'   => '<i class="fa fa-eye"></i>'
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
    $lapak = Lapak::where('created_by', auth()->user()->id)->first();
    return $this->render('backend.rental.index', [
      'mockup' => false,
      'lapak' => $lapak
    ]);
  }

  public function create()
  {
    return $this->render('backend.rental.create');
  }

  public function store(RentalRequest $request)
  {
    $this->validate($request, [
      'attachment.*' => 'max:5120',
      'attachment.*' => 'image|mimes:jpg,png,jpeg',
      "attachment.*" => "mimes:jpg,png,jpeg,gif"
    ], [
      'attachment.*.max' => 'Gambar tidak boleh lebih dari 5 MB',
      'attachment.*.mimes' => 'File Harus Berupa png, jpg, jpeg, gif',
      'attachment.*.dimensions' => 'Ukuran Kurang Gambar Harus 1070 X 490',
    ]);
    try {
      $harga_sewa = str_replace(".", "", $request->harga_sewa);
      $request['harga_sewa'] = $harga_sewa;

      $data = Rental::saveData($request);
    } catch (\Exception $e) {
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
    return $this->render('backend.rental.edit', [
      'record' => Rental::find($id),
    ]);
  }

  public function update(Request $request)
  {
    
    // if (!is_null($request->attachment[0])) {
    //   $this->validate($request, [
    //     'attachment.*' => 'max:5120',
    //     'attachment.*' => 'image|mimes:jpg,png,jpeg',
    //     "attachment.*" => "mimes:jpg,png,jpeg,gif"
    //   ], [
    //     'attachment.*.max' => 'Gambar tidak boleh lebih dari 5 MB',
    //     'attachment.*.mimes' => 'File Harus Berupa png, jpg, jpeg, gif',
    //     'attachment.*.dimensions' => 'Ukuran Kurang Gambar Harus 1070 X 490',
    //   ]);
    // }
   
    try {
      $harga_sewa = str_replace(".", "", $request->harga_sewa);
      $request['harga_sewa'] = $harga_sewa;
      $data = Rental::saveData($request);
    } catch (\Exception $e) {
      return response([
        'status' => 'error',
        'message' => $e,
      ], 500);
    }

    return response([
      'status' => true,
    ]);
  }

  public function show($id)
  {
    // dd($id);

    return $this->render('backend.rental.show', [
      'record' => Rental::find($id),
    ]);
  }

  public function destroy(Request $request, $id)
  {
    try {
      Rental::destroy($id);
    } catch (\Exception $e) {
      return response([
        'status' => 'error',
        'message' => 'An error occurred!',
      ], 500);
    }

    return response([
      'status' => true
    ]);
  }

  public function showFeedback($id)
  {
    // dd($id);
    $this->setTitle("Detail Rental");
    return $this->render('backend.rental.show-feedback', [
      'record' => Rental::find($id),
      'title' => 'Detail Data',
    ]);
  }
}

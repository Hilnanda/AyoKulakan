<?php

namespace App\Http\Controllers\BackEnd\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Roles;
use App\Models\Master\PPOBPulsaProvider;
use App\Http\Requests\Master\PPOBPulsaRequest;

use DataTables;
use Zipper;
use Carbon\Carbon;

class PPOBPulsaProviderController extends Controller
{
  //
  protected $link = 'master/ppob-provider/';

  function __construct()
  {
    $this->setLink($this->link);
    $this->setTitle("Data Provider");
    $this->setGroup("Master");
    $this->setSubGroup("PPOB");
    $this->setModalSize("lg");
    $this->setBreadcrumb(['Master' => '#', 'PPOB' => '#' , 'Data Provider' => 'master/ppob-provider/']);

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
        'data' => 'code',
        'name' => 'code',
        'label' => 'Code',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'type',
        'name' => 'type',
        'label' => 'Type Data',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'name',
        'name' => 'name',
        'label' => 'Operator',
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
    $records = PPOBPulsaProvider::with('creator')->select('*');
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
    return $this->render('backend.master.ppob.provider.index', [
      'mockup' => false,
    ]);
  }

  public function create()
  {
    return $this->render('backend.master.ppob.provider.create');
  }

  public function store(Request $request)
  {
    
    try {
        $data = PPOBPulsaProvider::saveData($request);
    }catch (\Exception $e) {
      return response([
        'status' => 'error',
        'message' => $e,
      ], 500);
    }

    return response([
      'status' => true,
      // 'url' => 'asdas'
      
    ]);
  }

  public function edit($id)
  {
    return $this->render('backend.master.ppob.provider.edit',[
        'record' => PPOBPulsaProvider::find($id),
    ]);
  }

  public function update(Request $request, $id)
  {
    
    try {
       $data = PPOBPulsaProvider::saveData($request);
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
    return $this->render('backend.master.ppob.provider.show',[
        'record' => PPOBPulsaProvider::find($id),
    ]);
  }

  public function destroy(Request $request, $id)
  {
    try {
      PPOBPulsaProvider::destroy($id);
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

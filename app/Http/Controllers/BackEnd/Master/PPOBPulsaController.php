<?php

namespace App\Http\Controllers\BackEnd\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Roles;
use App\Models\Master\PPOBPulsa;
use App\Http\Requests\Master\PPOBPulsaRequest;

use DataTables;
use Zipper;
use Carbon\Carbon;
use App\Helpers\HelpersPPOB;

class PPOBPulsaController extends Controller
{
  //
  protected $link = 'master/ppob-pulsa/';

  function __construct()
  {
    $this->setLink($this->link);
    $this->setTitle("Data Pulsa");
    $this->setGroup("Master");
    $this->setSubGroup("PPOB");
    $this->setModalSize("lg");
    $this->setBreadcrumb(['Master' => '#', 'PPOB' => '#' , 'Data Pulsa' => 'master/ppob-pulsa/']);

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
        'data' => 'pulsa_code',
        'name' => 'pulsa_code',
        'label' => 'Pulsa Code',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'pulsa_op',
        'name' => 'pulsa_op',
        'label' => 'Pulsa OP',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'pulsa_nominal',
        'name' => 'pulsa_nominal',
        'label' => 'Pulsa Nominal',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'pulsa_price',
        'name' => 'pulsa_price',
        'label' => 'Pulsa Price',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'pulsa_type',
        'name' => 'pulsa_type',
        'label' => 'Pulsa Type',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'masaaktif',
        'name' => 'masaaktif',
        'label' => 'Masa Aktif',
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
    $records = PPOBPulsa::with('creator')->select('*');
    // dd($records);
    //Init Sort
    if (!isset(request()->order[0]['column'])) {
      // $records->->sort();
      $records->orderBy('created_at', 'desc');
    }
    //Filters
    if ($name = $request->nama) {
      $records->where('pulsa_op', 'like', '%'.$name.'%' );
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
    // dd(HelpersPPOB::cekData('',''));
    return $this->render('backend.master.ppob.pulsa.index', [
      'mockup' => false,
    ]);
  }

  public function create()
  {
    return $this->render('backend.master.ppob.pulsa.create');
  }

  public function store(PPOBPulsaRequest $request)
  {
    
    try {
        $data = PPOBPulsa::saveData($request);
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
    return $this->render('backend.master.ppob.pulsa.edit',[
        'record' => PPOBPulsa::find($id),
    ]);
  }

  public function update(PPOBPulsaRequest $request, $id)
  {
    
    try {
       $data = PPOBPulsa::saveData($request);
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
    return $this->render('backend.master.ppob.pulsa.show',[
        'record' => PPOBPulsa::find($id),
    ]);
  }

  public function destroy(Request $request, $id)
  {
    try {
      PPOBPulsa::destroy($id);
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

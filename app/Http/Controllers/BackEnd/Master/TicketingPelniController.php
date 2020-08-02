<?php

namespace App\Http\Controllers\BackEnd\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Roles;
use App\Models\Master\TicketingPelni;
use App\Http\Requests\Master\TicketingPelniRequest;

use DataTables;
use Zipper;
use Carbon\Carbon;
use App\Helpers\HelpersPPOB;

class TicketingPelniController extends Controller
{
  //
  protected $link = 'master/pelni/';

  function __construct()
  {
    $this->setLink($this->link);
    $this->setTitle("Data Destinasi Pelni");
    $this->setGroup("Master");
    // $this->setSubGroup("PPOB");
    $this->setModalSize("lg");
    $this->setBreadcrumb(['Master' => '#','Data Destinasi Pelni' => 'master/pelni/']);

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
        'data' => 'name',
        'name' => 'name',
        'label' => 'Name',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
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
    $records = TicketingPelni::with('creator')->select('*');
    // dd($records);
    //Init Sort
    if (!isset(request()->order[0]['column'])) {
      // $records->->sort();
      $records->orderBy('created_at', 'desc');
    }
    //Filters
    if ($name = $request->name) {
      $records->where('name', 'like', '%'.$name.'%' );
    }

    if ($code = $request->code) {
      $records->where('code', 'like', '%'.$code.'%' );
    }

   
    //Filters
    return Datatables::of($records)
    ->addColumn('num', function ($record) use ($request) {
      return $request->get('start');
    })
    
    ->addColumn('created_at', function ($record) {
      return ($record->created_at) ? $record->creationDate() : '-';
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
    return $this->render('backend.master.ticketing.pelni.index', [
      'mockup' => false,
    ]);
  }

  public function edit($id)
  {
    return $this->render('backend.master.ticketing.pelni.edit',[
        'record' => TicketingPelni::find($id),
    ]);
  }

  public function update(TicketingPelniRequest $request, $id)
  {
    
    try {
       $data = TicketingPelni::saveData($request);
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
    return $this->render('backend.master.ticketing.pelni.show',[
        'record' => TicketingPelni::find($id),
    ]);
  }

  public function destroy(Request $request, $id)
  {
    try {
      TicketingPelni::destroy($id);
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

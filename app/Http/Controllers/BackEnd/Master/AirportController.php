<?php

namespace App\Http\Controllers\BackEnd\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Roles;
use App\Models\Master\TicketingAirport;
use App\Http\Requests\Master\AirportRequest;

use DataTables;
use Zipper;
use Carbon\Carbon;
use App\Helpers\HelpersPPOB;

class AirportController extends Controller
{
  //
  protected $link = 'master/airport/';

  function __construct()
  {
    $this->setLink($this->link);
    $this->setTitle("Data Airport");
    $this->setGroup("Master");
    // $this->setSubGroup("PPOB");
    $this->setModalSize("lg");
    $this->setBreadcrumb(['Master' => '#','Data Airport' => 'master/airport/']);

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
        'data' => 'airport_name',
        'name' => 'airport_name',
        'label' => 'Airport Name',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'airport_code',
        'name' => 'airport_code',
        'label' => 'Airport Code',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'location_name',
        'name' => 'location_name',
        'label' => 'Lokasi',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'country_name',
        'name' => 'country_name',
        'label' => 'Country Name',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'country_id',
        'name' => 'country_id',
        'label' => 'Country ID',
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
    $records = TicketingAirport::with('creator')->select('*');
    // dd($records);
    //Init Sort
    if (!isset(request()->order[0]['column'])) {
      // $records->->sort();
      $records->orderBy('created_at', 'desc');
    }
    //Filters
    if ($airport_name = $request->airport_name) {
      $records->where('airport_name', 'like', '%'.$airport_name.'%' );
    }

    if ($airport_code = $request->airport_code) {
      $records->where('airport_code', 'like', '%'.$airport_code.'%' );
    }

    if ($lokasi = $request->lokasi) {
      $records->where('location_name', 'like', '%'.$lokasi.'%' );
    }

    if ($country_name = $request->country_name) {
      $records->where('country_name', 'like', '%'.$country_name.'%' );
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
    return $this->render('backend.master.ticketing.airport.index', [
      'mockup' => false,
    ]);
  }

  public function edit($id)
  {
    return $this->render('backend.master.ticketing.airport.edit',[
        'record' => TicketingAirport::find($id),
    ]);
  }

  public function update(AirportRequest $request, $id)
  {
    
    try {
       $data = TicketingAirport::saveData($request);
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
    return $this->render('backend.master.ticketing.airport.show',[
        'record' => TicketingAirport::find($id),
    ]);
  }

  public function destroy(Request $request, $id)
  {
    try {
      TicketingAirport::destroy($id);
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

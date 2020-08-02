<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Master\KategoriBeritaRequest;
use App\Models\Master\KategoriBerita;
use Zipper;
use Carbon\Carbon;
use DataTables;
use Auth;
class DashboardController extends Controller
{
    //
  protected $link = 'dashboard/';

  function __construct()
  {
    $this->setLink($this->link);
    $this->setTitle("Dashboard");
    $this->setGroup("Dashboard");
    $this->setModalSize("mini");
    $this->setBreadcrumb(['Dashboard' => '#']);
    $this->setTableStruct([
      [
        'data' => 'num',
        'name' => 'num',
        'label' => '#',
        'orderable' => false,
        'searchable' => false,
        'className' => "center aligned",
        'width' => '40px',
      ],
      /* --------------------------- */
      [
        'data' => 'nama',
        'name' => 'nama',
        'label' => 'Nama Kategori',
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
        'className' => "center aligned",
        'width' => '100px',
      ],
      [
        'data' => 'created_at',
        'name' => 'created_at',
        'label' => 'Created At',
        'searchable' => false,
        'sortable' => true,
        'className' => "center aligned",
        'width' => '100px',
      ],
      [
        'data' => 'action',
        'name' => 'action',
        'label' => 'Aksi',
        'searchable' => false,
        'sortable' => false,
        'className' => "center aligned",
        'width' => '100px',
      ]
    ]);
  }

  public function grid(Request $request)
  {
    $records = KategoriBerita::with('creator')->select('*');
    // dd($records);
    //Init Sort
    if (!isset(request()->order[0]['column'])) {
      // $records->->sort();
      $records->orderBy('created_at', 'desc');
    }
    //Filters
    if ($nama = $request->nama) {
      $records->where('nama', 'like', '%'.$nama.'%' );
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
    ->rawColumns(['action'])
    ->make(true);
  }


  public function index()
  {
        // dd(formatStringMonth(Carbon::now()->format('m')));
    // dd('asd');
    if(Auth::check()){
      if(auth()->user())
      {
        $bulletin = NULL;
        $policy = NULL;
        $prosedur = NULL;
        $barChart = $this->barChart();
        $lineChart = $this->lineChart();

        return $this->render('backend.dashboard.index', [
          'mockup' => false,
          'bulletin' => $bulletin,
          'policy' => $policy,
          'prosedur' => $prosedur,
          'barChart' => $barChart,
          'lineChart' => $lineChart,
        ]);
      }
    }

    return redirect(url('/login'));
  }

  public function store(KategoriBeritaRequest $request)
  {

    try {

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

  public function create()
  {
    return $this->render('backend.dashboard.create');
  }

  public function edit($id)
  {
    return $this->render('backend.dashboard.edit',[
        'record' => KategoriBerita::find($id),
    ]);
  }

  public function update(Request $request, $id){
    try {

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

  public function destroy($id){
    try {
      KategoriBerita::destroy($id);
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

  public function notFoundPage(){
    return $this->render('failed.page', ['mockup' => false]);
  }

  public function barChart() {
    $chartjs = app()->chartjs
    ->name('barChart')
    ->type('horizontalBar')
    ->size(['width' => 400, 'height' => 200])
    ->labels(['January', 'February', 'March', 'April', 'May', 'June', 'July'])
    ->datasets([
      [
        "label" => "My First dataset",
        'backgroundColor' => "rgba(38, 185, 154, 0.31)",
        'borderColor' => "rgba(38, 185, 154, 0.7)",
        "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
        "pointBackgroundColor" => "rgba(38, 185, 154, 0.31)",
        "pointHoverBackgroundColor" => "#fff",
        "pointHoverBorderColor" => "rgba(220,220,220,1)",
        "pointStyle" => "star",
        'data' => [65, 59, 80, 81, 56, 55, 40],
      ],
      [
        "label" => "My Second dataset",
        'backgroundColor' => "#0f2233",
        'borderColor' => "#0f2233",
        "pointBorderColor" => "#0f2233",
        "pointBackgroundColor" => "#0f2233",
        "pointHoverBackgroundColor" => "#fff",
        "pointHoverBorderColor" => "#0f2233",
        "pointStyle" => "star",
        'data' => [12, 33, 44, 44, 55, 23, 40],
      ]
    ])
    ->options([
      "legend" => [
        "labels" => [
          "usePointStyle" => true,
          "fontSize" => 8,
        ],
        "position" => "bottom",
      ],
    ]);

    return $chartjs;
  }

  public function lineChart() {
    $chartjs = app()->chartjs
    ->name('lineChart')
    ->type('line')
    ->size(['width' => 400, 'height' => 200])
    ->labels(['January', 'February', 'March', 'April', 'May', 'June', 'July'])
    ->datasets([
      [
        "label" => "My First dataset",
        'backgroundColor' => "rgba(38, 185, 154, 0.31)",
        'borderColor' => "rgba(38, 185, 154, 0.7)",
        "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
        "pointBackgroundColor" => "rgba(38, 185, 154, 0.31)",
        "pointHoverBackgroundColor" => "#fff",
        "pointHoverBorderColor" => "rgba(220,220,220,1)",
        "pointStyle" => "star",
        'data' => [65, 59, 80, 81, 56, 55, 40],
      ],
      [
        "label" => "My Second dataset",
        'backgroundColor' => "#0f2233",
        'borderColor' => "#0f2233",
        "pointBorderColor" => "#0f2233",
        "pointBackgroundColor" => "#0f2233",
        "pointHoverBackgroundColor" => "#fff",
        "pointHoverBorderColor" => "#0f2233",
        "pointStyle" => "star",
        'data' => [12, 33, 44, 44, 55, 23, 40],
      ]
    ])
    ->options([
      "legend" => [
        "labels" => [
          "usePointStyle" => true,
          "fontSize" => 8,
        ],
        "position" => "bottom",
      ],
    ]);

    return $chartjs;
  }
}

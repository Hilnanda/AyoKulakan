<?php

namespace App\Http\Controllers\BackEnd\UserManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\UserManagement\UsersRequest;

use App\Models\User;
use App\Models\Users;
use Carbon\Carbon;

use DataTables;

class UsersPenggunaController extends Controller
{
  protected $link = 'user-management/users-pengguna/';

  function __construct()
  {
    $this->setLink($this->link);
    $this->setTitle("User Pembeli / Penjual / Kurir");
    $this->setGroup("User Management");
    $this->setModalSize("lg");
    $this->setBreadcrumb(['User Management' => '#', 'User Pembeli / Penjual / Kurir' => 'user-management/users-pengguna/']);

    // Header Grid Datatable
    $this->setTableStruct([
      [
        'data' => 'num',
        'name' => 'num',
        'label' => '#',
        'orderable' => false,
        'searchable' => false,
        'className' => "text-center",
        'width' => '40px',
      ],
      /* --------------------------- */
      [
        'data' => 'nama',
        'name' => 'nama',
        'label' => 'Name',
        'searchable' => false,
        'sortable' => true,

      ],
      [
        'data' => 'email',
        'name' => 'email',
        'label' => 'Email',
        'searchable' => false,
        'sortable' => true,

      ],
      [
        'data' => 'username',
        'name' => 'username',
        'label' => 'Username',
        'searchable' => false,
        'sortable' => true,

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
    $records = Users::ByUsersPengguna()->select('*');
    //Init Sort
    if (!isset(request()->order[0]['column'])) {
      // $records->->sort();
      $records->orderBy('created_at', 'desc');
    }

    //Filters
    if ($nama = $request->nama) {
      $records->where('nama', 'like', '%'.$nama.'%');
    }
    

    return Datatables::of($records)
    ->addColumn('num', function ($record) use ($request) {
      return $request->get('start');
    })
    ->addColumn('created_at', function ($record) {
      return $record->creationDate();
    })

    ->addColumn('action', function ($record) {
      $btn = '';
      //Edit
      $btn .= $this->makeButton([
        'type' => 'edit',
        'tooltip' => 'Edit',
        'id'   => $record->id
      ]);

      $btn .= $this->makeButton([
        'type' => 'delete',
        'id'   => $record->id
      ]);
      return $btn;
    })
    ->rawColumns(['tanggal', 'action','status'])
    ->make(true);
  }

  public function index()
  {
    return $this->render('backend.user-management.users-pengguna.index', [
      'mockup' => false,
    ]);
  }

  public function create()
  {
    return $this->render('backend.user-management.users-pengguna.create');
  }

  public function store(UsersRequest $request)
  {
    $this->validate($request, [
      'password' => 'required|string|min:6|confirmed',
    ]);
    try {
      $request['password'] = bcrypt($request['password']);
      $request['last_activity'] = Carbon::now()->toDateTimeString();
      $data = Users::saveData($request);
    }catch (\Exception $e) {
      return response([
        'status' => 'error',
        'message' => 'An error occurred!',
        'error' => $e->getMessage(),
      ], 500);
    }

    return response([
      'status' => true
    ]);
  }

  public function edit($id)
  {
    return $this->render('backend.user-management.users-pengguna.edit',[
      'record' => Users::find($id)
    ]);
  }

  public function update(UsersRequest $request, $id)
  {
    try {
      $request['last_activity'] = Carbon::now()->toDateTimeString();
      $data = Users::saveData($request);

    }catch (\Exception $e) {
      return response([
        'status' => 'error',
        'message' => 'An error occurred!',
        'error' => $e->getMessage(),
      ], 500);
    }

    return response([
      'status' => true
    ]);
  }

  public function destroy(Request $request, $id)
  {
    try {
      Users::destroy($id);
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
    return $this->render('backend.user-management.users-pengguna.show',[
      'record' => Users::find($id)
    ]);
  }

}

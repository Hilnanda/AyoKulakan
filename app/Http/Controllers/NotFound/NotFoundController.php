<?php

namespace App\Http\Controllers\NotFound;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Master\KategoriBeritaRequest;
use App\Models\Master\KategoriBerita;
use Zipper;
use Carbon\Carbon;
use DataTables;
class NotFoundController extends Controller
{
  public function index()
  {
      return $this->render('failed.404', [
        'mockup' => false,
      ]);
  }
}

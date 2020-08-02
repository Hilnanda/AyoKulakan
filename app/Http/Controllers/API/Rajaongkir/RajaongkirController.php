<?php

namespace App\Http\Controllers\API\Rajaongkir;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;

use App\Models\Users;
use App\Helpers\Rajaongkir\Rajaongkir;


class RajaongkirController extends Controller
{
    public function cost(Request $request)
    {
        try {
          $record = Rajaongkir::cost($request->all());
          return response([
            'status' => true,
            'result' => $record,
          ]);
        } catch (Exception $e) {
          return response([
            'status' => 'error',
            'message' => $e->getMessage(),
          ], 500);
        }
    }
}

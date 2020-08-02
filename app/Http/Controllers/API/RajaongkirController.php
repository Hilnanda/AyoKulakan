<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class RajaongkirController extends Controller
{
    public function province($id = null)
    {
        if ($id) {
            return RajaOngkir::provinsi()->find($id);
        }

        return RajaOngkir::provinsi()->all();
    }

    public function city($id = null)
    {
        if ($id) {
            return RajaOngkir::kota()->find($id);
        }

        return RajaOngkir::kota()->all();
    }

    public function cost(Request $request)
    {
        return RajaOngkir::ongkosKirim([
            'origin'          => $request->origin,
            'originType'      => 'city',
            'destination'     => $request->destination,
            'destinationType' => 'city',
            'weight'          => $request->weight,
            'courier'         => $request->courier
        ])->get();
    }
}

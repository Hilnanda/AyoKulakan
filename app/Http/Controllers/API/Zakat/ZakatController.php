<?php

namespace App\Http\Controllers\API\Zakat;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Roles;
use App\Models\HajiUmroh\BeritaTerbaru;
use App\Http\Requests\HajiUmroh\BeritaTerbaruRequest;
use App\Models\Master\GalleryZakat;
use DataTables;
use Zipper;
use Carbon\Carbon;

class ZakatController extends Controller
{

  public function gallery(Request $request)
  {
      $data = new QueryBuilder(new GalleryZakat, $request);
      $data = $data->build()->get();     
      return response()->json([
          'status' => true,
          'data' => $data,
          'total' => $data->count()
      ]);
  }

  public function galleryOne($id)
  {
       if($id){
            $data = GalleryZakat::with('attachments')->find($id);
                if($data == true){
                    return $this->messageApiJsonObject('true',$data);
                }else{
                    return $this->messageApiJsonObject();
                }
        }else{
            return response()->json([
                  'status' => false,
                  'message' => 'Data Tidak Ditemukan'
            ]);
        }
  }

  public function profesi(Request $request)
  {
    try {
        $pendapatan = $request->gaji_perbulan + $request->pendapatan_lain - $request->hutang;
        $besar_nishab = 522 * $request->beras;
        if ($pendapatan > $besar_nishab) {
          $jumlah_wajib_zakat = 0.025 * $pendapatan;
          return response([
            'pendapatan' => $pendapatan,
            'besar_nishab' => $besar_nishab,
            'hasil_nisab' => "Wajib Zakat : WAJIB",
            'wajib_zakat' => "Jumlah Zakat : ".$jumlah_wajib_zakat,
          ]);
         
        } else {
          $jumlah_wajib_zakat = 0;
          return response([
            'pendapatan' => $pendapatan,
            'besar_nishab' => $besar_nishab,
            'hasil_nisab' => "Wajib Zakat : TIDAK",
            'wajib_zakat' => "Jumlah Zakat : ".$jumlah_wajib_zakat,
          ]);
        }
    }catch (\Exception $e) {
      return response([
        'status' => 'error',
        'message' => $e,
      ], 500);
    }

  }

  public function maal(Request $request)
  {
    try {
      $total = $request->tabungan + $request->logam_mulia + $request->property_kendaraan + $request->harta_lainya - $request->hutang_jatuh_tempo;
      $total_nishab_maal = 85 * $request->emas;

      if ($total > $total_nishab_maal) {
          $jumlah_wajib_maal = 0.025 * $total;
          return response([
            'besar_nisab_maal' => $total_nishab_maal,
            'total' => $total,
            'hasil_nisab_maal' => "Wajib Zakat : WAJIB",
            'wajib_zakat_maal' => "Jumlah Zakat : ".$jumlah_wajib_maal,
          ]);

      } else {
        $jumlah_wajib_maal = 0;
          return response([
            'besar_nisab_maal' => $total_nishab_maal,
            'total' => $total,
            'hasil_nisab_maal' => "Wajib Zakat : TIDAK",
            'wajib_zakat_maal' => "Jumlah Zakat : ".$jumlah_wajib_maal,
          ]);
      }
    }catch (\Exception $e) {
      return response([
        'status' => 'error',
        'message' => $e,
      ], 500);
    }

  }


}

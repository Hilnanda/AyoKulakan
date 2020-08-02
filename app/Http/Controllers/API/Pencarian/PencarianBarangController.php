<?php

namespace App\Http\Controllers\API\Pencarian;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Lapak\Lapak;
use App\Models\Barang\LapakBarang;
use App\Models\Rental\Rental;

class PencarianBarangController extends Controller
{
    public function index(Request $request)
    {
        $record = LapakBarang::with('attachments','kategoriBarang','subKategoriBarang','childKategoriBarang')->select('*');
       
        if(isset($request->id_lapak)){
          $record->where('id_trans_lapak', $request->id_lapak);
        }

        if(isset($request->nama_barang)){
          $record->where('nama_barang', 'like', '%'.$request->nama_barang.'%' );
        }

        if(isset($request->kondisi_barang)){
          $record->where('kondisi_barang', 'like', '%'.$request->kondisi_barang.'%' );
        }

        if(isset($request->merek)){
          $record->where('merek', 'like', '%'.$request->merek.'%' );
        }

        if(isset($request->id_kategori)){
          $record->where('id_kategori', $request->id_kategori);
        }

        if(isset($request->id_sub_kategori)){
          $record->where('id_sub_kategori', $request->id_sub_kategori);
        }

        if(isset($request->id_child_kategori)){
          $record->where('id_child_kategori', $request->id_child_kategori);
        }

        if(isset($request->id_negara)){
          $record->where('lapak', function($q) use($request){
            $q->where('id_negara',$request->id_negara);
          });
        }

        if(isset($request->id_provinsi)){
          $record->where('lapak', function($q) use($request){
            $q->where('id_provinsi',$request->id_provinsi);
          });
        }

        if(isset($request->id_kota)){
          $record->where('lapak', function($q) use($request){
            $q->where('id_kota',$request->id_kota);
          });
        }

        if(isset($request->id_kecamatan)){
          $record->where('lapak', function($q) use($request){
            $q->where('id_kecamatan',$request->id_kecamatan);
          });
        }

        if(isset($request->min_harga) || isset($request->max_harga)){
          $min_harga = isset($request->min_harga) ? round($request->min_harga) : 0;
          $max_harga = isset($request->max_harga) ? round($request->max_harga) : round(1000000);
          // dd($min_harga,$max_harga);
          $record->whereBetween('harga_barang', [$min_harga,$max_harga]);
        }



        if ($order = $request->order) {
            if($order == 'date'){
              $record->orderBy('created_at', 'desc');
            }else if($order == 'price'){
              $record->orderBy('harga_barang', 'asc');
            }else if($order == 'price-desc'){
              $record->orderBy('harga_barang', 'desc');
            }
        }

        if(isset($request->limit)){
          $record->limit($request->limit);
        }

        if($record->count() > 0){
            return $this->messageApiJsonGet('true',$record);
        }else{
            return $this->messageApiJsonGet();
        }
    }

    public function indexRental(Request $request)
    {
        $record = Rental::with('kategori','sub_kategori','user','attachments')->select('*');


        if(isset($request->judul)){
          $record->where('judul', 'like', '%'.$request->judul.'%' );
        }

        if(isset($request->kategori_id)){
          $record->where('kategori_id', $request->kategori_id );
        }

        if(isset($request->sub_kategori_id)){
          $record->where('sub_kategori_id', $request->sub_kategori_id);
        }

        if(isset($request->min_harga) || isset($request->max_harga)){
          $min_harga = isset($request->min_harga) ? round($request->min_harga) : 0;
          $max_harga = isset($request->max_harga) ? round($request->max_harga) : round(1000000);
          // dd($min_harga,$max_harga);
          $record->whereBetween('harga_sewa', [$min_harga,$max_harga]);
        }



        if ($order = $request->order) {
            if($order == 'date'){
              $record->orderBy('created_at', 'desc');
            }else if($order == 'price'){
              $record->orderBy('harga_sewa', 'asc');
            }else if($order == 'price-desc'){
              $record->orderBy('harga_sewa', 'desc');
            }
        }

        if(isset($request->limit)){
          $record->limit($request->limit);
        }

        if($record->count() > 0){
            return $this->messageApiJsonGet('true',$record);
        }else{
            return $this->messageApiJsonGet();
        }
    }
}

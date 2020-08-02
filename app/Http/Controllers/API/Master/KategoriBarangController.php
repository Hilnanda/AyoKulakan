<?php

namespace App\Http\Controllers\API\Master;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;


use App\Models\User;
use App\Models\Master\KategoriBarang;
use App\Models\Master\KategoriBarangSub;
use App\Models\Master\KategoriBarangChild;


class KategoriBarangController extends Controller
{
    public function index(Request $request)
    {
        if(isset($request->nama_barang)){
            $data = KategoriBarang::with('attachments','creator','subkategori','subkategori.childkategori')->where('nama', 'LIKE' , '%'.$request->nama_barang.'%')->get();
            if($data->count() > 0){
                return $this->messageApiJson('true',$data);
            }else{
                return $this->messageApiJson();
            }
        }else if(isset($request->page)){
            $data = KategoriBarang::with('attachments','creator','subkategori','subkategori.childkategori')->paginate($request->page);
            if($data->count() > 0){
                return $this->messageApiJson('true',$data);
            }else{
                return $this->messageApiJson();
            }
        }else if(isset($request->id)){
            $data = KategoriBarang::with('attachments','creator','subkategori','subkategori.childkategori')->find($request->id);
                if($data == true){
                    return $this->messageApiJsonObject('true',$data);
                }else{
                    return $this->messageApiJsonObject();
                }
        }else{
            $data = KategoriBarang::with('attachments','creator','subkategori','subkategori.childkategori')->get();
                if($data->count() > 0){
                    return $this->messageApiJson('true',$data);
                }else{
                    return $this->messageApiJson();
                }
        }
    }

     public function subBarang(Request $request)
    {
        if(isset($request->nama_barang)){
            $data = KategoriBarangSub::with('attachments','creator','childkategori')->where('nama', 'LIKE' , '%'.$request->nama_barang.'%')->get();
            if($data->count() > 0){
                return $this->messageApiJson('true',$data);
            }else{
                return $this->messageApiJson();
            }
        }else if(isset($request->page)){
            $data = KategoriBarangSub::with('attachments','creator','childkategori')->paginate($request->page);
            if($data->count() > 0){
                return $this->messageApiJson('true',$data);
            }else{
                return $this->messageApiJson();
            }
        }else if(isset($request->id)){
            $data = KategoriBarangSub::with('attachments','creator','childkategori')->find($request->id);
                if($data == true){
                    return $this->messageApiJsonObject('true',$data);
                }else{
                    return $this->messageApiJsonObject();
                }
        }else if(isset($request->id_kategori)){
            $data = KategoriBarangSub::with('attachments','creator','childkategori')->where('id_kategori',$request->id_kategori)->get();
                if($data->count() > 0){
                    return $this->messageApiJson('true',$data);
                }else{
                    return $this->messageApiJson();
                }
        }else{
            $data = KategoriBarangSub::with('attachments','creator','childkategori')->get();
                if($data->count() > 0){
                    return $this->messageApiJson('true',$data);
                }else{
                    return $this->messageApiJson();
                }
        }
    }

     public function childBarang(Request $request)
    {
        if(isset($request->nama_barang)){
            $data = KategoriBarangChild::with('creator')->where('nama', 'LIKE' , '%'.$request->nama_barang.'%')->get();
            if($data->count() > 0){
                return $this->messageApiJson('true',$data);
            }else{
                return $this->messageApiJson();
            }
        }else if(isset($request->page)){
            $data = KategoriBarangChild::with('creator')->paginate($request->page);
            if($data->count() > 0){
                return $this->messageApiJson('true',$data);
            }else{
                return $this->messageApiJson();
            }
        }else if(isset($request->id)){
            $data = KategoriBarangChild::with('creator')->find($request->id);
                if($data == true){
                    return $this->messageApiJsonObject('true',$data);
                }else{
                    return $this->messageApiJsonObject();
                }
        }else if(isset($request->id_sub_kategori)){
            $data = KategoriBarangChild::with('creator')->where('id_sub_kategori',$request->id_sub_kategori)->get();
                if($data->count() > 0){
                    return $this->messageApiJson('true',$data);
                }else{
                    return $this->messageApiJson();
                }
        }else{
            $data = KategoriBarangChild::with('creator')->get();
                if($data->count() > 0){
                    return $this->messageApiJson('true',$data);
                }else{
                    return $this->messageApiJson();
                }
        }
    }
}

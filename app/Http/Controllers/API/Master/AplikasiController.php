<?php

namespace App\Http\Controllers\API\Master;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;


use App\Models\User;
use App\Models\Master\AplikasiTentang;
use App\Models\Master\AplikasiPanduan;
use App\Models\Master\AplikasiSosial;


class AplikasiController extends Controller
{
    public function index(Request $request)
    {
        $data = AplikasiTentang::with('creator')->where('kategori','Tentang')->first();
        if($data){
            $data->deskripsi = strip_tags($data->deskripsi);
        }
        if($data == true){
            return $this->messageApiJsonObject('true',$data);
        }else{
            return $this->messageApiJsonObject();
        }
    }

    public function aturanPengguna(Request $request)
    {
        $data = AplikasiTentang::with('creator')->where('kategori','Aturan Pengguna')->first();
        if($data){
            $data->deskripsi = strip_tags($data->deskripsi);
        }
        if($data == true){
            return $this->messageApiJsonObject('true',$data);
        }else{
            return $this->messageApiJsonObject();
        }
    }

    public function kebijakanPrivasi(Request $request)
    {
        $data = AplikasiTentang::with('creator')->where('kategori','Kebijakan Privasi')->first();
        if($data){
            $data->deskripsi = strip_tags($data->deskripsi);
        }
        if($data == true){
            return $this->messageApiJsonObject('true',$data);
        }else{
            return $this->messageApiJsonObject();
        }
    }

    public function identitasBrand(Request $request)
    {
        $data = AplikasiTentang::with('creator')->where('kategori','identitasBrand')->first();
        if($data){
            $data->deskripsi = strip_tags($data->deskripsi);
        }
        if($data == true){
            return $this->messageApiJsonObject('true',$data);
        }else{
            return $this->messageApiJsonObject();
        }
    }

    public function kontakKami(Request $request)
    {
        $data = AplikasiTentang::with('creator')->where('kategori','Kontak Kami')->first();
        if($data){
            $data->deskripsi = strip_tags($data->deskripsi);
        }
        if($data == true){
            return $this->messageApiJsonObject('true',$data);
        }else{
            return $this->messageApiJsonObject();
        }
    }

    public function panduanPelapak(Request $request)
    {
        $data = AplikasiPanduan::with('creator')->where('kategori','Panduan Pelapak')->first();
        if($data){
            $data->deskripsi = strip_tags($data->deskripsi);
        }
        if($data == true){
            return $this->messageApiJsonObject('true',$data);
        }else{
            return $this->messageApiJsonObject();
        }
    }

    public function panduanPembeli(Request $request)
    {
        $data = AplikasiPanduan::with('creator')->where('kategori','Panduan Pembeli')->first();
        if($data){
            $data->deskripsi = strip_tags($data->deskripsi);
        }
        if($data == true){
            return $this->messageApiJsonObject('true',$data);
        }else{
            return $this->messageApiJsonObject();
        }
    }

    public function bukaBantuan(Request $request)
    {
        $data = AplikasiPanduan::with('creator')->where('kategori','Buka Bantuan')->first();
        if($data){
            $data->deskripsi = strip_tags($data->deskripsi);
        }
        if($data == true){
            return $this->messageApiJsonObject('true',$data);
        }else{
            return $this->messageApiJsonObject();
        }
    }

    public function panduanHaji(Request $request)
    {
        $data = AplikasiPanduan::with('creator')->where('kategori','Panduan Haji & Umroh')->first();
        if($data){
            $data->deskripsi = strip_tags($data->deskripsi);
        }
        if($data == true){
            return $this->messageApiJsonObject('true',$data);
        }else{
            return $this->messageApiJsonObject();
        }
    }

    public function panduanKurir(Request $request)
    {
        $data = AplikasiPanduan::with('creator')->where('kategori','Panduan Kurir')->first();
        if($data){
            $data->deskripsi = strip_tags($data->deskripsi);
        }
        if($data == true){
            return $this->messageApiJsonObject('true',$data);
        }else{
            return $this->messageApiJsonObject();
        }
    }

    public function sosialMedia(Request $request)
    {
        if($request->sosial_media){
            $data = AplikasiSosial::with('creator')->where('sosial_media',$request->sosial_media)->first();
            if($data == true){
                return $this->messageApiJson('true',$data);
            }else{
                return $this->messageApiJson();
            }    
        }else if(!isset($request->sosial_media)){
            $data = AplikasiSosial::with('creator')->get();
            if($data == true){
                return $this->messageApiJson('true',$data);
            }else{
                return $this->messageApiJson();
            }
        }else{
            return response()->json([
              'status' => false,
              'message' => 'Data Tidak Ditemukan'
          ]);
        }
        
    }
}

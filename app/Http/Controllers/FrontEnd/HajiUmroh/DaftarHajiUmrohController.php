<?php

namespace App\Http\Controllers\FrontEnd\HajiUmroh;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HajiUmroh\HajiPaket;
use App\Models\HajiUmroh\HajiJadwal;
use App\Models\HajiUmroh\HajiDaftar;
use App\Http\Requests\HajiUmroh\HajiDaftarRequest;

use App\Models\Barang\FavoritBarang;
use App\Models\Master\AplikasiPanduan;
use App\Models\User;

use Zipper;
use Carbon\Carbon;
class DaftarHajiUmrohController extends Controller
{
    //
    protected $link = 'daftar-haji-umroh/';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Daftar Haji & Umroh");
        $this->setGroup("Daftar Haji & Umroh");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Daftar Haji & Umroh' => '#']);
    }

    public function index()
    {     
        $record =[];

        $record =['paket' => HajiPaket::all(), 'jadwal' => HajiJadwal::all(),'detail' => AplikasiPanduan::where('kategori','Panduan Haji & Umroh')->first()];

        return $this->render('frontend.daftar-haji-umroh.index', [
            'mockup' => false,
            'record' => $record,
        ]);
          
    }


    public function paket($id)
    {     
        if($id){
            $data = HajiPaket::find($id);
            if ($data) {
                return $data;
            }else{
                return notFoundPage();
            }
        }
    }

    public function jadwal($id)
    {     
        if($id){
            $data = HajiJadwal::find($id);
            if ($data) {
                return $data;
            }else{
                return notFoundPage();
            }
        }
    }

    public function store(HajiDaftarRequest $request)
    {
       try {
            $request['status'] = 1;
            $data = HajiDaftar::saveData($request);

            // $recordFav = new FavoritBarang;
            // $dataFav['user_id'] = auth()->user()->id;
            // $dataFav['id_barang'] = $data->id;
            // $dataFav['form_id'] = $data->id;
            // $dataFav['form_type'] = 'img_daftar_haji';
            // $dataFav['jumlah_barang'] = 1;
            // $recordFav->fill($dataFav);
            // $recordFav->save();
        }catch (\Exception $e) {
            return response([
                'status' => 'error',
                'message' => $e,
            ], 500);
        }

         return response([
            'status' => true,
            'url' => $this->link
        ]);
    }


    public function notFoundPage(){
        return $this->render('failed.page', ['mockup' => false]);
    }
}

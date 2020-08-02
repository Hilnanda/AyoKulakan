<?php

namespace App\Http\Controllers\FrontEnd\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Berita\Berita;
use App\Models\Barang\LapakBarang;
use App\Models\Master\KategoriBarang;
use App\Models\Master\KategoriBarangSub;
use App\Models\Master\KategoriRental;
use App\Models\Master\PPOBPulsaProvider;
use App\Models\Master\KategoriRentalSub;
use App\Models\User;
use App\Helpers\HelpersPPOB;
use App\Helpers\HelpersTiketPesawat;

use Zipper;
use Carbon\Carbon;
use App\Models\TransaksiAmpas\TransaksiAmpase;
class HomeController extends Controller
{
    //
    protected $link = 'fbarang/';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Home");
        $this->setGroup("Home");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Home' => '#']);
    }

    public function index()
    {
        // dd(HelpersTiketPesawat::TiketGetKabKot(12));
          // dd(HelpersPPOB::checkBooking('304'));
          // dd(HelpersPPOB::bookingAccept('306'));
          // dd(TransaksiAmpase::with('kereta')->get());
          $user = User::where('nama','ayokulakan')->first();
          $kategoriBarangPertanian = KategoriBarang::where('kat_nama','LIKE' , '%Pertanian%')->first();
          $kategoriBarangPerkebunan = KategoriBarang::where('kat_nama','LIKE' , '%Perkebunan%')->first();
          $kategoriBarangPerikanan= KategoriBarang::where('kat_nama','LIKE' , '%Perikanan%')->first();
          // dd($kategoriBarangPerkebunan->id);

          $perikanan = [];
          $pertanianPerkebunan = [];
          if($kategoriBarangPerikanan){
            $pertanianPerkebunan = LapakBarang::with('kategoriBarang')->whereIn('id_kategori',[$kategoriBarangPertanian->id,$kategoriBarangPerkebunan->id])->get();
            $perikanan = LapakBarang::with('kategoriBarang','feedback')->where('id_kategori',$kategoriBarangPerikanan->id)->get();
          }
          $date = Carbon::now();
          // $lapakBaru = LapakBarang::with('kategoriBarang','lapak')->whereHas('lapak',function($q) use($date){
          //   $q->whereMonth('created_at',$date->format('m'))->whereYear('created_at',$date->format('Y'));
          // })->get();
          $all = LapakBarang::with('kategoriBarang','lapak')->orderBy('created_at','desc')->get();
          $kategoriRental = KategoriRental::get();
          $subkategori = KategoriBarangSub::get();
          $ppobGame = PPOBPulsaProvider::where('type','game')->get();
          $iklanDisc = Berita::whereIn('kategori',['Diskon','Iklan'])->get();

          return $this->render('frontend.home.index', [
            'mockup' => false,
            'record' => Berita::where('kategori',['Slider','Berita'])->limit(20)->get(),
            'pertanianPerkebunan' => $pertanianPerkebunan,
            'perikanan' => $perikanan,
            'iklanDisc' => $iklanDisc,
            'kategoriRental' => $kategoriRental,
            'subkategori' => $subkategori,
            'all' => $all,
            'ppobGame' => $ppobGame,
          ]);

    }

    public function show(Request $request, $id, $name){
      // dd(LapakBarang::find($id)->feedback()->where('form_type','=','img_barang')->get());
      return $this->render('frontend.home.show', [
        'mockup' => false,
        'record' => LapakBarang::find($id),
      ]);
    }

    public function notFoundPage(){
        return $this->render('failed.page', ['mockup' => false]);
    }

}

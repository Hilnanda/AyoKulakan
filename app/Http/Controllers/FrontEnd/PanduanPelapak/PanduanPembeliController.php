<?php

namespace App\Http\Controllers\FrontEnd\PanduanPelapak;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\AplikasiPanduan;

use App\Models\User;

use Zipper;
use Carbon\Carbon;
class PanduanPembeliController extends Controller
{
    //
    protected $link = '/panduan-pembeli';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Panduan Pembeli");
        $this->setGroup("Panduan Pembeli");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Panduan Pembeli' => '#']);
    }

    public function index()
    {     
          $record = AplikasiPanduan::where('kategori','Panduan Pembeli')->first();
          

          return $this->render('frontend.panduan-pembeli.index', [
            'mockup' => false,
            'record' => $record,
          ]);
          
    }

    public function indexWebViews()
    {     
          $record = AplikasiPanduan::where('kategori','Panduan Pembeli')->first();
          

          return $this->render('frontend.panduan-pembeli.index-webviews', [
            'mockup' => false,
            'record' => $record,
          ]);
          
    }

    public function show(Request $request, $id, $name){
      
      return $this->render('frontend.panduan-pembeli.show', [
        'mockup' => false,
        'record' => LapakBarang::find($id),
      ]);
    }

    public function notFoundPage(){
        return $this->render('failed.page', ['mockup' => false]);
    }
}

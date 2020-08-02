<?php

namespace App\Http\Controllers\FrontEnd\PanduanPelapak;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\AplikasiPanduan;

use App\Models\User;

use Zipper;
use Carbon\Carbon;
class PanduanPelapakController extends Controller
{
    //
    protected $link = '/panduan-pelapak';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Panduan Pelapak");
        $this->setGroup("Panduan Pelapak");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Panduan Pelapak' => '#']);
    }

    public function index()
    {     
          $record = AplikasiPanduan::where('kategori','Panduan Pelapak')->first();
          

          return $this->render('frontend.panduan-pelapak.index', [
            'mockup' => false,
            'record' => $record,
          ]);
          
    }

    public function indexWebViews()
    {     
          $record = AplikasiPanduan::where('kategori','Panduan Pelapak')->first();
          

          return $this->render('frontend.panduan-pelapak.index-webviews', [
            'mockup' => false,
            'record' => $record,
          ]);
          
    }

    public function show(Request $request, $id, $name){
      
      return $this->render('frontend.panduan-pelapak.show', [
        'mockup' => false,
        'record' => LapakBarang::find($id),
      ]);
    }

    public function notFoundPage(){
        return $this->render('failed.page', ['mockup' => false]);
    }
}

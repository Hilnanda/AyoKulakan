<?php

namespace App\Http\Controllers\FrontEnd\PanduanPelapak;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\AplikasiPanduan;

use App\Models\User;

use Zipper;
use Carbon\Carbon;
class PanduanHajiUmrohController extends Controller
{
    //
    protected $link = '/panduan';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Panduan Haji & Umroh");
        $this->setGroup("Panduan Haji & Umroh");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Panduan Haji & Umroh' => '#']);
    }

    public function index()
    {     
          $record = AplikasiPanduan::where('kategori','Panduan Haji & Umroh')->first();
          

          return $this->render('frontend.panduan-haji.index', [
            'mockup' => false,
            'record' => $record,
          ]);
          
    }

    public function indexWebViews()
    {     
          $record = AplikasiPanduan::where('kategori','Panduan Haji & Umroh')->first();
          

          return $this->render('frontend.panduan-haji.index-webviews', [
            'mockup' => false,
            'record' => $record,
          ]);
          
    }

    public function show(Request $request, $id, $name){
      
      return $this->render('frontend.panduan-haji.show', [
        'mockup' => false,
        'record' => LapakBarang::find($id),
      ]);
    }

    public function notFoundPage(){
        return $this->render('failed.page', ['mockup' => false]);
    }
}

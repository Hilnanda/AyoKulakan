<?php

namespace App\Http\Controllers\FrontEnd\PanduanPelapak;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\AplikasiPanduan;

use App\Models\User;

use Zipper;
use Carbon\Carbon;

class PanduanKurirController extends Controller
{
    //
    protected $link = '/panduan-kurir';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Panduan Kurir");
        $this->setGroup("Panduan Kurir");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Panduan Kurir' => '#']);
    }

    public function index()
    {     
          $record = AplikasiPanduan::where('kategori','Panduan Kurir')->first();
          

          return $this->render('frontend.panduan-kurir.index', [
            'mockup' => false,
            'record' => $record,
          ]);
          
    }

    public function indexWebViews()
    {     
          $record = AplikasiPanduan::where('kategori','Panduan Kurir')->first();
          

          return $this->render('frontend.panduan-kurir.index-webviews', [
            'mockup' => false,
            'record' => $record,
          ]);
          
    }

    public function notFoundPage(){
        return $this->render('failed.page', ['mockup' => false]);
    }
}

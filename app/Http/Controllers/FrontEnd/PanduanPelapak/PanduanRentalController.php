<?php

namespace App\Http\Controllers\FrontEnd\PanduanPelapak;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\AplikasiPanduan;

use App\Models\User;

use Zipper;
use Carbon\Carbon;

class PanduanRentalController extends Controller
{
    //
    protected $link = '/rental-perental';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Panduan Rental & Perental");
        $this->setGroup("Panduan Rental & Perental");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Panduan Rental & Perental' => '#']);
    }

    public function index()
    {     
          $record = AplikasiPanduan::where('kategori','Panduan Rental')->first();
          

          return $this->render('frontend.panduan-rental.index', [
            'mockup' => false,
            'record' => $record,
          ]);
          
    }

    public function indexWebViews()
    {     
          $record = AplikasiPanduan::where('kategori','Panduan Rental')->first();
          

          return $this->render('frontend.panduan-rental.index-webviews', [
            'mockup' => false,
            'record' => $record,
          ]);
          
    }

    public function show(Request $request, $id, $name){
      
      return $this->render('frontend.panduan-rental.show', [
        'mockup' => false,
        'record' => LapakBarang::find($id),
      ]);
    }

    public function notFoundPage(){
        return $this->render('failed.page', ['mockup' => false]);
    }
}

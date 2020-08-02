<?php

namespace App\Http\Controllers\FrontEnd\Tentang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\AplikasiTentang;

use App\Models\User;

use Zipper;
use Carbon\Carbon;
class TentangController extends Controller
{
    //
    protected $link = '/tentang';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Tentang");
        $this->setGroup("Tentang");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Tentang' => '#']);
    }

    public function index()
    {     
          $record = AplikasiTentang::where('kategori','Tentang')->first();
          

          return $this->render('frontend.tentang.index', [
            'mockup' => false,
            'record' => $record,
          ]);
          
    }

    public function show(Request $request, $id, $name){
      
      return $this->render('frontend.tentang.show', [
        'mockup' => false,
        'record' => LapakBarang::find($id),
      ]);
    }

    public function notFoundPage(){
        return $this->render('failed.page', ['mockup' => false]);
    }
}

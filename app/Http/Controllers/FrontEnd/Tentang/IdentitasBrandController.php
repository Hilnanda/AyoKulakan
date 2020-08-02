<?php

namespace App\Http\Controllers\FrontEnd\Tentang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\AplikasiTentang;

use App\Models\User;

use Zipper;
use Carbon\Carbon;
class IdentitasBrandController extends Controller
{
    //
    protected $link = '/identitas-brand';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Identitas Brand");
        $this->setGroup("Identitas Brand");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Identitas Brand' => '#']);
    }

    public function index()
    {     
          $record = AplikasiTentang::where('kategori','Identitas Brand')->first();
          

          return $this->render('frontend.identitas-brand.index', [
            'mockup' => false,
            'record' => $record,
          ]);
          
    }

    public function show(Request $request, $id, $name){
      
      return $this->render('frontend.identitas-brand.show', [
        'mockup' => false,
        'record' => LapakBarang::find($id),
      ]);
    }

    public function notFoundPage(){
        return $this->render('failed.page', ['mockup' => false]);
    }
}

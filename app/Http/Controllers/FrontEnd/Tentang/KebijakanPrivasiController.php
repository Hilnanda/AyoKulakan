<?php

namespace App\Http\Controllers\FrontEnd\Tentang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\AplikasiTentang;

use App\Models\User;

use Zipper;
use Carbon\Carbon;
class KebijakanPrivasiController extends Controller
{
    //
    protected $link = '/kebijakan-privasi';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Kebijakan Privasi");
        $this->setGroup("Kebijakan Privasi");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Kebijakan Privasi' => '#']);
    }

    public function index()
    {     
          $record = AplikasiTentang::where('kategori','Kebijakan Privasi')->first();
          

          return $this->render('frontend.kebijakan-privasi.index', [
            'mockup' => false,
            'record' => $record,
            'tentang' => 'true',
          ]);
          
    }

    public function show(Request $request, $id, $name){
      
      return $this->render('frontend.kebijakan-privasi.show', [
        'mockup' => false,
        'record' => LapakBarang::find($id),
      ]);
    }

    public function notFoundPage(){
        return $this->render('failed.page', ['mockup' => false]);
    }
}

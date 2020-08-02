<?php

namespace App\Http\Controllers\FrontEnd\Tentang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\AplikasiTentang;

use App\Models\User;

use Zipper;
use Carbon\Carbon;
class FaqController extends Controller
{
    //
    protected $link = '/faq';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("FAQ");
        $this->setGroup("FAQ");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['FAQ' => '#']);
    }

    public function index()
    {     
          $record = AplikasiTentang::where('kategori','FAQ')->first();
          

          return $this->render('frontend.faq.index', [
            'mockup' => false,
            'record' => $record,
          ]);
          
    }

    public function show(Request $request, $id, $name){
      
      return $this->render('frontend.faq.show', [
        'mockup' => false,
        'record' => LapakBarang::find($id),
      ]);
    }

    public function notFoundPage(){
        return $this->render('failed.page', ['mockup' => false]);
    }
}

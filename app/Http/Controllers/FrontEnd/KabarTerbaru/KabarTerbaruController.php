<?php

namespace App\Http\Controllers\FrontEnd\KabarTerbaru;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Berita\Berita;


use App\Models\User;

use Zipper;
use Carbon\Carbon;
class KabarTerbaruController extends Controller
{
    //
    protected $link = 'kabar-terbaru/';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Kabar Terbaru");
        $this->setGroup("Kabar Terbaru");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Kabar Terbaru' => '#']);
    }

    public function index(Request $request)
    {
          $record = Berita::paginate(5);
          $diskon = Berita::where('kategori','Diskon')->orderBy('created_at','desc')->limit(10)->get();
          $promo = Berita::where('kategori','Promosi')->orderBy('created_at','desc')->limit(10)->get();

          return $this->render('frontend.kabar-terbaru.index', [
            'mockup' => false,
            'record' => $record,
            'diskon' => $diskon,
            'promo' => $promo,
          ]);

    }

    public function show(Request $request, $id, $name){
      $record = Berita::find($id);
      $diskon = Berita::where('kategori','Diskon')->orderBy('created_at','desc')->limit(5)->get();
      $promo = Berita::where('kategori','Promosi')->orderBy('created_at','desc')->limit(5)->get();

      return $this->render('frontend.kabar-terbaru.show', [
        'mockup' => false,
        'record' => $record,
        'diskon' => $diskon,
        'promo' => $promo,
      ]);
    }

    public function notFoundPage(){
        return $this->render('failed.page', ['mockup' => false]);
    }
}

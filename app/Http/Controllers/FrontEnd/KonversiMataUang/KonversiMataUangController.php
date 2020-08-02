<?php

namespace App\Http\Controllers\FrontEnd\KonversiMataUang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HajiUmroh\BeritaTerbaru;
use App\Models\Master\AplikasiTentang;

use App\Models\User;

use Zipper;
use Carbon\Carbon;
class KonversiMataUangController extends Controller
{
    //
    protected $link = 'konversi-mata-uang';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Konversi Mata Uang");
        $this->setGroup("Konversi Mata Uang");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Konversi Mata Uang' => '#']);
    }

    public function index()
    {     
        return $this->render('frontend.konversimatauang.index');
          
    }

    public function notFoundPage(){
        return $this->render('failed.page', ['mockup' => false]);
    }
}

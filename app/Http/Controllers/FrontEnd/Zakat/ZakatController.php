<?php

namespace App\Http\Controllers\FrontEnd\Zakat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HajiUmroh\BeritaTerbaru;
use App\Models\Master\AplikasiTentang;

use App\Models\User;

use Zipper;
use Carbon\Carbon;
class ZakatController extends Controller
{
    //
    protected $link = 'zakat/info/';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Tentang Haji & Umroh");
        $this->setGroup("Tentang Haji & Umroh");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Tentang Haji & Umroh' => '#']);
    }

    public function info()
    {     
        return $this->render('frontend.zakat.info');
          
    }

    public function notFoundPage(){
        return $this->render('failed.page', ['mockup' => false]);
    }
}

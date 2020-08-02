<?php

namespace App\Http\Controllers\FrontEnd\HajiUmroh;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HajiUmroh\BeritaTerbaru;
use App\Models\Master\AplikasiTentang;

use App\Models\User;

use Zipper;
use Carbon\Carbon;
class TentangHajiUmrohController extends Controller
{
    //
    protected $link = 'tentang-hanji-umroh/';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Tentang Haji & Umroh");
        $this->setGroup("Tentang Haji & Umroh");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Tentang Haji & Umroh' => '#']);
    }

    public function index()
    {     
        $record = AplikasiTentang::where('kategori','Tentang Haji & Umroh')->first();

        return $this->render('frontend.tentang-haji-umroh.index', [
            'mockup' => false,
            'record' => $record,
        ]);
          
    }

    public function notFoundPage(){
        return $this->render('failed.page', ['mockup' => false]);
    }
}

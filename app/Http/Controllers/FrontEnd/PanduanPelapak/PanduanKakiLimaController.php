<?php

namespace App\Http\Controllers\FrontEnd\PanduanPelapak;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\AplikasiPanduan;

use App\Models\User;

use Zipper;
use Carbon\Carbon;

class PanduanKakiLimaController extends Controller
{
    //
    protected $link = '/panduan-kaki-lima';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Panduan Kaki Lima");
        $this->setGroup("Panduan Kaki Lima");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Panduan Kaki Lima' => '#']);
    }

    public function index()
    {
        $record = AplikasiPanduan::where('kategori', 'Panduan Kaki Lima')->first();
        return $this->render('frontend.panduan-kaki-lima.index', [
            'mockup' => false,
            'record' => $record,
        ]);
    }

    public function indexWebViews()
    {
        $record = AplikasiPanduan::where('kategori', 'Panduan Kaki Lima')->first();
        return $this->render('frontend.panduan-kaki-lima.index-webviews', [
            'mockup' => false,
            'record' => $record,
        ]);
    }

    public function notFoundPage()
    {
        return $this->render('failed.page', ['mockup' => false]);
    }
}

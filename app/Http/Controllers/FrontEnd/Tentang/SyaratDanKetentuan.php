<?php

namespace App\Http\Controllers\FrontEnd\Tentang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\AplikasiTentang;

class SyaratDanKetentuan extends Controller
{
    //
    protected $link = '/syarat-dan-ketentuan';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Syarat Dan Ketentuan");
        $this->setGroup("Syarat Dan Ketentuan");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Syarat Dan Ketentuan' => '#']);
    }

    public function index()
    {
        $record = AplikasiTentang::where('kategori', 'SyaratDanKetentuan')->first();
        return $this->render('frontend.syarat-dan-ketentuan.index', [
            'mockup' => false,
            'record' => $record,
        ]);
    }
}

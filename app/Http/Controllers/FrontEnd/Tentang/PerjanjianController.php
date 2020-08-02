<?php

namespace App\Http\Controllers\FrontEnd\Tentang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\AplikasiTentang;

class PerjanjianController extends Controller
{
    //
    protected $link = '/perjanjian';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Perjanjian");
        $this->setGroup("Perjanjian");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Perjanjian' => '#']);
    }

    public function index()
    {
        $record = AplikasiTentang::where('kategori', 'SyaratDanKetentuan')->first();
        return $this->render('frontend.perjanjian.index', [
            'mockup' => false,
            'record' => $record,
        ]);
    }
}

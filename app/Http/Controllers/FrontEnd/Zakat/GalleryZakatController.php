<?php

namespace App\Http\Controllers\FrontEnd\Zakat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\GalleryZakat;

use App\Models\User;

use Zipper;
use Carbon\Carbon;
class GalleryZakatController extends Controller
{
    //
    protected $link = 'gallery-photo/';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Gallery Foto Zakat & Infaq");
        $this->setGroup("Gallery Foto Zakat & Infaq");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Gallery Foto Zakat & Infaq' => '#']);
    }

    public function index()
    {     
        $record = GalleryZakat::with('attachments')->get();
        return $this->render('frontend.zakat.gallery', [
        'mockup' => false,
        'record' => $record,
        ]);
          
    }

    public function notFoundPage(){
        return $this->render('failed.page', ['mockup' => false]);
    }
}

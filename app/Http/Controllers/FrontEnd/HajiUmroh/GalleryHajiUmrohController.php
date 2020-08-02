<?php

namespace App\Http\Controllers\FrontEnd\HajiUmroh;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HajiUmroh\Gallery;

use App\Models\User;

use Zipper;
use Carbon\Carbon;
class GalleryHajiUmrohController extends Controller
{
    //
    protected $link = 'galery/';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Gallery");
        $this->setGroup("Gallery");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Gallery' => '#']);
    }

    public function index()
    {     
        $record = Gallery::with('attachments')->get();
        return $this->render('frontend.gallery-haji-umroh.index', [
        'mockup' => false,
        'record' => $record,
        ]);
          
    }

    public function notFoundPage(){
        return $this->render('failed.page', ['mockup' => false]);
    }
}

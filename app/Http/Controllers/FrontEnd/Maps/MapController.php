<?php

namespace App\Http\Controllers\FrontEnd\Maps;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HajiUmroh\BeritaTerbaru;
use App\Models\Master\AplikasiTentang;

use App\Models\User;

use Zipper;
use Carbon\Carbon;

class MapController extends Controller
{
    //
    protected $link = 'maps-ayokulakan';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Maps");
        $this->setGroup("Maps");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Maps' => '#']);
    }

    public function index()
    {
        return $this->render('frontend.maps.index');
    }

    public function search()
    {
        return $this->render('frontend.maps.search');
    }

    public function mesjid()
    {
        return $this->render('frontend.maps.mesjid');
    }

    public function kakiLima()
    {
        return $this->render('frontend.maps.kaki-lima');
    }

    public function cuaca()
    {
        return $this->render('frontend.maps.prakiraan-cuaca');
    }

    public function tanam()
    {
        return $this->render('frontend.maps.kalender-tanam');
    }
    public function ikan()
    {
        return $this->render('frontend.maps.kalender-tanam');
    }
    public function notFoundPage()
    {
        return $this->render('failed.page', ['mockup' => false]);
    }
}

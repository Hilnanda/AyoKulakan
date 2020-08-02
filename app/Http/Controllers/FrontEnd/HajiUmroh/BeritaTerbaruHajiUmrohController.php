<?php

namespace App\Http\Controllers\FrontEnd\HajiUmroh;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HajiUmroh\BeritaTerbaru;

use App\Models\User;

use Zipper;
use Carbon\Carbon;
class BeritaTerbaruHajiUmrohController extends Controller
{
    //
    protected $link = 'berita-terbaru/';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Berita Terbaru");
        $this->setGroup("Berita Terbaru");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Berita Terbaru' => '#']);
    }

    public function index()
    {
        $record = BeritaTerbaru::paginate(10);

        return $this->render('frontend.berita-terbaru-haji-umroh.index', [
        'mockup' => false,
        'record' => $record,
        ]);

    }

    public function show(Request $request, $id){
        return $this->render('frontend.berita-terbaru-haji-umroh.show', [
        'mockup' => false,
        'record' => BeritaTerbaru::find($id)
        ]);
    }

    public function notFoundPage(){
        return $this->render('failed.page', ['mockup' => false]);
    }
}

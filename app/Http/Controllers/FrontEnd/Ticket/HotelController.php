<?php

namespace App\Http\Controllers\FrontEnd\Ticket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\Models\User;

use App\Models\TransaksiAmpas\TransaksiAmpase;
use App\Models\TransaksiAmpas\TransaksiAmpaseBarangDetail;
use App\Models\TransaksiAmpas\TransaksiAmpaseKereta;
use Veritrans_Config;
use Veritrans_Snap;
use Veritrans_Notification;
use Veritrans_Transaction;
use Veritrans_VtDirect;
use Zipper;
use Carbon\Carbon;
use Auth;
use DB;
use App\Helpers\HelpersPPOB;
use App\Helpers\HelpersTiketPesawat;


class HotelController extends Controller
{
    //
    protected $link = 'check-ticket/';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Cek Ticket Anda");
        $this->setGroup("Cek Ticket Anda");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Cek Ticket Anda' => '#']);

        Veritrans_Config::$serverKey = config('services.midtrans.serverKey');
        Veritrans_Config::$isProduction = config('services.midtrans.isProduction');
        Veritrans_Config::$isSanitized = config('services.midtrans.isSanitized');
        Veritrans_Config::$is3ds = config('services.midtrans.is3ds');
    }

    public function checkHotel(Request $request){
        return $this->render('frontend.home.partial.ppob.10-1', ['request'=>$request->all()]);
    }

    public function notFoundPage(){
        return $this->render('failed.page', ['mockup' => false]);
    }

}

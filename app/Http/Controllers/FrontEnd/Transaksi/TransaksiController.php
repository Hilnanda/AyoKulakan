<?php

namespace App\Http\Controllers\FrontEnd\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\FrontEnd\Cart\CartMidtransRequest;

use App\Models\User;
use App\Models\Barang\FavoritBarang;

use App\Models\Lapak\Lapak;
use App\Models\Barang\LapakBarang;
use App\Models\TransaksiAmpas\TransaksiAmpase;
use App\Models\TransaksiAmpas\TransaksiAmpaseBarangDetail;

use Veritrans_Config;
use Veritrans_Snap;
use Veritrans_Notification;
use Veritrans_Transaction;
use Veritrans_VtDirect;
use Zipper;
use Carbon\Carbon;
use Auth;
use DB;


class TransaksiController extends Controller
{
    //
    protected $link = 'transaksi/';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Transaksi Anda");
        $this->setGroup("Transaksi Anda");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Transaksi Anda' => '#']);

        Veritrans_Config::$serverKey = config('services.midtrans.serverKey');
        Veritrans_Config::$isProduction = config('services.midtrans.isProduction');
        Veritrans_Config::$isSanitized = config('services.midtrans.isSanitized');
        Veritrans_Config::$is3ds = config('services.midtrans.is3ds');
    }

    public function confirmMidtrans($order_id){
      $record = TransaksiAmpase::where('order_id',$order_id)->first();
      if($record){
        $data = Veritrans_Transaction::status($order_id);
        $carbons = Carbon::parse($data->transaction_time)->addDays(1);

        $user = auth()->user();
        return $this->render('frontend.transaksi.detail', [
          'mockup' => false,
          'record' => $record,
          'status' => $data,
          'batasPembayaran' => $carbons,
          'user' => $user
        ]);
      }else{
         return $this->render('failed.page', ['mockup' => false]);
      }
    }

    public function deleteTransaksi(Request $request){
      $record = TransaksiAmpase::destroy($request->id);
      return response([
            'status' => true,
            'url' => url('/')
        ]);
    }

    public function notFoundPage(){
        return $this->render('failed.page', ['mockup' => false]);
    }
}

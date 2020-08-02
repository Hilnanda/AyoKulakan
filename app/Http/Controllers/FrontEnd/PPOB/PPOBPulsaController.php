<?php

namespace App\Http\Controllers\FrontEnd\PPOB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\FrontEnd\PPOB\PPOBPulsaRequest;

use App\Models\User;
use App\Models\Barang\FavoritBarang;
use App\Models\Master\PPOBPulsa;

use App\Models\Lapak\Lapak;
use App\Models\Barang\LapakBarang;
use App\Models\TransaksiAmpas\TransaksiAmpase;
use App\Models\TransaksiAmpas\TransaksiAmpaseBarangDetail;
use App\Models\TransaksiAmpas\TransaksiAmpasePrepaid;

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


class PPOBPulsaController extends Controller
{
    //
    protected $link = 'ppob-pulsa/';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Keranjang Anda");
        $this->setGroup("Keranjang Anda");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Keranjang Anda' => '#']);

        Veritrans_Config::$serverKey = config('services.midtrans.serverKey');
        Veritrans_Config::$isProduction = config('services.midtrans.isProduction');
        Veritrans_Config::$isSanitized = config('services.midtrans.isSanitized');
        Veritrans_Config::$is3ds = config('services.midtrans.is3ds');
    }

    public function checkGame(Request $request){
        
        $record = HelpersPPOB::checkGame($request->all());
        return $record;
    }

    public function storeMidtrans(PPOBPulsaRequest $request){
      DB::beginTransaction();
      try {
        $recordPPOB = PPOBPulsa::where('pulsa_code',$request->id_barang)->first();
        
        if(isset($request->ppob_pelanggan_next)){
            $ppobPelanggan = $request->ppob_pelanggan.''.$request->ppob_pelanggan_next;
        }else{
            $ppobPelanggan = $request->ppob_pelanggan;
        }

        $saveTrans = [];
        $saveTrans['user_id'] = auth()->user()->id;
        $saveTrans['status'] = 'Menunggu Pembayaran';
        $recordTrans = new TransaksiAmpase;
        $recordTrans->fill($saveTrans);
        $recordTrans->save();

        $generateOrder = generateOrder(strlen(auth()->user()->nama));
        $recordTrans->order_id = '0'.$generateOrder.'000'.$recordTrans->id;
        $recordTrans->save();
        
        
        $saveTransDetailBarang = [];
        $recordDetailBarang = [];
        $toMidtrans = [];

        $saveTransDetailBarang['trans_transaksi_id'] = $recordTrans->id;
        $saveTransDetailBarang['target_id'] = $recordTrans->id;
        $saveTransDetailBarang['target_type'] = 'trans_prepaid';
        $saveTransDetailBarang['form_id'] = $recordPPOB->id;
        $saveTransDetailBarang['form_type'] = $request->form_type;
        $saveTransDetailBarang['jml_brg'] = 1;
        $saveTransDetailBarang['ttl_harga'] = $recordPPOB->pulsa_price;
        $saveTransDetailBarang['pelanggan'] = $ppobPelanggan;
        $saveTransDetailBarang['type'] = $request->types;
        $saveTransDetailBarang['server'] = $request->ppob_type;
        // $sendMobil = [];
        // $sendMobil['hp'] = $ppobPelanggan;
        // $sendMobil['pulsa_code'] = $recordPPOB->pulsa_code;
        // $recordChargePPOB = json_decode(HelpersPPOB::post($recordTrans->order_id,$request->ppob_type,$sendMobil));
        // $saveTransDetailBarang['rc'] = $recordChargePPOB->data->rc;
        // $saveTransDetailBarang['tr_id'] = $recordChargePPOB->data->tr_id;
        // $saveTransDetailBarang['ref_id'] = $recordChargePPOB->data->ref_id;
        
        $recordDetailBarang = new TransaksiAmpasePrepaid;
        $recordDetailBarang->fill($saveTransDetailBarang);
        $recordDetailBarang->save();

        $toMidtrans['item_details'][0]['id'] = $recordDetailBarang->id;
        $toMidtrans['item_details'][0]['name'] = $recordPPOB->pulsa_code;
        $toMidtrans['item_details'][0]['price'] = $recordPPOB->pulsa_price;
        $toMidtrans['item_details'][0]['quantity'] = 1;
        $toMidtrans['transaction_details'] = array(
          'order_id' => $recordTrans->order_id,
          'gross_amount' => $recordPPOB->pulsa_price
        );

        $toMidtrans["customer_details"]['first_name'] = auth()->user()->nama;
        $toMidtrans["customer_details"]['last_name'] = '';
        $toMidtrans["customer_details"]['email'] = auth()->user()->email;
        $toMidtrans["customer_details"]['phone'] = auth()->user()->phone;
        $toMidtrans["customer_details"]['billing_address']['first_name'] = auth()->user()->nama;
        $toMidtrans["customer_details"]['billing_address']['last_name'] = '';
        $toMidtrans["customer_details"]['billing_address']['email'] = auth()->user()->email;
        $toMidtrans["customer_details"]['billing_address']['phone'] = auth()->user()->phone;
        $toMidtrans["customer_details"]['billing_address']['address'] = auth()->user()->alamat;
        $toMidtrans["customer_details"]['billing_address']['city'] = isset(auth()->user()->kota->kota) ? auth()->user()->kota->kota : '-';
        $toMidtrans["customer_details"]['billing_address']['postal_code'] = auth()->user()->kode_pos;
        $toMidtrans["customer_details"]['billing_address']['country_code'] = 'IDN';

        $toMidtrans['enabled_payments'] = array('bca_klikbca', 'bca_klikpay', 'permata_va', 'bca_va', 'bni_va', 'other_va', 'indomaret','credit_card','gopay','mandiri_clickpay','echannel','xl_tunai','permata_va','kioson','alfamart');

        $RessSnap = Veritrans_Snap::getSnapToken($toMidtrans);
        $recordTrans->snap_token = $RessSnap;
        $recordTrans->total_harga = $recordPPOB->pulsa_price;
        $recordTrans->save();

        
        DB::commit();

      } catch (Exception $e) {
          DB::rollback();
          return response([
              'status' => false,
              'errors' => $e
          ]);
      }
        return response([
            'status' => true,
            'record' => $recordTrans,
            'url' => url('transaksi/confirmation/'.$recordTrans->order_id)
        ]);
    }

    public function confirmMidtrans($order_id){
      $record = FavoritBarang::where('user_id',auth()->user()->id)->where('status','11')->get();
      $user = auth()->user();
      return $this->render('frontend.cart.detail-transaksi', [
        'mockup' => false,
        'record' => $record,
        'user' => $user
      ]);
    }

    public function checkRequest(Request $request){

    }

    public function notFoundPage(){
        return $this->render('failed.page', ['mockup' => false]);
    }
}

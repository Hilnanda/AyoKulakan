<?php

namespace App\Http\Controllers\FrontEnd\PPOB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\FrontEnd\PPOB\PPOBPulsaRequest;

use App\Models\User;
use App\Models\Barang\FavoritBarang;
use App\Models\Master\PPOBPulsa;
use App\Models\Master\PPOBPdam;

use App\Models\Lapak\Lapak;
use App\Models\Barang\LapakBarang;
use App\Models\TransaksiAmpas\TransaksiAmpase;
use App\Models\TransaksiAmpas\TransaksiAmpaseBarangDetail;
use App\Models\TransaksiAmpas\TransaksiAmpasePostpaid;

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


class PPOBPascaController extends Controller
{
    //
    protected $link = 'ppob-pasca/';

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

    public function PPOBIquiryBpjs(PPOBPulsaRequest $request){
        $record = HelpersPPOB::cekInqueryPasca($request->all());        
        $rec = json_decode($record);
        $hasil = [];
        if(isset($rec->data)){
            foreach ($rec->data as $k => $value) {
                $hasil[$k] = $value;
            }
        }
        return $this->render('frontend.home.partial.ppob.4-1', ['record' => $hasil,'request'=>$request->all()]);
    }

    public function PPOBIquiryPdam(PPOBPulsaRequest $request){
        $record = HelpersPPOB::cekInqueryPasca($request->all());  
        $rec = json_decode($record);
        $hasil = [];
        if(isset($rec->data)){
            foreach ($rec->data as $k => $value) {
                $hasil[$k] = $value;
            }
        }
        return $this->render('frontend.home.partial.ppob.5-1', ['record' => $hasil]);
    }

    public function PPOBIquiryPlnPrabayar(PPOBPulsaRequest $request){
        $record = HelpersPPOB::post($request->hp,$request->type,$request->all());  
        $rec = json_decode($record);
        $hasil = [];
        if(isset($rec->data)){
            foreach ($rec->data as $k => $value) {
                $hasil[$k] = $value;
            }
        }
        return $this->render('frontend.home.partial.ppob.6-1', ['record' => $hasil]);
    }

    public function PPOBIquiryPlnPostpaid(PPOBPulsaRequest $request){
        $record = HelpersPPOB::cekInqueryPasca($request->all());          
        $rec = json_decode($record);
        $hasil = [];
        if(isset($rec->data)){
            foreach ($rec->data as $k => $value) {
                $hasil[$k] = $value;
            }
        }
        return $this->render('frontend.home.partial.ppob.7-1', ['record' => $hasil]);
    }

    public function PPOBIquiryEsamsat(PPOBPulsaRequest $request){
        $record = HelpersPPOB::cekInqueryPasca($request->all());        
        $rec = json_decode($record);
        $hasil = [];
        if(isset($rec->data)){
            foreach ($rec->data as $k => $value) {
                $hasil[$k] = $value;
            }
        }
        return $this->render('frontend.home.partial.ppob.12-1', ['record' => $hasil,'request'=>$request->all()]);
    }

    public function PPOBIquiryTv(Request $request){
        $this->validate($request,[
            'type' => 'required',
            'ppob_pelanggan' => 'required'
        ]);
        $record = HelpersPPOB::cekInqueryPasca($request->all());        
        $rec = json_decode($record);
        $hasil = [];
        if(isset($rec->data)){
            foreach ($rec->data as $k => $value) {
                $hasil[$k] = $value;
            }
        }
        return $this->render('frontend.home.partial.ppob.13-1', ['record' => $hasil,'request'=>$request->all()]);
    }

    public function PPOBIquiryInternet(Request $request){
        $this->validate($request,[
            'type' => 'required',
            'ppob_pelanggan' => 'required'
        ]);
        // $record = HelpersPPOB::cekInqueryPasca($request->all());        
        // $rec = json_decode($record);
        $hasil = [];
        // if(isset($rec->data)){
        //     foreach ($rec->data as $k => $value) {
        //         $hasil[$k] = $value;
        //     }
        // }
        return $this->render('frontend.home.partial.ppob.14-1', ['record' => $hasil,'request'=>$request->all()]);
    }

    public function PPOBIquiryTLpRmh(Request $request){
        $this->validate($request,[
            'ppob_pelanggan' => 'required'
        ]);
        // $record = HelpersPPOB::cekInqueryPasca($request->all());        
        // $rec = json_decode($record);
        $hasil = [];
        // if(isset($rec->data)){
        //     foreach ($rec->data as $k => $value) {
        //         $hasil[$k] = $value;
        //     }
        // }
        return $this->render('frontend.home.partial.ppob.15-1', ['record' => $hasil,'request'=>$request->all()]);
    }

    public function storeMidtrans(PPOBPulsaRequest $request){
      
      DB::beginTransaction();
      try {
        $record = HelpersPPOB::cekInqueryPasca($request->all());
        $record = json_decode($record);
        if($record->data){
            $saveTrans = [];
            $saveTrans['user_id'] = auth()->user()->id;
            $saveTrans['status'] = 1;
            
            $saveTrans['order_id'] = $record->data->ref_id;
            $recordTrans = new TransaksiAmpase;
            $recordTrans->fill($saveTrans);
            $recordTrans->save();


            if(isset($request->form_type)){
                $cekPdam = PPOBPdam::where('code','=',$request->type)->first();
                $saveTransDetailBarang['form_type'] = $request->form_type;
                $saveTransDetailBarang['form_id'] = $cekPdam->id;
            }
            // $recordPPOB = HelpersPPOB::postPayPasca($record->data->tr_id);
            $saveTransDetailBarang['trans_transaksi_id'] = $recordTrans->id;
            $saveTransDetailBarang['target_id'] = $recordTrans->id;
            $saveTransDetailBarang['target_type'] = 'trans_pospaid';
            
            $saveTransDetailBarang['pelanggan'] = $record->data->hp;
            $saveTransDetailBarang['tr_name'] = $record->data->tr_name;
            $saveTransDetailBarang['period'] = isset($record->data->period) ? $record->data->period : '';
            $saveTransDetailBarang['noref'] = isset($record->data->noref) ? $record->data->noref : '';
            $saveTransDetailBarang['jml_brg'] = 1;
            $saveTransDetailBarang['ttl_harga'] = isset($record->data->price) ? $record->data->price : '';
            $saveTransDetailBarang['sn'] = isset($record->data->sn) ? $record->data->sn : '';
            $saveTransDetailBarang['pin'] = isset($record->data->pin) ? $record->data->pin : '';
            $saveTransDetailBarang['rc'] = isset($record->data->rc) ? $record->data->rc : '';
            // $saveTransDetailBarang['biaya_admin'] = isset($record->data->rc) ? $record->data->rc : '';
            $saveTransDetailBarang['type'] = isset($request->types) ? $request->types : '';
            $saveTransDetailBarang['server'] = isset($request->type) ? $request->type : '';
            $saveTransDetailBarang['tr_id'] = isset($record->data->tr_id) ? $record->data->tr_id : '';
            $saveTransDetailBarang['ref_id'] = isset($record->data->ref_id) ? $record->data->ref_id : '';
            $recordDetailBarang = new TransaksiAmpasePostpaid;
            $recordDetailBarang->fill($saveTransDetailBarang);
            $recordDetailBarang->save();

            $toMidtrans = [];

            $toMidtrans['item_details'][0]['id'] = $recordDetailBarang->id;
            $toMidtrans['item_details'][0]['name'] = isset($record->data->code) ? $record->data->code : $record->data->hp;
            $toMidtrans['item_details'][0]['price'] = $recordDetailBarang->ttl_harga;
            $toMidtrans['item_details'][0]['quantity'] = 1;
            $toMidtrans['transaction_details'] = array(
              'order_id' => $recordTrans->order_id,
              'gross_amount' => $recordDetailBarang->ttl_harga
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
            $recordTrans->total_harga = isset($record->data->price) ? $record->data->price : 0;
            $recordTrans->save();

           
        }else{
            header('HTTP/1.1 500 Terjadi Kesalahan');
            header('Content-Type: application/json; charset=UTF-8');
            die();
        }
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

    public function notFoundPage(){
        return $this->render('failed.page', ['mockup' => false]);
    }
}

<?php

namespace App\Http\Controllers\API\PPOB;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;

use App\Models\User;

use App\Models\Master\PPOBPdam;
use App\Models\Master\PPOBPulsa;
use App\Models\Master\PPOBPulsaProvider;
use App\Helpers\HelpersPPOB;

use App\Models\TransaksiAmpas\TransaksiAmpase;
use App\Models\TransaksiAmpas\TransaksiAmpaseBarangDetail;
use App\Models\TransaksiAmpas\TransaksiAmpasePostpaid;

use Veritrans_Config;
use Veritrans_Snap;
use Veritrans_Notification;
use Veritrans_Transaction;
use Veritrans_VtDirect;
use Carbon\Carbon;
use DB;

class PPOBInqueryController extends Controller
{

    public function __construct(Request $request)
    {
        $this->request = $request;
 
        // Set midtrans configuration
        Veritrans_Config::$serverKey = config('services.midtrans.serverKey');
        Veritrans_Config::$isProduction = config('services.midtrans.isProduction');
        Veritrans_Config::$isSanitized = config('services.midtrans.isSanitized');
        Veritrans_Config::$is3ds = config('services.midtrans.is3ds');
    }

    public function getInquery(Request $request)
    {
        $record = HelpersPPOB::cekInqueryPasca($request->all());        
        $rec = json_decode($record);
        $hasil = [];
        if(isset($rec->data)){
            foreach ($rec->data as $k => $value) {
                $hasil[$k] = $value;
            }
        }
        return $hasil;
    }

    public function getPLNPrabayar(Request $request){
       $record = HelpersPPOB::post($request->hp,$request->type,$request->all());  
        $rec = json_decode($record);
        $hasil = [];
        if(isset($rec->data)){
            foreach ($rec->data as $k => $value) {
                $hasil[$k] = $value;
            }
        }
        return $hasil;
    }

    public function store(Request $request){
      DB::beginTransaction();
      try {
        $user = User::find($request->user_id);
        if(!$user){
          return response([
              'status' => false,
              'message' => 'User Tidak Ditemukan'
          ],400);
        }else{

          $saveTrans = [];
          $saveTransDetailBarang = [];
          $recordDetailBarang = [];
          $totalBarang = 0;
          $toMidtrans = [];
          $sendMobil = [];
          $ppobType = '';

          $toMidtrans["customer_details"]['first_name'] = $user->nama;
          $toMidtrans["customer_details"]['last_name'] = '';
          $toMidtrans["customer_details"]['email'] = $user->email;
          $toMidtrans["customer_details"]['phone'] = $user->phone;
          $toMidtrans["customer_details"]['billing_address']['first_name'] = $user->nama;
          $toMidtrans["customer_details"]['billing_address']['last_name'] = '';
          $toMidtrans["customer_details"]['billing_address']['email'] = $user->email;
          $toMidtrans["customer_details"]['billing_address']['phone'] = isset($user->phone) ? $user->phone : '';
          $toMidtrans["customer_details"]['billing_address']['address'] = isset($user->alamat) ? $user->alamat : '';
          $toMidtrans["customer_details"]['billing_address']['city'] = isset($user->kota->kota) ? $user->kota->kota : '';
          $toMidtrans["customer_details"]['billing_address']['postal_code'] = isset($user->kode_pos) ? $user->kode_pos : '';
          $toMidtrans["customer_details"]['billing_address']['country_code'] = 'IDN';
      
          $saveTrans['user_id'] = $request->user_id;
          $saveTrans['status'] = 1;
          $recordTrans = new TransaksiAmpase;
          $recordTrans->fill($saveTrans);
          $recordTrans->save();

          $generateOrder = generateOrder(strlen($user->nama));
          $recordTrans->order_id = '0'.$generateOrder.'000'.$recordTrans->id;
          $recordTrans->save();

          $senMob = [];
          if(count($request->item_details) > 0){
            foreach ($request->item_details as $k => $value) {
              $senMob['ppob_pelanggan'] = $value['id'];
              $senMob['month'] = $value['month'];
              $senMob['type'] = $value['type'];
              if(isset($value['nomor_identitas'])){
                $senMob['nomor_identitas'] = $value['nomor_identitas'];
              }
              $senMob['type'] = $value['type'];
              $record = HelpersPPOB::cekInqueryPasca($senMob);
              $record = json_decode($record);
                if(isset($value['form_type'])){
                    $cekPdam = PPOBPdam::where('code','=',$value['name'])->first();
                    $saveTransDetailBarang['form_type'] = (!is_null($value['form_type'])) ? $value['form_type'] : '';
                    $saveTransDetailBarang['form_id'] = ($cekPdam) ? $cekPdam->id : '';
                }

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
                $saveTransDetailBarang['type'] = isset($value['types']) ? $value['types'] : '';
                $saveTransDetailBarang['server'] = isset($value['type']) ? $value['type'] : '';
                $saveTransDetailBarang['tr_id'] = isset($record->data->tr_id) ? $record->data->tr_id : '';
                $saveTransDetailBarang['ref_id'] = isset($record->data->ref_id) ? $record->data->ref_id : '';
                $recordDetailBarang = new TransaksiAmpasePostpaid;
                $recordDetailBarang->fill($saveTransDetailBarang);
                $recordDetailBarang->save();
                ////////////////
                $toMidtrans['item_details'][$k]['id'] = $recordDetailBarang->id;
                $toMidtrans['item_details'][$k]['name'] = isset($record->data->code) ? $record->data->code : $record->data->hp;
                $toMidtrans['item_details'][$k]['price'] = $recordDetailBarang->ttl_harga;
                $toMidtrans['item_details'][$k]['quantity'] = 1;
            }
          }
          $toMidtrans['transaction_details'] = array(
            'order_id' => $recordTrans->order_id,
            'gross_amount' => isset($recordDetailBarang->ttl_harga) ? $recordDetailBarang->ttl_harga : 0,
          );
          if($request->form){
            if(count($request->form) > 0){
              foreach ($request->form as $k => $value) {
                if(!is_array($value)){
                  $toMidtrans[$k] = $value;  
                }else{
                  if(count($value) > 0){
                    foreach ($value as $k1 => $value1) {
                      if(!is_array($value1)){
                        $toMidtrans[$k][$k1] = $value1;    
                      }else{
                        if(count($value1) > 0){
                          foreach ($value1 as $k2 => $value2) {
                            $toMidtrans[$k][$k1][$k2] = $value2;    
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
            $RessSnap = Veritrans_VtDirect::charge($toMidtrans);
            $recordTrans->total_harga = isset($recordDetailBarang->ttl_harga) ? $recordDetailBarang->ttl_harga : 0;
            $recordTrans->save();
          }else{
            $toMidtrans['enabled_payments'] = array('bca_klikbca', 'bca_klikpay', 'permata_va', 'bca_va', 'bni_va', 'other_va', 'indomaret','credit_card','gopay','mandiri_clickpay','echannel','xl_tunai','permata_va','kioson','alfamart');

            $RessSnap = Veritrans_Snap::getSnapToken($toMidtrans);
            $recordTrans->snap_token = $RessSnap;
            $recordTrans->total_harga = isset($recordDetailBarang->ttl_harga) ? $recordDetailBarang->ttl_harga : 0;
            $recordTrans->save();
          }
        }
        DB::commit();
        return response([
            'status' => true,
            'message' => $RessSnap,
        ]);
      } catch (Exception $e) {
          DB::rollback();
          return response([
              'status' => false,
              'errors' => $e->getMesssage()
          ]);
      }
      
      
    }
    
}

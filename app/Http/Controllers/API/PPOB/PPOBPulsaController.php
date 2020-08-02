<?php

namespace App\Http\Controllers\API\PPOB;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Master\PPOBPulsa;
use App\Models\Master\PPOBPulsaProvider;
use App\Helpers\HelpersPPOB;

use App\Models\TransaksiAmpas\TransaksiAmpase;
use App\Models\TransaksiAmpas\TransaksiAmpaseBarangDetail;
use App\Models\TransaksiAmpas\TransaksiAmpasePrepaid;

use Veritrans_Config;
use Veritrans_Snap;
use Veritrans_Notification;
use Veritrans_Transaction;
use Veritrans_VtDirect;
use Carbon\Carbon;
use DB;

class PPOBPulsaController extends Controller
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
    public function index(Request $request)
    {
        $data = new QueryBuilder(new PPOBPulsaProvider, $request);
        $data = $data->build()->get();     
        return response()->json([
            'status' => true,
            'total' => $data->count(),
            'data' => $data,
        ]);
    }

    public function show($id)
    {
        if($id){
            $data = PPOBPulsaProvider::with('attachments')->find($id);
                if($data == true){
                    return $this->messageApiJsonObject('true',$data);
                }else{
                    return $this->messageApiJsonObject();
                }
        }else{
            return response()->json([
                  'status' => false,
                  'message' => 'Data Tidak Ditemukan'
            ]);
        }
    }

    public function filter(Request $request)
    {
      $return = false;
        if($request->value && $request->type){
          $provider = PPOBPulsaProvider::where('code',$request->value)->where('type',$request->type)->first();
          $return = [];
          if($provider){
              $return = HelpersPPOB::cekData($provider->type,$provider->name);
          }
          return $return;
        }else{
            return response()->json([
                  'status' => false,
                  'message' => 'Data Tidak Ditemukan'
            ]);
        }
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
          $saveTrans['status'] = 'Menunggu Pembayaran';
          $recordTrans = new TransaksiAmpase;
          $recordTrans->fill($saveTrans);
          $recordTrans->save();

          $generateOrder = generateOrder(strlen($user->nama));
          $recordTrans->order_id = '0'.$generateOrder.'000'.$recordTrans->id;
          $recordTrans->save();
          $ppobPelanggan = '-';
          if(count($request->item_details) > 0){
            foreach ($request->item_details as $k => $value) {
              $recordPPOB = PPOBPulsa::where('pulsa_code',$value['id'])->first();
          
              if(isset($value['ppob_pelanggan_next'])){
                  $ppobPelanggan = $value['ppob_pelanggan'].''.$value['ppob_pelanggan_next'];
              }else{
                  $ppobPelanggan = $value['ppob_pelanggan'];
              }

              $saveTransDetailBarang['trans_transaksi_id'] = $recordTrans->id;
              $saveTransDetailBarang['target_id'] = $recordTrans->id;
              $saveTransDetailBarang['target_type'] = 'trans_prepaid';
              $saveTransDetailBarang['form_id'] = $recordPPOB->id;
              $saveTransDetailBarang['form_type'] = $value['form_type'];
              $saveTransDetailBarang['jml_brg'] = 1;
              $saveTransDetailBarang['ttl_harga'] = $value['price'];
              $saveTransDetailBarang['pelanggan'] = $ppobPelanggan;
              $saveTransDetailBarang['type'] = $value['types'];
              $saveTransDetailBarang['server'] = $value['ppob_type'];

              $totalBarang += $value['price'];
                     
              $recordDetailBarang = new TransaksiAmpasePrepaid;
              $recordDetailBarang->fill($saveTransDetailBarang);
              $recordDetailBarang->save();

              $toMidtrans['item_details'][$k]['id'] = $recordDetailBarang->id;
              $toMidtrans['item_details'][$k]['name'] = $value['id'];
              $toMidtrans['item_details'][$k]['price'] = $value['price'];
              $toMidtrans['item_details'][$k]['quantity'] = $value['quantity'];

            }
          }
          $toMidtrans['transaction_details'] = array(
            'order_id' => $recordTrans->order_id,
            'gross_amount' => $totalBarang
          );
          // dd($toMidtrans);
          

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
            // dd($toMidtrans);
            $RessSnap = Veritrans_VtDirect::charge($toMidtrans);
            $recordTrans->total_harga = $totalBarang;
            $recordTrans->save();
          }else{
            $toMidtrans['enabled_payments'] = array('bca_klikbca', 'bca_klikpay', 'permata_va', 'bca_va', 'bni_va', 'other_va', 'indomaret','credit_card','gopay','mandiri_clickpay','echannel','xl_tunai','permata_va','kioson','alfamart');
            $RessSnap = Veritrans_Snap::getSnapToken($toMidtrans);
            $recordTrans->snap_token = $RessSnap;
            $recordTrans->total_harga = $totalBarang;
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
              'errors' => $e
          ]);
      }
      
      
    }
  
}

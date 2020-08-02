<?php

namespace App\Http\Controllers\API\Trans;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;

use App\Models\Barang\FavoritBarang;
use App\Models\User;
use App\Models\Lapak\Lapak;
use App\Models\Barang\LapakBarang;
use App\Models\TransaksiAmpas\TransaksiAmpase;
use App\Models\TransaksiAmpas\TransaksiAmpaseBarangDetail;
use App\Models\TransaksiAmpas\TransaksiKurir;

use App\Models\Master\Rajaongkir;

use App\Http\Requests\APIRequest\TransaksiRentalRequest;

use Veritrans_Config;
use Veritrans_Snap;
use Veritrans_Notification;
use Veritrans_Transaction;
use Veritrans_VtDirect;
use Carbon\Carbon;
use DB;

use GuzzleHttp\Client;

class TransaksiRentalController extends Controller
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

    public function index(){
      return response([],500);
    }

    public function store(TransaksiRentalRequest $request){

      DB::beginTransaction();
      try {
        $user = User::find($request->user_id);

        if(!$user){
          return response([
            'status' => 'false',
            'message' => 'user tidak ditemukan'
          ],500);
        }

        $saveTrans = [];
        $saveTrans['user_id'] = $request->user_id;
        $saveTrans['status'] = 'Menunggu Pembayaran';
        $recordTrans = new TransaksiAmpase;
        $recordTrans->fill($saveTrans);
        $recordTrans->save();

        $generateOrder = generateOrder(strlen($user->nama));
        $recordTrans->order_id = '0'.$generateOrder.'000'.$recordTrans->id;
        $recordTrans->save();

        $saveTransDetailBarang = [];
        $recordDetailBarang = [];
        $totalBarang = 0;
        $totalHargaKurir = 0;
        $toMidtrans = [];
        $dataTransKurir = [];
        // dump($request->all());
        if(count($request->item_details) > 0){
          foreach ($request->item_details as $k => $val) {
            if(isset($val['barang'])){
              if(count($val['barang']) > 0){
                foreach ($val['barang'] as $k => $value) {

                  $saveTransDetailBarang['trans_transaksi_id'] = $recordTrans->id;
                  $saveTransDetailBarang['id_barang'] = $value['id'];
                  $saveTransDetailBarang['jumlah_barang'] = $value['quantity'];
                  $saveTransDetailBarang['total_harga'] = $value['price'];
                  
                  $hitung = ((float)$value['price'] * (float)$value['quantity']);
                  $totalBarang += $hitung;

                  $recordDetailBarang = $recordTrans->detail()->create($saveTransDetailBarang);
                  
                  if(isset($toMidtrans['item_details'])){
                    array_push($toMidtrans['item_details'],array(
                      'id' => $recordDetailBarang->id,
                      'name' => $value['name'],
                      'price' => $value['price'],
                      'quantity' => $value['quantity'],
                    ));
                  }else{
                    $toMidtrans['item_details'][$k]['id'] = $recordDetailBarang->id;
                    $toMidtrans['item_details'][$k]['name'] = $value['name'];
                    $toMidtrans['item_details'][$k]['price'] = $value['price'];
                    $toMidtrans['item_details'][$k]['quantity'] = $value['quantity'];
                  }

                }
              }
            }

            
          }
        }

        $toMidtrans['transaction_details'] = array(
          'order_id' => $recordTrans->order_id,
          'gross_amount' => $totalBarang
        );
        

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
        // $toMidtrans["customer_details"]['billing_address']['postal_code'] = isset($user->kode_pos) ? $user->kode_pos : null;
        $toMidtrans["customer_details"]['billing_address']['country_code'] = 'IDN';

        $toMidtrans['enabled_payments'] = array('bca_klikbca', 'bca_klikpay', 'permata_va', 'bca_va', 'bni_va', 'other_va', 'indomaret','credit_card','gopay','mandiri_clickpay','echannel','xl_tunai','permata_va','kioson','alfamart');

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
        }
        // dd($toMidtrans);
        $RessSnap = Veritrans_VtDirect::charge($toMidtrans);

        $recordTrans->total_harga = $totalBarang;
        $recordTrans->save();
        FavoritBarang::where('form_type','img_rental')->where('user_id',$user->id)->where('status','11')->delete();

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

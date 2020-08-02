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

use App\Http\Requests\APIRequest\TransaksiBarangRequest;

use Veritrans_Config;
use Veritrans_Snap;
use Veritrans_Notification;
use Veritrans_Transaction;
use Veritrans_VtDirect;
use Carbon\Carbon;
use DB;

use GuzzleHttp\Client;

class TransaksiBarangController extends Controller
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

    public function store(TransaksiBarangRequest $request){
      DB::beginTransaction();
      try {
        $user = User::find($request->user_id);

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

            if(isset($val['kurir_code'])){
              $itemDetail = '-';
              $masterRk = Rajaongkir::where('code',$val['kurir_code'])->first();
              if($masterRk){
                $itemDetail = $masterRk->name.' '.$val['kurir_tipe'];
                $recordTransKurir = TransaksiKurir::create([
                  'trans_id' => $recordTrans->id,
                  'lapak_id' => $masterRk->id,
                  'form_id' => $masterRk->id,
                  'form_type' => 'rajaongkir',
                  'kurir_child_tipe' => $val['kurir_tipe'],
                  'kurir_child_harga' => $val['kurir_harga'],
                  'kurir_child_hari' => $val['kurir_hari'],
                ]);
              }else{
                $masterRk = Kurir::where('user_id',$val['kurir_code'])->first();
                $itemDetail = 'Kurir Ayokulakan '.$masterRk->creator->name;
                $recordTransKurir = TransaksiKurir::create([
                  'trans_id' => $recordTrans->id,
                  'form_id' => $masterRk->id,
                  'form_type' => 'Rajaongkir',
                ]);
              }
              $totalHargaKurir += (float)$val['kurir_harga'];
              array_push($dataTransKurir,[
                'id' => $recordTransKurir->id,
                'name' => $itemDetail,
                'price' => $val['kurir_harga'],
                'quantity' => 1,
              ]);
              
            }
          }
        }

        $toMidtrans['item_details'] = array_merge($toMidtrans['item_details'],$dataTransKurir);
        $resultTotalHarga = $totalBarang + $totalHargaKurir;
        $toMidtrans['transaction_details'] = array(
          'order_id' => $recordTrans->order_id,
          'gross_amount' => $resultTotalHarga
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
        $RessSnap = Veritrans_VtDirect::charge($toMidtrans);

        $recordTrans->total_harga = $resultTotalHarga;
        $recordTrans->save();
        FavoritBarang::where('form_type','img_barang')->where('user_id',$user->id)->where('status','11')->delete();

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

<?php

namespace App\Http\Controllers\API\Ticketing;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Roles;
use App\Models\Master\TicketingAirport;
use App\Models\Master\TicketingStatsiunKereta;
use App\Http\Requests\HajiUmroh\BeritaTerbaruRequest;
use App\Models\TransaksiAmpas\TransaksiAmpase;
use App\Models\TransaksiAmpas\TransaksiAmpaseBarangDetail;
use App\Models\TransaksiAmpas\TransaksiAmpaseKereta;

use DataTables;
use Zipper;
use Carbon\Carbon;
use App\Helpers\HelpersPPOB;
use DB;
use Veritrans_Config;
use Veritrans_Snap;
use Veritrans_Notification;
use Veritrans_Transaction;
use Veritrans_VtDirect;


class TiketPesawatController extends Controller
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

   $data = new QueryBuilder(new TicketingAirport, $request);
       $data = $data->build()->get();
        return response()->json([
            'status' => true,
            'data' => $data,
            'total' => $data->count()
        ]);
  }

  public function show($id)
  {
      if($id){
          $data = TicketingAirport::findOrFail($id);
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

  public function search(Request $request)
  {
    try {
      $recordKeberangkatan = [];
      $recordKepulangan = [];
      if(isset($request->tanggal_berangkat)){
        if(!is_null($request->tanggal_berangkat)){
          $recordKeberangkatan = HelpersPPOB::findKereta($request->all());  
        }
      }

      if(isset($request->tanggal_kepulangan)){
        if(!is_null($request->tanggal_kepulangan)){
          $asal = $request->rute_asal;
          $tujuan = $request->rute_tujuan;
          $request['rute_asal'] = $tujuan;
          $request['rute_tujuan'] = $asal;
          $recordKepulangan = HelpersPPOB::findKereta($request->all());  
        }
      }

      return response([
        'status' => true,
        'berangkat' => $recordKeberangkatan,
        'pulang' => $recordKepulangan,
      ]);
    }catch (\Exception $e) {
      return response([
        'status' => 'error',
        'message' => $e,
      ], 500);
    }
  }

  public function searchSeat(Request $request)
  {
    try {
      $recordKeberangkatan = [];
      $recordKepulangan = [];
      if(isset($request->berangkat['trainNo'])){
        if(!is_null($request->berangkat['trainNo'])){
          $request['date'] = $request->berangkat['tanggal_berangkat'];
          $request['subClass'] = $request->berangkat['sub_class'];
          $recordKeberangkatan = HelpersPPOB::seatMapSubClass($request->all());
        }
      }

      if(isset($request->kepulangan['trainNo'])){
        if(!is_null($request->kepulangan['trainNo'])){
          $arrayPulang['berangkat']['trainNo'] = $request->kepulangan['trainNo'];
          $arrayPulang['org'] = $request->dest;
          $arrayPulang['dest'] = $request->org;
          $arrayPulang['date'] = $request->kepulangan['tanggal_kepulangan'];
          $arrayPulang['subClass'] = $request->kepulangan['sub_class'];
          $recordKepulangan = HelpersPPOB::seatMapSubClass($arrayPulang);  
        }
      }

      return response([
        'status' => true,
        'seat_berangkat' => $recordKeberangkatan,
        'seat_pulang' => $recordKepulangan,
      ]);
    }catch (\Exception $e) {
      return response([
        'status' => 'error',
        'message' => $e,
      ], 500);
    }
  }

  public function store(Request $request)
  {
      DB::beginTransaction();
        try {
            $recordTrans = $this->saveKereta($request);
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
          'message' => $recordTrans->snap_token,
        ]);
  }

   public function saveKereta(Request $request){
        $recKeberangkatan = json_decode(HelpersPPOB::storeBerangkatKeretaAPI($request->all()));
        $user = User::find($request->user_id);
        // dd($user);
            if($recKeberangkatan){
                $saveTransKereta = [];
                $saveTransKereta['user_id'] = $request->user_id;
                $saveTransKereta['status'] = 'Menunggu Pembayaran';
                
                $saveTransKereta['order_id'] = $recKeberangkatan->data->ref_id;
                $saveTransKereta['total_harga'] = $recKeberangkatan->data->totalPrice;
                $recordTrans = new TransaksiAmpase;
                $recordTrans->fill($saveTransKereta);
                $recordTrans->save();
                $this->addAttribute($recKeberangkatan,$recordTrans->id);
                if($request->tanggal_kepulangan){
                    $recKepulangan = json_decode(HelpersPPOB::storePulangKeretaAPI($request->all()));
                    
                    // $recKepulangan = json_decode(json_encode($this->cekArray()));
                    if($recKepulangan){
                        $this->addAttribute($recKepulangan,$recordTrans->id,'Kepulangan');
                        $totalJML = (int)$recordTrans->total_harga+(int)$recKepulangan->data->totalPrice;
                        $recordTrans->total_harga = $totalJML;
                        $recordTrans->save();
                    }
                }

                if($recordTrans->kereta->count() > 0){
                    foreach ($recordTrans->kereta as $k => $value) {
                        $toMidtrans['item_details'][$k]['id'] = $value->id;
                        $toMidtrans['item_details'][$k]['name'] = $recKeberangkatan->data->trainName.' ('.$recKeberangkatan->data->trainNo.') '.$value->org.' To '.$value->dest;
                        $toMidtrans['item_details'][$k]['price'] = (float)$recKeberangkatan->data->adultPrice;
                        $toMidtrans['item_details'][$k]['quantity'] = 1;
                    }
                }
                $addToMidtrans['id'] = $recordTrans->kereta->count()+1;
                $addToMidtrans['name'] = 'Biaya Administrasi Keberangkatan';
                $addToMidtrans['price'] = $recKeberangkatan->data->admin;
                $addToMidtrans['quantity'] = 1;
                array_push($toMidtrans['item_details'],$addToMidtrans);

                $toMidtrans['transaction_details'] = array(
                  'order_id' => $recordTrans->order_id,
                  'gross_amount' => $recordTrans->total_harga
                );

                if($request->tanggal_kepulangan){
                    $recKepulangan = json_decode(HelpersPPOB::storePulangKeretaAPI($request->all()));
                    // $recKepulangan = json_decode(json_encode($this->cekArray()));
                    if($recKepulangan){
                        $addToMidtransPulang['id'] = $recordTrans->kereta->count()+2;
                        $addToMidtransPulang['name'] = 'Biaya Administrasi Kepulangan';
                        $addToMidtransPulang['price'] = $recKepulangan->data->admin;
                        $addToMidtransPulang['quantity'] = 1;
                        array_push($toMidtrans['item_details'],$addToMidtransPulang);
                    }
                }
               
                $toMidtrans["customer_details"]['first_name'] = $user->nama;
                $toMidtrans["customer_details"]['last_name'] = '';
                $toMidtrans["customer_details"]['email'] = $user->email;
                $toMidtrans["customer_details"]['phone'] = $user->phone;
                $toMidtrans["customer_details"]['billing_address']['first_name'] = $user->nama;
                $toMidtrans["customer_details"]['billing_address']['last_name'] = '';
                $toMidtrans["customer_details"]['billing_address']['email'] = isset($user->email) ? $user->email : '';
                $toMidtrans["customer_details"]['billing_address']['phone'] = isset($user->phone) ? $user->phone : '';
                $toMidtrans["customer_details"]['billing_address']['address'] = isset($user->alamat) ? $user->alamat : '';
                $toMidtrans["customer_details"]['billing_address']['city'] = isset($user->kota->kota) ? $user->kota->kota : '';
                $toMidtrans["customer_details"]['billing_address']['postal_code'] = isset($user->kode_pos) ? $user->kode_pos : '';
                $toMidtrans["customer_details"]['billing_address']['country_code'] = 'IDN';
                
                
                $toMidtrans['enabled_payments'] = array('bca_klikbca', 'bca_klikpay', 'permata_va', 'bca_va', 'bni_va', 'other_va', 'indomaret','credit_card','gopay','mandiri_clickpay','echannel','xl_tunai','permata_va','kioson','alfamart');

                $RessSnap = Veritrans_Snap::getSnapToken($toMidtrans);
                $recordTrans->snap_token = $RessSnap;
                $recordTrans->save();
                return $recordTrans;
            }else{
                header('HTTP/1.1 500 Terjadi Kesalahan');
                header('Content-Type: application/json; charset=UTF-8');
                die();
            }
    }

    public function addAttribute($request, $id, $status_tujuan = 'Keberangkatan'){
        $saveTransDtKereta['trans_transaksi_id'] = $id;
        $saveTransDtKereta['target_id'] = $id;
        $saveTransDtKereta['target_type'] = 'trans_kereta';
        $saveTransDtKereta['org'] = $request->data->org;
        $saveTransDtKereta['dest'] = $request->data->dest;
        $saveTransDtKereta['trainNo'] = $request->data->trainNo;
        $saveTransDtKereta['trainName'] = $request->data->trainName;
        
        $saveTransDtKereta['subClass'] = $request->data->subClass;
        $saveTransDtKereta['status_tujuan'] = $status_tujuan;
        $saveTransDtKereta['bookingCode'] = $request->data->bookingCode;
        $saveTransDtKereta['bookTime'] = $request->data->bookTime;
        $saveTransDtKereta['timeLimit'] = $request->data->timeLimit;
        $saveTransDtKereta['bookingDate'] = $request->data->bookingDate;
        $saveTransDtKereta['class'] = $request->data->class;
        $saveTransDtKereta['className'] = $request->data->className;
        $saveTransDtKereta['departDate'] = $request->data->departDate;
        $saveTransDtKereta['departTime'] = $request->data->departTime;
        $saveTransDtKereta['arriveDate'] = $request->data->arriveDate;
        $saveTransDtKereta['arriveTime'] = $request->data->arriveTime;
        $saveTransDtKereta['ticketPrice'] = $request->data->adultPrice;
        $saveTransDtKereta['discount'] = $request->data->discount;
        $saveTransDtKereta['admin'] = $request->data->admin;
        $saveTransDtKereta['tr_id'] = $request->data->tr_id;
        if(is_array($request->data->passengers->passenger)){
            foreach ($request->data->passengers->passenger as $k => $value) {
                $saveTransDtKereta['seats'] = $value->seat;
                $saveTransDtKereta['seatSelect'] = $value->category;
                $saveTransDtKereta['kodeWagon'] = $value->kodeWagon;
                $saveTransDtKereta['adult_id'] = $value->id;
                $saveTransDtKereta['adult_name'] = $value->name;
                $recordDtKereta = new TransaksiAmpaseKereta;
                $recordDtKereta->fill($saveTransDtKereta);
                $recordDtKereta->save();
            }
        }elseif(is_object($request->data->passengers->passenger)){
            $saveTransDtKereta['seats'] = $request->data->passengers->passenger->seat;
            $saveTransDtKereta['seatSelect'] = $request->data->passengers->passenger->category;
            $saveTransDtKereta['kodeWagon'] = $request->data->passengers->passenger->kodeWagon;
            $saveTransDtKereta['adult_id'] = $request->data->passengers->passenger->id;
            $saveTransDtKereta['adult_name'] = $request->data->passengers->passenger->name;
            $recordDtKereta = new TransaksiAmpaseKereta;
            $recordDtKereta->fill($saveTransDtKereta);
            $recordDtKereta->save();
        }
    }
}

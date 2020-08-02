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

use App\Http\Requests\APIRequest\TransaksiBarangRequest;

use Veritrans_Config;
use Veritrans_Snap;
use Veritrans_Notification;
use Veritrans_Transaction;
use Veritrans_VtDirect;
use Carbon\Carbon;
use DB;


class TransaksiController extends Controller
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
        $data = new QueryBuilder(new TransaksiAmpase, $request);
        
        if($page = $request->page){
            return $data->build()->paginate();
        }

        return response()->json([
            'status' => true,
            'data' => $data->build()->get()
        ]);
    }

    public function show($id)
    {
        $record = TransaksiAmpase::with('attach','prepaid','postpaid','detail','kurir','user')->get();

        return response()->json([
            'status' => true,
            'data' => $record
        ]);
    }

    public function status($id)
    {
        if($id){
            $data = Veritrans_Transaction::status($id);
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

    public function approve($id)
    {
        if($id){
            $data = [];
            $record = TransaksiAmpase::where('order_id',$id)->first();

            if($record->status == 'capture'){
              return response()->json([
                  'status' => false,
                  'message' => 'Data Sudah Terubah'
              ]);
            }elseif($record->status == 'refund' || $record->status == 'chargeback' || $record->status == 'partial_refund' || 'partial_chargeback'){
              return response()->json([
                  'status' => false,
                  'message' => 'Status Transaksi Belum Masuk Kedalam refund / chargeback / partial_refund / partial_chargeback'
              ]);
            }else{
              $data = Veritrans_Transaction::cancel($id);
              $record->status = $data->transaction_status;
              $record->save();
            }
            
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

    public function cancel($id)
    {
        try {
            $data = [];
            $record = TransaksiAmpase::where('order_id',$id)->first();
            if($record->status == 'cancel'){
              return response()->json([
                  'status' => false,
                  'message' => 'Data Sudah Expier'
              ]);
            }else{
              
              $data = Veritrans_Transaction::cancel($id);
              $record->status = $data->transaction_status;
              $record->save();
            }
            
            if($data == true){
                return $this->messageApiJsonObject('true',$data);
            }else{
                return $this->messageApiJsonObject();
            }
           
        } catch (Exception $e) {
            return response()->json([
                  'status' => false,
                  'message' => 'Data Tidak Ditemukan'
            ]);
        }
        
    }

    public function expiers($id)
    {
        try {
            if($id){
                $data = [];
                $record = TransaksiAmpase::where('order_id',$id)->first();
                if($record->status == 'expire'){
                  return response()->json([
                      'status' => false,
                      'message' => 'Data Sudah Expier'
                  ]);
                }else{
                  $data = Veritrans_Transaction::expire($id);
                  $record->status = $data->transaction_status;
                  $record->save();
                }
                
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
        } catch (Exception $e) {
            return response()->json([
                  'status' => false,
                  'message' => 'Data Tidak Ditemukan'
            ]);
        }
        
    }

    public function capture($id)
    {
        try {
            if($id){
                $data = [];
                $record = TransaksiAmpase::where('order_id',$id)->first();
                if($record->status == 'expire'){
                  return response()->json([
                      'status' => false,
                      'message' => 'Data Sudah Expier'
                  ]);
                }else{
                  $data = Veritrans_Transaction::expire($id);
                  $record->status = $data->transaction_status;
                  $record->save();
                }
                
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
        } catch (Exception $e) {
            return response()->json([
                  'status' => false,
                  'message' => 'Data Tidak Ditemukan'
            ]);
        }
        
    }

  

      public function getNotif(Request $request){
        try{
          $notif = $request;
          $file = fopen("testNotif.txt","w");
          fwrite($file,json_encode($request->all()));
          fclose($file);
          $recordTrans = TransaksiAmpase::where('order_id',$notif->order_id)->first();
          $recordTrans->transaction_time_expiry = Carbon::parse($recordTrans->transaction_time)->addDays(1)->format('Y-m-d H:i:s');
          if($recordTrans){
            $recordTrans->fill($notif->all());
            $recordTrans->save();
            $recordTrans->checkTransaksi($notif);
            $recordTrans->checkTransaksiBarangRental($notif);
              
          }
          return response()->json([
            'status' => 200,
          ]);
        } catch (Exception $e) {
            $file = fopen("testErrorMobilPulsa.txt","w");
            fwrite($file,$e->getMessage());
            fclose($file);
        }
      }

}

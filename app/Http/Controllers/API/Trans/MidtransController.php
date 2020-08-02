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

class MidtransController extends Controller
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
        return response([
            'not found'
        ],500);
    }

    public function getTokenCredit(Request $request){
        $request['client_key'] = config('services.midtrans.clientKey');
        $AuthMarket = base64_encode(config('services.midtrans.serverKey').':');
        $paramReq = http_build_query($request->all());
        $data = [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'verify' => false
        ];

        $client = new Client();
        $apiUrl = config('services.midtrans.midtransUrl');
        $result = $client->get($apiUrl.'/v2/token?'.$paramReq,$data);
        return $result;
    }
}

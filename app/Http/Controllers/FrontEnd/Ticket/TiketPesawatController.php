<?php

namespace App\Http\Controllers\FrontEnd\Ticket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\Models\User;

use App\Models\TransaksiAmpas\TransaksiAmpase;
use App\Models\TransaksiAmpas\TransaksiAmpaseBarangDetail;
use App\Models\TransaksiAmpas\TransaksiAmpaseKereta;
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
use App\Helpers\HelpersTiketPesawat;


class TiketPesawatController extends Controller
{
    //
    protected $link = 'check-ticket/';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Cek Ticket Anda");
        $this->setGroup("Cek Ticket Anda");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Cek Ticket Anda' => '#']);

        Veritrans_Config::$serverKey = config('services.midtrans.serverKey');
        Veritrans_Config::$isProduction = config('services.midtrans.isProduction');
        Veritrans_Config::$isSanitized = config('services.midtrans.isSanitized');
        Veritrans_Config::$is3ds = config('services.midtrans.is3ds');
    }

    public function checkPesawat(Request $request){
        // dd($request->all());

        // dd(json_decode());
        $searchAirB = [];
        $searchAirB['d'] = $request->pswt['rute_asal'];
        $searchAirB['a'] = $request->pswt['rute_tujuan'];
        $searchAirB['date'] = $request->pswt['tanggal_berangkat'];
        $searchAirB['ret_date'] = isset($request->pswt['tanggal_kepulangan']) ? $request->pswt['tanggal_kepulangan'] : '';
        $searchAirB['adult'] = $request->pswt['dewasa'];
        $searchAirB['child'] = $request->pswt['anak'];
        $searchAirB['infant'] = $request->pswt['bayi'];
        $searchAirB['v'] = 1;
        $searchAirB['time'] = time();
        // dd($this->jsonAlias());
        // dd(HelpersTiketPesawat::TiketGetSearch(http_build_query($searchAirB)));

        $recordKepulangan = [];
        if(isset($request->pswt['pulang_pergi'])){
            if($request->pswt['pulang_pergi'] != 1){
                header('HTTP/1.1 500 Internal Server Booboo');
                header('Content-Type: application/json; charset=UTF-8');
                die(json_encode(array('message' => 'ERROR', 'errors' => array("pulang_pergi" => ["Silahkan Cek Ulang Kembali"]))));
            }else{
                $this->validate($request,[
                    'pswt.rute_asal' => 'required',
                    'pswt.rute_tujuan' => 'required',
                    'pswt.tanggal_berangkat' => 'required|date',
                    'pswt.tanggal_kepulangan' => 'required|date|after_or_equal:pswt.tanggal_berangkat',
                    'pswt.dewasa' => 'required|numeric|min:1|max:7'
                ]);
                
            }
        }else{
            $this->validate($request,[
                'pswt.rute_asal' => 'required',
                'pswt.rute_tujuan' => 'required',
                'pswt.tanggal_berangkat' => 'required',
                'pswt.dewasa' => 'required|numeric|min:1|max:7'
            ]);
        }
       
        return $this->render('frontend.home.partial.ppob.9-1', ['record' => $this->jsonAlias(),'request'=>$request->all()]);
    }

    public function store(Request $request){
        // dd($request->all());
        DB::beginTransaction();
        try {
            $this->storeRequest($request);
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
            'record' => $recordTrans,
            'url' => url('transaksi/confirmation/'.$recordTrans->order_id)
        ]);
    }

    public function notFoundPage(){
        return $this->render('failed.page', ['mockup' => false]);
    }

    public function storeRequest(Request $request){
        // dd($request->anak);
        // $this->validate($request,[
        //     'dewasa' => 'required|numeric|min:1|max:4',
        //     'berangkat.dewasa.*.title' => 'required|max:185',
        //     'berangkat.dewasa.*.name' => 'required|max:185',
        //     'berangkat.dewasa.*.negara' => 'required|max:185',

        //     'berangkat.anak.*.title' => 'required|max:185',
        //     'berangkat.anak.*.name' => 'required|max:185',
        //     'berangkat.anak.*.negara' => 'required|max:185',
        //     'berangkat.anak.*.dob' => 'required|max:185',

        //     'berangkat.bayi.*.title' => 'required|max:185',
        //     'berangkat.bayi.*.name' => 'required|max:185',
        //     'berangkat.bayi.*.negara' => 'required|max:185',
        //     'berangkat.bayi.*.dob' => 'required|max:185',
            
        // ],[
        //     'required' => 'Kolom tidak boleh kosong',
        //     'max' => 'Karakter tidak boleh lebih dari :max',
        //     'min' => 'Karakter tidak boleh lebih dari :min',
        //     'numeric' => 'Isian Kolom harus berisi Nomor',
        //     'digits' => 'Isian tidak boleh melebihi :digits',
        // ]);
    }

    public function saveKereta(Request $request){
        $recPesawat = $this->jsonAlias();
        $recKeberangkatan = [];
        if($recPesawat->departures){
            if(count($recPesawat->departures->result) > 0){
                foreach ($recPesawat->departures->result as $k => $value) {
                    if($value->flight_id == $request->pswtid){
                        $recKeberangkatan = $value;
                    }
                }
            }
        }
        // dd($recKeberangkatan);
        // $recKeberangkatan = json_decode(json_encode($this->cekArray()));
            if($recKeberangkatan){
                $saveRt1 = [];
                $saveRt1['user_id'] = auth()->user()->id;
                $saveRt1['status'] = 'Menunggu Pembayaran';
                $saveRt1['total_harga'] = (float)$recKeberangkatan->price_value * count($request->berangkat['dewasa']);
                $recordTrans = new TransaksiAmpase;
                $recordTrans->fill($saveRt1);
                $recordTrans->save();

                $generateOrder = generateOrder(strlen(auth()->user()->nama));
                $recordTrans->order_id = '0'.$generateOrder.'000'.$recordTrans->id;
                $recordTrans->save();

                // $this->addAttribute($recKeberangkatan,$recordTrans->id);
                // if($request->pulang_pergi != '-'){
                //     $recKepulangan = json_decode(HelpersPPOB::storePulangKereta($request->all()));
                //     // $recKepulangan = json_decode(json_encode($this->cekArray()));
                //     if($recKepulangan){
                //         $this->addAttribute($recKepulangan,$recordTrans->id,'Kepulangan');
                //         $totalJML = (int)$recordTrans->total_harga+(int)$recKepulangan->data->totalPrice;
                //         $recordTrans->total_harga = $totalJML;
                //         $recordTrans->save();
                //     }
                // }

                // if($recordTrans->kereta->count() > 0){
                //     foreach ($recordTrans->kereta as $k => $value) {
                        $toMidtrans['item_details'][0]['id'] = $recordTrans->id;
                        $toMidtrans['item_details'][0]['name'] = $recKeberangkatan->airlines_name.' ('.$recKeberangkatan->flight_number.') ';
                        $toMidtrans['item_details'][0]['price'] = (float)$recKeberangkatan->price_value;
                        $toMidtrans['item_details'][0]['quantity'] = count($request->berangkat['dewasa']);
                //     }
                // }
                // $addToMidtrans['id'] = $recordTrans->id;
                // $addToMidtrans['name'] = 'Biaya Administrasi Keberangkatan';
                // $addToMidtrans['price'] = $recKeberangkatan->data->admin;
                // $addToMidtrans['quantity'] = 1;
                // array_push($toMidtrans['item_details'],$addToMidtrans);

                $toMidtrans['transaction_details'] = array(
                  'order_id' => $recordTrans->order_id,
                  'gross_amount' => $recordTrans->total_harga
                );

                // if($request->pulang_pergi != '-'){
                //     // $recKepulangan = json_decode(HelpersPPOB::storePulangKereta($request->all()));
                //     $recKepulangan = json_decode(json_encode($this->cekArray()));
                //     if($recKepulangan){
                //         $addToMidtransPulang['id'] = $recordTrans->kereta->count()+2;
                //         $addToMidtransPulang['name'] = 'Biaya Administrasi Kepulangan';
                //         $addToMidtransPulang['price'] = $recKepulangan->data->admin;
                //         $addToMidtransPulang['quantity'] = 1;
                //         array_push($toMidtrans['item_details'],$addToMidtransPulang);
                //     }
                // }
               
                $toMidtrans["customer_details"]['first_name'] = auth()->user()->nama;
                $toMidtrans["customer_details"]['last_name'] = '';
                $toMidtrans["customer_details"]['email'] = auth()->user()->email;
                $toMidtrans["customer_details"]['phone'] = auth()->user()->phone;
                $toMidtrans["customer_details"]['billing_address']['first_name'] = auth()->user()->nama;
                $toMidtrans["customer_details"]['billing_address']['last_name'] = '';
                $toMidtrans["customer_details"]['billing_address']['email'] = auth()->user()->email;
                $toMidtrans["customer_details"]['billing_address']['phone'] = auth()->user()->phone;
                $toMidtrans["customer_details"]['billing_address']['address'] = auth()->user()->alamat;
                $toMidtrans["customer_details"]['billing_address']['city'] = auth()->user()->kota->kota;
                $toMidtrans["customer_details"]['billing_address']['postal_code'] = auth()->user()->kode_pos;
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

    public function jsonAlias(){
        return json_decode('{
          "output_type": "json",
          "round_trip": true,
          "search_queries": {
            "from": "BPN",
            "to": "MES",
            "date": "2013-02-05",
            "ret_date": "2013-02-10",
            "adult": 1,
            "child": 0,
            "infant": 0
          },
          "go_det": {
            "dep_airport": {
              "airport_code": "BPN",
              "international": "1",
              "trans_name_id": "7565",
              "business_name": "SEPINGGAN",
              "business_name_trans_id": "5924",
              "business_id": "20350",
              "country_name": "Indonesia ",
              "city_name": "Balikpapan",
              "province_name": "Kalimantan Timur",
              "location_name": "BalikPapan"
            },
            "arr_airport": {
              "airport_code": "MES",
              "international": "1",
              "trans_name_id": "7585",
              "business_name": "POLONIA",
              "business_name_trans_id": "5949",
              "business_id": "20375",
              "country_name": "Indonesia ",
              "city_name": "Medan",
              "province_name": "Sumatera Utara",
              "location_name": "Medan"
            },
            "date": "2013-02-05",
            "formatted_date": "05 February 2013"
          },
          "ret_det": {
            "dep_airport": {
              "airport_code": "MES",
              "international": "1",
              "trans_name_id": "7585",
              "business_name": "POLONIA",
              "business_name_trans_id": "5949",
              "business_id": "20375",
              "country_name": "Indonesia ",
              "city_name": "Medan",
              "province_name": "Sumatera Utara",
              "location_name": "Medan"
            },
            "arr_airport": {
              "airport_code": "BPN",
              "international": "1",
              "trans_name_id": "7565",
              "business_name": "SEPINGGAN",
              "business_name_trans_id": "5924",
              "business_id": "20350",
              "country_name": "Indonesia ",
              "city_name": "Balikpapan",
              "province_name": "Kalimantan Timur",
              "location_name": "BalikPapan"
            },
            "date": "2013-02-10",
            "formatted_date": "10 February 2013"
          },
          "diagnostic": {
            "status": 200,
            "elapsetime": "1.5670",
            "memoryusage": "20.37MB",
            "confirm": "success",
            "lang": "en",
            "currency": "IDR"
          },
          "departures": {
            "result": [
              {
                "flight_id": "3789714",
                "airlines_name": "LION",
                "flight_number": "JT-763/JT-382",
                "price_value": "1126500.00",
                "timestamp": "2013-01-14 16:58:00",
                "price_adult": "1126500.00",
                "price_child": "0.00",
                "price_infant": "0.00",
                "simple_departure_time": "06:00",
                "simple_arrival_time": "15:10",
                "stop": "1 Stop",
                "long_via": "Jakarta (CGK)",
                "full_via": "BPN - CGK (06:00 - 07:10), CGK - MES (12:50 - 15:10)",
                "duration": "10 h 10 m",
                "image": "http://www.sandbox.tiket.com/images/tiket2/icon_lion_2.jpg",
                "flight_infos": {
                  "flight_info": [
                    {
                      "flight_number": "JT-763",
                      "departure_city": "BPN",
                      "arrival_city": "CGK",
                      "simple_departure_time": "06:00",
                      "simple_arrival_time": "07:10"
                    },
                    {
                      "flight_number": "JT-382",
                      "departure_city": "CGK",
                      "arrival_city": "MES",
                      "simple_departure_time": "12:50",
                      "simple_arrival_time": "15:10"
                    }
                  ]
                }
              },
              {
                "flight_id": "3789712",
                "airlines_name": "LION",
                "flight_number": "JT-673/JT-382",
                "price_value": "1126500.00",
                "timestamp": "2013-01-14 16:58:00",
                "price_adult": "1126500.00",
                "price_child": "0.00",
                "price_infant": "0.00",
                "simple_departure_time": "07:45",
                "simple_arrival_time": "15:10",
                "stop": "1 Stop",
                "long_via": "Jakarta (CGK)",
                "full_via": "BPN - CGK (07:45 - 08:55), CGK - MES (12:50 - 15:10)",
                "duration": "8 h 25 m",
                "image": "http://www.sandbox.tiket.com/images/tiket2/icon_lion_2.jpg",
                "flight_infos": {
                  "flight_info": [
                    {
                      "flight_number": "JT-673",
                      "departure_city": "BPN",
                      "arrival_city": "CGK",
                      "simple_departure_time": "07:45",
                      "simple_arrival_time": "08:55"
                    },
                    {
                      "flight_number": "JT-382",
                      "departure_city": "CGK",
                      "arrival_city": "MES",
                      "simple_departure_time": "12:50",
                      "simple_arrival_time": "15:10"
                    }
                  ]
                }
              },
              {
                "flight_id": "3789711",
                "airlines_name": "LION",
                "flight_number": "JT-763/JT-398",
                "price_value": "1126500.00",
                "timestamp": "2013-01-14 16:58:00",
                "price_adult": "1126500.00",
                "price_child": "0.00",
                "price_infant": "0.00",
                "simple_departure_time": "06:00",
                "simple_arrival_time": "14:40",
                "stop": "1 Stop",
                "long_via": "Jakarta (CGK)",
                "full_via": "BPN - CGK (06:00 - 07:10), CGK - MES (12:20 - 14:40)",
                "duration": "9 h 40 m",
                "image": "http://www.sandbox.tiket.com/images/tiket2/icon_lion_2.jpg",
                "flight_infos": {
                  "flight_info": [
                    {
                      "flight_number": "JT-763",
                      "departure_city": "BPN",
                      "arrival_city": "CGK",
                      "simple_departure_time": "06:00",
                      "simple_arrival_time": "07:10"
                    },
                    {
                      "flight_number": "JT-398",
                      "departure_city": "CGK",
                      "arrival_city": "MES",
                      "simple_departure_time": "12:20",
                      "simple_arrival_time": "14:40"
                    }
                  ]
                }
              },
              {
                "flight_id": "3789715",
                "airlines_name": "LION",
                "flight_number": "JT-673/JT-384",
                "price_value": "1126500.00",
                "timestamp": "2013-01-14 16:58:00",
                "price_adult": "1126500.00",
                "price_child": "0.00",
                "price_infant": "0.00",
                "simple_departure_time": "07:45",
                "simple_arrival_time": "16:20",
                "stop": "1 Stop",
                "long_via": "Jakarta (CGK)",
                "full_via": "BPN - CGK (07:45 - 08:55), CGK - MES (14:00 - 16:20)",
                "duration": "9 h 35 m",
                "image": "http://www.sandbox.tiket.com/images/tiket2/icon_lion_2.jpg",
                "flight_infos": {
                  "flight_info": [
                    {
                      "flight_number": "JT-673",
                      "departure_city": "BPN",
                      "arrival_city": "CGK",
                      "simple_departure_time": "07:45",
                      "simple_arrival_time": "08:55"
                    },
                    {
                      "flight_number": "JT-384",
                      "departure_city": "CGK",
                      "arrival_city": "MES",
                      "simple_departure_time": "14:00",
                      "simple_arrival_time": "16:20"
                    }
                  ]
                }
              },
              {
                "flight_id": "4755478",
                "airlines_name": "SRIWIJAYA",
                "flight_number": "SJ-231/SJ-020",
                "price_value": "2690000.00",
                "timestamp": "2013-01-14 16:57:55",
                "price_adult": "2690000.00",
                "price_child": "0.00",
                "price_infant": "0.00",
                "simple_departure_time": "09:00",
                "simple_arrival_time": "15:40",
                "stop": "3 Stops",
                "long_via": "Yogyakarta (JOG) - Jakarta (CGK) - Padang (PDG)",
                "full_via": "BPN - CGK (09:00 - 11:20), CGK - MES (12:30 - 15:40)",
                "duration": "7 h 40 m",
                "image": "http://www.sandbox.tiket.com/images/tiket2/icon_sriwijaya_2.jpg",
                "flight_infos": {
                  "flight_info": [
                    {
                      "flight_number": "SJ-231",
                      "departure_city": "BPN",
                      "arrival_city": "CGK",
                      "simple_departure_time": "09:00",
                      "simple_arrival_time": "11:20"
                    },
                    {
                      "flight_number": "SJ-020",
                      "departure_city": "CGK",
                      "arrival_city": "MES",
                      "simple_departure_time": "12:30",
                      "simple_arrival_time": "15:40"
                    }
                  ]
                }
              },
              {
                "flight_id": "3789719",
                "airlines_name": "LION",
                "flight_number": "JT-367/JT-973",
                "price_value": "1814000.00",
                "timestamp": "2013-01-14 16:58:00",
                "price_adult": "1814000.00",
                "price_child": "0.00",
                "price_infant": "0.00",
                "simple_departure_time": "06:50",
                "simple_arrival_time": "16:00",
                "stop": "2 Stops",
                "long_via": "Surabaya (SUB)",
                "full_via": "BPN - SUB (06:50 - 07:20), SUB - MES (11:50 - 16:00)",
                "duration": "10 h 10 m",
                "image": "http://www.sandbox.tiket.com/images/tiket2/icon_lion_2.jpg",
                "flight_infos": {
                  "flight_info": [
                    {
                      "flight_number": "JT-367",
                      "departure_city": "BPN",
                      "arrival_city": "SUB",
                      "simple_departure_time": "06:50",
                      "simple_arrival_time": "07:20"
                    },
                    {
                      "flight_number": "JT-973",
                      "departure_city": "SUB",
                      "arrival_city": "MES",
                      "simple_departure_time": "11:50",
                      "simple_arrival_time": "16:00"
                    }
                  ]
                }
              },
              {
                "flight_id": "3789718",
                "airlines_name": "LION",
                "flight_number": "JT-361/JT-973",
                "price_value": "1550000.00",
                "timestamp": "2013-01-14 16:58:00",
                "price_adult": "1550000.00",
                "price_child": "0.00",
                "price_infant": "0.00",
                "simple_departure_time": "09:15",
                "simple_arrival_time": "16:00",
                "stop": "2 Stops",
                "long_via": "Surabaya (SUB)",
                "full_via": "BPN - SUB (09:15 - 09:45), SUB - MES (11:50 - 16:00)",
                "duration": "7 h 45 m",
                "image": "http://www.sandbox.tiket.com/images/tiket2/icon_lion_2.jpg",
                "flight_infos": {
                  "flight_info": [
                    {
                      "flight_number": "JT-361",
                      "departure_city": "BPN",
                      "arrival_city": "SUB",
                      "simple_departure_time": "09:15",
                      "simple_arrival_time": "09:45"
                    },
                    {
                      "flight_number": "JT-973",
                      "departure_city": "SUB",
                      "arrival_city": "MES",
                      "simple_departure_time": "11:50",
                      "simple_arrival_time": "16:00"
                    }
                  ]
                }
              },
              {
                "flight_id": "3789717",
                "airlines_name": "LION",
                "flight_number": "JT-761/JT-384",
                "price_value": "1126500.00",
                "timestamp": "2013-01-14 16:58:00",
                "price_adult": "1126500.00",
                "price_child": "0.00",
                "price_infant": "0.00",
                "simple_departure_time": "09:45",
                "simple_arrival_time": "16:20",
                "stop": "1 Stop",
                "long_via": "Jakarta (CGK)",
                "full_via": "BPN - CGK (09:45 - 10:55), CGK - MES (14:00 - 16:20)",
                "duration": "7 h 35 m",
                "image": "http://www.sandbox.tiket.com/images/tiket2/icon_lion_2.jpg",
                "flight_infos": {
                  "flight_info": [
                    {
                      "flight_number": "JT-761",
                      "departure_city": "BPN",
                      "arrival_city": "CGK",
                      "simple_departure_time": "09:45",
                      "simple_arrival_time": "10:55"
                    },
                    {
                      "flight_number": "JT-384",
                      "departure_city": "CGK",
                      "arrival_city": "MES",
                      "simple_departure_time": "14:00",
                      "simple_arrival_time": "16:20"
                    }
                  ]
                }
              },
              {
                "flight_id": "3789709",
                "airlines_name": "LION",
                "flight_number": "JT-673/JT-398",
                "price_value": "1126500.00",
                "timestamp": "2013-01-14 16:58:00",
                "price_adult": "1126500.00",
                "price_child": "0.00",
                "price_infant": "0.00",
                "simple_departure_time": "07:45",
                "simple_arrival_time": "14:40",
                "stop": "1 Stop",
                "long_via": "Jakarta (CGK)",
                "full_via": "BPN - CGK (07:45 - 08:55), CGK - MES (12:20 - 14:40)",
                "duration": "7 h 55 m",
                "image": "http://www.sandbox.tiket.com/images/tiket2/icon_lion_2.jpg",
                "flight_infos": {
                  "flight_info": [
                    {
                      "flight_number": "JT-673",
                      "departure_city": "BPN",
                      "arrival_city": "CGK",
                      "simple_departure_time": "07:45",
                      "simple_arrival_time": "08:55"
                    },
                    {
                      "flight_number": "JT-398",
                      "departure_city": "CGK",
                      "arrival_city": "MES",
                      "simple_departure_time": "12:20",
                      "simple_arrival_time": "14:40"
                    }
                  ]
                }
              },
              {
                "flight_id": "3789703",
                "airlines_name": "LION",
                "flight_number": "JT-763/JT-200",
                "price_value": "1126500.00",
                "timestamp": "2013-01-14 16:58:00",
                "price_adult": "1126500.00",
                "price_child": "0.00",
                "price_infant": "0.00",
                "simple_departure_time": "06:00",
                "simple_arrival_time": "12:10",
                "stop": "1 Stop",
                "long_via": "Jakarta (CGK)",
                "full_via": "BPN - CGK (06:00 - 07:10), CGK - MES (09:50 - 12:10)",
                "duration": "7 h 10 m",
                "image": "http://www.sandbox.tiket.com/images/tiket2/icon_lion_2.jpg",
                "flight_infos": {
                  "flight_info": [
                    {
                      "flight_number": "JT-763",
                      "departure_city": "BPN",
                      "arrival_city": "CGK",
                      "simple_departure_time": "06:00",
                      "simple_arrival_time": "07:10"
                    },
                    {
                      "flight_number": "JT-200",
                      "departure_city": "CGK",
                      "arrival_city": "MES",
                      "simple_departure_time": "09:50",
                      "simple_arrival_time": "12:10"
                    }
                  ]
                }
              },
              {
                "flight_id": "3789702",
                "airlines_name": "LION",
                "flight_number": "JT-763/JT-214",
                "price_value": "1126500.00",
                "timestamp": "2013-01-14 16:58:00",
                "price_adult": "1126500.00",
                "price_child": "0.00",
                "price_infant": "0.00",
                "simple_departure_time": "06:00",
                "simple_arrival_time": "11:40",
                "stop": "1 Stop",
                "long_via": "Jakarta (CGK)",
                "full_via": "BPN - CGK (06:00 - 07:10), CGK - MES (09:20 - 11:40)",
                "duration": "6 h 40 m",
                "image": "http://www.sandbox.tiket.com/images/tiket2/icon_lion_2.jpg",
                "flight_infos": {
                  "flight_info": [
                    {
                      "flight_number": "JT-763",
                      "departure_city": "BPN",
                      "arrival_city": "CGK",
                      "simple_departure_time": "06:00",
                      "simple_arrival_time": "07:10"
                    },
                    {
                      "flight_number": "JT-214",
                      "departure_city": "CGK",
                      "arrival_city": "MES",
                      "simple_departure_time": "09:20",
                      "simple_arrival_time": "11:40"
                    }
                  ]
                }
              },
              {
                "flight_id": "2765018",
                "airlines_name": "SRIWIJAYA",
                "flight_number": "SJ-161/SJ-014",
                "price_value": "1510000.00",
                "timestamp": "2013-01-14 16:57:55",
                "price_adult": "1510000.00",
                "price_child": "0.00",
                "price_infant": "0.00",
                "simple_departure_time": "13:20",
                "simple_arrival_time": "21:05",
                "stop": "1 Stop",
                "long_via": "Jakarta (CGK)",
                "full_via": "BPN - CGK (13:20 - 14:20), CGK - MES (18:50 - 21:05)",
                "duration": "8 h 45 m",
                "image": "http://www.sandbox.tiket.com/images/tiket2/icon_sriwijaya_2.jpg",
                "flight_infos": {
                  "flight_info": [
                    {
                      "flight_number": "SJ-161",
                      "departure_city": "BPN",
                      "arrival_city": "CGK",
                      "simple_departure_time": "13:20",
                      "simple_arrival_time": "14:20"
                    },
                    {
                      "flight_number": "SJ-014",
                      "departure_city": "CGK",
                      "arrival_city": "MES",
                      "simple_departure_time": "18:50",
                      "simple_arrival_time": "21:05"
                    }
                  ]
                }
              },
              {
                "flight_id": "3789704",
                "airlines_name": "LION",
                "flight_number": "JT-763/JT-204",
                "price_value": "1126500.00",
                "timestamp": "2013-01-14 16:58:00",
                "price_adult": "1126500.00",
                "price_child": "0.00",
                "price_infant": "0.00",
                "simple_departure_time": "06:00",
                "simple_arrival_time": "13:10",
                "stop": "1 Stop",
                "long_via": "Jakarta (CGK)",
                "full_via": "BPN - CGK (06:00 - 07:10), CGK - MES (10:50 - 13:10)",
                "duration": "8 h 10 m",
                "image": "http://www.sandbox.tiket.com/images/tiket2/icon_lion_2.jpg",
                "flight_infos": {
                  "flight_info": [
                    {
                      "flight_number": "JT-763",
                      "departure_city": "BPN",
                      "arrival_city": "CGK",
                      "simple_departure_time": "06:00",
                      "simple_arrival_time": "07:10"
                    },
                    {
                      "flight_number": "JT-204",
                      "departure_city": "CGK",
                      "arrival_city": "MES",
                      "simple_departure_time": "10:50",
                      "simple_arrival_time": "13:10"
                    }
                  ]
                }
              },
              {
                "flight_id": "3789705",
                "airlines_name": "LION",
                "flight_number": "JT-945/JT-911",
                "price_value": "1638000.00",
                "timestamp": "2013-01-14 16:58:00",
                "price_adult": "1638000.00",
                "price_child": "0.00",
                "price_infant": "0.00",
                "simple_departure_time": "07:35",
                "simple_arrival_time": "12:35",
                "stop": "2 Stops",
                "long_via": "Bandung (BDO)",
                "full_via": "BPN - BDO (07:35 - 09:30), BDO - MES (10:15 - 12:35)",
                "duration": "6 h 0 m",
                "image": "http://www.sandbox.tiket.com/images/tiket2/icon_lion_2.jpg",
                "flight_infos": {
                  "flight_info": [
                    {
                      "flight_number": "JT-945",
                      "departure_city": "BPN",
                      "arrival_city": "BDO",
                      "simple_departure_time": "07:35",
                      "simple_arrival_time": "09:30"
                    },
                    {
                      "flight_number": "JT-911",
                      "departure_city": "BDO",
                      "arrival_city": "MES",
                      "simple_departure_time": "10:15",
                      "simple_arrival_time": "12:35"
                    }
                  ]
                }
              },
              {
                "flight_id": "3789708",
                "airlines_name": "LION",
                "flight_number": "JT-763/JT-306",
                "price_value": "1154000.00",
                "timestamp": "2013-01-14 16:58:00",
                "price_adult": "1154000.00",
                "price_child": "0.00",
                "price_infant": "0.00",
                "simple_departure_time": "06:00",
                "simple_arrival_time": "14:10",
                "stop": "1 Stop",
                "long_via": "Jakarta (CGK)",
                "full_via": "BPN - CGK (06:00 - 07:10), CGK - MES (11:50 - 14:10)",
                "duration": "9 h 10 m",
                "image": "http://www.sandbox.tiket.com/images/tiket2/icon_lion_2.jpg",
                "flight_infos": {
                  "flight_info": [
                    {
                      "flight_number": "JT-763",
                      "departure_city": "BPN",
                      "arrival_city": "CGK",
                      "simple_departure_time": "06:00",
                      "simple_arrival_time": "07:10"
                    },
                    {
                      "flight_number": "JT-306",
                      "departure_city": "CGK",
                      "arrival_city": "MES",
                      "simple_departure_time": "11:50",
                      "simple_arrival_time": "14:10"
                    }
                  ]
                }
              },
              {
                "flight_id": "3789706",
                "airlines_name": "LION",
                "flight_number": "JT-673/JT-306",
                "price_value": "1154000.00",
                "timestamp": "2013-01-14 16:58:00",
                "price_adult": "1154000.00",
                "price_child": "0.00",
                "price_infant": "0.00",
                "simple_departure_time": "07:45",
                "simple_arrival_time": "14:10",
                "stop": "1 Stop",
                "long_via": "Jakarta (CGK)",
                "full_via": "BPN - CGK (07:45 - 08:55), CGK - MES (11:50 - 14:10)",
                "duration": "7 h 25 m",
                "image": "http://www.sandbox.tiket.com/images/tiket2/icon_lion_2.jpg",
                "flight_infos": {
                  "flight_info": [
                    {
                      "flight_number": "JT-673",
                      "departure_city": "BPN",
                      "arrival_city": "CGK",
                      "simple_departure_time": "07:45",
                      "simple_arrival_time": "08:55"
                    },
                    {
                      "flight_number": "JT-306",
                      "departure_city": "CGK",
                      "arrival_city": "MES",
                      "simple_departure_time": "11:50",
                      "simple_arrival_time": "14:10"
                    }
                  ]
                }
              },
              {
                "flight_id": "2765017",
                "airlines_name": "SRIWIJAYA",
                "flight_number": "SJ-161/SJ-016",
                "price_value": "1440000.00",
                "timestamp": "2013-01-14 16:57:55",
                "price_adult": "1440000.00",
                "price_child": "0.00",
                "price_infant": "0.00",
                "simple_departure_time": "13:20",
                "simple_arrival_time": "18:45",
                "stop": "1 Stop",
                "long_via": "Jakarta (CGK)",
                "full_via": "BPN - CGK (13:20 - 14:20), CGK - MES (16:30 - 18:45)",
                "duration": "6 h 25 m",
                "image": "http://www.sandbox.tiket.com/images/tiket2/icon_sriwijaya_2.jpg",
                "flight_infos": {
                  "flight_info": [
                    {
                      "flight_number": "SJ-161",
                      "departure_city": "BPN",
                      "arrival_city": "CGK",
                      "simple_departure_time": "13:20",
                      "simple_arrival_time": "14:20"
                    },
                    {
                      "flight_number": "SJ-016",
                      "departure_city": "CGK",
                      "arrival_city": "MES",
                      "simple_departure_time": "16:30",
                      "simple_arrival_time": "18:45"
                    }
                  ]
                }
              }
            ]
          },
          "returns": {
            "result": [
              {
                "flight_id": "724202",
                "airlines_name": "LION",
                "flight_number": "JT-972/JT-730",
                "price_value": "1357500.00",
                "timestamp": "2013-01-11 10:08:26",
                "price_adult": "1357500.00",
                "price_child": "0.00",
                "price_infant": "0.00",
                "simple_departure_time": "12:55",
                "simple_arrival_time": "20:35",
                "stop": "2 Stops",
                "long_via": "Surabaya (SUB)",
                "full_via": "MES - SUB (12:55 - 17:05), SUB - BPN (18:05 - 20:35)",
                "duration": "6 h 40 m",
                "image": "http://www.sandbox.tiket.com/images/tiket2/icon_lion_2.jpg",
                "flight_infos": {
                  "flight_info": [
                    {
                      "flight_number": "JT-972",
                      "departure_city": "MES",
                      "arrival_city": "SUB",
                      "simple_departure_time": "12:55",
                      "simple_arrival_time": "17:05"
                    },
                    {
                      "flight_number": "JT-730",
                      "departure_city": "SUB",
                      "arrival_city": "BPN",
                      "simple_departure_time": "18:05",
                      "simple_arrival_time": "20:35"
                    }
                  ]
                }
              },
              {
                "flight_id": "724201",
                "airlines_name": "LION",
                "flight_number": "JT-397/JT-766",
                "price_value": "1110000.00",
                "timestamp": "2013-01-11 10:08:26",
                "price_adult": "1110000.00",
                "price_child": "0.00",
                "price_infant": "0.00",
                "simple_departure_time": "07:50",
                "simple_arrival_time": "19:15",
                "stop": "1 Stop",
                "long_via": "Jakarta (CGK)",
                "full_via": "MES - CGK (07:50 - 10:15), CGK - BPN (16:10 - 19:15)",
                "duration": "10 h 25 m",
                "image": "http://www.sandbox.tiket.com/images/tiket2/icon_lion_2.jpg",
                "flight_infos": {
                  "flight_info": [
                    {
                      "flight_number": "JT-397",
                      "departure_city": "MES",
                      "arrival_city": "CGK",
                      "simple_departure_time": "07:50",
                      "simple_arrival_time": "10:15"
                    },
                    {
                      "flight_number": "JT-766",
                      "departure_city": "CGK",
                      "arrival_city": "BPN",
                      "simple_departure_time": "16:10",
                      "simple_arrival_time": "19:15"
                    }
                  ]
                }
              },
              {
                "flight_id": "724200",
                "airlines_name": "LION",
                "flight_number": "JT-395/JT-766",
                "price_value": "1082500.00",
                "timestamp": "2013-01-11 10:08:26",
                "price_adult": "1082500.00",
                "price_child": "0.00",
                "price_infant": "0.00",
                "simple_departure_time": "11:00",
                "simple_arrival_time": "19:15",
                "stop": "1 Stop",
                "long_via": "Jakarta (CGK)",
                "full_via": "MES - CGK (11:00 - 13:25), CGK - BPN (16:10 - 19:15)",
                "duration": "7 h 15 m",
                "image": "http://www.sandbox.tiket.com/images/tiket2/icon_lion_2.jpg",
                "flight_infos": {
                  "flight_info": [
                    {
                      "flight_number": "JT-395",
                      "departure_city": "MES",
                      "arrival_city": "CGK",
                      "simple_departure_time": "11:00",
                      "simple_arrival_time": "13:25"
                    },
                    {
                      "flight_number": "JT-766",
                      "departure_city": "CGK",
                      "arrival_city": "BPN",
                      "simple_departure_time": "16:10",
                      "simple_arrival_time": "19:15"
                    }
                  ]
                }
              },
              {
                "flight_id": "5085425",
                "airlines_name": "SRIWIJAYA",
                "flight_number": "SJ-017/SJ-160",
                "price_value": "1360000.00",
                "timestamp": "2013-01-11 10:08:19",
                "price_adult": "1360000.00",
                "price_child": "0.00",
                "price_infant": "0.00",
                "simple_departure_time": "19:30",
                "simple_arrival_time": "09:10",
                "stop": "1 Stop",
                "long_via": "Jakarta (CGK)",
                "full_via": "MES - CGK (19:30 - 21:50), CGK - BPN (06:10 - 09:10)",
                "duration": "12 h 40 m",
                "image": "http://www.sandbox.tiket.com/images/tiket2/icon_sriwijaya_2.jpg",
                "flight_infos": {
                  "flight_info": [
                    {
                      "flight_number": "SJ-017",
                      "departure_city": "MES",
                      "arrival_city": "CGK",
                      "simple_departure_time": "19:30",
                      "simple_arrival_time": "21:50"
                    },
                    {
                      "flight_number": "SJ-160",
                      "departure_city": "CGK",
                      "arrival_city": "BPN",
                      "simple_departure_time": "06:10",
                      "simple_arrival_time": "09:10"
                    }
                  ]
                }
              },
              {
                "flight_id": "5085424",
                "airlines_name": "LION",
                "flight_number": "JT-960/JT-940",
                "price_value": "1396000.00",
                "timestamp": "2013-01-11 10:08:26",
                "price_adult": "1396000.00",
                "price_child": "0.00",
                "price_infant": "0.00",
                "simple_departure_time": "09:00",
                "simple_arrival_time": "20:10",
                "stop": "2 Stops",
                "long_via": "Bandung (BDO)",
                "full_via": "MES - BDO (09:00 - 11:20), BDO - BPN (16:10 - 20:10)",
                "duration": "10 h 10 m",
                "image": "http://www.sandbox.tiket.com/images/tiket2/icon_lion_2.jpg",
                "flight_infos": {
                  "flight_info": [
                    {
                      "flight_number": "JT-960",
                      "departure_city": "MES",
                      "arrival_city": "BDO",
                      "simple_departure_time": "09:00",
                      "simple_arrival_time": "11:20"
                    },
                    {
                      "flight_number": "JT-940",
                      "departure_city": "BDO",
                      "arrival_city": "BPN",
                      "simple_departure_time": "16:10",
                      "simple_arrival_time": "20:10"
                    }
                  ]
                }
              },
              {
                "flight_id": "5085423",
                "airlines_name": "LION",
                "flight_number": "JT-902/JT-940",
                "price_value": "1451000.00",
                "timestamp": "2013-01-11 10:08:26",
                "price_adult": "1451000.00",
                "price_child": "0.00",
                "price_infant": "0.00",
                "simple_departure_time": "13:15",
                "simple_arrival_time": "20:10",
                "stop": "2 Stops",
                "long_via": "Bandung (BDO)",
                "full_via": "MES - BDO (13:15 - 15:35), BDO - BPN (16:10 - 20:10)",
                "duration": "5 h 55 m",
                "image": "http://www.sandbox.tiket.com/images/tiket2/icon_lion_2.jpg",
                "flight_infos": {
                  "flight_info": [
                    {
                      "flight_number": "JT-902",
                      "departure_city": "MES",
                      "arrival_city": "BDO",
                      "simple_departure_time": "13:15",
                      "simple_arrival_time": "15:35"
                    },
                    {
                      "flight_number": "JT-940",
                      "departure_city": "BDO",
                      "arrival_city": "BPN",
                      "simple_departure_time": "16:10",
                      "simple_arrival_time": "20:10"
                    }
                  ]
                }
              },
              {
                "flight_id": "724199",
                "airlines_name": "LION",
                "flight_number": "JT-301/JT-766",
                "price_value": "1082500.00",
                "timestamp": "2013-01-11 10:08:26",
                "price_adult": "1082500.00",
                "price_child": "0.00",
                "price_infant": "0.00",
                "simple_departure_time": "10:00",
                "simple_arrival_time": "19:15",
                "stop": "1 Stop",
                "long_via": "Jakarta (CGK)",
                "full_via": "MES - CGK (10:00 - 12:25), CGK - BPN (16:10 - 19:15)",
                "duration": "8 h 15 m",
                "image": "http://www.sandbox.tiket.com/images/tiket2/icon_lion_2.jpg",
                "flight_infos": {
                  "flight_info": [
                    {
                      "flight_number": "JT-301",
                      "departure_city": "MES",
                      "arrival_city": "CGK",
                      "simple_departure_time": "10:00",
                      "simple_arrival_time": "12:25"
                    },
                    {
                      "flight_number": "JT-766",
                      "departure_city": "CGK",
                      "arrival_city": "BPN",
                      "simple_departure_time": "16:10",
                      "simple_arrival_time": "19:15"
                    }
                  ]
                }
              },
              {
                "flight_id": "724198",
                "airlines_name": "LION",
                "flight_number": "JT-207/JT-766",
                "price_value": "1027500.00",
                "timestamp": "2013-01-11 10:08:26",
                "price_adult": "1027500.00",
                "price_child": "0.00",
                "price_infant": "0.00",
                "simple_departure_time": "08:40",
                "simple_arrival_time": "19:15",
                "stop": "1 Stop",
                "long_via": "Jakarta (CGK)",
                "full_via": "MES - CGK (08:40 - 11:05), CGK - BPN (16:10 - 19:15)",
                "duration": "9 h 35 m",
                "image": "http://www.sandbox.tiket.com/images/tiket2/icon_lion_2.jpg",
                "flight_infos": {
                  "flight_info": [
                    {
                      "flight_number": "JT-207",
                      "departure_city": "MES",
                      "arrival_city": "CGK",
                      "simple_departure_time": "08:40",
                      "simple_arrival_time": "11:05"
                    },
                    {
                      "flight_number": "JT-766",
                      "departure_city": "CGK",
                      "arrival_city": "BPN",
                      "simple_departure_time": "16:10",
                      "simple_arrival_time": "19:15"
                    }
                  ]
                }
              },
              {
                "flight_id": "724192",
                "airlines_name": "LION",
                "flight_number": "JT-397/JT-764",
                "price_value": "1110000.00",
                "timestamp": "2013-01-11 10:08:26",
                "price_adult": "1110000.00",
                "price_child": "0.00",
                "price_infant": "0.00",
                "simple_departure_time": "07:50",
                "simple_arrival_time": "15:55",
                "stop": "1 Stop",
                "long_via": "Jakarta (CGK)",
                "full_via": "MES - CGK (07:50 - 10:15), CGK - BPN (12:50 - 15:55)",
                "duration": "7 h 5 m",
                "image": "http://www.sandbox.tiket.com/images/tiket2/icon_lion_2.jpg",
                "flight_infos": {
                  "flight_info": [
                    {
                      "flight_number": "JT-397",
                      "departure_city": "MES",
                      "arrival_city": "CGK",
                      "simple_departure_time": "07:50",
                      "simple_arrival_time": "10:15"
                    },
                    {
                      "flight_number": "JT-764",
                      "departure_city": "CGK",
                      "arrival_city": "BPN",
                      "simple_departure_time": "12:50",
                      "simple_arrival_time": "15:55"
                    }
                  ]
                }
              },
              {
                "flight_id": "724191",
                "airlines_name": "LION",
                "flight_number": "JT-381/JT-764",
                "price_value": "1082500.00",
                "timestamp": "2013-01-11 10:08:26",
                "price_adult": "1082500.00",
                "price_child": "0.00",
                "price_infant": "0.00",
                "simple_departure_time": "06:45",
                "simple_arrival_time": "15:55",
                "stop": "1 Stop",
                "long_via": "Jakarta (CGK)",
                "full_via": "MES - CGK (06:45 - 09:10), CGK - BPN (12:50 - 15:55)",
                "duration": "8 h 10 m",
                "image": "http://www.sandbox.tiket.com/images/tiket2/icon_lion_2.jpg",
                "flight_infos": {
                  "flight_info": [
                    {
                      "flight_number": "JT-381",
                      "departure_city": "MES",
                      "arrival_city": "CGK",
                      "simple_departure_time": "06:45",
                      "simple_arrival_time": "09:10"
                    },
                    {
                      "flight_number": "JT-764",
                      "departure_city": "CGK",
                      "arrival_city": "BPN",
                      "simple_departure_time": "12:50",
                      "simple_arrival_time": "15:55"
                    }
                  ]
                }
              },
              {
                "flight_id": "724190",
                "airlines_name": "LION",
                "flight_number": "JT-211/JT-764",
                "price_value": "1027500.00",
                "timestamp": "2013-01-11 10:08:26",
                "price_adult": "1027500.00",
                "price_child": "0.00",
                "price_infant": "0.00",
                "simple_departure_time": "05:45",
                "simple_arrival_time": "15:55",
                "stop": "1 Stop",
                "long_via": "Jakarta (CGK)",
                "full_via": "MES - CGK (05:45 - 08:10), CGK - BPN (12:50 - 15:55)",
                "duration": "9 h 10 m",
                "image": "http://www.sandbox.tiket.com/images/tiket2/icon_lion_2.jpg",
                "flight_infos": {
                  "flight_info": [
                    {
                      "flight_number": "JT-211",
                      "departure_city": "MES",
                      "arrival_city": "CGK",
                      "simple_departure_time": "05:45",
                      "simple_arrival_time": "08:10"
                    },
                    {
                      "flight_number": "JT-764",
                      "departure_city": "CGK",
                      "arrival_city": "BPN",
                      "simple_departure_time": "12:50",
                      "simple_arrival_time": "15:55"
                    }
                  ]
                }
              },
              {
                "flight_id": "724189",
                "airlines_name": "LION",
                "flight_number": "JT-381/JT-756",
                "price_value": "1082500.00",
                "timestamp": "2013-01-11 10:08:26",
                "price_adult": "1082500.00",
                "price_child": "0.00",
                "price_infant": "0.00",
                "simple_departure_time": "06:45",
                "simple_arrival_time": "15:00",
                "stop": "1 Stop",
                "long_via": "Jakarta (CGK)",
                "full_via": "MES - CGK (06:45 - 09:10), CGK - BPN (11:55 - 15:00)",
                "duration": "7 h 15 m",
                "image": "http://www.sandbox.tiket.com/images/tiket2/icon_lion_2.jpg",
                "flight_infos": {
                  "flight_info": [
                    {
                      "flight_number": "JT-381",
                      "departure_city": "MES",
                      "arrival_city": "CGK",
                      "simple_departure_time": "06:45",
                      "simple_arrival_time": "09:10"
                    },
                    {
                      "flight_number": "JT-756",
                      "departure_city": "CGK",
                      "arrival_city": "BPN",
                      "simple_departure_time": "11:55",
                      "simple_arrival_time": "15:00"
                    }
                  ]
                }
              },
              {
                "flight_id": "724193",
                "airlines_name": "LION",
                "flight_number": "JT-207/JT-768",
                "price_value": "1027500.00",
                "timestamp": "2013-01-11 10:08:26",
                "price_adult": "1027500.00",
                "price_child": "0.00",
                "price_infant": "0.00",
                "simple_departure_time": "08:40",
                "simple_arrival_time": "17:50",
                "stop": "1 Stop",
                "long_via": "Jakarta (CGK)",
                "full_via": "MES - CGK (08:40 - 11:05), CGK - BPN (14:45 - 17:50)",
                "duration": "8 h 10 m",
                "image": "http://www.sandbox.tiket.com/images/tiket2/icon_lion_2.jpg",
                "flight_infos": {
                  "flight_info": [
                    {
                      "flight_number": "JT-207",
                      "departure_city": "MES",
                      "arrival_city": "CGK",
                      "simple_departure_time": "08:40",
                      "simple_arrival_time": "11:05"
                    },
                    {
                      "flight_number": "JT-768",
                      "departure_city": "CGK",
                      "arrival_city": "BPN",
                      "simple_departure_time": "14:45",
                      "simple_arrival_time": "17:50"
                    }
                  ]
                }
              },
              {
                "flight_id": "724194",
                "airlines_name": "LION",
                "flight_number": "JT-301/JT-768",
                "price_value": "1082500.00",
                "timestamp": "2013-01-11 10:08:26",
                "price_adult": "1082500.00",
                "price_child": "0.00",
                "price_infant": "0.00",
                "simple_departure_time": "10:00",
                "simple_arrival_time": "17:50",
                "stop": "1 Stop",
                "long_via": "Jakarta (CGK)",
                "full_via": "MES - CGK (10:00 - 12:25), CGK - BPN (14:45 - 17:50)",
                "duration": "6 h 50 m",
                "image": "http://www.sandbox.tiket.com/images/tiket2/icon_lion_2.jpg",
                "flight_infos": {
                  "flight_info": [
                    {
                      "flight_number": "JT-301",
                      "departure_city": "MES",
                      "arrival_city": "CGK",
                      "simple_departure_time": "10:00",
                      "simple_arrival_time": "12:25"
                    },
                    {
                      "flight_number": "JT-768",
                      "departure_city": "CGK",
                      "arrival_city": "BPN",
                      "simple_departure_time": "14:45",
                      "simple_arrival_time": "17:50"
                    }
                  ]
                }
              },
              {
                "flight_id": "724197",
                "airlines_name": "LION",
                "flight_number": "JT-970/JT-366",
                "price_value": "1313500.00",
                "timestamp": "2013-01-11 10:08:26",
                "price_adult": "1313500.00",
                "price_child": "0.00",
                "price_infant": "0.00",
                "simple_departure_time": "07:00",
                "simple_arrival_time": "17:15",
                "stop": "2 Stops",
                "long_via": "Surabaya (SUB)",
                "full_via": "MES - SUB (07:00 - 11:10), SUB - BPN (14:45 - 17:15)",
                "duration": "9 h 15 m",
                "image": "http://www.sandbox.tiket.com/images/tiket2/icon_lion_2.jpg",
                "flight_infos": {
                  "flight_info": [
                    {
                      "flight_number": "JT-970",
                      "departure_city": "MES",
                      "arrival_city": "SUB",
                      "simple_departure_time": "07:00",
                      "simple_arrival_time": "11:10"
                    },
                    {
                      "flight_number": "JT-366",
                      "departure_city": "SUB",
                      "arrival_city": "BPN",
                      "simple_departure_time": "14:45",
                      "simple_arrival_time": "17:15"
                    }
                  ]
                }
              },
              {
                "flight_id": "724196",
                "airlines_name": "LION",
                "flight_number": "JT-397/JT-768",
                "price_value": "1110000.00",
                "timestamp": "2013-01-11 10:08:26",
                "price_adult": "1110000.00",
                "price_child": "0.00",
                "price_infant": "0.00",
                "simple_departure_time": "07:50",
                "simple_arrival_time": "17:50",
                "stop": "1 Stop",
                "long_via": "Jakarta (CGK)",
                "full_via": "MES - CGK (07:50 - 10:15), CGK - BPN (14:45 - 17:50)",
                "duration": "9 h 0 m",
                "image": "http://www.sandbox.tiket.com/images/tiket2/icon_lion_2.jpg",
                "flight_infos": {
                  "flight_info": [
                    {
                      "flight_number": "JT-397",
                      "departure_city": "MES",
                      "arrival_city": "CGK",
                      "simple_departure_time": "07:50",
                      "simple_arrival_time": "10:15"
                    },
                    {
                      "flight_number": "JT-768",
                      "departure_city": "CGK",
                      "arrival_city": "BPN",
                      "simple_departure_time": "14:45",
                      "simple_arrival_time": "17:50"
                    }
                  ]
                }
              },
              {
                "flight_id": "724195",
                "airlines_name": "LION",
                "flight_number": "JT-381/JT-768",
                "price_value": "1082500.00",
                "timestamp": "2013-01-11 10:08:26",
                "price_adult": "1082500.00",
                "price_child": "0.00",
                "price_infant": "0.00",
                "simple_departure_time": "06:45",
                "simple_arrival_time": "17:50",
                "stop": "1 Stop",
                "long_via": "Jakarta (CGK)",
                "full_via": "MES - CGK (06:45 - 09:10), CGK - BPN (14:45 - 17:50)",
                "duration": "10 h 5 m",
                "image": "http://www.sandbox.tiket.com/images/tiket2/icon_lion_2.jpg",
                "flight_infos": {
                  "flight_info": [
                    {
                      "flight_number": "JT-381",
                      "departure_city": "MES",
                      "arrival_city": "CGK",
                      "simple_departure_time": "06:45",
                      "simple_arrival_time": "09:10"
                    },
                    {
                      "flight_number": "JT-768",
                      "departure_city": "CGK",
                      "arrival_city": "BPN",
                      "simple_departure_time": "14:45",
                      "simple_arrival_time": "17:50"
                    }
                  ]
                }
              },
              {
                "flight_id": "724188",
                "airlines_name": "LION",
                "flight_number": "JT-211/JT-756",
                "price_value": "1027500.00",
                "timestamp": "2013-01-11 10:08:26",
                "price_adult": "1027500.00",
                "price_child": "0.00",
                "price_infant": "0.00",
                "simple_departure_time": "05:45",
                "simple_arrival_time": "15:00",
                "stop": "1 Stop",
                "long_via": "Jakarta (CGK)",
                "full_via": "MES - CGK (05:45 - 08:10), CGK - BPN (11:55 - 15:00)",
                "duration": "8 h 15 m",
                "image": "http://www.sandbox.tiket.com/images/tiket2/icon_lion_2.jpg",
                "flight_infos": {
                  "flight_info": [
                    {
                      "flight_number": "JT-211",
                      "departure_city": "MES",
                      "arrival_city": "CGK",
                      "simple_departure_time": "05:45",
                      "simple_arrival_time": "08:10"
                    },
                    {
                      "flight_number": "JT-756",
                      "departure_city": "CGK",
                      "arrival_city": "BPN",
                      "simple_departure_time": "11:55",
                      "simple_arrival_time": "15:00"
                    }
                  ]
                }
              }
            ]
          },
          "nearby_go_date": {
            "nearby": [
              {
                "date": "2013-01-31",
                "price": "1000000.00"
              },
              {
                "date": "2013-02-01",
                "price": "1027500.00"
              },
              {
                "date": "2013-02-02",
                "price": "1027500.00"
              },
              {
                "date": "2013-02-03",
                "price": "1027500.00"
              },
              {
                "date": "2013-02-04",
                "price": "1027500.00"
              },
              {
                "date": "2013-02-05",
                "price": "1126500.00"
              },
              {
                "date": "2013-02-06",
                "price": "1126500.00"
              },
              {
                "date": "2013-02-07",
                "price": "1209000.00"
              },
              {
                "date": "2013-02-08",
                "price": "1374000.00"
              },
              {
                "date": "2013-02-09",
                "price": "1319000.00"
              },
              {
                "date": "2013-02-10",
                "price": "1027500.00"
              }
            ]
          },
          "nearby_ret_date": {
            "nearby": [
              {
                "date": "2013-02-05",
                "price": "1126500.00"
              },
              {
                "date": "2013-02-06",
                "price": "1126500.00"
              },
              {
                "date": "2013-02-07",
                "price": "1209000.00"
              },
              {
                "date": "2013-02-08",
                "price": "1374000.00"
              },
              {
                "date": "2013-02-09",
                "price": "1319000.00"
              },
              {
                "date": "2013-02-10",
                "price": "1027500.00"
              },
              {
                "date": "2013-02-11",
                "price": "1027500.00"
              },
              {
                "date": "2013-02-12",
                "price": "1027500.00"
              },
              {
                "date": "2013-02-13",
                "price": "1027500.00"
              },
              {
                "date": "2013-02-14",
                "price": "1027500.00"
              },
              {
                "date": "2013-02-15",
                "price": "1027500.00"
              }
            ]
          },
          "token": "7f6ba5da47c3a36159463ddddfa530ab"
        }');
    }
}

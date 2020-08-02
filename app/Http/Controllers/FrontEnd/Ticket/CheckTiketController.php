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


class CheckTiketController extends Controller
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

    public function checkKereta(Request $request){
        $recordKepulangan = [];
        if(isset($request->pulang_pergi)){
            if($request->pulang_pergi != 1){
                header('HTTP/1.1 500 Internal Server Booboo');
                header('Content-Type: application/json; charset=UTF-8');
                die(json_encode(array('message' => 'ERROR', 'errors' => array("pulang_pergi" => ["Silahkan Cek Ulang Kembali"]))));
            }else{
                $this->validate($request,[
                    'tanggal_berangkat' => 'required|date',
                    'tanggal_kepulangan' => 'required|date|after_or_equal:tanggal_berangkat',
                    'dewasa' => 'required|numeric|min:1|max:4'
                ]);
                $kepulangan['rute_asal'] = $request->rute_tujuan;
                $kepulangan['rute_tujuan'] = $request->rute_asal;
                $kepulangan['tanggal_berangkat'] = $request->tanggal_kepulangan;
                $recordKepulangan = HelpersPPOB::findKereta($kepulangan);  
            }
        }else{
            $this->validate($request,[
                'tanggal_berangkat' => 'required',
                'dewasa' => 'required|numeric|min:1|max:4'
            ]);
        }
        $recordBerangkat = HelpersPPOB::findKereta($request->all());  

        $recBerangkat = json_decode($recordBerangkat);
        if($recordKepulangan){
            $recKepulangan = json_decode($recordKepulangan);
        }else{
            $recKepulangan = [];
        }
        $hasilBerangkat = [];
        if(isset($recBerangkat->data)){
            foreach ($recBerangkat->data as $k => $value) {
                $hasilBerangkat[$k] = $value;
            }
        }

        $hasilKepulangan = [];
        if(isset($recKepulangan->data)){
            foreach ($recKepulangan->data as $k => $value) {
                $hasilKepulangan[$k] = $value;
            }
        }
        return $this->render('frontend.home.partial.ppob.8-1', ['record' => $hasilBerangkat,'hasilKepulangan'=>$hasilKepulangan,'request'=>$request->all()]);
    }

    public function checkKursi(Request $request){
        $this->validate($request,[
            'dewasa' => 'required|numeric|min:1|max:4',
            'berangkat.passenger.adult.*.title' => 'required|max:185',
            'berangkat.passenger.adult.*.name' => 'required|max:185',
            'berangkat.passenger.adult.*.tanda_pengenal' => 'required|max:185',
            'berangkat.passenger.adult.*.id' => 'required|max:185',
            'berangkat.passenger.adult.*.dob' => 'required|date|max:185',
            'berangkat.passenger.adult.*.phone' => 'required|numeric',
        ],[
            'required' => 'Kolom tidak boleh kosong',
            'max' => 'Karakter tidak boleh lebih dari :max',
            'min' => 'Karakter tidak boleh lebih dari :min',
            'numeric' => 'Isian Kolom harus berisi Nomor',
            'digits' => 'Isian tidak boleh melebihi :digits',
        ]);
        if(!is_null($request->anak)){
            $this->validate($request,[
                'anak' => 'required|numeric|min:1|max:4',
                'berangkat.passenger.infant.*.name' => 'required|max:185'
            ],[
            'required' => 'Kolom tidak boleh kosong',
            'max' => 'Karakter tidak boleh lebih dari :max',
            'min' => 'Karakter tidak boleh lebih dari :min',
            'numeric' => 'Isian Kolom harus berisi Nomor',
        ]);
        }
        // dd($request->all());
        $this->validate($request,[
            'berangkat.trainNo' => 'required',
        ]);

        $dataPenumpang = [];

        $dataPenumpang['desc']['hp']   = auth()->user()->hp;
        $dataPenumpang['desc']['contactName']   = auth()->user()->username;
        $dataPenumpang['desc']['contactEmail']  = auth()->user()->email;
        $dataPenumpang['desc']['fareId']        = $request['berangkat']['trainNo'];
        $dataPenumpang['desc']['adult']         = count($request['berangkat']['passenger']['adult']);
        $no = -1;
        foreach ($request['berangkat']['passenger']['adult'] as $value) {
            $no++;
            $dataPenumpang['desc']['passenger'][$no]['name'] = $value['name'];
            $dataPenumpang['desc']['passenger'][$no]['id'] = $value['id'];
            $dataPenumpang['desc']['passenger'][$no]['category'] = 'A';
        }

        if(isset($request['berangkat']['passenger']['infant'])){
            foreach ($request['berangkat']['passenger']['infant'] as $value) {
                $no++;
                $dataPenumpang['desc']['passenger'][$no]['name'] = $value['name'];
                $dataPenumpang['desc']['passenger'][$no]['category'] = 'I';
            }
        }

        $arrayPulang = [];
        $recordKepul = [];
        $recordKepulangan = [];
        $recordBrkt = [];
        if($request->pulang_pergi != '-'){
            if(!isset($request->kepulangan['trainNo'])){
                header('HTTP/1.1 500 Internal Server Booboo');
                header('Content-Type: application/json; charset=UTF-8');
                die(json_encode(array('data' => array("message" => "Silahkan Cek Ulang Kembali, Pastikan Anda Memilih Kereta Untuk Pulang"))));
            }else{
                $dataPenumpang['desc']['fareId']        = $request->kepulangan['trainNo'];
                $recordKepul = HelpersPPOB::seatMapSubClass($dataPenumpang);  
                $recordKepul = json_decode($recordKepul);
                    if(isset($recordKepul->data->tr_id)){
                        $recordKepulangan = HelpersPPOB::seatMap([
                            'tr_id' => $recordKepul->data->tr_id,
                            'ticketNumber' => $recordKepul->data->desc->passenger[0]->ticketNumber,
                        ]);
                        $recordKepulangan = json_decode($recordKepulangan);
                        $recordKepulangan->data->passenger = $recordKepul->data->desc->passenger;
                    }
            }
        }

        $dataPenumpang['desc']['fareId']        = $request->berangkat['trainNo'];
        $request['subClass'] = $request->subclassbr;
        $record = HelpersPPOB::seatMapSubClass($dataPenumpang);  
        $record = json_decode($record); 
        if(isset($record->data->tr_id)){
            $recordBrkt = HelpersPPOB::seatMap([
                'tr_id' => $record->data->tr_id,
                'ticketNumber' => $record->data->desc->passenger[0]->ticketNumber,
            ]);
            $recordBrkt = json_decode($recordBrkt);
            $recordBrkt->data->passenger = $recordKepul->data->desc->passenger;
        } 
        // $recordBrkt = json_decode(json_encode($this->tembak()));
        // $recordKepulangan = json_decode(json_encode($this->tembak()));
        return $this->render('frontend.home.partial.ppob.8-2', [
            'recBrkt' => $record,
            'recKepul' => $recordKepul,
            'record' => $recordBrkt,
            'record' => $recordBrkt,
            'request'=>$request->all(),
            'recordKepulangan' => $recordKepulangan
        ]);

    }

    

    public function store(Request $request){
        // dd(json_decode(json_encode($this->cekArray())));
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
        if($request->berangkat){
            if(isset($request->berangkat['seats'])){
                $seats = array_values($request->berangkat['seats']);
                if(count($seats[0]) != $request['dewasa']){
                    header('HTTP/1.1 500 Internal Server Booboo');
                    header('Content-Type: application/json; charset=UTF-8');
                    die(json_encode(array('data' => array("message" => "Silahkan Cek Ulang Kembali, Jumlah Kursi Tidak Sesuai"))));
                }
            }else{
                header('HTTP/1.1 500 Internal Server Booboo');
                header('Content-Type: application/json; charset=UTF-8');
                die(json_encode(array('data' => array("message" => "Silahkan Cek Ulang Kembali, Pastikan Anda Memilih Kereta Keberangkatan & Kursi"))));
            }
        }

        if(!$request->berangkat){
            header('HTTP/1.1 500 Internal Server Booboo');
            header('Content-Type: application/json; charset=UTF-8');
            die(json_encode(array('data' => array("message" => "Silahkan Cek Ulang Kembali, Pastikan Anda Memilih Kereta Keberangkatan & Kursi"))));
        }
        if($request->pulang_pergi != '-'){
            if(!isset($request->kepulangan['trainNo'])){
                header('HTTP/1.1 500 Internal Server Booboo');
                header('Content-Type: application/json; charset=UTF-8');
                die(json_encode(array('data' => array("message" => "Silahkan Cek Ulang Kembali, Pastikan Anda Memilih Kereta Untuk Pulang"))));
            }elseif(!isset($request->kepulangan['seats'])){
                header('HTTP/1.1 500 Internal Server Booboo');
                header('Content-Type: application/json; charset=UTF-8');
                die(json_encode(array('data' => array("message" => "Silahkan Cek Ulang Kembali, Pastikan Anda Memilih Kereta Untuk Pulang"))));
            }else{
                $seatsKepul = array_values($request->kepulangan['seats']);
                if(count($seatsKepul[0]) != $request['dewasa']){
                    header('HTTP/1.1 500 Internal Server Booboo');
                    header('Content-Type: application/json; charset=UTF-8');
                    die(json_encode(array('data' => array("message" => "Silahkan Cek Ulang Kembali, Jumlah Kursi Tidak Sesuai"))));
                }
            }
        }
        // dd($request->anak);
        $this->validate($request,[
            'dewasa' => 'required|numeric|min:1|max:4',
            'berangkat.passenger.adult.*.title' => 'required|max:185',
            'berangkat.passenger.adult.*.name' => 'required|max:185',
            'berangkat.passenger.adult.*.tanda_pengenal' => 'required|max:185',
            'berangkat.passenger.adult.*.id' => 'required|max:185',
            'berangkat.passenger.adult.*.dob' => 'required|date|max:185',
            'berangkat.passenger.adult.*.phone' => 'required|numeric',
        ],[
            'required' => 'Kolom tidak boleh kosong',
            'max' => 'Karakter tidak boleh lebih dari :max',
            'min' => 'Karakter tidak boleh lebih dari :min',
            'numeric' => 'Isian Kolom harus berisi Nomor',
            'digits' => 'Isian tidak boleh melebihi :digits',
        ]);
        if(!is_null($request->anak)){
            $this->validate($request,[
                'anak' => 'required|numeric|min:1|max:4',
                'berangkat.passenger.infant.*.name' => 'required|max:185'
            ],[
            'required' => 'Kolom tidak boleh kosong',
            'max' => 'Karakter tidak boleh lebih dari :max',
            'min' => 'Karakter tidak boleh lebih dari :min',
            'numeric' => 'Isian Kolom harus berisi Nomor',
        ]);
        }
    }

    public function saveKereta(Request $request){
        if(count($request['brkt']['ticketNumber']) > 0){
            foreach ($request['brkt']['ticketNumber'] as $k => $value) {
                $recKeberangkatan = json_decode(HelpersPPOB::changeSeets([
                    'tr_id' => $request['brkt']['tr_id'],
                    'ticketNumber' => $value,
                    'newSeatId' => $request['berangkat']['seats'][$k]
                ]));
            }
        }

        if(count($request['kepul']['ticketNumber']) > 0){
            foreach ($request['kepul']['ticketNumber'] as $k => $value) {
                $recKeberangkatan = json_decode(HelpersPPOB::changeSeets([
                    'tr_id' => $request['kepul']['tr_id'],
                    'ticketNumber' => $value,
                    'newSeatId' => $request['kepulangan']['seats'][$k]
                ]));
            }
        }

            if($request['brkt']){
                $recKeberangkatan = json_decode(HelpersPPOB::bookingAccept($request['brkt']['tr_id']));
                $saveTransKereta = [];
                $saveTransKereta['user_id'] = auth()->user()->id;
                $saveTransKereta['status'] = 'Menunggu Pembayaran';
                
                $saveTransKereta['order_id'] = $recKeberangkatan->data->ref_id;
                $saveTransKereta['total_harga'] = $recKeberangkatan->data->price;
                $recordTrans = new TransaksiAmpase;
                $recordTrans->fill($saveTransKereta);
                $recordTrans->save();
                $this->addAttribute($recKeberangkatan,$recordTrans->id);
                
                $recKepulangan = [];
                if($request->pulang_pergi != '-'){
                    $recKepulangan = json_decode(HelpersPPOB::bookingAccept($request['kepul']['tr_id']));
                    if($recKepulangan){
                        $this->addAttribute($recKepulangan,$recordTrans->id,'Kepulangan');
                        $totalJML = (int)$recordTrans->total_harga+(int)$recKepulangan->data->price;
                        $recordTrans->total_harga = $totalJML;
                        $recordTrans->save();
                    }
                }

                if($recordTrans->kereta->count() > 0){
                    foreach ($recordTrans->kereta as $k => $value) {
                        $toMidtrans['item_details'][$k]['id'] = $value->id;
                        $toMidtrans['item_details'][$k]['name'] = $value->trainName.' ('.$value->trainNo.') '.$value->org.' To '.$value->dest;
                        $toMidtrans['item_details'][$k]['price'] = (float)$value->ticketPrice;
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

                if($request->pulang_pergi != '-'){
                    if($recKepulangan){
                        $addToMidtransPulang['id'] = $recordTrans->kereta->count()+2;
                        $addToMidtransPulang['name'] = 'Biaya Administrasi Kepulangan';
                        $addToMidtransPulang['price'] = $recKepulangan->data->admin;
                        $addToMidtransPulang['quantity'] = 1;
                        array_push($toMidtrans['item_details'],$addToMidtransPulang);
                    }
                }
               
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
        $saveTransDtKereta['org'] = $request->data->desc->org;
        $saveTransDtKereta['dest'] = $request->data->desc->des;
        $saveTransDtKereta['trainNo'] = $request->data->desc->trainNumber;
        $saveTransDtKereta['trainName'] = $request->data->desc->trainName;
        
        $saveTransDtKereta['subClass'] = $request->data->desc->subClass;
        $saveTransDtKereta['status_tujuan'] = $status_tujuan;
        $saveTransDtKereta['bookingCode'] = $request->data->desc->bookingCode;
        $saveTransDtKereta['bookTime'] = $request->data->desc->bookingDateTime;
        $saveTransDtKereta['timeLimit'] = $request->data->desc->bookingTimeLimit;
        $saveTransDtKereta['bookingDate'] = $request->data->desc->bookingDateTime;
        $saveTransDtKereta['class'] = $request->data->desc->class;
        // $saveTransDtKereta['className'] = $request->data->className;
        $saveTransDtKereta['departDate'] = $request->data->desc->departDate;
        $saveTransDtKereta['departTime'] = $request->data->desc->departTime;
        $saveTransDtKereta['arriveDate'] = $request->data->desc->arriveDate;
        $saveTransDtKereta['arriveTime'] = $request->data->desc->arriveTime;
        $saveTransDtKereta['ticketPrice'] = $request->data->selling_price;
        // $saveTransDtKereta['discount'] = $request->data->discount;
        $saveTransDtKereta['admin'] = $request->data->admin;
        $saveTransDtKereta['tr_id'] = $request->data->tr_id;
        if(is_array($request->data->desc->passenger)){
            foreach ($request->data->desc->passenger as $k => $value) {
                $saveTransDtKereta['seats'] = $value->seat;
                $saveTransDtKereta['seatSelect'] = $value->category;
                $saveTransDtKereta['kodeWagon'] = $value->wagonCode;
                $saveTransDtKereta['adult_id'] = $value->id;
                $saveTransDtKereta['adult_name'] = $value->name;
                $recordDtKereta = new TransaksiAmpaseKereta;
                $recordDtKereta->fill($saveTransDtKereta);
                $recordDtKereta->save();
            }
        }elseif(is_object($request->data->desc->passenger)){
            $saveTransDtKereta['seats'] = $request->data->desc->passenger->seat;
            $saveTransDtKereta['seatSelect'] = $request->data->desc->passenger->category;
            $saveTransDtKereta['kodeWagon'] = $request->data->desc->passenger->wagonCode;
            $saveTransDtKereta['adult_id'] = $request->data->desc->passenger->id;
            $saveTransDtKereta['adult_name'] = $request->data->desc->passenger->name;
            $recordDtKereta = new TransaksiAmpaseKereta;
            $recordDtKereta->fill($saveTransDtKereta);
            $recordDtKereta->save();
        }
    }


    public function cekArray(){
        // return '{
        //   "data": {
        //     "response_code": "00",
        //     "message": "SUCCESS",
        //     "org": "GMR",
        //     "dest": "BD",
        //     "trainNo": "2",
        //     "depDate": "20190725",
        //     "seatMaps": {
        //       "seatMap": [
        //         {
        //           "kelasWagon": "EKS",
        //           "kodeWagon": "1",
        //           "seat": [
        //             {
        //               "row": "1",
        //               "column": "1",
        //               "seatRow": "1",
        //               "seatColumn": "A",
        //               "subClass": "A",
        //               "status": "1"
        //             },
        //             {
        //               "row": "1",
        //               "column": "2",
        //               "seatRow": "1",
        //               "seatColumn": "B",
        //               "subClass": "A",
        //               "status": "1"
        //             },
        //             {
        //               "row": "1",
        //               "column": "3",
        //               "seatRow": "1",
        //               "seatColumn": {},
        //               "subClass": {},
        //               "status": "1"
        //             },
        //             {
        //               "row": "1",
        //               "column": "4",
        //               "seatRow": "1",
        //               "seatColumn": "C",
        //               "subClass": "A",
        //               "status": "1"
        //             },
        //             {
        //               "row": "1",
        //               "column": "5",
        //               "seatRow": "1",
        //               "seatColumn": "D",
        //               "subClass": {},
        //               "status": "1"
        //             },
        //             {
        //               "row": "2",
        //               "column": "1",
        //               "seatRow": "2",
        //               "seatColumn": "A",
        //               "subClass": "A",
        //               "status": "1"
        //             },
        //             {
        //               "row": "2",
        //               "column": "2",
        //               "seatRow": "2",
        //               "seatColumn": "B",
        //               "subClass": "A",
        //               "status": "0"
        //             },
        //             {
        //               "row": "2",
        //               "column": "3",
        //               "seatRow": "2",
        //               "seatColumn": {},
        //               "subClass": {},
        //               "status": "1"
        //             },
        //             {
        //               "row": "2",
        //               "column": "4",
        //               "seatRow": "2",
        //               "seatColumn": "C",
        //               "subClass": "A",
        //               "status": "0"
        //             },
        //             {
        //               "row": "2",
        //               "column": "5",
        //               "seatRow": "2",
        //               "seatColumn": "D",
        //               "subClass": "A",
        //               "status": "0"
        //             }
        //           ]
        //         },
        //         {
        //           "kelasWagon": "EKS",
        //           "kodeWagon": "2",
        //           "seat": [
        //             {
        //               "row": "1",
        //               "column": "1",
        //               "seatRow": "1",
        //               "seatColumn": "A",
        //               "subClass": "A",
        //               "status": "0"
        //             },
        //             {
        //               "row": "1",
        //               "column": "2",
        //               "seatRow": "1",
        //               "seatColumn": "B",
        //               "subClass": "A",
        //               "status": "0"
        //             },
        //             {
        //               "row": "1",
        //               "column": "3",
        //               "seatRow": "1",
        //               "seatColumn": {},
        //               "subClass": {},
        //               "status": "0"
        //             },
        //             {
        //               "row": "1",
        //               "column": "4",
        //               "seatRow": "1",
        //               "seatColumn": "C",
        //               "subClass": "A",
        //               "status": "0"
        //             },
        //             {
        //               "row": "1",
        //               "column": "5",
        //               "seatRow": "1",
        //               "seatColumn": "D",
        //               "subClass": "A",
        //               "status": "0"
        //             }
        //           ]
        //         }
        //       ]
        //     }
        //   },
        //   "meta": []
        // }';
        $data['data']['response_code'] = "00";
        $data['data']['message'] = "SUCCESS";
        $data['data']['bookingCode'] = "MJKSMT";
        $data['data']['refId'] = "1576199";
        $data['data']['bookTime'] = "29-MAR-2019 14:16:42";
        $data['data']['timeLimit'] = "2019-03-29 14:30:43";
        $data['data']['bookingDate'] = "2019-03-29 14:16:43";
        $data['data']['trainName'] = "ARGO PARAHYANGAN";
        $data['data']['trainNo'] = "2";
        $data['data']['class'] = "K";
        $data['data']['subClass'] = "C";
        $data['data']['className'] = "EKONOMI";
        $data['data']['numCode'] = "9984004481109";
        $data['data']['org'] = "GMR (GAMBIR)";
        $data['data']['departDate'] = "30-MAR-19";
        $data['data']['departTime'] = "07:00";
        $data['data']['dest'] = "BD (BANDUNG)";
        $data['data']['arriveDate'] = "30-MAR-19";
        $data['data']['arriveTime'] = "10:00";
        $data['data']['adult'] = "2";
        $data['data']['infant'] = "0";
        $data['data']['adultPrice'] = "90000";
        $data['data']['infantPrice'] = "0";
        $data['data']['ticketPrice'] = "180000";
        $data['data']['discount'] = "0";
        $data['data']['admin'] = "7500";
        $data['data']['totalPrice'] = "187500";
        $data['data']['tr_id'] = "89";
        $data['data']['ref_id'] = "89";
        $data['data']['passengers']['passenger']['name'] = "Gandhi P";
        $data['data']['passengers']['passenger']['id'] = "123412345698";
        $data['data']['passengers']['passenger']['category'] = "A";
        $data['data']['passengers']['passenger']['kodeWagon'] = "PREMIUM_A-2";
        $data['data']['passengers']['passenger']['seat'] = "2A";
        return $data;
    }

    public function tembak(){
        return $aa = json_decode('{"data":{"response_code":"00","message":"SUCCESS","bookingCode":"XWB3ALY","passengerSeat":{"ticketNumber":"TIKET03025XWB3ALY1","seatId":78600128,"category":"A","id":"1212","name":"dsfdf","seatRow":"4","seatColumn":"C","wagonCode":"EKS-2"},"seatMap":[{"seatId":78600065,"wagonCode":"EKS-1","row":"1","column":"1","seatRow":"1","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600066,"wagonCode":"EKS-1","row":"1","column":"1","seatRow":"1","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600067,"wagonCode":"EKS-1","row":"1","column":"2","seatRow":"1","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600068,"wagonCode":"EKS-1","row":"1","column":"1","seatRow":"2","seatColumn":"A","subClass":"I","isAvailable":"false"},{"seatId":78600069,"wagonCode":"EKS-1","row":"1","column":"1","seatRow":"2","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600070,"wagonCode":"EKS-1","row":"1","column":"2","seatRow":"2","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600071,"wagonCode":"EKS-1","row":"1","column":"2","seatRow":"2","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600072,"wagonCode":"EKS-1","row":"1","column":"1","seatRow":"3","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600073,"wagonCode":"EKS-1","row":"1","column":"1","seatRow":"3","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600074,"wagonCode":"EKS-1","row":"1","column":"2","seatRow":"3","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600075,"wagonCode":"EKS-1","row":"1","column":"2","seatRow":"3","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600076,"wagonCode":"EKS-1","row":"1","column":"1","seatRow":"4","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600077,"wagonCode":"EKS-1","row":"1","column":"1","seatRow":"4","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600078,"wagonCode":"EKS-1","row":"1","column":"2","seatRow":"4","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600079,"wagonCode":"EKS-1","row":"1","column":"2","seatRow":"4","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600080,"wagonCode":"EKS-1","row":"1","column":"1","seatRow":"5","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600081,"wagonCode":"EKS-1","row":"1","column":"1","seatRow":"5","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600082,"wagonCode":"EKS-1","row":"1","column":"2","seatRow":"5","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600083,"wagonCode":"EKS-1","row":"1","column":"2","seatRow":"5","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600084,"wagonCode":"EKS-1","row":"1","column":"1","seatRow":"6","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600085,"wagonCode":"EKS-1","row":"1","column":"1","seatRow":"6","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600086,"wagonCode":"EKS-1","row":"1","column":"2","seatRow":"6","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600087,"wagonCode":"EKS-1","row":"1","column":"2","seatRow":"6","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600088,"wagonCode":"EKS-1","row":"1","column":"1","seatRow":"7","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600089,"wagonCode":"EKS-1","row":"1","column":"1","seatRow":"7","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600090,"wagonCode":"EKS-1","row":"1","column":"2","seatRow":"7","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600091,"wagonCode":"EKS-1","row":"1","column":"2","seatRow":"7","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600092,"wagonCode":"EKS-1","row":"1","column":"1","seatRow":"8","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600093,"wagonCode":"EKS-1","row":"1","column":"1","seatRow":"8","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600094,"wagonCode":"EKS-1","row":"1","column":"2","seatRow":"8","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600095,"wagonCode":"EKS-1","row":"1","column":"2","seatRow":"8","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600096,"wagonCode":"EKS-1","row":"1","column":"1","seatRow":"9","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600097,"wagonCode":"EKS-1","row":"1","column":"1","seatRow":"9","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600098,"wagonCode":"EKS-1","row":"1","column":"2","seatRow":"9","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600099,"wagonCode":"EKS-1","row":"1","column":"2","seatRow":"9","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600100,"wagonCode":"EKS-1","row":"1","column":"1","seatRow":"10","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600101,"wagonCode":"EKS-1","row":"1","column":"1","seatRow":"10","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600102,"wagonCode":"EKS-1","row":"1","column":"2","seatRow":"10","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600103,"wagonCode":"EKS-1","row":"1","column":"2","seatRow":"10","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600104,"wagonCode":"EKS-1","row":"1","column":"1","seatRow":"11","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600105,"wagonCode":"EKS-1","row":"1","column":"1","seatRow":"11","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600106,"wagonCode":"EKS-1","row":"1","column":"2","seatRow":"11","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600107,"wagonCode":"EKS-1","row":"1","column":"2","seatRow":"11","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600108,"wagonCode":"EKS-1","row":"1","column":"1","seatRow":"12","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600109,"wagonCode":"EKS-1","row":"1","column":"1","seatRow":"12","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600110,"wagonCode":"EKS-1","row":"1","column":"2","seatRow":"12","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600111,"wagonCode":"EKS-1","row":"1","column":"2","seatRow":"12","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600112,"wagonCode":"EKS-1","row":"1","column":"1","seatRow":"13","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600113,"wagonCode":"EKS-1","row":"1","column":"2","seatRow":"13","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600114,"wagonCode":"EKS-1","row":"1","column":"2","seatRow":"13","seatColumn":"D","subClass":"I","isAvailable":"false"},{"seatId":78600115,"wagonCode":"EKS-2","row":"1","column":"1","seatRow":"1","seatColumn":"A","subClass":"I","isAvailable":"false"},{"seatId":78600116,"wagonCode":"EKS-2","row":"1","column":"1","seatRow":"1","seatColumn":"B","subClass":"I","isAvailable":"false"},{"seatId":78600117,"wagonCode":"EKS-2","row":"1","column":"2","seatRow":"1","seatColumn":"C","subClass":"I","isAvailable":"false"},{"seatId":78600118,"wagonCode":"EKS-2","row":"1","column":"1","seatRow":"2","seatColumn":"A","subClass":"I","isAvailable":"false"},{"seatId":78600119,"wagonCode":"EKS-2","row":"1","column":"1","seatRow":"2","seatColumn":"B","subClass":"I","isAvailable":"false"},{"seatId":78600120,"wagonCode":"EKS-2","row":"1","column":"2","seatRow":"2","seatColumn":"C","subClass":"I","isAvailable":"false"},{"seatId":78600121,"wagonCode":"EKS-2","row":"1","column":"2","seatRow":"2","seatColumn":"D","subClass":"I","isAvailable":"false"},{"seatId":78600122,"wagonCode":"EKS-2","row":"1","column":"1","seatRow":"3","seatColumn":"A","subClass":"I","isAvailable":"false"},{"seatId":78600123,"wagonCode":"EKS-2","row":"1","column":"1","seatRow":"3","seatColumn":"B","subClass":"I","isAvailable":"false"},{"seatId":78600124,"wagonCode":"EKS-2","row":"1","column":"2","seatRow":"3","seatColumn":"C","subClass":"I","isAvailable":"false"},{"seatId":78600125,"wagonCode":"EKS-2","row":"1","column":"2","seatRow":"3","seatColumn":"D","subClass":"I","isAvailable":"false"},{"seatId":78600126,"wagonCode":"EKS-2","row":"1","column":"1","seatRow":"4","seatColumn":"A","subClass":"I","isAvailable":"false"},{"seatId":78600127,"wagonCode":"EKS-2","row":"1","column":"1","seatRow":"4","seatColumn":"B","subClass":"I","isAvailable":"false"},{"seatId":78600128,"wagonCode":"EKS-2","row":"1","column":"2","seatRow":"4","seatColumn":"C","subClass":"I","isAvailable":"false"},{"seatId":78600129,"wagonCode":"EKS-2","row":"1","column":"2","seatRow":"4","seatColumn":"D","subClass":"I","isAvailable":"false"},{"seatId":78600130,"wagonCode":"EKS-2","row":"1","column":"1","seatRow":"5","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600131,"wagonCode":"EKS-2","row":"1","column":"1","seatRow":"5","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600132,"wagonCode":"EKS-2","row":"1","column":"2","seatRow":"5","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600133,"wagonCode":"EKS-2","row":"1","column":"2","seatRow":"5","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600134,"wagonCode":"EKS-2","row":"1","column":"1","seatRow":"6","seatColumn":"A","subClass":"I","isAvailable":"false"},{"seatId":78600135,"wagonCode":"EKS-2","row":"1","column":"1","seatRow":"6","seatColumn":"B","subClass":"I","isAvailable":"false"},{"seatId":78600136,"wagonCode":"EKS-2","row":"1","column":"2","seatRow":"6","seatColumn":"C","subClass":"I","isAvailable":"false"},{"seatId":78600137,"wagonCode":"EKS-2","row":"1","column":"2","seatRow":"6","seatColumn":"D","subClass":"I","isAvailable":"false"},{"seatId":78600138,"wagonCode":"EKS-2","row":"1","column":"1","seatRow":"7","seatColumn":"A","subClass":"I","isAvailable":"false"},{"seatId":78600139,"wagonCode":"EKS-2","row":"1","column":"1","seatRow":"7","seatColumn":"B","subClass":"I","isAvailable":"false"},{"seatId":78600140,"wagonCode":"EKS-2","row":"1","column":"2","seatRow":"7","seatColumn":"C","subClass":"I","isAvailable":"false"},{"seatId":78600141,"wagonCode":"EKS-2","row":"1","column":"2","seatRow":"7","seatColumn":"D","subClass":"I","isAvailable":"false"},{"seatId":78600142,"wagonCode":"EKS-2","row":"1","column":"1","seatRow":"8","seatColumn":"A","subClass":"I","isAvailable":"false"},{"seatId":78600143,"wagonCode":"EKS-2","row":"1","column":"1","seatRow":"8","seatColumn":"B","subClass":"I","isAvailable":"false"},{"seatId":78600144,"wagonCode":"EKS-2","row":"1","column":"2","seatRow":"8","seatColumn":"C","subClass":"I","isAvailable":"false"},{"seatId":78600145,"wagonCode":"EKS-2","row":"1","column":"2","seatRow":"8","seatColumn":"D","subClass":"I","isAvailable":"false"},{"seatId":78600146,"wagonCode":"EKS-2","row":"1","column":"1","seatRow":"9","seatColumn":"A","subClass":"I","isAvailable":"false"},{"seatId":78600147,"wagonCode":"EKS-2","row":"1","column":"1","seatRow":"9","seatColumn":"B","subClass":"I","isAvailable":"false"},{"seatId":78600148,"wagonCode":"EKS-2","row":"1","column":"2","seatRow":"9","seatColumn":"C","subClass":"I","isAvailable":"false"},{"seatId":78600149,"wagonCode":"EKS-2","row":"1","column":"2","seatRow":"9","seatColumn":"D","subClass":"I","isAvailable":"false"},{"seatId":78600150,"wagonCode":"EKS-2","row":"1","column":"1","seatRow":"10","seatColumn":"A","subClass":"I","isAvailable":"false"},{"seatId":78600151,"wagonCode":"EKS-2","row":"1","column":"1","seatRow":"10","seatColumn":"B","subClass":"I","isAvailable":"false"},{"seatId":78600152,"wagonCode":"EKS-2","row":"1","column":"2","seatRow":"10","seatColumn":"C","subClass":"I","isAvailable":"false"},{"seatId":78600153,"wagonCode":"EKS-2","row":"1","column":"2","seatRow":"10","seatColumn":"D","subClass":"I","isAvailable":"false"},{"seatId":78600154,"wagonCode":"EKS-2","row":"1","column":"1","seatRow":"11","seatColumn":"A","subClass":"I","isAvailable":"false"},{"seatId":78600155,"wagonCode":"EKS-2","row":"1","column":"1","seatRow":"11","seatColumn":"B","subClass":"I","isAvailable":"false"},{"seatId":78600156,"wagonCode":"EKS-2","row":"1","column":"2","seatRow":"11","seatColumn":"C","subClass":"I","isAvailable":"false"},{"seatId":78600157,"wagonCode":"EKS-2","row":"1","column":"2","seatRow":"11","seatColumn":"D","subClass":"I","isAvailable":"false"},{"seatId":78600158,"wagonCode":"EKS-2","row":"1","column":"1","seatRow":"12","seatColumn":"A","subClass":"I","isAvailable":"false"},{"seatId":78600159,"wagonCode":"EKS-2","row":"1","column":"1","seatRow":"12","seatColumn":"B","subClass":"I","isAvailable":"false"},{"seatId":78600160,"wagonCode":"EKS-2","row":"1","column":"2","seatRow":"12","seatColumn":"C","subClass":"I","isAvailable":"false"},{"seatId":78600161,"wagonCode":"EKS-2","row":"1","column":"2","seatRow":"12","seatColumn":"D","subClass":"I","isAvailable":"false"},{"seatId":78600162,"wagonCode":"EKS-2","row":"1","column":"1","seatRow":"13","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600163,"wagonCode":"EKS-2","row":"1","column":"2","seatRow":"13","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600164,"wagonCode":"EKS-2","row":"1","column":"2","seatRow":"13","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600165,"wagonCode":"EKS-3","row":"1","column":"1","seatRow":"1","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600166,"wagonCode":"EKS-3","row":"1","column":"1","seatRow":"1","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600167,"wagonCode":"EKS-3","row":"1","column":"2","seatRow":"1","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600168,"wagonCode":"EKS-3","row":"1","column":"1","seatRow":"2","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600169,"wagonCode":"EKS-3","row":"1","column":"1","seatRow":"2","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600170,"wagonCode":"EKS-3","row":"1","column":"2","seatRow":"2","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600171,"wagonCode":"EKS-3","row":"1","column":"2","seatRow":"2","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600172,"wagonCode":"EKS-3","row":"1","column":"1","seatRow":"3","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600173,"wagonCode":"EKS-3","row":"1","column":"1","seatRow":"3","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600174,"wagonCode":"EKS-3","row":"1","column":"2","seatRow":"3","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600175,"wagonCode":"EKS-3","row":"1","column":"2","seatRow":"3","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600176,"wagonCode":"EKS-3","row":"1","column":"1","seatRow":"4","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600177,"wagonCode":"EKS-3","row":"1","column":"1","seatRow":"4","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600178,"wagonCode":"EKS-3","row":"1","column":"2","seatRow":"4","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600179,"wagonCode":"EKS-3","row":"1","column":"2","seatRow":"4","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600180,"wagonCode":"EKS-3","row":"1","column":"1","seatRow":"5","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600181,"wagonCode":"EKS-3","row":"1","column":"1","seatRow":"5","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600182,"wagonCode":"EKS-3","row":"1","column":"2","seatRow":"5","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600183,"wagonCode":"EKS-3","row":"1","column":"2","seatRow":"5","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600184,"wagonCode":"EKS-3","row":"1","column":"1","seatRow":"6","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600185,"wagonCode":"EKS-3","row":"1","column":"1","seatRow":"6","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600186,"wagonCode":"EKS-3","row":"1","column":"2","seatRow":"6","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600187,"wagonCode":"EKS-3","row":"1","column":"2","seatRow":"6","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600188,"wagonCode":"EKS-3","row":"1","column":"1","seatRow":"7","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600189,"wagonCode":"EKS-3","row":"1","column":"1","seatRow":"7","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600190,"wagonCode":"EKS-3","row":"1","column":"2","seatRow":"7","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600191,"wagonCode":"EKS-3","row":"1","column":"2","seatRow":"7","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600192,"wagonCode":"EKS-3","row":"1","column":"1","seatRow":"8","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600193,"wagonCode":"EKS-3","row":"1","column":"1","seatRow":"8","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600194,"wagonCode":"EKS-3","row":"1","column":"2","seatRow":"8","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600195,"wagonCode":"EKS-3","row":"1","column":"2","seatRow":"8","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600196,"wagonCode":"EKS-3","row":"1","column":"1","seatRow":"9","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600197,"wagonCode":"EKS-3","row":"1","column":"1","seatRow":"9","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600198,"wagonCode":"EKS-3","row":"1","column":"2","seatRow":"9","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600199,"wagonCode":"EKS-3","row":"1","column":"2","seatRow":"9","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600200,"wagonCode":"EKS-3","row":"1","column":"1","seatRow":"10","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600201,"wagonCode":"EKS-3","row":"1","column":"1","seatRow":"10","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600202,"wagonCode":"EKS-3","row":"1","column":"2","seatRow":"10","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600203,"wagonCode":"EKS-3","row":"1","column":"2","seatRow":"10","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600204,"wagonCode":"EKS-3","row":"1","column":"1","seatRow":"11","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600205,"wagonCode":"EKS-3","row":"1","column":"1","seatRow":"11","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600206,"wagonCode":"EKS-3","row":"1","column":"2","seatRow":"11","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600207,"wagonCode":"EKS-3","row":"1","column":"2","seatRow":"11","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600208,"wagonCode":"EKS-3","row":"1","column":"1","seatRow":"12","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600209,"wagonCode":"EKS-3","row":"1","column":"1","seatRow":"12","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600210,"wagonCode":"EKS-3","row":"1","column":"2","seatRow":"12","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600211,"wagonCode":"EKS-3","row":"1","column":"2","seatRow":"12","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600212,"wagonCode":"EKS-3","row":"1","column":"1","seatRow":"13","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600213,"wagonCode":"EKS-3","row":"1","column":"2","seatRow":"13","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600214,"wagonCode":"EKS-3","row":"1","column":"2","seatRow":"13","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600215,"wagonCode":"EKS-4","row":"1","column":"1","seatRow":"1","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600216,"wagonCode":"EKS-4","row":"1","column":"1","seatRow":"1","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600217,"wagonCode":"EKS-4","row":"1","column":"2","seatRow":"1","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600218,"wagonCode":"EKS-4","row":"1","column":"1","seatRow":"2","seatColumn":"A","subClass":"I","isAvailable":"false"},{"seatId":78600219,"wagonCode":"EKS-4","row":"1","column":"1","seatRow":"2","seatColumn":"B","subClass":"I","isAvailable":"false"},{"seatId":78600220,"wagonCode":"EKS-4","row":"1","column":"2","seatRow":"2","seatColumn":"C","subClass":"I","isAvailable":"false"},{"seatId":78600221,"wagonCode":"EKS-4","row":"1","column":"2","seatRow":"2","seatColumn":"D","subClass":"I","isAvailable":"false"},{"seatId":78600222,"wagonCode":"EKS-4","row":"1","column":"1","seatRow":"3","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600223,"wagonCode":"EKS-4","row":"1","column":"1","seatRow":"3","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600224,"wagonCode":"EKS-4","row":"1","column":"2","seatRow":"3","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600225,"wagonCode":"EKS-4","row":"1","column":"2","seatRow":"3","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600226,"wagonCode":"EKS-4","row":"1","column":"1","seatRow":"4","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600227,"wagonCode":"EKS-4","row":"1","column":"1","seatRow":"4","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600228,"wagonCode":"EKS-4","row":"1","column":"2","seatRow":"4","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600229,"wagonCode":"EKS-4","row":"1","column":"2","seatRow":"4","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600230,"wagonCode":"EKS-4","row":"1","column":"1","seatRow":"5","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600231,"wagonCode":"EKS-4","row":"1","column":"1","seatRow":"5","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600232,"wagonCode":"EKS-4","row":"1","column":"2","seatRow":"5","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600233,"wagonCode":"EKS-4","row":"1","column":"2","seatRow":"5","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600234,"wagonCode":"EKS-4","row":"1","column":"1","seatRow":"6","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600235,"wagonCode":"EKS-4","row":"1","column":"1","seatRow":"6","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600236,"wagonCode":"EKS-4","row":"1","column":"2","seatRow":"6","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600237,"wagonCode":"EKS-4","row":"1","column":"2","seatRow":"6","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600238,"wagonCode":"EKS-4","row":"1","column":"1","seatRow":"7","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600239,"wagonCode":"EKS-4","row":"1","column":"1","seatRow":"7","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600240,"wagonCode":"EKS-4","row":"1","column":"2","seatRow":"7","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600241,"wagonCode":"EKS-4","row":"1","column":"2","seatRow":"7","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600242,"wagonCode":"EKS-4","row":"1","column":"1","seatRow":"8","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600243,"wagonCode":"EKS-4","row":"1","column":"1","seatRow":"8","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600244,"wagonCode":"EKS-4","row":"1","column":"2","seatRow":"8","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600245,"wagonCode":"EKS-4","row":"1","column":"2","seatRow":"8","seatColumn":"D","subClass":"I","isAvailable":"false"},{"seatId":78600246,"wagonCode":"EKS-4","row":"1","column":"1","seatRow":"9","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600247,"wagonCode":"EKS-4","row":"1","column":"1","seatRow":"9","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600248,"wagonCode":"EKS-4","row":"1","column":"2","seatRow":"9","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600249,"wagonCode":"EKS-4","row":"1","column":"2","seatRow":"9","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600250,"wagonCode":"EKS-4","row":"1","column":"1","seatRow":"10","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600251,"wagonCode":"EKS-4","row":"1","column":"1","seatRow":"10","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600252,"wagonCode":"EKS-4","row":"1","column":"2","seatRow":"10","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600253,"wagonCode":"EKS-4","row":"1","column":"2","seatRow":"10","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600254,"wagonCode":"EKS-4","row":"1","column":"1","seatRow":"11","seatColumn":"A","subClass":"I","isAvailable":"false"},{"seatId":78600255,"wagonCode":"EKS-4","row":"1","column":"1","seatRow":"11","seatColumn":"B","subClass":"I","isAvailable":"false"},{"seatId":78600256,"wagonCode":"EKS-4","row":"1","column":"2","seatRow":"11","seatColumn":"C","subClass":"I","isAvailable":"false"},{"seatId":78600257,"wagonCode":"EKS-4","row":"1","column":"2","seatRow":"11","seatColumn":"D","subClass":"I","isAvailable":"false"},{"seatId":78600258,"wagonCode":"EKS-4","row":"1","column":"1","seatRow":"12","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600259,"wagonCode":"EKS-4","row":"1","column":"1","seatRow":"12","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600260,"wagonCode":"EKS-4","row":"1","column":"2","seatRow":"12","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600261,"wagonCode":"EKS-4","row":"1","column":"2","seatRow":"12","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600262,"wagonCode":"EKS-4","row":"1","column":"1","seatRow":"13","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600263,"wagonCode":"EKS-4","row":"1","column":"2","seatRow":"13","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600264,"wagonCode":"EKS-4","row":"1","column":"2","seatRow":"13","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600265,"wagonCode":"EKS-5","row":"1","column":"1","seatRow":"1","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600266,"wagonCode":"EKS-5","row":"1","column":"1","seatRow":"1","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600267,"wagonCode":"EKS-5","row":"1","column":"2","seatRow":"1","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600268,"wagonCode":"EKS-5","row":"1","column":"1","seatRow":"2","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600269,"wagonCode":"EKS-5","row":"1","column":"1","seatRow":"2","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600270,"wagonCode":"EKS-5","row":"1","column":"2","seatRow":"2","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600271,"wagonCode":"EKS-5","row":"1","column":"2","seatRow":"2","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600272,"wagonCode":"EKS-5","row":"1","column":"1","seatRow":"3","seatColumn":"A","subClass":"I","isAvailable":"false"},{"seatId":78600273,"wagonCode":"EKS-5","row":"1","column":"1","seatRow":"3","seatColumn":"B","subClass":"I","isAvailable":"false"},{"seatId":78600274,"wagonCode":"EKS-5","row":"1","column":"2","seatRow":"3","seatColumn":"C","subClass":"I","isAvailable":"false"},{"seatId":78600275,"wagonCode":"EKS-5","row":"1","column":"2","seatRow":"3","seatColumn":"D","subClass":"I","isAvailable":"false"},{"seatId":78600276,"wagonCode":"EKS-5","row":"1","column":"1","seatRow":"4","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600277,"wagonCode":"EKS-5","row":"1","column":"1","seatRow":"4","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600278,"wagonCode":"EKS-5","row":"1","column":"2","seatRow":"4","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600279,"wagonCode":"EKS-5","row":"1","column":"2","seatRow":"4","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600280,"wagonCode":"EKS-5","row":"1","column":"1","seatRow":"5","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600281,"wagonCode":"EKS-5","row":"1","column":"1","seatRow":"5","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600282,"wagonCode":"EKS-5","row":"1","column":"2","seatRow":"5","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600283,"wagonCode":"EKS-5","row":"1","column":"2","seatRow":"5","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600284,"wagonCode":"EKS-5","row":"1","column":"1","seatRow":"6","seatColumn":"A","subClass":"I","isAvailable":"false"},{"seatId":78600285,"wagonCode":"EKS-5","row":"1","column":"1","seatRow":"6","seatColumn":"B","subClass":"I","isAvailable":"false"},{"seatId":78600286,"wagonCode":"EKS-5","row":"1","column":"2","seatRow":"6","seatColumn":"C","subClass":"I","isAvailable":"false"},{"seatId":78600287,"wagonCode":"EKS-5","row":"1","column":"2","seatRow":"6","seatColumn":"D","subClass":"I","isAvailable":"false"},{"seatId":78600288,"wagonCode":"EKS-5","row":"1","column":"1","seatRow":"7","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600289,"wagonCode":"EKS-5","row":"1","column":"1","seatRow":"7","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600290,"wagonCode":"EKS-5","row":"1","column":"2","seatRow":"7","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600291,"wagonCode":"EKS-5","row":"1","column":"2","seatRow":"7","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600292,"wagonCode":"EKS-5","row":"1","column":"1","seatRow":"8","seatColumn":"A","subClass":"I","isAvailable":"false"},{"seatId":78600293,"wagonCode":"EKS-5","row":"1","column":"1","seatRow":"8","seatColumn":"B","subClass":"I","isAvailable":"false"},{"seatId":78600294,"wagonCode":"EKS-5","row":"1","column":"2","seatRow":"8","seatColumn":"C","subClass":"I","isAvailable":"false"},{"seatId":78600295,"wagonCode":"EKS-5","row":"1","column":"2","seatRow":"8","seatColumn":"D","subClass":"I","isAvailable":"false"},{"seatId":78600296,"wagonCode":"EKS-5","row":"1","column":"1","seatRow":"9","seatColumn":"A","subClass":"I","isAvailable":"false"},{"seatId":78600297,"wagonCode":"EKS-5","row":"1","column":"1","seatRow":"9","seatColumn":"B","subClass":"I","isAvailable":"false"},{"seatId":78600298,"wagonCode":"EKS-5","row":"1","column":"2","seatRow":"9","seatColumn":"C","subClass":"I","isAvailable":"false"},{"seatId":78600299,"wagonCode":"EKS-5","row":"1","column":"2","seatRow":"9","seatColumn":"D","subClass":"I","isAvailable":"false"},{"seatId":78600300,"wagonCode":"EKS-5","row":"1","column":"1","seatRow":"10","seatColumn":"A","subClass":"I","isAvailable":"false"},{"seatId":78600301,"wagonCode":"EKS-5","row":"1","column":"1","seatRow":"10","seatColumn":"B","subClass":"I","isAvailable":"false"},{"seatId":78600302,"wagonCode":"EKS-5","row":"1","column":"2","seatRow":"10","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600303,"wagonCode":"EKS-5","row":"1","column":"2","seatRow":"10","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600304,"wagonCode":"EKS-5","row":"1","column":"1","seatRow":"11","seatColumn":"A","subClass":"I","isAvailable":"false"},{"seatId":78600305,"wagonCode":"EKS-5","row":"1","column":"1","seatRow":"11","seatColumn":"B","subClass":"I","isAvailable":"false"},{"seatId":78600306,"wagonCode":"EKS-5","row":"1","column":"2","seatRow":"11","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600307,"wagonCode":"EKS-5","row":"1","column":"2","seatRow":"11","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600308,"wagonCode":"EKS-5","row":"1","column":"1","seatRow":"12","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600309,"wagonCode":"EKS-5","row":"1","column":"1","seatRow":"12","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600310,"wagonCode":"EKS-5","row":"1","column":"2","seatRow":"12","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600311,"wagonCode":"EKS-5","row":"1","column":"2","seatRow":"12","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600312,"wagonCode":"EKS-5","row":"1","column":"1","seatRow":"13","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600313,"wagonCode":"EKS-5","row":"1","column":"2","seatRow":"13","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600314,"wagonCode":"EKS-5","row":"1","column":"2","seatRow":"13","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600315,"wagonCode":"EKS-6","row":"1","column":"1","seatRow":"1","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600316,"wagonCode":"EKS-6","row":"1","column":"1","seatRow":"1","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600317,"wagonCode":"EKS-6","row":"1","column":"2","seatRow":"1","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600318,"wagonCode":"EKS-6","row":"1","column":"1","seatRow":"2","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600319,"wagonCode":"EKS-6","row":"1","column":"1","seatRow":"2","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600320,"wagonCode":"EKS-6","row":"1","column":"2","seatRow":"2","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600321,"wagonCode":"EKS-6","row":"1","column":"2","seatRow":"2","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600322,"wagonCode":"EKS-6","row":"1","column":"1","seatRow":"3","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600323,"wagonCode":"EKS-6","row":"1","column":"1","seatRow":"3","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600324,"wagonCode":"EKS-6","row":"1","column":"2","seatRow":"3","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600325,"wagonCode":"EKS-6","row":"1","column":"2","seatRow":"3","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600326,"wagonCode":"EKS-6","row":"1","column":"1","seatRow":"4","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600327,"wagonCode":"EKS-6","row":"1","column":"1","seatRow":"4","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600328,"wagonCode":"EKS-6","row":"1","column":"2","seatRow":"4","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600329,"wagonCode":"EKS-6","row":"1","column":"2","seatRow":"4","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600330,"wagonCode":"EKS-6","row":"1","column":"1","seatRow":"5","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600331,"wagonCode":"EKS-6","row":"1","column":"1","seatRow":"5","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600332,"wagonCode":"EKS-6","row":"1","column":"2","seatRow":"5","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600333,"wagonCode":"EKS-6","row":"1","column":"2","seatRow":"5","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600334,"wagonCode":"EKS-6","row":"1","column":"1","seatRow":"6","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600335,"wagonCode":"EKS-6","row":"1","column":"1","seatRow":"6","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600336,"wagonCode":"EKS-6","row":"1","column":"2","seatRow":"6","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600337,"wagonCode":"EKS-6","row":"1","column":"2","seatRow":"6","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600338,"wagonCode":"EKS-6","row":"1","column":"1","seatRow":"7","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600339,"wagonCode":"EKS-6","row":"1","column":"1","seatRow":"7","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600340,"wagonCode":"EKS-6","row":"1","column":"2","seatRow":"7","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600341,"wagonCode":"EKS-6","row":"1","column":"2","seatRow":"7","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600342,"wagonCode":"EKS-6","row":"1","column":"1","seatRow":"8","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600343,"wagonCode":"EKS-6","row":"1","column":"1","seatRow":"8","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600344,"wagonCode":"EKS-6","row":"1","column":"2","seatRow":"8","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600345,"wagonCode":"EKS-6","row":"1","column":"2","seatRow":"8","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600346,"wagonCode":"EKS-6","row":"1","column":"1","seatRow":"9","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600347,"wagonCode":"EKS-6","row":"1","column":"1","seatRow":"9","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600348,"wagonCode":"EKS-6","row":"1","column":"2","seatRow":"9","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600349,"wagonCode":"EKS-6","row":"1","column":"2","seatRow":"9","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600350,"wagonCode":"EKS-6","row":"1","column":"1","seatRow":"10","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600351,"wagonCode":"EKS-6","row":"1","column":"1","seatRow":"10","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600352,"wagonCode":"EKS-6","row":"1","column":"2","seatRow":"10","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600353,"wagonCode":"EKS-6","row":"1","column":"2","seatRow":"10","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600354,"wagonCode":"EKS-6","row":"1","column":"1","seatRow":"11","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600355,"wagonCode":"EKS-6","row":"1","column":"1","seatRow":"11","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600356,"wagonCode":"EKS-6","row":"1","column":"2","seatRow":"11","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600357,"wagonCode":"EKS-6","row":"1","column":"2","seatRow":"11","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600358,"wagonCode":"EKS-6","row":"1","column":"1","seatRow":"12","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600359,"wagonCode":"EKS-6","row":"1","column":"1","seatRow":"12","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600360,"wagonCode":"EKS-6","row":"1","column":"2","seatRow":"12","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600361,"wagonCode":"EKS-6","row":"1","column":"2","seatRow":"12","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600362,"wagonCode":"EKS-6","row":"1","column":"1","seatRow":"13","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600363,"wagonCode":"EKS-6","row":"1","column":"2","seatRow":"13","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600364,"wagonCode":"EKS-6","row":"1","column":"2","seatRow":"13","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600365,"wagonCode":"EKS-7","row":"1","column":"1","seatRow":"1","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600366,"wagonCode":"EKS-7","row":"1","column":"1","seatRow":"1","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600367,"wagonCode":"EKS-7","row":"1","column":"2","seatRow":"1","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600368,"wagonCode":"EKS-7","row":"1","column":"1","seatRow":"2","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600369,"wagonCode":"EKS-7","row":"1","column":"1","seatRow":"2","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600370,"wagonCode":"EKS-7","row":"1","column":"2","seatRow":"2","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600371,"wagonCode":"EKS-7","row":"1","column":"2","seatRow":"2","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600372,"wagonCode":"EKS-7","row":"1","column":"1","seatRow":"3","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600373,"wagonCode":"EKS-7","row":"1","column":"1","seatRow":"3","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600374,"wagonCode":"EKS-7","row":"1","column":"2","seatRow":"3","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600375,"wagonCode":"EKS-7","row":"1","column":"2","seatRow":"3","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600376,"wagonCode":"EKS-7","row":"1","column":"1","seatRow":"4","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600377,"wagonCode":"EKS-7","row":"1","column":"1","seatRow":"4","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600378,"wagonCode":"EKS-7","row":"1","column":"2","seatRow":"4","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600379,"wagonCode":"EKS-7","row":"1","column":"2","seatRow":"4","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600380,"wagonCode":"EKS-7","row":"1","column":"1","seatRow":"5","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600381,"wagonCode":"EKS-7","row":"1","column":"1","seatRow":"5","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600382,"wagonCode":"EKS-7","row":"1","column":"2","seatRow":"5","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600383,"wagonCode":"EKS-7","row":"1","column":"2","seatRow":"5","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600384,"wagonCode":"EKS-7","row":"1","column":"1","seatRow":"6","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600385,"wagonCode":"EKS-7","row":"1","column":"1","seatRow":"6","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600386,"wagonCode":"EKS-7","row":"1","column":"2","seatRow":"6","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600387,"wagonCode":"EKS-7","row":"1","column":"2","seatRow":"6","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600388,"wagonCode":"EKS-7","row":"1","column":"1","seatRow":"7","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600389,"wagonCode":"EKS-7","row":"1","column":"1","seatRow":"7","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600390,"wagonCode":"EKS-7","row":"1","column":"2","seatRow":"7","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600391,"wagonCode":"EKS-7","row":"1","column":"2","seatRow":"7","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600392,"wagonCode":"EKS-7","row":"1","column":"1","seatRow":"8","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600393,"wagonCode":"EKS-7","row":"1","column":"1","seatRow":"8","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600394,"wagonCode":"EKS-7","row":"1","column":"2","seatRow":"8","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600395,"wagonCode":"EKS-7","row":"1","column":"2","seatRow":"8","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600396,"wagonCode":"EKS-7","row":"1","column":"1","seatRow":"9","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600397,"wagonCode":"EKS-7","row":"1","column":"1","seatRow":"9","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600398,"wagonCode":"EKS-7","row":"1","column":"2","seatRow":"9","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600399,"wagonCode":"EKS-7","row":"1","column":"2","seatRow":"9","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600400,"wagonCode":"EKS-7","row":"1","column":"1","seatRow":"10","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600401,"wagonCode":"EKS-7","row":"1","column":"1","seatRow":"10","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600402,"wagonCode":"EKS-7","row":"1","column":"2","seatRow":"10","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600403,"wagonCode":"EKS-7","row":"1","column":"2","seatRow":"10","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600404,"wagonCode":"EKS-7","row":"1","column":"1","seatRow":"11","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600405,"wagonCode":"EKS-7","row":"1","column":"1","seatRow":"11","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600406,"wagonCode":"EKS-7","row":"1","column":"2","seatRow":"11","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600407,"wagonCode":"EKS-7","row":"1","column":"2","seatRow":"11","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600408,"wagonCode":"EKS-7","row":"1","column":"1","seatRow":"12","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600409,"wagonCode":"EKS-7","row":"1","column":"1","seatRow":"12","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600410,"wagonCode":"EKS-7","row":"1","column":"2","seatRow":"12","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600411,"wagonCode":"EKS-7","row":"1","column":"2","seatRow":"12","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600412,"wagonCode":"EKS-7","row":"1","column":"1","seatRow":"13","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600413,"wagonCode":"EKS-7","row":"1","column":"2","seatRow":"13","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600414,"wagonCode":"EKS-7","row":"1","column":"2","seatRow":"13","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600415,"wagonCode":"EKS-8","row":"1","column":"1","seatRow":"1","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600416,"wagonCode":"EKS-8","row":"1","column":"1","seatRow":"1","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600417,"wagonCode":"EKS-8","row":"1","column":"2","seatRow":"1","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600418,"wagonCode":"EKS-8","row":"1","column":"1","seatRow":"2","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600419,"wagonCode":"EKS-8","row":"1","column":"1","seatRow":"2","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600420,"wagonCode":"EKS-8","row":"1","column":"2","seatRow":"2","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600421,"wagonCode":"EKS-8","row":"1","column":"2","seatRow":"2","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600422,"wagonCode":"EKS-8","row":"1","column":"1","seatRow":"3","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600423,"wagonCode":"EKS-8","row":"1","column":"1","seatRow":"3","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600424,"wagonCode":"EKS-8","row":"1","column":"2","seatRow":"3","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600425,"wagonCode":"EKS-8","row":"1","column":"2","seatRow":"3","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600426,"wagonCode":"EKS-8","row":"1","column":"1","seatRow":"4","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600427,"wagonCode":"EKS-8","row":"1","column":"1","seatRow":"4","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600428,"wagonCode":"EKS-8","row":"1","column":"2","seatRow":"4","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600429,"wagonCode":"EKS-8","row":"1","column":"2","seatRow":"4","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600430,"wagonCode":"EKS-8","row":"1","column":"1","seatRow":"5","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600431,"wagonCode":"EKS-8","row":"1","column":"1","seatRow":"5","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600432,"wagonCode":"EKS-8","row":"1","column":"2","seatRow":"5","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600433,"wagonCode":"EKS-8","row":"1","column":"2","seatRow":"5","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600434,"wagonCode":"EKS-8","row":"1","column":"1","seatRow":"6","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600435,"wagonCode":"EKS-8","row":"1","column":"1","seatRow":"6","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600436,"wagonCode":"EKS-8","row":"1","column":"2","seatRow":"6","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600437,"wagonCode":"EKS-8","row":"1","column":"2","seatRow":"6","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600438,"wagonCode":"EKS-8","row":"1","column":"1","seatRow":"7","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600439,"wagonCode":"EKS-8","row":"1","column":"1","seatRow":"7","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600440,"wagonCode":"EKS-8","row":"1","column":"2","seatRow":"7","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600441,"wagonCode":"EKS-8","row":"1","column":"2","seatRow":"7","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600442,"wagonCode":"EKS-8","row":"1","column":"1","seatRow":"8","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600443,"wagonCode":"EKS-8","row":"1","column":"1","seatRow":"8","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600444,"wagonCode":"EKS-8","row":"1","column":"2","seatRow":"8","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600445,"wagonCode":"EKS-8","row":"1","column":"2","seatRow":"8","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600446,"wagonCode":"EKS-8","row":"1","column":"1","seatRow":"9","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600447,"wagonCode":"EKS-8","row":"1","column":"1","seatRow":"9","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600448,"wagonCode":"EKS-8","row":"1","column":"2","seatRow":"9","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600449,"wagonCode":"EKS-8","row":"1","column":"2","seatRow":"9","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600450,"wagonCode":"EKS-8","row":"1","column":"1","seatRow":"10","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600451,"wagonCode":"EKS-8","row":"1","column":"1","seatRow":"10","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600452,"wagonCode":"EKS-8","row":"1","column":"2","seatRow":"10","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600453,"wagonCode":"EKS-8","row":"1","column":"2","seatRow":"10","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600454,"wagonCode":"EKS-8","row":"1","column":"1","seatRow":"11","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600455,"wagonCode":"EKS-8","row":"1","column":"1","seatRow":"11","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600456,"wagonCode":"EKS-8","row":"1","column":"2","seatRow":"11","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600457,"wagonCode":"EKS-8","row":"1","column":"2","seatRow":"11","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600458,"wagonCode":"EKS-8","row":"1","column":"1","seatRow":"12","seatColumn":"A","subClass":"I","isAvailable":"true"},{"seatId":78600459,"wagonCode":"EKS-8","row":"1","column":"1","seatRow":"12","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600460,"wagonCode":"EKS-8","row":"1","column":"2","seatRow":"12","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600461,"wagonCode":"EKS-8","row":"1","column":"2","seatRow":"12","seatColumn":"D","subClass":"I","isAvailable":"true"},{"seatId":78600462,"wagonCode":"EKS-8","row":"1","column":"1","seatRow":"13","seatColumn":"B","subClass":"I","isAvailable":"true"},{"seatId":78600463,"wagonCode":"EKS-8","row":"1","column":"2","seatRow":"13","seatColumn":"C","subClass":"I","isAvailable":"true"},{"seatId":78600464,"wagonCode":"EKS-8","row":"1","column":"2","seatRow":"13","seatColumn":"D","subClass":"I","isAvailable":"true"}],"passenger":[{"id":"1212","name":"dsfdf","category":"A","wagonCode":"EKS-1","seat":"4D","amount":170000,"refundStatus":"false","ticketNumber":"TIKET03025S1M3PWY1"},{"id":"2332345","name":"aasas","category":"A","wagonCode":"EKS-1","seat":"5A","amount":170000,"refundStatus":"false","ticketNumber":"TIKET03025S1M3PWY2"}]},"meta":[]}');
    }
}

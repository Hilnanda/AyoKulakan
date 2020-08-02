<?php
namespace App\Helpers;

use Carbon\Carbon;

class HelpersPPOB
{
	public static function getAll(){
		$username   = "0895422649167";
		$apiKey   = "3615d0a49ed95164361";
		$signature  = md5($username.$apiKey.'pl');

		$json = '{
		          "commands" : "pricelist",
		          "username" : "0895422649167",
		          "sign"     : "16bdad92c280b7ee9b0febabb630523b"
		        }';

		$url = "https://api.mobilepulsa.net/v1/legacy/index";

		$ch  = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$data = curl_exec($ch);
		curl_close($ch);

		return $data;
	}

	public static function checkType($type){
		$return = '-';
	    switch ($type)
	    {
	        case 'list_ppob': $return = 'topup';
	        break;
	        case 'pln': $return = 'inquiry_pln';
	        break;
	        case 'PLNPOSTPAID': $return = 'inq-pasca';
	        break;
	    }

	    return $return;
	}

	public static function checkError($data){
		$return = '-';
		$type = isset(json_decode($data)->data) ? json_decode($data)->data : [];
		$array = ['2','05','06','07','09','13','14','16','17','20','10','34','37','39','43','50','52','53','54','55','56','57','58','60','61','62','102','103','106','107','201','202','203','204','205','206','207','false'];
		// dd($type);
		if(isset($type->status)){
			if(in_array($type->status,$array)){
				header('HTTP/1.1 500 Internal Server Booboo');
		        header('Content-Type: application/json; charset=UTF-8');
		        die($data);
			}else{
				return $data;
			}
		}elseif(isset($type->response_code)){
			if(in_array($type->response_code,$array)){
				header('HTTP/1.1 500 Internal Server Booboo');
		        header('Content-Type: application/json; charset=UTF-8');
		        die($data);
			}else{				
				return $data;
			}
		}else{
			if(count($type) > 0){
				return $data;
			}else{
				header('HTTP/1.1 500 Internal Server Booboo');
			    header('Content-Type: application/json; charset=UTF-8');
			    die(json_encode(array('dataPpob' => array('message' => 'Status Sedang Pending, Mohon Di Tunggu'))));
			}
			
		}
	}

	public static function checkGame($record=''){
		$username   = "0895422649167";
		$apiKey   = "3615d0a49ed95164361";
		$signature  = md5($username.$apiKey.$record['game_code']);
			$jsons = '{
	            "commands" : "check-game-id",
		        "username" : "'.$username.'",
		        "game_code"   : "'.$record['game_code'].'",
		        "hp"   : "'.$record['ppob_pelanggan'].'|'.$record['ppob_pelanggan_next'].'",
		        "sign"     : "'.$signature.'"
	        }';
		        
		$url = "https://api.mobilepulsa.net/v1/player-detail";

		$ch  = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsons);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$data = curl_exec($ch);
		curl_close($ch);
		
		return HelpersPPOB::checkError($data);
	}

	public static function checkStatusPrepaid($ref_id=''){
		$username   = "0895422649167";
		$apiKey   = "3615d0a49ed95164361";
		$signature  = md5($username.$apiKey.$ref_id);
			$jsons = '{
	            "commands" : "inquiry",
		        "username" : "'.$username.'",
		        "ref_id"   : "'.$ref_id.'",
		        "sign"     : "'.$signature.'"
	        }';
		        
		$url = "https://api.mobilepulsa.net/v1/legacy/index";

		$ch  = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsons);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$data = curl_exec($ch);
		curl_close($ch);
		
		return HelpersPPOB::checkError($data);
	}

	public static function checkStatusPostpaid($ref_id=''){
		$username   = "0895422649167";
		$apiKey   = "3615d0a49ed95164361";
		$signature  = md5($username.$apiKey.'cs');
			$jsons = '{
	            "commands" : "checkstatus",
		        "username" : "'.$username.'",
		        "ref_id"   : "'.$ref_id.'",
		        "sign"     : "'.$signature.'"
	        }';
		        
		$url = "https://mobilepulsa.net/api/v1/bill/check";

		$ch  = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsons);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$data = curl_exec($ch);
		curl_close($ch);
		
		return HelpersPPOB::checkError($data);
	}

	public static function post($order_id, $type, $jsons){
		$username   = "0895422649167";
		$apiKey   = "3615d0a49ed95164361";
		$signature  = md5($username.$apiKey.$order_id);
		$pulsa_code = isset($jsons['pulsa_code']) ? $jsons['pulsa_code'] : null;
		$hp = isset($jsons['hp']) ? $jsons['hp'] : $username;
				$jsons = '{
		          "commands"    : "'.HelpersPPOB::checkType($type).'",
		          "username"    : "'.$username.'",
		          "ref_id"      : "'.$order_id.'",
		          "hp"          : "'.$hp.'",
		          "pulsa_code"  : "'.$pulsa_code.'",
		          "sign"        : "'.$signature.'"
		        }';
		        
		$url = "https://api.mobilepulsa.net/v1/legacy/index";

		$ch  = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsons);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$data = curl_exec($ch);
		curl_close($ch);
		
		return HelpersPPOB::checkError($data);
	}


	// CEK DATA PULSA, PAKET DATA, VOUCHER
	public static function cekData($data, $type){
		$username   = "0895422649167";
		$apiKey   = "3615d0a49ed95164361";
		$signature  = md5($username.$apiKey.'pl');
			
		$jsons = '{
			"commands" : "pricelist",
			"username" : "0895422649167",
			"sign"     : "'.$signature.'",
			"status"   : "all"
		}';
		$url = "https://api.mobilepulsa.net/v1/legacy/index/".$data."/".$type."";
		// dd($jsons);
		$ch  = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsons);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$data = curl_exec($ch);
		curl_close($ch);
		// dd($data);
		return HelpersPPOB::checkError($data);
	}

	// CEK DATA INQUERY PASCA BPJS
	public static function cekInqueryPasca($req){
		$username   = "0895422649167";
		$apiKey   = "3615d0a49ed95164361";
		// $apiKey   = "8585cfe52cfc0dff";
		// $apiKeyProd = "3615d0a49ed95164361";
		$ref_id  = uniqid('');
		$signature  = md5($username.$apiKey.$ref_id);
		$month = isset($req['month']) ? formatNumMonth($req['month']) : '';
		$nomor_identitas = isset($req['nomor_identitas']) ? formatNumMonth($req['nomor_identitas']) : '';
		$json = '{
		          "commands" : "inq-pasca",
		          "username" : "'.$username.'",
		          "ref_id"   : "'.$ref_id.'",
		          "sign"     : "'.md5($username.$apiKey.$ref_id).'",
		          "code"     : "'.$req['type'].'",
		          "hp"       : "'.$req['ppob_pelanggan'].'",
		          "nomor_identitas" : "'.$nomor_identitas.'",
		          "month"    : "'.$month.'"
		      }';
		$url = "https://mobilepulsa.net/api/v1/bill/check";
		// $url = "https://testpostpaid.mobilepulsa.net/api/v1/bill/check";
		$ch  = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$data = curl_exec($ch);
		curl_close($ch);
		
		return HelpersPPOB::checkError($data);
	}
	
	public static function postPayPasca($tr_id){
		$username   = "0895422649167";
		$apiKey   = "3615d0a49ed95164361";
		
		$signature  = md5($username.$apiKey.$tr_id);

		$json = '{
		          "commands" : "pay-pasca",
		          "username" : "'.$username.'",
		          "tr_id"    : "'.$tr_id.'",
		          "sign"     : "'.$signature.'"
		        }';

		$url = "https://mobilepulsa.net/api/v1/bill/check";

		$ch  = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$data = curl_exec($ch);
		curl_close($ch);

		return HelpersPPOB::checkError($data);
	}

	// STATSIUN KRETA
	public static function checkClass($class){
		$return = $class;
	    switch ($class)
	    {
	        case 'EKSEKUTIF': $return = 'EKS';
	        break;
	        case 'EKONOMI': $return = 'PREMIUM_SS';
	        break;
	    }

	    return $return;
	}

	public static function arrayToComa($req){
		$show = '';
        foreach ($req as $i => $data) {
            $show .= $data;
            if($i < count($req) - 1){
                $show .= ', ';
            }
        }
        return $show;
	}

	public static function arrayToGetLastChar($req){
		$show = '';
        foreach ($req as $i => $data) {
            if($i == 0){
            	$show = substr($data, -1);
            }
        }
        return $show;
	}

	public static function arrayToSliceLastChar($req){
		$show = '';
        foreach ($req as $i => $data) {
        	if($i == 0){
            	$show = substr($data, 0, -1);
        	}
        }
        return $show;
	}
	
	public static function getListKereta(){
		$username   = "0895422649167";
		$apiKey   = "3615d0a49ed95164361";
		$signature  = md5($username.$apiKey.'pl');

		$json = '{
		          "commands" : "pricelist",
		          "username" : "0895422649167",
		          "sign"     : "16bdad92c280b7ee9b0febabb630523b"
		        }';

		$url = "https://mobilepulsa.net/api/v1/tiketv2";

		$ch  = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$data = curl_exec($ch);
		curl_close($ch);

		return $data;
	}

	public static function findKereta($req){
		// API PRODUCTION
		// 3615d0a49ed95164361 
		// https://mobilepulsa.net/api/v1/tiketv2
		$apiKey   = "3615d0a49ed95164361";
		$username   = "0895422649167";
		$signature  = md5($username.$apiKey."st");
		// dd($req['tanggal_berangkat']);
		// dd($req['tanggal_berangkat']);
		 $jsonDK ='{
            "commands" : "search-train",
		    "username" : "'.$username.'",
		    "org" : "'.$req['rute_asal'].'",
		    "dest" : "'.$req['rute_tujuan'].'",
		    "date" : "'.$req['tanggal_berangkat'].'",
		    "sign" : "'.$signature.'"
        }';
        $urlDK = "https://mobilepulsa.net/api/v1/tiketv2";
        // dd($jsonDK);
        $chDK  = curl_init();
        curl_setopt($chDK, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($chDK, CURLOPT_URL, $urlDK);
        curl_setopt($chDK, CURLOPT_POSTFIELDS, $jsonDK);
        curl_setopt($chDK, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($chDK, CURLOPT_RETURNTRANSFER, true);

        $dataDK = curl_exec($chDK);
        curl_close($chDK);
        // dd($dataDK);
        return HelpersPPOB::checkError($dataDK);
        
	}

	public static function seatMapSubClass($req){
		// API PRODUCTION
		// 3615d0a49ed95164361 
		// https://mobilepulsa.net/api/v1/tiket
		// dd($req);
		$apiKey   = "3615d0a49ed95164361";
		$username   = "0895422649167";
		$ref_id  = uniqid('');
		$signature  = md5($username.$apiKey.$ref_id);
		$hp = $req['desc']['hp'];
		unset($req['desc']['hp']);
		$desc = $req['desc'];
		$jsonDK ='{
            "commands" : "inq-pasca",
		    "username" : "'.$username.'",
		    "code" : "KAI",
		    "ref_id" : "'.$ref_id.'",
		    "hp" : "'.$hp.'",
		    "desc" : {
		    	"contactName" : "'.$req['desc']['contactName'].'",
		        "contactEmail" : "'.$req['desc']['contactEmail'].'",
		        "fareId" : "'.$req['desc']['fareId'].'",
		        "adult" : "'.$req['desc']['adult'].'",
		        "passenger" : '.json_encode($req['desc']['passenger']).'
		    },
		    "sign" : "'.$signature.'"
        }';
        $jsonDK = preg_replace("!\r?\n?\t?\ ?!", "", $jsonDK);
        // dd($jsonDK);

        $urlDK = "https://mobilepulsa.net/api/v1/bill/check";
        
        $chDK  = curl_init();
        curl_setopt($chDK, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($chDK, CURLOPT_URL, $urlDK);
        curl_setopt($chDK, CURLOPT_POSTFIELDS, $jsonDK);
        curl_setopt($chDK, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($chDK, CURLOPT_RETURNTRANSFER, true);

        $dataDK = curl_exec($chDK);
        curl_close($chDK);
        return HelpersPPOB::checkError($dataDK);
        
	}

	// SEAT MAP KERETA
	public static function seatMap($req){
		// API PRODUCTION
		// 3615d0a49ed95164361 
		// https://mobilepulsa.net/api/v1/tiket
		$apiKey   = "3615d0a49ed95164361";
		$username   = "0895422649167";
		$signature  = md5($username.$apiKey.$req['tr_id']);
		// dd($req['tanggal_berangkat']);
		// dd($req['tanggal_berangkat']);
		 $jsonDK ='{
            "commands" : "seat-map",
		    "username" : "'.$username.'",
		    "tr_id" : "'.$req['tr_id'].'",
		    "ticketNumber" : "'.$req['ticketNumber'].'",
		    "sign" : "'.$signature.'"
        }';
        // dd($jsonDK);
        $urlDK = "https://mobilepulsa.net/api/v1/tiketv2";
        
        $chDK  = curl_init();
        curl_setopt($chDK, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($chDK, CURLOPT_URL, $urlDK);
        curl_setopt($chDK, CURLOPT_POSTFIELDS, $jsonDK);
        curl_setopt($chDK, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($chDK, CURLOPT_RETURNTRANSFER, true);

        $dataDK = curl_exec($chDK);
        curl_close($chDK);
        // dd(json_decode($dataDK));
        return HelpersPPOB::checkError($dataDK);
        
	}

	public static function changeSeets($req){
		// API PRODUCTION
		// 3615d0a49ed95164361 
		// https://mobilepulsa.net/api/v1/tiket
		$apiKey   = "3615d0a49ed95164361";
		$username   = "0895422649167";
		$ref_id  = uniqid('');
		$signature  = md5($username.$apiKey.$req['tr_id']);
		$jsonDK ='{
		    "commands" : "change-seat",
		    "username" : "'.$username.'",
		    "tr_id" : '.$req['tr_id'].',
		    "ticketNumber" : "'.$req['ticketNumber'].'",
		    "newSeatId" : "'.$req['newSeatId'].'",
		    "sign" : "'.$signature.'"
		}';


        $urlDK = "https://mobilepulsa.net/api/v1/tiketv2";
        
        $chDK  = curl_init();
        curl_setopt($chDK, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($chDK, CURLOPT_URL, $urlDK);
        curl_setopt($chDK, CURLOPT_POSTFIELDS, $jsonDK);
        curl_setopt($chDK, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($chDK, CURLOPT_RETURNTRANSFER, true);

        $dataDK = curl_exec($chDK);
        curl_close($chDK);
        return HelpersPPOB::checkError($dataDK);
        
	}

	public static function storeBerangkatKeretaAPI($req){
		// API PRODUCTION
		// 3615d0a49ed95164361 
		// https://mobilepulsa.net/api/v1/tiket
		// 3615d0a49ed95164361
		// https://testpostpaid.mobilepulsa.net/api/v1/tiket
		$apiKey   = "3615d0a49ed95164361";
		$username   = "0895422649167";
		$ref_id  = uniqid('');
		
		$arraySubClass = [];
		if(count($req['berangkat']['seats']) > 0){
			foreach ($req['berangkat']['seats'] as $value) {
				// if(count($value) > 0){
					// foreach ($value as $value1) {
						array_push($arraySubClass,$value);
					// }
				// }
			}
		}
		$seats = HelpersPPOB::arrayToComa($arraySubClass);
		
		
		$signature  = md5($username.$apiKey.$seats.$ref_id);
		
		
		 $jsonDK ='{
            "commands" : "book-seat",
		    "username" : "'.$username.'",
		    "refId" : "'.$ref_id.'",
		    "org" : "'.$req['org'].'",
		    "dest" : "'.$req['dest'].'",
		    "date" : "'.$req['tanggal_berangkat'].'",
		    "trainNo" : "'.$req['berangkat']['train_no'].'",
		    "kodeWagon" : "'.$req['berangkat']['kode_wagon'].'",
		    "kelasWagon" : "'.$req['class'].'",
		    "subClass" : "'.$req['berangkat']['sub_class'].'",
		    "seats" : "'.$seats.'",
		    "seatSelect" : "manual",
		    "adult" : "'.count($req['adult']).'",
		    "infant" : "0",
		    "passenger" : {
		        "adult" : {
		            "detail" : '.json_encode($req['adult']).'
		        },
		        "infant" : ""
		    },
		    "sign" : "'.$signature.'"
        }';


        $urlDK = "https://mobilepulsa.net/api/v1/tiketv2";
        
        $chDK  = curl_init();
        curl_setopt($chDK, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($chDK, CURLOPT_URL, $urlDK);
        curl_setopt($chDK, CURLOPT_POSTFIELDS, $jsonDK);
        curl_setopt($chDK, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($chDK, CURLOPT_RETURNTRANSFER, true);

        $dataDK = curl_exec($chDK);
        curl_close($chDK);
        return HelpersPPOB::checkError($dataDK);
        
	}


	public static function storePulangKeretaAPI($req){
		// API PRODUCTION
		// 3615d0a49ed95164361 
		// https://mobilepulsa.net/api/v1/tiketv2
		// API DEVELOPMENT
		// 3615d0a49ed95164361
		// https://testpostpaid.mobilepulsa.net/api/v1/tiketv2
		$apiKey   = "3615d0a49ed95164361";
		$username   = "0895422649167";
		$ref_id  = uniqid('');

		$arraySubClass = [];
		if(count($req['kepulangan']['seats']) > 0){
			foreach ($req['kepulangan']['seats'] as $value) {
				array_push($arraySubClass,$value);
			}
		}

		$seats = HelpersPPOB::arrayToComa($arraySubClass);
		
		$signature  = md5($username.$apiKey.$seats.$ref_id);
		
	    $jsonDK ='{
            "commands" : "book-seat",
		    "username" : "'.$username.'",
		    "refId" : "'.$ref_id.'",
		    "org" : "'.$req['dest'].'",
		    "dest" : "'.$req['org'].'",
		    "date" : "'.$req['tanggal_kepulangan'].'",
		    "trainNo" : "'.$req['kepulangan']['train_no'].'",
		    "kodeWagon" : "'.$req['kepulangan']['kode_wagon'].'",
		    "kelasWagon" : "'.$req['class_kepulangan'].'",
		    "subClass" : "'.$req['kepulangan']['sub_class'].'",
		    "seats" : "'.$seats.'",
		    "seatSelect" : "manual",
		    "adult" : "'.count($req['adult']).'",
		    "infant" : "0",
		    "passenger" : {
		        "adult" : {
		            "detail" : '.json_encode($req['adult']).'
		        },
		        "infant" : ""
		    },
		    "sign" : "'.$signature.'"
        }';
        $urlDK = "https://mobilepulsa.net/api/v1/tiketv2";
        
        $chDK  = curl_init();
        curl_setopt($chDK, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($chDK, CURLOPT_URL, $urlDK);
        curl_setopt($chDK, CURLOPT_POSTFIELDS, $jsonDK);
        curl_setopt($chDK, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($chDK, CURLOPT_RETURNTRANSFER, true);

        $dataDK = curl_exec($chDK);
        curl_close($chDK);
        return HelpersPPOB::checkError($dataDK);
        
	}

	public static function bookingAccept($id){
		// API PRODUCTION
		// 3615d0a49ed95164361 
		// https://mobilepulsa.net/api/v1/tiketv2
		$apiKey   = "3615d0a49ed95164361";
		$username   = "0895422649167";
		$signature  = md5($username.$apiKey.$id);
		// dd($req['tanggal_berangkat']);
		dd($id);
		 $jsonDK ='{
            "commands" : "pay-pasca",
		    "username" : "0895422649167",
		    "tr_id" : "'.$id.'",
		    "sign" : "'.$signature.'"
        }';
        $urlDK = "https://mobilepulsa.net/api/v1/tiketv2";
        
        $chDK  = curl_init();
        curl_setopt($chDK, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($chDK, CURLOPT_URL, $urlDK);
        curl_setopt($chDK, CURLOPT_POSTFIELDS, $jsonDK);
        curl_setopt($chDK, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($chDK, CURLOPT_RETURNTRANSFER, true);

        $dataDK = curl_exec($chDK);
        curl_close($chDK);
        return HelpersPPOB::checkError($dataDK);
        
	}

	public static function checkBooking($id){
		// API PRODUCTION
		// 3615d0a49ed95164361 
		// https://mobilepulsa.net/api/v1/tiketv2
		$apiKey   = "3615d0a49ed95164361";
		$username   = "0895422649167";
		$signature  = md5($username.$apiKey.$id);
		// dd($req['tanggal_berangkat']);
		// dd($req['tanggal_berangkat']);
		 $jsonDK ='{
            "commands" : "check-book",
		    "username" : "0895422649167",
		    "trId" : "'.$id.'",
		    "sign" : "'.$signature.'"
        }';
        $urlDK = "https://mobilepulsa.net/api/v1/tiketv2";
        
        $chDK  = curl_init();
        curl_setopt($chDK, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($chDK, CURLOPT_URL, $urlDK);
        curl_setopt($chDK, CURLOPT_POSTFIELDS, $jsonDK);
        curl_setopt($chDK, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($chDK, CURLOPT_RETURNTRANSFER, true);

        $dataDK = curl_exec($chDK);
        curl_close($chDK);
        return HelpersPPOB::checkError($dataDK);
        
	}
	
}
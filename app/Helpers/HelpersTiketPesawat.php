<?php
namespace App\Helpers;

use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class HelpersTiketPesawat
{
	// API TIKET.COM
	public static function TiketGetToken(){
		$apiKey   = "cfc53bff46a9cafe6d9677d781ad0744";
		
		$url = "https://api-sandbox.tiket.com/apiv1/payexpress?method=getToken&secretkey=56c8624d6a62e1ab22f0d9915ff2d43c&output=json";
		
		$ch  = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','User-Agent: twh:[33315199];[Ayokulakans];'));
		curl_setopt($ch, CURLOPT_USERAGENT, "twh:[33315199];[Ayokulakans];");
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_FAILONERROR, 0);
		curl_setopt($ch, CURLOPT_URL, $url);
		// curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$data = json_decode(curl_exec($ch));
		curl_close($ch);

		return $data;
	}

	// COUNTRY
	public static function TiketGetCountry(){
		$data = HelpersTiketPesawat::TiketGetToken();
		
		$url1 = "https://api-sandbox.tiket.com/general_api/listCountry?token=".$data->token."&output=json";
		$ch1  = curl_init();
		curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch1, CURLOPT_VERBOSE, 1);
		curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch1, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch1, CURLOPT_FAILONERROR, 0);
		curl_setopt($ch1, CURLOPT_URL, $url1);
		// curl_setopt($ch1, CURLOPT_POSTFIELDS, '?token="'.$data->token.'"&output=json');
		curl_setopt($ch1, CURLOPT_CONNECTTIMEOUT, 30);
		// dd($ch1);
		$data1 = curl_exec($ch1);
		curl_close($ch1);
		
		return json_decode($data1);
	}

	// KAB / KOTA
	public static function TiketGetKabKot($id){
		
		$url1 = "http://dev.farizdotid.com/api/daerahindonesia/provinsi/".$id."/kabupaten";
		$ch1  = curl_init();
		curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch1, CURLOPT_VERBOSE, 1);
		curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch1, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch1, CURLOPT_FAILONERROR, 0);
		curl_setopt($ch1, CURLOPT_URL, $url1);
		// curl_setopt($ch1, CURLOPT_POSTFIELDS, '?token="'.$data->token.'"&output=json');
		curl_setopt($ch1, CURLOPT_CONNECTTIMEOUT, 30);
		// dd($ch1);
		$data1 = curl_exec($ch1);
		curl_close($ch1);
		
		return json_decode($data1);
	}

	// KAB / KOTA
	public static function TiketGetKecamatan($id){
		
		$url1 = "http://dev.farizdotid.com/api/daerahindonesia/provinsi/kabupaten/".$id."/kecamatan";
		$ch1  = curl_init();
		curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch1, CURLOPT_VERBOSE, 1);
		curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch1, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch1, CURLOPT_FAILONERROR, 0);
		curl_setopt($ch1, CURLOPT_URL, $url1);
		// curl_setopt($ch1, CURLOPT_POSTFIELDS, '?token="'.$data->token.'"&output=json');
		curl_setopt($ch1, CURLOPT_CONNECTTIMEOUT, 30);
		// dd($ch1);
		$data1 = curl_exec($ch1);
		curl_close($ch1);
		
		return json_decode($data1);
	}


	// CURENCY
	public static function TiketGetCurrency(){
		$data = HelpersTiketPesawat::TiketGetToken();
		
		$url1 = "http://api-sandbox.tiket.com/general_api/listCurrency?token=".$data->token."&output=json";
		$ch1  = curl_init();
		curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch1, CURLOPT_VERBOSE, 1);
		curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch1, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch1, CURLOPT_FAILONERROR, 0);
		curl_setopt($ch1, CURLOPT_URL, $url1);
		// curl_setopt($ch1, CURLOPT_POSTFIELDS, '?token="'.$data->token.'"&output=json');
		curl_setopt($ch1, CURLOPT_CONNECTTIMEOUT, 30);
		// dd($ch1);
		$data1 = curl_exec($ch1);
		curl_close($ch1);
		
		return json_decode($data1);
	}

	// GET ALL AIR PORT
	public static function TiketGetAirport(){
		$data = HelpersTiketPesawat::TiketGetToken();
		//
		$url1 = "https://api-sandbox.tiket.com/flight_api/all_airport?token=".$data->token."&output=json";
		
		$ch1  = curl_init();
		curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		// curl_setopt($ch1, CURLOPT_USERAGENT, $config['useragent']);
		curl_setopt($ch1, CURLOPT_VERBOSE, 1);
		curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch1, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch1, CURLOPT_FAILONERROR, 0);
		curl_setopt($ch1, CURLOPT_URL, $url1);
		// curl_setopt($ch1, CURLOPT_POSTFIELDS, '?token="'.$data->token.'"&output=json');
		curl_setopt($ch1, CURLOPT_CONNECTTIMEOUT, 30);
		// dd($ch1);
		$data1 = curl_exec($ch1);
		curl_close($ch1);
		// dd(json_decode($data1));
		return json_decode($data1);
	}

	//SEARCH AIRPORT

	public static function TiketGetSearch($request,$token = '-'){
		$data = HelpersTiketPesawat::TiketGetToken();
		if($token != '-'){
			$tokens = $token;
		}else{
			$tokens = $data->token;
		}
		$url1 = "http://api-sandbox.tiket.com/search/flight?token=".$tokens."&".$request."&output=json";
		
		$ch1  = curl_init();
		curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type: application/json','User-Agent: twh:[33315199];[Ayokulakans];'));
		curl_setopt($ch1, CURLOPT_USERAGENT, "twh:[33315199];[Ayokulakans];");
		curl_setopt($ch1, CURLOPT_VERBOSE, 1);
		curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch1, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch1, CURLOPT_FAILONERROR, 0);
		curl_setopt($ch1, CURLOPT_URL, $url1);
		curl_setopt($ch1, CURLOPT_CONNECTTIMEOUT, 30);
		$data1 = curl_exec($ch1);
		curl_close($ch1);
		// dd(json_decode($data1));
		// HelpersTiketPesawat::TiketGetCekUpdt($tokens,$request);
		return json_decode($data1);
	}

	public static function TiketGetCekUpdt($token,$request){
		$url1 = "https://api-sandbox.tiket.com/ajax/mCheckFlightUpdated?token=".$token."&".$request."&output=json";
		
		$ch1  = curl_init();
		curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type: application/json','User-Agent: twh:[33315199];[Ayokulakans];'));
		curl_setopt($ch1, CURLOPT_USERAGENT, "twh:[33315199];[Ayokulakans];");
		curl_setopt($ch1, CURLOPT_VERBOSE, 1);
		curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch1, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch1, CURLOPT_FAILONERROR, 0);
		curl_setopt($ch1, CURLOPT_URL, $url1);
		curl_setopt($ch1, CURLOPT_CONNECTTIMEOUT, 30);
		$data1 = curl_exec($ch1);
		curl_close($ch1);
		// dd(json_decode($data1));
		$url = "http://api-sandbox.tiket.com/search/flight?token=".$token."&".$request."&output=json";
		
		$ch  = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','User-Agent: twh:[33315199];[Ayokulakans];'));
		curl_setopt($ch, CURLOPT_USERAGENT, "twh:[33315199];[Ayokulakans];");
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_FAILONERROR, 0);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		$data = curl_exec($ch);
		curl_close($ch);
		return json_decode($data);
	}

	// public static function TiketGetCountry(){
	// 	$apiKey   = "cfc53bff46a9cafe6d9677d781ad0744";
		
	// 	// $url = "https://api-sandbox.tiket.com/apiv1/payexpress?method=getToken&secretkey=d18e93fc2665e7d0b1428df358273b9138f787bb&output=json";
		
	// 	$ch  = curl_init();
	// 	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	// 	curl_setopt($ch, CURLOPT_VERBOSE, 1);
	// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	// 	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	// 	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	// 	curl_setopt($ch, CURLOPT_FAILONERROR, 0);
	// 	curl_setopt($ch, CURLOPT_URL, $url);
	// 	// curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
	// 	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
	// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	// 	$data = json_decode(curl_exec($ch));
	// 	curl_close($ch);
	// 	//
	// 	$url = "http://api-sandbox.tiket.com/general_api/listCountry?token=".$data->token."&output=json";
		
	// 	$ch1  = curl_init();
	// 	curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	// 	curl_setopt($ch1, CURLOPT_VERBOSE, 1);
	// 	curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
	// 	curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, 0);
	// 	curl_setopt($ch1, CURLOPT_SSL_VERIFYHOST, 0);
	// 	curl_setopt($ch1, CURLOPT_FAILONERROR, 0);
	// 	curl_setopt($ch1, CURLOPT_URL, $url);
	// 	// curl_setopt($ch1, CURLOPT_POSTFIELDS, $json);
	// 	curl_setopt($ch1, CURLOPT_CONNECTTIMEOUT, 30);
	// 	curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);

	// 	$data1 = curl_exec($ch1);
	// 	curl_close($ch1);
	// 	dd(json_decode($data1));
	// 	return HelpersPPOB::checkError($data);
	// }

}
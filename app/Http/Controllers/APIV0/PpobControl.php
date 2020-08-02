<?php

namespace App\Http\Controllers\APIV0;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

// class CurlControl
// {
//   public static $header = [];
//   public static function setHeader($val)
//   {
//     self::$header = $val;
//   }

//   public static function request($end_api,$request_data = null,int $type = 0){

//     if ($type == 1 && $request_data != null) {
//       $endpoint = $end_api."?".http_build_query($request_data);
//     }else {
//       $endpoint = $end_api;
//     }


// 		$ch = curl_init($endpoint);
//     if ($type == 1) {
//       curl_setopt($ch, CURLOPT_POST, true);
//   		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request_data));
//     }
//     curl_setopt($ch, CURLOPT_HEADER, 1);
// 		curl_setopt($ch, CURLOPT_HTTPHEADER, self::$header);
// 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// 		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

// 		$result = curl_exec($ch);
//       $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
//     $headers = substr($result, 0, $header_size);
//     $body = substr($result, $header_size);
//     $result = $body;
// 		if ($result === FALSE) {
// 			return FALSE;
// 		}

// 		curl_close($ch);
// 		$result = json_decode($result, TRUE);
//     if (!empty($result)) {
//       return $result;
//     }

// 		return NULL;
// 	}

// }

class PpobControl extends Controller
{
  public function telepon_rumah(Request $req)
  {

    $this->validate($req, [
      "telepon_rumah"=>"required"
    ]);

    $build = [
      "customer_number"=>$req->telepon_rumah,
      "product_id"=>663,
    ];

    CurlControl::setHeader([
      "Content-Type: application/json"
    ]);

    $res = CurlControl::request("https://gaia.sepulsa.com/bumi/telkom_services/inquiry?".time(),$build,1);

    return response()->json($res);


  }
}

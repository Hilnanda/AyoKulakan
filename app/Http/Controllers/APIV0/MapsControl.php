<?php

namespace App\Http\Controllers\APIV0;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\KakiLima\KakiLima;
class CurlControl
{
  public static $header = [];
  public static function setHeader($val)
  {
    self::$header = $val;
  }

  public static function request($end_api,$request_data = null,int $type = 0){

    if ($type == 1 && $request_data != null) {
      $endpoint = $end_api."?".http_build_query($request_data);
    }else {
      $endpoint = $end_api;
    }


		$ch = curl_init($endpoint);
    if ($type == 1) {
      curl_setopt($ch, CURLOPT_POST, true);
  		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request_data));
    }
    curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, self::$header);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$result = curl_exec($ch);
      $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headers = substr($result, 0, $header_size);
    $body = substr($result, $header_size);
    $result = $body;
		if ($result === FALSE) {
			return FALSE;
		}

		curl_close($ch);
		$result = json_decode($result, TRUE);
    if (!empty($result)) {
      return $result;
    }

		return NULL;
	}

}

class MapsControl extends Controller
{
  public function cari_kl(Request $req)
  {

    $this->validate($req, [
      "nama_kl"=>"required"
    ]);
    $find = KakiLima::where("name","like","%".$req->nama_kl."%")->where("lat","!=",null)->where("lng","!=",null);
    if ($find->count() > 0) {
      $row = $find->first();
      $data = [
        "lat"=>$row->lat,
        "lng"=>$row->lng,
      ];
      return response(["code"=>200,"data"=>$data],200);

    }else {
      return response(["code"=>404],200);
    }

  }
}

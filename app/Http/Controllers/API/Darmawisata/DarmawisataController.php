<?php

namespace App\Http\Controllers\API\Darmawisata;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;


use App\Models\User;
use App\Models\Berita\Berita;
use Carbon\Carbon;

use App\Helpers\Darmawisata\Hotel;
use GuzzleHttp\Client;

class DarmawisataController extends Controller
{
	public function __construct()
    {
        $this->hotel = new Hotel();
        $this->client   = new Client();
    }


    public function login(Request $request)
    {
    	// dump($this->hotel->sessionLoginss());
    	// $apiToken = date('Y-m-d\TH:i:s');
    	$pass = 'UXI5VVVYBY';
     //    $securityCode = md5($apiToken . md5($pass));
    	dump(Carbon::now()->format('Y-m-d\TH:i:s.uP'));
    	dump(date('Y-m-d\TH:i:s'));

        $login = curlsPost('https://61.8.74.42:7080/h2h/Session/Login',array('Content-Type: application/json'),'{
            "token":"'.Carbon::now()->format('Y-m-d\TH:i:s.uP').'",
            "securityCode":"'.md5(Carbon::now()->format('Y-m-d\TH:i:s.uP') . md5($pass)).'",
            "userID":"UXI5CFRYBY"
        }');
        
        dd($login);
    	// $response = $this->client->post('https://ayokulakan.com/api/darmawisata/coba',[
     //        'headers' => [
		   //      'Accept' => 'application/json',
		   //      'Content-Type' => 'application/json'
		   //  ],
     //        'verify' => false
     //    ])->getBody();
    	// return $response;
    }

    public function coba(Request $request){
    	return response([
    		'status'=>true
    	]);
    }
}

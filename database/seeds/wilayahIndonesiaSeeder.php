<?php

use Illuminate\Database\Seeder;
use App\Models\Master\WilayahKota;
use App\Models\Master\WilayahKecamatan;
use App\Models\Master\WilayahProvinsi;
use App\Models\Master\WilayahNegara;
use GuzzleHttp\Client;
class wilayahIndonesiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function options($data=[]){
        $apiKey = Config('services.rajaongkir.key');
        if(count($data) > 0){
            return [
                'data' => $data,
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'key' => $apiKey,
                ],
                'verify' => false
            ];
        }else{
            return [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'key' => $apiKey,
                ],
                'verify' => false
            ];
        }
    }

    public function run()
    {
        WilayahKecamatan::truncate();
        WilayahKota::truncate();
        WilayahProvinsi::truncate();
        $negara = WilayahNegara::where('negara','Indonesia')->first();
        $client = new Client();
        $apiUrl = Config('services.rajaongkir.url');
        
        $result = $client->get($apiUrl.'/province',$this->options())->getBody();
        $result = json_decode($result);
        if(count($result->rajaongkir->results) > 0){
        	foreach ($result->rajaongkir->results as $value) {
        		$provinsi = WilayahProvinsi::create([
        			'id_negara' => $negara->id,
        			'provinsi' => $value->province,
        		]);

        		$resKota = $client->get($apiUrl.'/city?province='.$value->province_id,$this->options())->getBody();
        		$resKota = json_decode($resKota);

        		if(count($resKota->rajaongkir->results) > 0){
        			foreach ($resKota->rajaongkir->results as $value1) {
        				$kota = WilayahKota::create([
        					'id' => $value1->city_id,
        					'id_negara' => $negara->id,
        					'id_provinsi' => $provinsi->id,
        					'kota' => $value1->city_name
        				]);

        				$resKec = $client->get($apiUrl.'/subdistrict?city='.$value1->city_id,$this->options())->getBody();
        				$resKec = json_decode($resKec);
        				if(count($resKec->rajaongkir->results) > 0){
		        			foreach ($resKec->rajaongkir->results as $value2) {
		        				$kota = WilayahKecamatan::create([
		        					'id' => $value2->subdistrict_id,
		        					'id_negara' => $negara->id,
        							'id_provinsi' => $provinsi->id,
		        					'id_kota' => $kota->id,
		        					'kecamatan' => $value2->subdistrict_name
		        				]);
		        			}
		        		}

        			}
        		}
        	}
        }
    }
}

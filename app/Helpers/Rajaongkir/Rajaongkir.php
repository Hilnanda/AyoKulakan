<?php

namespace App\Helpers\Rajaongkir;

use GuzzleHttp\Client;
use Kavist\RajaOngkir\Facades\RajaOngkir as KavistOngkir;

class Rajaongkir
{

    public static function getOptions($data=[]){
        $apiKey = Config('services.rajaongkir.key');
        if (count($data) > 0) {
            return [
                'data' => $data,
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'key' => $apiKey,
                ],
                'verify' => false
            ];
        } else {
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

    public static function postOptions($data){
        $apiKey = Config('services.rajaongkir.key');
        return [
            'body' => $data,
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'key' => $apiKey,
            ],
            'verify' => false
        ];
    }

    public static function cost($data = []){
        $client = new Client();
        $apiUrl = Config('services.rajaongkir.url');
        $result = $client->post($apiUrl.'/cost',Rajaongkir::postOptions(json_encode($data)))->getBody();
        return json_decode($result);
    }

    public static function ongkosKirim($origin, $destination, $weight, $courier)
    {
        return KavistOngkir::ongkosKirim([
            'origin'          => $origin,           // ID kota/kabupaten asal
            'originType'      => 'city',            // ID kota/kabupaten asal
            'destination'     => $destination,      // ID kota/kabupaten tujuan
            'destinationType' => 'city',            // ID kota/kabupaten tujuan
            'weight'          => $weight,           // berat barang dalam gram
            'courier'         => $courier           // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ]);
    }
}

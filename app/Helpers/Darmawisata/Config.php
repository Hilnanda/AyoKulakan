<?php

namespace App\Helpers\Darmawisata;

class Config
{
    /**
     * User ID yang di gunakan untuk koneksi server darmawisata
     *
     * @var String
     */
    public static $userID = 'UXI5CFRYBY';

    /**
     * Password yang di gunakan untuk koneksi server darmawisata
     *
     * @var String
     */
    public static $pass = 'UXI5VVVYBY';

    /**
     * URL darmawisata
     *
     * @var String
     */
    public static $apiEndPoint = 'https://61.8.74.42:7080/h2h';

    /**
     * Header API Request
     *
     * @var Array
     */
    public static $header = [
        'Accept' => 'application/json',
        'Content-Type' => 'application/json'
    ];
}

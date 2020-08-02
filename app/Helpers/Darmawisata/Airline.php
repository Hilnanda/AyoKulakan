<?php

namespace App\Helpers\Darmawisata;

use GuzzleHttp\Client;

class Airline
{
    /**
     * User ID yang di gunakan untuk koneksi server darmawisata
     *
     * @var String
     */
    private $userID;

    /**
     * Password yang di gunakan untuk koneksi server darmawisata
     *
     * @var String
     */
    private $pass;

    /**
     * URL darmawisata
     *
     * @var String
     */
    private $apiEndPoint;

    /**
     * new Client()
     *
     * @var GuzzleHttp\Client
     */
    private $client;

    /**
     * Default token
     *
     * @var Date
     */
    private $apiToken;

    /**
     * Method Constructor
     */
    public function __construct()
    {
        $this->client   = new Client();
        $this->apiToken = date('Y-m-d\TH:i:s');
        $this->headers  = Config::$header;
        $this->userID = Config::$userID;
        $this->pass = Config::$pass;
        $this->apiEndPoint = Config::$apiEndPoint;
    }

    /**
     * Option API
     *
     * @param array $data
     * @return array
     */
    private function options($data)
    {
        return [
            'body' => $data,
            'headers' => $this->headers,
            'verify' => false
        ];
    }

    /**
     * Parsing data Token
     *
     * @return session
     */
    private function getAccessToken()
    {
        // if (session()->has('accessToken')) {
        //     $token = session('accessToken');
        // } else {
        //     $token = $this->sessionLogin()->accessToken;
        //     session(['accessToken' => $token]);
        // }
        $token = $this->sessionLogin()->accessToken;

        return $token;
    }

    /**
     * Session Login
     *
     * @return \GuzzleHttp\Client
     */
    private function sessionLogin()
    {
        $securityCode = md5($this->apiToken . md5($this->pass));

        $data = json_encode([
            'userID' => $this->userID,
            'securityCode' => $securityCode,
            'token' => $this->apiToken,
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Session/Login', $this->options($data))->getBody();
        return json_decode($response);
    }

    /**
     * Session Login
     *
     * @return \GuzzleHttp\Client
     */
    public function sessionLogout()
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken(),
            'token' => $this->apiToken,
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Session/Logout', $this->options($data))->getBody();
        session()->forget('accessToken');
        return json_decode($response);
    }

    /**
     * Show All Airline
     *
     * @return \GuzzleHttp\Client
     */
    public function getAirLine()
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken()
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Airline/List', $this->options($data))->getBody();
        $obj = json_decode($response);

        return $obj;
    }

    /**
     * Get All Airline Nationality
     *
     * @return \GuzzleHttp\Client
     */
    public function getAirlineNationality()
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken()
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Airline/Nationality', $this->options($data))->getBody();
        $obj = json_decode($response);

        return $obj;
    }

    /**
     * Get All Airline Route
     *
     * @return \GuzzleHttp\Client
     */
    public function getAirlineRoute($request)
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken(),
            'airlineID' => $request->airlineID,
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Airline/Route', $this->options($data))->getBody();
        $obj = json_decode($response);

        return $obj;
    }

    /**
     * Get All Airline Route
     *
     * @return \GuzzleHttp\Client
     */
    public function getAirlineLowFareRoute()
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken()
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Airline/LowFareRoute', $this->options($data))->getBody();
        $obj = json_decode($response);

        return $obj;
    }

    /**
     * Show All Airline Schedules
     *
     * @return \GuzzleHttp\Client
     */
    public function getScheduleAllAirline($request)
    {
        $data = [
            "userID" => $this->userID,
            "accessToken" => $this->getAccessToken(),
            "tripType" => $request['tripType'],
            "origin" => $request['origin'],
            "destination" => $request['destination'],
            "departDate" => $request['departDate'],
            "returnDate" => $request['returnDate'],
            "paxAdult" => $request['paxAdult'],
            "paxChild" => $request['paxChild'],
            "paxInfant" => $request['paxInfant'],
            "promoCode" => $request['promoCode'],
            "airlineAccessCode" => $request['airlineAccessCode'],
            "cacheType" => "Mix",
            "isShowEachAirline" => false
        ];

        $response = $this->client->post($this->apiEndPoint . '/Airline/ScheduleAllAirline', $this->options(json_encode($data)))->getBody();
        $obj = json_decode($response);

        return $obj;
    }

    /**
     * Show All Airline Prices
     *
     * @return \GuzzleHttp\Client
     */
    public function getPriceAllAirline($request)
    {
        $data = [
            "userID" => $this->userID,
            "accessToken" => $request->accessToken,
            "airlineID" => $request->airlineID,
            "origin" => $request->origin,
            "destination" => $request->destination,
            "tripType" => $request->tripType,
            "departDate" => $request->departDate,
            "returnDate" => $request->returnDate,
            "paxAdult" => $request->paxAdult,
            "paxChild" => $request->paxChild,
            "paxInfant" => $request->paxInfant,
            "airlineAccessCode" => $request->airlineAccessCode,
            "journeyDepartReference" => $request->journeyDepartReference,
            "journeyReturnReference" => $request->journeyReturnReference
        ];

        $response = $this->client->post($this->apiEndPoint . '/Airline/PriceAllAirline', $this->options(json_encode($data)))->getBody();
        $obj = json_decode($response);

        return $obj;
    }

    /**
     * Show All Airline Schedule
     *
     * @return \GuzzleHttp\Client
     */
    public function getAirlineSchedule($request)
    {
        $data = [
            "userID" => $this->userID,
            "accessToken" => $this->getAccessToken(),
            "airlineID" => $request->airlineID,
            "origin" => $request->origin,
            "destination" => $request->destination,
            "tripType" => $request->tripType,
            "departDate" => $request->departDate,
            "returnDate" => $request->returnDate,
            "paxAdult" => $request->paxAdult,
            "paxChild" => $request->paxChild,
            "paxInfant" => $request->paxInfant,
            "promoCode" => $request->promoCode,
            "airlineAccessCode" => $request->airlineAccessCode
        ];

        $response = $this->client->post($this->apiEndPoint . '/Airline/Schedule', $this->options(json_encode($data)))->getBody();
        $obj = json_decode($response);

        return $obj;
    }

    /**
     * Get Baggage And Meal Airline Schedule
     *
     * @return \GuzzleHttp\Client
     */
    public function getBaggageAndMeal($request)
    {
        $data = [
            "userID" => $this->userID,
            "accessToken" => $request->accessToken,
            "airlineID" => $request->airlineID,
            "tripType" => $request->tripType,
            "origin" => $request->origin,
            "destination" => $request->destination,
            "departDate" => $request->departDate,
            "returnDate" => $request->returnDate,
            "paxAdult" => $request->paxAdult,
            "paxChild" => $request->paxChild,
            "paxInfant" => $request->paxInfant,
            "schDepart" => $request->schDepart,
            "schReturn" => $request->schReturn,
            "contactTitle" => $request->contactTitle,
            "contactFirstName" => $request->contactFirstName,
            "contactLastName" => $request->contactLastName,
            "contactCountryCodePhone" => $request->contactCountryCodePhone,
            "contactAreaCodePhone" => $request->contactAreaCodePhone,
            "contactRemainingPhoneNo" => $request->contactRemainingPhoneNo,
            "insurance" => $request->insurance,
            "paxDetails" => [
                [
                    "IDNumber" => "1122334455",
                    "title" => "MR",
                    "firstName" => "Garry",
                    "lastName" => "Cokie",
                    "birthDate" => "1980-08-17",
                    "gender" => "Male",
                    "nationality" => "ID",
                    "birthCountry" => "ID",
                    "parent" => "",
                    "passportNumber" => "",
                    "passportIssuedCountry" => "",
                    "passportIssuedDate" => "",
                    "passportExpiredDate" => "",
                    "type" => "Adult"
                ]
            ]
        ];

        $response = $this->client->post($this->apiEndPoint . '/Airline/BaggageAndMeal', $this->options(json_encode($data)))->getBody();
        $obj = json_decode($response);

        return $obj;
    }

    /**
     * Get Baggage And Meal Airline Schedule
     *
     * @return \GuzzleHttp\Client
     */
    public function getSeat($request)
    {
        $data = [
            "userID" => $this->userID,
            "accessToken" => $request->accessToken,
            "airlineID" => $request->airlineID,
            "tripType" => $request->tripType,
            "origin" => $request->origin,
            "destination" => $request->destination,
            "departDate" => $request->departDate,
            "returnDate" => $request->returnDate,
            "paxAdult" => $request->paxAdult,
            "paxChild" => $request->paxChild,
            "paxInfant" => $request->paxInfant,
            "schDepart" => $request->schDepart,
            "schReturn" => $request->schReturn,
            "contactTitle" => $request->contactTitle,
            "contactFirstName" => $request->contactFirstName,
            "contactLastName" => $request->contactLastName,
            "contactCountryCodePhone" => $request->contactCountryCodePhone,
            "contactAreaCodePhone" => $request->contactAreaCodePhone,
            "contactRemainingPhoneNo" => $request->contactRemainingPhoneNo,
            "insurance" => $request->insurance,
            "paxDetails" => [
                [
                    "IDNumber" => "1122334455",
                    "title" => "MR",
                    "firstName" => "Garry",
                    "lastName" => "Cokie",
                    "birthDate" => "1980-08-17",
                    "gender" => "Male",
                    "nationality" => "ID",
                    "birthCountry" => "ID",
                    "parent" => "",
                    "passportNumber" => "",
                    "passportIssuedCountry" => "",
                    "passportIssuedDate" => "",
                    "passportExpiredDate" => "",
                    "type" => "Adult"
                ]
            ]
        ];

        $response = $this->client->post($this->apiEndPoint . '/Airline/seat', $this->options(json_encode($data)))->getBody();
        $obj = json_decode($response);

        return $obj;
    }

    /**
     * Get Price Airline Schedule
     *
     * @return \GuzzleHttp\Client
     */
    public function getPriceAirline($request)
    {
        $data = [
            "userID" => $this->userID,
            "accessToken" => $request->accessToken, // accessToken dari hasil schedule
            "airlineID" => $request->airlineID,
            "tripType" => $request->tripType,
            "origin" => $request->origin,
            "destination" => $request->destination,
            "departDate" => $request->departDate,
            "returnDate" => $request->returnDate,
            "paxAdult" => $request->paxAdult,
            "paxChild" => $request->paxChild,
            "paxInfant" => $request->paxInfant,
            "promoCode" => $request->promoCode,
            "schDeparts" => [
                [
                    "airlineCode" => "QG",
                    "flightNumber" => "800",
                    "schOrigin" => "SUB",
                    "schDestination" => "CGK",
                    "detailSchedule" => "0~P~~P~RGFR~~1~X|QG~ 800~ ~~SUB~00/16/2020 05:45~CGK~00/16/2020 07:15~",
                    "schDepartTime" => "2020-04-16T05:45:00",
                    "schArrivalTime" => "2020-04-16T07:15:00",
                    "flightClass" => "P",
                    "garudaNumber" => "",
                    "garudaAvailability" => ""
                ]
            ],
            "schReturns" => []
        ];

        $response = $this->client->post($this->apiEndPoint . '/Airline/Price', $this->options(json_encode($data)))->getBody();
        $obj = json_decode($response);

        return $obj;
    }

    /**
     * Mengambil data List Booking
     *
     * @param Illuminate\Http\Request $request
     * @return Illumintae\Http\Response
     */
    public function getBookingList($request)
    {
        $data = [
            "userID" => $this->userID,
            "accessToken" => $this->getAccessToken(),
            "filterByStatus" => $request->status,       // “Booking”,”Processed” or “Issued”
            "startDate" => $request->start,             // Filter date from       Format yyyy-MM-dd
            "endDate" => $request->end                  // Filter date end to     Format yyyy-MM-dd
        ];

        $response = $this->client->post($this->apiEndPoint . '/Airline/BookingList', $this->options(json_encode($data)))->getBody();
        $obj = json_decode($response);

        return $obj;
    }

    /**
     * Mengambil data List Booking
     *
     * @param Illuminate\Http\Request $request
     * @return Illumintae\Http\Response
     */
    public function getBookingDetail($request)
    {
        $data = [
            "userID" => $this->userID,
            "accessToken" => $this->getAccessToken(),
            "bookingCode" => $request->bookingCode,
            "bookingDate" => $request->bookingDate,
        ];

        $response = $this->client->post($this->apiEndPoint . '/Airline/BookingDetail', $this->options(json_encode($data)))->getBody();
        $obj = json_decode($response);

        return $obj;
    }

    /**
     * Membuat data booking
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function setBooking($request)
    {
        $adult = data_get($request->pax, 'adult');
        $paxDetails = collect($adult);

        if (array_key_exists('child', $request->pax)) {
            $child = data_get($request->pax, 'child');
            $paxDetails = $paxDetails->concat($child);
        }

        if (array_key_exists('infant', $request->pax)) {
            $infant = data_get($request->pax, 'infant');
            $paxDetails = $paxDetails->concat($infant);
        }

        $data = [
            "userID" => $this->userID,
            "accessToken" => $request->accessToken, // accessToken dari hasil schedule
            "airlineID" => $request->airlineID,
            "origin" => $request->origin,
            "destination" => $request->destination,
            "tripType" => $request->tripType,
            "departDate" => $request->departDate,
            "returnDate" => $request->returnDate,
            "contactTitle" => $request->pemesanTitle,
            "contactFirstName" => $request->pemesanFirstName,
            "contactLastName" => $request->pemesanLastName,
            "contactCountryCodePhone" => $this->splitPhone($request->pemesanTelepon, 1),
            "contactAreaCodePhone" => $this->splitPhone($request->pemesanTelepon, 2),
            "contactRemainingPhoneNo" => $this->splitPhone($request->pemesanTelepon, 3),
            "paxAdult" => $request->paxAdult,
            "paxChild" => $request->paxChild,
            "paxInfant" => $request->paxInfant,
            "searchKey" => $request->searchKey, // Optional
            "insurance" => $request->insurance, // Optional
            "schDeparts" => [$request->schDeparts],
            "schReturns" => "",  // Optional
            "paxDetails" => $paxDetails
        ];

        $response = $this->client->post($this->apiEndPoint . '/Airline/Booking', $this->options(json_encode($data)))->getBody();
        $obj = json_decode($response);

        return $obj;
    }

    /**
     * Membuat data isssue
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function setIssued($request)
    {
        $data = [
            "userID" => $this->userID,
            "accessToken" => $this->getAccessToken(),
            "airlineID" => $request->airlineID,
            "origin" => $request->origin,
            "destination" => $request->destination,
            "tripType" => $request->tripType,
            "departDate" => $request->departDate,
            "returnDate" => $request->returnDate,
            "bookingCode" => $request->bookingCode,
            "bookingDate" => $request->bookingDate,
            "airlineAccessCode" => $request->airlineAccessCode
        ];

        $response = $this->client->post($this->apiEndPoint . '/Airline/Issued', $this->options(json_encode($data)))->getBody();
        $obj = json_decode($response);

        return $obj;
    }

    /**
     * Mendapatkan data Nomor Telepon
     *
     * @param String $nohp
     * @param integer $type
     * @return String
     */
    public function splitPhone($nohp, $type = 1)
    {
        $nohp = str_replace(" ", "", $nohp);
        $nohp = str_replace("(", "", $nohp);
        $nohp = str_replace(")", "", $nohp);
        $nohp = str_replace(".", "", $nohp);
        $nohp = str_replace("+", "", $nohp);

        $hp = '';
        if (!preg_match('/[^+0-9]/', trim($nohp))) {
            if (substr(trim($nohp), 0, 1) == '0') {
                if ($type == 1) {
                    $hp = '62';
                } elseif ($type == 2) {
                    $hp = substr(trim($nohp), 1, 3);
                } else {
                    $hp = substr(trim($nohp), 4);
                }
            } elseif (substr(trim($nohp), 0, 2) == '62') {
                if ($type == 1) {
                    $hp = '62';
                } elseif ($type == 2) {
                    $hp = substr(trim($nohp), 2, 3);
                } else {
                    $hp = substr(trim($nohp), 5);
                }
            }
        }

        return $hp;
    }
}

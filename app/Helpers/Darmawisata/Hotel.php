<?php

namespace App\Helpers\Darmawisata;

use GuzzleHttp\Client;

class Hotel
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
     * Show All Country
     *
     * @return \GuzzleHttp\Client
     */
    public function getCountry()
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken()
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Hotel/Country', $this->options($data))->getBody();
        $obj = json_decode($response);

        return $obj;
    }

    /**
     * Show All Passport
     *
     * @return \GuzzleHttp\Client
     */
    public function getPassport()
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken()
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Hotel/Passport', $this->options($data))->getBody();
        $obj = json_decode($response);

        return $obj;
    }

    /**
     * Show All City by CountryID
     *
     * @return \GuzzleHttp\Client
     */
    public function getCity($request)
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken(),
            'countryID' => $request->countryID,
            'cityNameFilter' => $request->filter
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Hotel/City', $this->options($data))->getBody();
        $obj = json_decode($response);

        return $obj;
    }

    /**
     * Show All Country All City
     *
     * @return \GuzzleHttp\Client
     */
    public function getAllCountryAllCity()
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken()
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Hotel/AllCountryAllCity', $this->options($data))->getBody();
        $obj = json_decode($response);

        return $obj;
    }

    /**
     * Show Search All Supplier
     *
     * @return \GuzzleHttp\Client
     */
    public function searchAllSupplier($request)
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken(),
            'paxPassport' => ($request->paxPassport) ? $request->paxPassport : $request->countryID,
            'countryID' => $request->countryID,
            'cityID' => $request->cityID,
            'checkInDate' => $request->checkInDate,
            'checkOutDate' => $request->checkOutDate,
            'roomRequest' => [
                [
                    'roomType' => $request->roomType,           // Single, Double, Twin, Triple, Quad
                    'isRequestChildBed' => $request->isRequestChildBed,  // true or false
                    'childNum' => $request->childNum,           // int
                    'childAges' => ($request->childAges) ? $request->childAges : [],         // Array
                ]
            ],
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Hotel/SearchAllSupplier', $this->options($data))->getBody();
        $obj = json_decode($response);

        return $obj;
    }

    /**
     * Show Search Available Rooms
     *
     * @return \GuzzleHttp\Client
     */
    public function searchAvailableRooms($request)
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken(),
            'paxPassport' => $request->paxPassport,
            'countryID' => $request->countryID,
            'cityID' => $request->cityID,
            'checkInDate' => $request->checkInDate,
            'checkOutDate' => $request->checkOutDate,
            'hotelID' => $request->hotelID,
            'breakfast' => $request->breakfast ?? 'RO',
            'roomRequest' => [
                [
                    'roomType' => $request->roomType,           // Single, Double, Twin, Triple, Quad
                    'isRequestChildBed' => $request->isRequestChildBed,  // true or false
                    'childNum' => $request->childNum,           // int
                    'childAges' => $request->childAges,         // Array
                ]
            ],
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Hotel/AvailableRooms', $this->options($data))->getBody();
        $obj = json_decode($response);

        return $obj;
    }

    /**
     * Get Hotel Images
     *
     * @return \GuzzleHttp\Client
     */
    public function getHotelImages($request)
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken(),
            'hotelID' => $request->hotelID,
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Hotel/Images', $this->options($data))->getBody();
        $obj = json_decode($response);

        return $obj;
    }

    /**
     * Get Hotel Price And Policy Info
     *
     * @return \GuzzleHttp\Client
     */
    public function getPriceAndPolicyInfo($request)
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken(),
            'paxPassport' => $request->paxPassport,
            'countryId' => $request->countryID,
            'cityId' => $request->cityID,
            'checkInDate' => $request->checkInDate,
            'checkOutDate' => $request->checkOutDate,
            'hotelID' =>  $request->hotelID,
            'internalCode' =>  $request->internalCode,
            'breakfast' =>  $request->breakfast,
            'roomID' =>  $request->roomID,
            'roomRequest' => [
                [
                    'roomType' => $request->roomType,
                    'isRequestChildBed' => $request->isRequestChildBed,
                    'childNum' => $request->childNum,
                    'childAges' => $request->childAges,
                ]
            ],
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Hotel/PriceAndPolicyInfo', $this->options($data))->getBody();
        $obj = json_decode($response);

        return $obj;
    }

    /**
     * Set Booking All Supplier Hotel
     *
     * @return \GuzzleHttp\Client
     */
    public function setBookingAllSupplier($request)
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken(),
            'paxPassport' => $request->paxPassport,
            'countryId' => $request->countryID,
            'cityId' => $request->cityID,
            'checkInDate' => $request->checkInDate,
            'checkOutDate' => $request->checkOutDate,
            'hotelID' =>  $request->hotelID,
            'internalCode' =>  $request->internalCode,
            'breakfast' =>  $request->breakfast,
            'roomID' =>  $request->roomID,
            'roomRequest' => [
                [
                    'roomType' => $request->roomType,
                    'isRequestChildBed' => $request->isRequestChildBed,
                    'childNum' => $request->childNum,
                    'childAges' => $request->childAges,
                    'paxes' =>  [
                        [
                            'title' => $request->paxTitle,
                            'firstName' => $request->paxFirstName,
                            'lastName' => $request->paxLastName,
                        ]
                    ],
                    'isSmokingRoom' => $request->smookingRoom,
                    'phone' => $request->phone,
                    'specialRequestArray' => [
                        [
                            'ID' => $request->specialRequestID,
                            'description' => $request->specialRequestDescription
                        ],
                    ],
                    'email' => $request->email,
                    'requestDescription' => $request->requestDescription,
                ]
            ],
            'bedType' => [
                'ID' => $request->bedTypeID,
                'bed' => $request->bedTypeBed,
            ],
            'agentOsRef' => $request->agentOsRef
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Hotel/BookingAllSupplier', $this->options($data))->getBody();
        $obj = json_decode($response);

        return $obj;
    }

    /**
     * Set Issued Hotel
     *
     * @return \GuzzleHttp\Client
     */
    public function setIssued($request)
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken(),
            'reservationNo' => $request->reservationNo
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Hotel/Issued', $this->options($data))->getBody();
        $obj = json_decode($response);

        return $obj;
    }

    /**
     * Get List Booking Hotel
     *
     * @return \GuzzleHttp\Client
     */
    public function getBookingList($request)
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken(),
            'filterDate' => $request->filter,
            'dateStart' => $request->start,
            'dateEnd' => $request->end,
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Hotel/BookingList', $this->options($data))->getBody();
        $obj = json_decode($response);

        return $obj;
    }

    /**
     * Get Hotel Booking Detail
     *
     * @return \GuzzleHttp\Client
     */
    public function getBookingDetail($request)
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken(),
            'reservationNo' => $request->reservationNo,
            'osRefNo' => $request->osRefNo,
            'agentOsRef' => $request->agentOsRef
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Hotel/BookingDetail', $this->options($data))->getBody();
        $obj = json_decode($response);

        return $obj;
    }

    /**
     * Get Hotel Detail Information
     *
     * @return \GuzzleHttp\Client
     */
    public function getDetailInfo($request)
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken(),
            'hotelID' => $request->hotelID
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Hotel/DetailInfo', $this->options($data))->getBody();
        $obj = json_decode($response);

        return $obj;
    }

    public function sessionLoginss()
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
}

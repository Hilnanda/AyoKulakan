<?php

namespace App\Helpers\Darmawisata;

use GuzzleHttp\Client;

class Bus
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
     * Session Logout
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
        return json_decode($response);
    }

    /**
     * Get Bus List
     *
     * @return \GuzzleHttp\Client
     */
    public function getBusList()
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken()
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Bus/List', $this->options($data))->getBody();
        return json_decode($response);
    }

    /**
     * Get Bus Routes
     *
     * @return \GuzzleHttp\Client
     */
    public function getBusRoute($request)
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken(),
            'bus' => $request->busName
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Bus/Route', $this->options($data))->getBody();
        return json_decode($response);
    }

    /**
     * Get Bus Schedule
     *
     * @return \GuzzleHttp\Client
     */
    public function getBusSchedule($request)
    {
        // Selain Pahala Kencana infant dan child harus 0
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken(),
            'bus' => $request->busName,
            'originTerminal' => $request->originTerminal,
            'destinationTerminal' => $request->destinationTerminal,
            'departDate' => $request->departDate,
            'paxAdult' => $request->adult,
            'paxChild' => $request->child,
            'paxInfant' => $request->infant,
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Bus/Schedule', $this->options($data))->getBody();
        return json_decode($response);
    }

    /**
     * Get Bus SeatMap
     *
     * @return \GuzzleHttp\Client
     */
    public function getBusSeatMap($request)
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken(),
            'bus' => $request->busName,
            'originTerminal' => $request->originTerminal,
            'destinationTerminal' => $request->destinationTerminal,
            'departDate' => $request->departDate,
            'paxAdult' => $request->adult,
            'paxChild' => $request->child,
            'paxInfant' => $request->infant,
            'directCode' => $request->directCode,
            'subClassFare' => $request->subClassFare,
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Bus/SeatMap', $this->options($data))->getBody();
        return json_decode($response);
    }

    /**
     * Set Bus Booking
     *
     * @return \GuzzleHttp\Client
     */
    public function setBusBooking($request)
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken(),
            'bus' => $request->busName,
            'originTerminal' => $request->originTerminal,
            'destinationTerminal' => $request->destinationTerminal,
            'choosedSeat' => $request->choosedSeat,
            'locationID' => $request->locationID,
            'departDate' => $request->departDate,
            'paxAdult' => $request->adult,
            'paxChild' => $request->child,
            'paxInfant' => $request->infant,
            'directCode' => $request->directCode,
            'subClassFare' => $request->subClassFare,
            'passengers' =>
            [
                [
                    'title' => $request->title,
                    'firstName' => $request->firstName,
                    'lastName' => $request->lastName,
                    'identity' => $request->identity,
                    'phone' => $request->phone,
                    'identityType' => $request->identityType,
                    'address' => $request->address,
                    'email' => $request->email,
                    'birthDate' => $request->birthDate,
                    'parent' => $request->parent,
                    'paxType' => $request->paxType
                ]
            ],
            'departID' => $request->departID,
            'arrivalID' => $request->arrivalID
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Bus/Booking', $this->options($data))->getBody();
        return json_decode($response);
    }

    /**
     * Set Bus Issued
     *
     * @return \GuzzleHttp\Client
     */
    public function setBusIssued($request)
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken(),
            'bookingCode' => $request->bookingCode,
            'bookingDate' => $request->bookingDate
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Bus/Issued', $this->options($data))->getBody();
        return json_decode($response);
    }

    /**
     * get Bus Booking List
     *
     * @return \GuzzleHttp\Client
     */
    public function getBusBookingList($request)
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken(),
            'filterBy' => $request->filter,
            'startDate' => $request->start,
            'endDate' => $request->end
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Bus/BookingList', $this->options($data))->getBody();
        return json_decode($response);
    }

    /**
     * get Bus Booking Detail
     *
     * @return \GuzzleHttp\Client
     */
    public function getBusBookingDetail($request)
    {
        $data = json_encode([
            'userID' => $this->userID,
            'accessToken' => $this->getAccessToken(),
            'bookingCode' => $request->bookingCode,
            'bookingDate' => $request->bookingDate
        ]);

        $response = $this->client->post($this->apiEndPoint . '/Bus/BookingDetail', $this->options($data))->getBody();
        return json_decode($response);
    }
}

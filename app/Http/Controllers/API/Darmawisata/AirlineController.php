<?php

namespace App\Http\Controllers\API\Darmawisata;

use App\Helpers\Darmawisata\Airline;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Darmawisata\Ticket\CityResource;
use App\Models\AirlineBooking;
use App\Models\Master\TicketingAirport;

class AirlineController extends Controller
{
    public function __construct()
    {
        $this->airline = new Airline();
    }

    /**
     * Mengambil list Airline
     *
     * @return Illuminate\Http\Response
     */
    public function getAirline()
    {
        return response()->json(['data' => $this->airline->getAirline()]);
    }

    /**
     * Menampilkan data Negara
     *
     * @return Illuminate\Http\Response
     */
    public function getAirlineNationality()
    {
        return response()->json(['data' => $this->airline->getAirlineNationality()]);
    }

    /**
     * Mengambil data Route penerbangan
     *
     * @return Illuminate\Http\Response
     */
    public function getAirlineRoute(Request $request)
    {
        return response()->json(['data' => $this->airline->getAirlineRoute($request)]);
    }

    /**
     * Mengambil data Route penerbangan
     *
     * @return Illuminate\Http\Response
     */
    public function getAirlineLowFareRoute()
    {
        return response()->json(['data' => $this->airline->getAirlineLowFareRoute()]);
    }

    /**
     * Mengambil jadwal seluruh Airline
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getScheduleAllAirline(Request $request)
    {
        return response()->json(['data' => $this->airline->getScheduleAllAirline($request)]);
    }

    /**
     * Mengambil data harga Airline
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getPriceAllAirline(Request $request)
    {
        return response()->json(['data' => $this->airline->getPriceAllAirline($request)]);
    }

    /**
     * Mengambil jadwal satu Airline
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getAirlineSchedule(Request $request)
    {
        return response()->json(['data' => $this->airline->getAirlineSchedule($request)]);
    }

    /**
     * Mendapatkan seluruh data Bandara
     *
     * @return App\Http\Resources\Darmawisata\Ticket\CityResource
     */
    public function getCities($resource = false)
    {
        $cities = TicketingAirport::get();

        if ($resource) {
            return CityResource::collection($cities);
        }

        return $cities;
    }

    /**
     * Mendapatkan data Bagasi dan Makanan
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getBaggageAndMeal(Request $request)
    {
        return response()->json(['data' => $this->airline->getBaggageAndMeal($request)]);
    }

    /**
     * Mendapatkan data Kursi
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getSeat(Request $request)
    {
        return response()->json(['data' => $this->airline->getSeat($request)]);
    }

    /**
     * Mendapatkan data Harga Detail Airline
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getPriceAirline(Request $request)
    {
        return response()->json(['data' => $this->airline->getPriceAirline($request)]);
    }

    /**
     * Mendapatkan data Booking List
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getBookingList(Request $request)
    {
        return response()->json(['data' => $this->airline->getBookingList($request)]);
    }

    /**
     * Mendapatkan data Booking List
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getBookingDetail(Request $request)
    {
        return response()->json(['data' => $this->airline->getBookingDetail($request)]);
    }

    /**
     * Input data booking
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function setBooking(Request $request)
    {
        return response()->json(['data' => $this->airline->setBooking($request)]);
    }

    /**
     * Input data Issued
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function setIssued(Request $request)
    {
        return response()->json(['data' => $this->airline->setIssued($request)]);
    }
    //-------------------- End Api Airline -----------------------------------
}

<?php

namespace App\Http\Controllers\API\Darmawisata;

use Illuminate\Http\Request;
use App\Helpers\Darmawisata\Hotel;
use App\Http\Controllers\Controller;

class HotelController extends Controller
{
    /**
     * Constructor method
     */
    public function __construct()
    {
        $this->hotel = new Hotel();
    }

    /**
     * Mengambil list Country
     *
     * @return Illuminate\Http\Response
     */
    public function getCountry()
    {
        return response()->json(['data' => $this->hotel->getCountry()]);
    }

    /**
     * Mengambil list Passport
     *
     * @return Illuminate\Http\Response
     */
    public function getPassport()
    {
        return response()->json(['data' => $this->hotel->getPassport()]);
    }

    /**
     * Mengambil list City
     *
     * @return Illuminate\Http\Response
     */
    public function getCity(Request $request)
    {
        if (count($request->all()) > 0) {
            return response()->json(['data' => $this->hotel->getCity($request)]);
        }

        return $this->getAllCountryAllCity();
    }

    /**
     * Mengambil list All Country All City
     *
     * @return Illuminate\Http\Response
     */
    public function getAllCountryAllCity()
    {
        return response()->json(['data' => $this->hotel->getAllCountryAllCity()]);
    }

    /**
     * search All Supplier
     *
     * @return Illuminate\Http\Response
     */
    public function searchAllSupplier(Request $request)
    {
        return response()->json(['data' => $this->hotel->searchAllSupplier($request)]);
    }

    /**
     * Mengambil Available Rooms
     *
     * @return Illuminate\Http\Response
     */
    public function searchAvailableRooms(Request $request)
    {
        return response()->json(['data' => $this->hotel->searchAvailableRooms($request)]);
    }

    /**
     * Mengambil data Images hotels
     *
     * @return Illuminate\Http\Response
     */
    public function getHotelImages(Request $request)
    {
        return response()->json(['data' => $this->hotel->getHotelImages($request)]);
    }

    /**
     * Mengambil Get Hotel Price And Policy Info
     *
     * @return Illuminate\Http\Response
     */
    public function getPriceAndPolicyInfo(Request $request)
    {
        return response()->json(['data' => $this->hotel->getPriceAndPolicyInfo($request)]);
    }

    /**
     * Set Booking All Supplier Hotel
     *
     * @return Illuminate\Http\Response
     */
    public function setBookingAllSupplier(Request $request)
    {
        return response()->json(['data' => $this->hotel->setBookingAllSupplier($request)]);
    }

    /**
     * Set Issued Hotel
     *
     * @return Illuminate\Http\Response
     */
    public function setIssued(Request $request)
    {
        return response()->json(['data' => $this->hotel->setIssued($request)]);
    }

    /**
     * Get Booking List Hotel
     *
     * @return Illuminate\Http\Response
     */
    public function getBookingList(Request $request)
    {
        return response()->json(['data' => $this->hotel->getBookingList($request)]);
    }

    /**
     * Get Booking List Hotel
     *
     * @return Illuminate\Http\Response
     */
    public function getBookingDetail(Request $request)
    {
        return response()->json(['data' => $this->hotel->getBookingDetail($request)]);
    }

    /**
     * Get Hotel Detail Information
     *
     * @return Illuminate\Http\Response
     */
    public function getDetailInfo(Request $request)
    {
        return response()->json(['data' => $this->hotel->getDetailInfo($request)]);
    }
    //-------------------- End Api Hotel -----------------------------------
}

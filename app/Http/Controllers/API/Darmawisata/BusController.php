<?php

namespace App\Http\Controllers\API\Darmawisata;

use Illuminate\Http\Request;
use App\Helpers\Darmawisata\Bus;
use App\Http\Controllers\Controller;

class BusController extends Controller
{
    /**
     * Constructor method
     */
    public function __construct()
    {
        $this->bus = new Bus();
    }

    /**
     * Get Bus List
     *
     * @return Illuminate\Http\Response
     */
    public function getBusList()
    {
        return response()->json(['data' => $this->bus->getBusList()]);
    }

    /**
     * Get Bus Route
     *
     * @return Illuminate\Http\Response
     */
    public function getBusRoute(Request $request)
    {
        return response()->json(['data' => $this->bus->getBusRoute($request)]);
    }

    /**
     * Get Bus Schedules
     *
     * @return Illuminate\Http\Response
     */
    public function getBusSchedule(Request $request)
    {
        return response()->json(['data' => $this->bus->getBusSchedule($request)]);
    }

    /**
     * Get Bus Schedules
     *
     * @return Illuminate\Http\Response
     */
    public function getBusSeatMap(Request $request)
    {
        return response()->json(['data' => $this->bus->getBusSeatMap($request)]);
    }

    /**
     * set Bus Booking
     *
     * @return Illuminate\Http\Response
     */
    public function setBusBooking(Request $request)
    {
        return response()->json(['data' => $this->bus->setBusBooking($request)]);
    }

    /**
     * set Bus Issued
     *
     * @return Illuminate\Http\Response
     */
    public function setBusIssued(Request $request)
    {
        return response()->json(['data' => $this->bus->setBusIssued($request)]);
    }

    /**
     * get Bus Booking List
     *
     * @return Illuminate\Http\Response
     */
    public function getBusBookingList(Request $request)
    {
        return response()->json(['data' => $this->bus->getBusBookingList($request)]);
    }

    /**
     * get Bus Booking List
     *
     * @return Illuminate\Http\Response
     */
    public function getBusBookingDetail(Request $request)
    {
        return response()->json(['data' => $this->bus->getBusBookingDetail($request)]);
    }
}

<?php

namespace App\Http\Controllers\FrontEnd\Darmawisata;

use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Models\Airline;
use Illuminate\Http\Request;
use App\Models\AirlineBooking;
use Illuminate\Support\Facades\DB;
use App\Helpers\Darmawisata\Airline as AirlineDarmawisata;
use App\Http\Controllers\Controller;
use App\Http\Resources\AirlineBookingResource;
use App\Models\Master\TicketingAirport;

class AirlineController extends Controller
{
    public function __construct()
    {
        $this->client = new Client();
        $this->airline = new AirlineDarmawisata();
    }

    /**
     * Menampilkan halaman form pencarian
     *
     * @return Illuminate\Http\Response
     */
    public function showAirlineForm()
    {
        $cities = TicketingAirport::get();
        return $this->render('frontend.tickets.airline.index', compact('cities'));
    }

    /**
     * Menampilkan jadwal penerbangan
     *
     * @param Illuminate\Http\Request $request
     * @return Illumintae\Http\Response
     */
    public function showAirlineSchedule(Request $request)
    {
        if (!$request->tripType) {
            $request['tripType'] = 'OneWay';
        }

        if (!$request->promoCode) {
            $request['promoCode'] = '';
        }

        if (!$request->returnDate) {
            $request['returnDate'] = '';
        }

        if (!$request->airlineAccessCode) {
            $request['airlineAccessCode'] = '';
        }

        $schedules = $this->airline->getScheduleAllAirline($request->all());

        $departs = $schedules->journeyDepart;
        $returns = $schedules->journeyReturn;

        return $this->render('frontend.tickets.airline.schedule', compact('request', 'schedules', 'departs', 'returns'));
    }

    /**
     * Menampilkan halaman form pencarian
     *
     * @return Illuminate\Http\Response
     */
    public function showAirlineCart(Request $request, $cart)
    {
        $cityOrigin = TicketingAirport::where('airport_code', $request->origin)->first();
        $cityDestination = TicketingAirport::where('airport_code', $request->destination)->first();

        $request['accessToken'] = $accessToken = $cart;

        $prices = $this->airline->getPriceAllAirline($request);

        $request['schDepart'] = $request->journeyDepartReference;

        $addonsBags = $this->airline->getBaggageAndMeal($request)->addOns;

        $baggages = [];
        $meals = [];
        if (!is_null($addonsBags)) {
            $baggages = array_values(array_sort($addonsBags[0]->baggageInfos, function ($value) {
                return $value->fare;
            }));

            $meals = array_values(array_sort($addonsBags[0]->mealInfos, function ($value) {
                return $value->fare;
            }));
        }

        $addonsSeats = $this->airline->getSeat($request)->seatAddOns;

        $seats = [];
        if (!is_null($addonsSeats)) {
            $seats = array_values(array_sort($addonsSeats[0]->infos, function ($value) {
                return $value->seatPrice;
            }));
        }

        $response = $this->client->get('http://www.geoplugin.net/json.gp')->getBody();
        $visitor = json_decode($response);

        return $this->render(
            'frontend.tickets.airline.cart',
            compact(
                'cityOrigin',
                'cityDestination',
                'request',
                'accessToken',
                'prices',
                'baggages',
                'meals',
                'seats',
                'visitor'
            )
        );
    }

    /**
     * Menampilkan data hasil Booking
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function setAirlineBooking(Request $request)
    {
        $airline = Airline::where('code', $request->airlineID)->first();
        $booking = $this->airline->setBooking($request);

        AirlineBooking::create([
            'user_id' => auth()->user()->id,
            'airline' => $airline->name,
            'airlineID' => $airline->code,
            'bookingCode' => $booking->bookingCode,
            'bookingDate' => $booking->bookingDate,
            'bookingStatus' => 'HOLD',
        ]);

        return $this->render('frontend.tickets.airline.booking', compact('booking'));
    }

    /**
     * Menampilkan data hasil Booking
     *
     * @return Illuminate\Http\Response
     */
    public function showFormAirlineBookingList()
    {
        return $this->render('frontend.tickets.airline.booking-list');
    }

    /**
     * Mendapatkan data Booking List
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getBookingList(Request $request)
    {
        if (is_null($request->start)) {
            $request['start'] = date('Y-m-d');
        }

        if (is_null($request->end)) {
            $request['end'] = date('Y-m-d');
        }

        $booking = AirlineBooking::where('user_id', auth()->user()->id)
            ->whereBetween('bookingDate', [$request->start, $request->end])->get();

        return response()->json([
            'data' => [
                'bookingInfos' => $booking
            ]
        ]);
    }

    /**
     * Mengubah data status booking di local
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function setIssued(Request $request)
    {
        AirlineBooking::updateOrCreate(
            ['bookingCode' => $request->bookingCode],
            ['bookingStatus' => $request->bookingStatus],
        );

        return response()->json([
            'success' => true,
            'message' => 'success'
        ]);
    }
}

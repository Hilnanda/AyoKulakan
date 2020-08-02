<?php

namespace App\Http\Controllers\Api\Map;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class MapController extends Controller
{
    protected string $apiKey = 'AIzaSyC01hCsQ46I133UAz8pdjjRXlZ-o5DT1pY';
    protected int $radius = 1000;

    public function __invoke(Request $request)
    {
        $client = new Client();

        if (!is_null($request->type)) {
            $type = '&type=' . $request->type;
        }

        $response = $client->get('https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=' . $request->lat . ', ' . $request->lng . '&radius=' . $this->radius . $type . '&language=id&region=ID&key=' . $this->apiKey);
        return $response->getBody();
    }
}

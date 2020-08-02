<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class AirlineBookingResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "bookingInfos" => [
                [
                    "airline" => $this->airline->name,
                    "airlineID" => $this->airline->code,
                    "bookingCode" => $this->bookingCode,
                    "bookingDate" => $this->bookingDate
                ]
            ]
        ];
    }
}

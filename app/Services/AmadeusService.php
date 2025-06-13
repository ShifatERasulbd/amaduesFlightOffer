<?php

namespace App\Services;

use Amadeus\Amadeus;

class AmadeusService
{
    protected $amadeus;

    public function __construct()
    {
        $this->amadeus = Amadeus::builder(
            config('services.amadeus.client_id'),
            config('services.amadeus.client_secret')
        )->build();
    }

      public function searchFlights($params)
    {
        $response = $this->amadeus->getShopping()->getFlightOffers()->get([
            'originLocationCode' => $params['origin'],
            'destinationLocationCode' => $params['destination'],
            'departureDate' => $params['date'],
            'adults' => $params['adults'],
            'nonStop' => 'false',
            'max' => '10',
        ]);

        return $response;  // return array directly
    }

}

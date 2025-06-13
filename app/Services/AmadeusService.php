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
        $response = $amadeus->getShopping()->getFlightOffers()->get([
            'originLocationCode' => 'DAC', // example: Dhaka
            'destinationLocationCode' => 'DXB', // example: Dubai
            'departureDate' => '2025-06-20',
            'adults' => 1,
            'nonStop' => 'false',
            'max' => 250 // MAXIMUM allowed
        ]);

            return $response;  // return array directly
        }

}

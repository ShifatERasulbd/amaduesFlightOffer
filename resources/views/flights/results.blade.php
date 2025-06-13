@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Available Flights</h2>

    @if(isset($offers) && count($offers) > 0)
        <ul>
            @foreach ($offers as $offer)
                @php
                    $price = $offer->getPrice();

                    $carrierCodes = [];
                    foreach ($offer->getItineraries() as $itinerary) {
                        foreach ($itinerary->getSegments() as $segment) {
                            $carrierCodes[] = $segment->getCarrierCode();
                        }
                    }

                    $carrierCodes = array_unique($carrierCodes);
                    $firstCarrierCode = $carrierCodes[0] ?? 'N/A';

                    // Use the airlineNames array passed from the controller
                    $carrierName = $airlineNames[$firstCarrierCode] ?? 'Unknown Airline';
                @endphp

                <li>
                    <strong>Price:</strong> {{ $price->getTotal() }} {{ $price->getCurrency() }} <br>
                    <strong>Carrier Code:</strong> {{ $firstCarrierCode }} <br>
                    <strong>Airline Name:</strong> {{ $carrierName }}
                </li>
            @endforeach
        </ul>
    @else
        <p>No flights found for your search criteria.</p>
    @endif
</div>
@endsection

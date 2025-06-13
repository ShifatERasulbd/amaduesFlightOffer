@extends('layouts.app')

@section('title', 'Final Price Confirmation')

@section('content')
<div class="container mt-4">
    <h2>Confirmed Flight Price</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Final Price:</strong> {{ $offer['price']['total'] }} {{ $offer['price']['currency'] }}</p>

            @foreach ($offer['itineraries'] as $itinIndex => $itinerary)
                <h5 class="mt-3">Itinerary {{ $itinIndex + 1 }}</h5>
                @foreach ($itinerary['segments'] as $segment)
                    <div class="border rounded p-2 mb-2 bg-light">
                        <strong>From:</strong> {{ $segment['departure']['iataCode'] }} ({{ $segment['departure']['at'] }})<br>
                        <strong>To:</strong> {{ $segment['arrival']['iataCode'] }} ({{ $segment['arrival']['at'] }})<br>
                        <strong>Carrier:</strong> {{ $segment['carrierCode'] }} {{ $segment['number'] }}<br>
                        <strong>Duration:</strong> {{ $segment['duration'] }}
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
</div>
@endsection

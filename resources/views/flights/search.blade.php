@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Search Flights</h2>

    @if($errors->has('api_error'))
        <div class="alert alert-danger">{{ $errors->first('api_error') }}</div>
    @endif

    <form method="POST" action="{{ route('flights.search') }}">
        @csrf
        <div class="form-group">
            <label>Origin Airport (IATA code)</label>
            <input type="text" name="origin" class="form-control" placeholder="e.g. DAC" value="{{ old('origin') }}" required>
        </div>

        <div class="form-group">
            <label>Destination Airport (IATA code)</label>
            <input type="text" name="destination" class="form-control" placeholder="e.g. DXB" value="{{ old('destination') }}" required>
        </div>

        <div class="form-group">
            <label>Departure Date</label>
            <input type="date" name="date" class="form-control" value="{{ old('date') }}" required>
        </div>

        <div class="form-group">
            <label>Adults</label>
            <input type="number" name="adults" class="form-control" value="{{ old('adults', 1) }}" min="1" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Search</button>
    </form>

    @if(isset($offers) && isset($offers['data']))
        <h4 class="mt-5">Flight Results</h4>
        <ul class="list-group">
            @foreach($offers['data'] as $offer)
                <li class="list-group-item">
                    <strong>From:</strong> {{ $offer['itineraries'][0]['segments'][0]['departure']['iataCode'] }}
                    →
                    <strong>To:</strong> {{ $offer['itineraries'][0]['segments'][0]['arrival']['iataCode'] }} <br>
                    <strong>Price:</strong> {{ $offer['price']['total'] }} {{ $offer['price']['currency'] }} <br>
                    <strong>Airline:</strong>
                    {{ $offer['itineraries'][0]['segments'][0]['carrierCode'] }} <br>
                    <strong>Departure:</strong> {{ $offer['itineraries'][0]['segments'][0]['departure']['at'] }}
                </li>
            @endforeach
        </ul>
    @elseif(isset($offers))
        <div class="alert alert-warning mt-5">No flight results found.</div>
    @endif
</div>
@endsection

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AmadeusService;

class FlightController extends Controller
{
    protected $amadeus;

    public function __construct(AmadeusService $amadeus)
    {
        $this->amadeus = $amadeus;
    }

   public function search(Request $request)
    {
        $validated = $request->validate([
            'origin' => 'required|string|size:3',
            'destination' => 'required|string|size:3',
            'date' => 'required|date',
            'adults' => 'required|integer|min:1',
        ]);

        try {
            $offers = $this->amadeus->searchFlights($validated); // already an array
            return view('flights.search', compact('offers'));

        } catch (\Exception $e) {
            return back()->withErrors(['api_error' => $e->getMessage()]);
        }
    }
    public function showForm()
    {
        return view('flights.search');
    }
    
}

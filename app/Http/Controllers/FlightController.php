<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Amadeus\Amadeus;

class FlightController extends Controller
{
    protected $amadeus;

    public function __construct()
    {
        $this->amadeus = Amadeus::builder("crYIQNGrtpAfrdJjhEMAanIYFhOSTmqJ", "lPnq8NlxA5VKzRaG")->build();
    }

   public function search(Request $request)
{
    $validated = $request->validate([
        'origin' => 'required|string|size:3',
        'destination' => 'required|string|size:3',
        'date' => 'required|date',
        'adults' => 'required|integer|min:1',
    ]);

    // ✅ Step 1: Build the params
    $params = [
        'originLocationCode'      => $validated['origin'],
        'destinationLocationCode' => $validated['destination'],
        'departureDate'           => $validated['date'],
        'adults'                  => $validated['adults'],
        'max'                     => 50,
    ];

$airlineNames = [
    'AI' => 'American Airlines',
    'DL' => 'Delta Air Lines',
    'UA' => 'United Airlines',
    'BA' => 'British Airways',
    'LH' => 'Lufthansa',
    'AF' => 'Air France',
    // add other airline codes as you want
];
    

    // ✅ Step 2: Debug what's being sent to Amadeus
    // dd($params);

    // ✅ Step 3: Make the actual API call (this will run after you remove dd)
    $offers = $this->amadeus->getShopping()->getFlightOffers()->get($params);
// dd($offers);
    return view('flights.results', compact('offers','airlineNames'));
}

     public function showForm()
    {
        return view('flights.search');
    }

    public function confirm(Request $request)
    {
        $validated = $request->validate([
            'offer' => 'required|array'
        ]);

        // Confirm the actual price
        $confirmed = $this->amadeus->getShopping()
            ->getFlightOffers()
            ->getPricing()
            ->post(['data' => $validated['offer']])
            ->getResult();

        return view('flights.confirm', [
            'offer' => $confirmed['data']
        ]);
    }
}

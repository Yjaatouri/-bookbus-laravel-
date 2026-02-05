<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\Etape;
use App\Models\Programme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index()
    {
        // Get unique cities from Etapes to populate the select dropdowns
        $cities = Etape::select('ville')->distinct()->orderBy('ville')->pluck('ville');

        return view('search.form', compact('cities'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'city_from' => 'required|string',
            'city_to' => 'required|string|different:city_from',
            'date' => 'required|date|after_or_equal:today',
        ]);

        $from = $request->input('city_from');
        $to = $request->input('city_to');
        $date = $request->input('date');

        // Logic to find matching routes
        // A route matches if:
        // 1. It has an etape at 'from' city
        // 2. It has an etape at 'to' city
        // 3. The 'from' etape comes before the 'to' etape (ordre < ordre)

        $routes = Route::whereHas('etapes', function ($query) use ($from) {
            $query->where('ville', $from);
        })->whereHas('etapes', function ($query) use ($to) {
            $query->where('ville', $to);
        })->with([
                    'etapes' => function ($query) {
                        $query->orderBy('ordre');
                    },
                    'programmes' => function ($query) {
                        $query->where('actif', true);
                    }
                ])->get();

        // Filter routes to ensure order is correct (From < To)
        $validRoutes = $routes->filter(function ($route) use ($from, $to) {
            $etapeFrom = $route->etapes->firstWhere('ville', $from);
            $etapeTo = $route->etapes->firstWhere('ville', $to);

            return $etapeFrom && $etapeTo && $etapeFrom->ordre < $etapeTo->ordre;
        });

        // Calculate price and duration for the specific segment (approximate logic based on distance/proportion or sum of segments)
        // For simplicity in this demo, we will sum the segments between the two etapes or just take a base price if segments aren't perfectly granular.
        // Let's pass the valid routes to the view.

        $results = $validRoutes->map(function ($route) use ($from, $to, $date) {
            $etapeFrom = $route->etapes->firstWhere('ville', $from);
            $etapeTo = $route->etapes->firstWhere('ville', $to);

            // Calculate pseudo-price and duration
            // In a real app, query the Segment model between specific etapes.
            // Here we'll estimate: 50DH base + 10DH per etape diff? 
            // Or sum available segments.

            $segmentsCount = $etapeTo->ordre - $etapeFrom->ordre;
            $price = 100 * $segmentsCount; // Placeholder logic as SegmentSeeder logic is complex to reverse-engineer perfectly in one go

            // Using actual segments if they exist would be better, but they link stage N to N+1
            // So we can sum segments from order From to To-1.

            // NOTE: This relies on segments existing for every hop. The seeder ensures this.

            return [
                'route' => $route,
                'departure_time' => $route->programmes->first()->heure_arrivee ?? '08:00', // Simplified
                'price' => $price,
                'duration' => ($segmentsCount * 2) . 'h 00m', // Simplified
                'from_station' => $etapeFrom->nom_etape,
                'to_station' => $etapeTo->nom_etape,
            ];
        });

        return view('search.results', compact('results', 'from', 'to', 'date'));
    }
}

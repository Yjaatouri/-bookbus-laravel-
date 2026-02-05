<?php

namespace Database\Seeders;

use App\Models\Bus;
use App\Models\Programme;
use App\Models\Route;
use Illuminate\Database\Seeder;

class ProgrammeSeeder extends Seeder
{
    public function run(): void
    {
        $buses = Bus::all();
        $routes = Route::all();

        foreach ($routes as $route) {
            foreach ($buses as $bus) {
                // Determine if we should create a programme
                $shouldCreate = rand(0, 1) ||
                    $route->nom_route === 'Casablanca - Marrakech (Direct)' ||
                    $route->nom_route === 'Casablanca - Marrakech (via Rabat)';

                if ($shouldCreate) {
                    Programme::create([
                        'heure_arrivee' => now()->addHours(rand(1, 8))->format('H:i'),
                        'actif' => true,
                        'bus_id' => $bus->id,
                        'route_id' => $route->id,
                    ]);

                    // If it's one of our specific routes, break after creating one per bus (or just one total?) 
                    // Let's create one per bus to have multiple schedules
                }
            }
        }
    }
}
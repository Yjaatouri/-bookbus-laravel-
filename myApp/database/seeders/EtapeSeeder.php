<?php

namespace Database\Seeders;

use App\Models\Etape;
use App\Models\Route;
use Illuminate\Database\Seeder;

class EtapeSeeder extends Seeder
{
    public function run(): void
    {
        $routes = Route::all();

        foreach ($routes as $route) {
            if ($route->nom_route === 'Casablanca - Marrakech (Direct)') {
                $this->createEtape($route, 1, 'Casablanca', 'Gare Routière Casablanca');
                $this->createEtape($route, 2, 'Marrakech', 'Gare Routière Marrakech');
            } elseif ($route->nom_route === 'Casablanca - Marrakech (via Rabat)') {
                $this->createEtape($route, 1, 'Casablanca', 'Gare Routière Casablanca');
                $this->createEtape($route, 2, 'Rabat', 'Gare Routière Rabat');
                $this->createEtape($route, 3, 'Marrakech', 'Gare Routière Marrakech');
            } else {
                // Créer 3-5 étapes pour chaque autre route
                $nombreEtapes = rand(3, 5);

                for ($i = 1; $i <= $nombreEtapes; $i++) {
                    Etape::create([
                        'nom_etape' => 'Etape ' . $i . ' - ' . $route->ville_depart,
                        'adresse' => 'Adresse ' . $i . ', ' . $route->ville_depart,
                        'ville' => $route->ville_depart,
                        'heure_passage' => now()->addHours($i)->format('H:i'),
                        'ordre' => $i,
                        'route_id' => $route->id,
                    ]);
                }
            }
        }
    }

    private function createEtape($route, $ordre, $ville, $nom)
    {
        Etape::firstOrCreate(
            [
                'route_id' => $route->id,
                'ordre' => $ordre,
            ],
            [
                'nom_etape' => $nom,
                'adresse' => 'Adresse à ' . $ville,
                'ville' => $ville,
                'heure_passage' => now()->addHours($ordre)->format('H:i'),
            ]
        );
    }
}
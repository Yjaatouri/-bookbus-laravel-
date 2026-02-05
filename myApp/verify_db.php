
use App\Models\Route;
use App\Models\Etape;
use App\Models\Programme;

echo "Verifying Database Content...\n";

// 1. Verify Cities
$cities = ['Casablanca', 'Marrakech', 'Rabat'];
foreach ($cities as $city) {
    $exists = Etape::where('ville', $city)->exists();
    echo "City $city exists: " . ($exists ? 'YES' : 'NO') . "\n";
}

// 2. Verify Routes
$routesToCheck = [
    'Casablanca - Marrakech (Direct)' => 2,
    'Casablanca - Marrakech (via Rabat)' => 3
];

foreach ($routesToCheck as $nom => $expectedEtapes) {
    $route = Route::where('nom_route', $nom)->first();
    if ($route) {
        echo "Route '$nom' exists: YES\n";
        $count = $route->etapes()->count();
        echo "  - Etapes count: $count (Expected: $expectedEtapes) - " . ($count == $expectedEtapes ? 'OK' : 'FAIL') . "\n";
        
        $programmesCount = $route->programmes()->where('actif', true)->count();
        echo "  - Active Programmes: $programmesCount (Expected: >0) - " . ($programmesCount > 0 ? 'OK' : 'FAIL') . "\n";
    } else {
        echo "Route '$nom' exists: NO\n";
    }
}
exit();

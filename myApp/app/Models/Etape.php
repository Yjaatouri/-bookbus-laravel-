<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etape extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_etape',
        'adresse',
        'ville',
        'heure_passage',
        'ordre',
        'route_id',
    ];

    public function route()
    {
        return $this->belongsTo(Route::class);
    }
}

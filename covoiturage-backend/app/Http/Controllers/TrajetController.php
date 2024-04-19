<?php

namespace App\Http\Controllers;
use App\Models\Trajet;
use Illuminate\Http\Request;

class TrajetController extends Controller
{
    public function getAllTrajets()
    {
        // Récupérer tous les trajets à partir du modèle Trajet
        $trajets = Trajet::all();
        
        // Retourner les trajets en tant que réponse JSON
        return response()->json($trajets);
    }
}

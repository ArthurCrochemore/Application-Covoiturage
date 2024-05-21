<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adresse;
use Illuminate\Http\Response;

class AdresseController extends Controller
{
    public function GetAllBaseAerienne()
    {
        try {
            // Récupérer toutes les adresses  Base_Aerienne 
            $adresses = Adresse::where('Est_Base_Aerienne', true)->get(['Id_Adresse', 'Intitule']);

            
            return response()->json($adresses, 200);
        } catch (\Exception $e) {
            
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }

    public function GetAllDomicile()
    {
        try {
            // Récupérer toutes les adresses  Base_Aerienne 
            $adresses = Adresse::where('Est_Base_Aerienne', false)->get(['Id_Adresse', 'Intitule']);

            
            return response()->json($adresses, 200);
        } catch (\Exception $e) {
            
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }
}

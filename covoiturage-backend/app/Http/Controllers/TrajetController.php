<?php

namespace App\Http\Controllers;
use App\Models\Trajet;
use App\Models\Adresse;
use App\Models\Jours;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;



class TrajetController extends Controller
{
    public function getAllTrajets()
{
    try {
        // Recuperer tous les trajets avec les relations nécessaires
        $trajets = Trajet::with(['domicile', 'base', 'utilisateur'])->get();

        
        $result = $trajets->map(function ($trajet) {
            
            $domicile = $trajet->domicile;
            $base = $trajet->base;

            $ptDepart = null;
            $ptArrive = null;

            if ($domicile && $base) {
                // Determiner les de dpt et d'arrivee  en fonction de Domicile_Base
                if ($trajet->Domicile_Base) {
                    $ptDepart = $domicile->Intitule;
                    $ptArrive = $base->Intitule;
                } else {
                    $ptDepart = $base->Intitule;
                    $ptArrive = $domicile->Intitule;
                }
            }

            
            $utilisateur = $trajet->utilisateur;

            return [
                'ptDepart' => $ptDepart,
                'ptArrive' => $ptArrive,
                'heureDepart' => $trajet->Heure_Depart,
                'Date_Depart' => $trajet->Date_Depart,
                'nomConducteur' => $utilisateur ? $utilisateur->Nom : null,
                'uniteConducteur' => $utilisateur ? $utilisateur->Unite : null,
            ];
        });

        return response()->json($result, 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
    }
}

public function getTrajet($id)
{
    try {
        // Recuperer le trajet 
        $trajet = Trajet::with(['domicile', 'base', 'utilisateur'])->find($id);

        if ($trajet) {
            // Recuperer les objets Adresse pour Id_Domicile et Id_Base
            $domicile = $trajet->domicile;
            $base = $trajet->base;

            $ptDepart = null;
            $ptArrive = null;

            if ($domicile && $base) {
                // Determiner les de dpt et d'arrivee  en fonction de Domicile_Base
                if ($trajet->Domicile_Base) {
                    $ptDepart = $domicile->Intitule;
                    $ptArrive = $base->Intitule;
                } else {
                    $ptDepart = $base->Intitule;
                    $ptArrive = $domicile->Intitule;
                }
            }

            //Recuperer l'utilisateur
            $utilisateur = $trajet->utilisateur;

            $result = [
                'ptDepart' => $ptDepart,
                'ptArrive' => $ptArrive,
                'heureDepart' => $trajet->Heure_Depart,
                'Date_Depart' => $trajet->Date_Depart,
                'nomConducteur' => $utilisateur ? $utilisateur->Nom : null,
                'uniteConducteur' => $utilisateur ? $utilisateur->Unite : null
            ];

            return response()->json($result, 200);
        } else {
            return response()->json(['message' => 'Trajet non trouve'], Response::HTTP_NOT_FOUND);
        }
    } catch (\Exception $e) {
        return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
    }
}


   

    public function updateTrajet(Request $request, $id)
    {
        try {
            // Assurer que les données sont valides
            $validatedData = $request->validate([
                'Date_Depart' => 'required|date',
                'Heure_Depart' => 'required|date_format:H:i',
                'Nbre_Places' => 'required|integer',
                'Qte_Bagages' => 'required|integer',
                'Description' => 'nullable|string|max:300',
                'Trajet_Regulier' => 'required|boolean',
                'Statut' => 'required|boolean',
                'Domicile_Base' => 'required|boolean',
                'Id_Domicile' => 'required|exists:Adresse,Id_Adresse',
                'Id_Base' => 'required|exists:Adresse,Id_Adresse',
                'Id_Jours' => 'nullable|array|size:7',
                'Id_Jours.*' => 'required|boolean',
                'Id_Conducteur' => 'required|exists:Utilisateur,Id_Utilisateur',
            ]);
    
            
            $trajet = Trajet::find($id);
    
            // Dans le cas où le trajet n'est pas trouvé
            if (!$trajet) {
                return response()->json(['message' => 'Trajet not found'], 404);
            }
    
            // Recuperer l'ID du jour associé au trajet
            $idJour = $trajet->Id_Jours;
    
            
            $jours = Jours::find($idJour);
    
            // Mise a jour du jour
            if ($jours && !is_null($validatedData['Id_Jours'])) {
                $jours->update([
                    'Lundi' => $validatedData['Id_Jours'][0],
                    'Mardi' => $validatedData['Id_Jours'][1],
                    'Mercredi' => $validatedData['Id_Jours'][2],
                    'Jeudi' => $validatedData['Id_Jours'][3],
                    'Vendredi' => $validatedData['Id_Jours'][4],
                    'Samedi' => $validatedData['Id_Jours'][5],
                    'Dimanche' => $validatedData['Id_Jours'][6],
                ]);
    
                
                $validatedData['Id_Jours'] = $jours->Id_Jours;
            }
    
            
            $trajet->update($validatedData);
    
           
            return response()->json(['message' => 'Trajet updated successfully'], 200);
        } catch (\Exception $e) {
            
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }
    


    public function createTrajet(Request $request)
    {
        try {
            // Assurer que les donnes sont valide 
            $validatedData = $request->validate([
                'Date_Depart' => 'required|date',
                'Heure_Depart' => 'required|date_format:H:i',
                'Nbre_Places' => 'required|integer',
                'Qte_Bagages' => 'required|integer',
                'Description' => 'nullable|string|max:300',
                'Trajet_Regulier' => 'required|boolean',
                'Statut' => 'required|boolean',
                'Domicile_Base' => 'required|boolean',
                'Id_Domicile' => 'required|exists:Adresse,Id_Adresse',
                'Id_Base' => 'required|exists:Adresse,Id_Adresse',
                'Id_Jours' => 'required|array|size:7',
                'Id_Jours.*' => 'required|boolean',
                'Id_Conducteur' => 'required|exists:Utilisateur,Id_Utilisateur',
            ]);
    
            // Cree un Jour
            $joursData = [
                'Lundi' => $validatedData['Id_Jours'][0],
                'Mardi' => $validatedData['Id_Jours'][1],
                'Mercredi' => $validatedData['Id_Jours'][2],
                'Jeudi' => $validatedData['Id_Jours'][3],
                'Vendredi' => $validatedData['Id_Jours'][4],
                'Samedi' => $validatedData['Id_Jours'][5],
                'Dimanche' => $validatedData['Id_Jours'][6],
            ];
            $jours = Jours::create($joursData);
    
            
            $validatedData['Id_Jours'] = $jours->Id_Jours;
    
            // Creation du trajet
            $trajet = Trajet::create($validatedData);
    
            
            return response()->json([], 201);
        } catch (\Exception $e) {
            
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }
    
    


} 

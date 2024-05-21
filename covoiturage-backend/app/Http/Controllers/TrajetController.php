<?php

namespace App\Http\Controllers;
use App\Models\Trajet;
use App\Models\Adresse;
use App\Models\Jours;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;



class TrajetController extends Controller
{
    public function getAllTrajets()
    {
       
        $trajets = Trajet::all();
        
      
        return response()->json($trajets);
    }


    
    public function getTrajet($id)
    {
     
        $trajet = Trajet::find($id);

       
        if ($trajet) {
            
            return response()->json($trajet);
        } else {
           
            return response()->json(['message' => 'Trajet non trouvé'], Response::HTTP_NOT_FOUND);
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
                'Id_Jours' => 'nullable|exists:Jours,Id_Jours',
                'Id_Conducteur' => 'required|exists:Utilisateur,Id_Utilisateur',
            ]);

           
            $trajet = Trajet::find($id);
            
            // Dans le cas où le trajet n'est pas trouvé
            if (!$trajet) {
                return response()->json(['message' => 'Trajet not found'], 404);
            }
            

            // Mise à jour avec les données validées
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

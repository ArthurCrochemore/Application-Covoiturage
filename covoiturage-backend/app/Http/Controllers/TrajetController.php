<?php

namespace App\Http\Controllers;
use App\Models\Trajet;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;



class TrajetController extends Controller
{
    public function getAllTrajets(): \Illuminate\Http\JsonResponse
    {
       
        $trajets = Trajet::all();

        // Retourner les trajets en tant que réponse JSON
        return response()->json($trajets);
    }


    // Méthode pour récupérer un trajet par son ID
    public function getTrajet($id): \Illuminate\Http\JsonResponse
    {
     
        $trajet = Trajet::find($id);

       
        if ($trajet) {
            
            return response()->json($trajet);
        } else {
           
            return response()->json(['message' => 'Trajet non trouvé'], Response::HTTP_NOT_FOUND);
        }
    }


     // Méthode pour mettre à jour un trajet par son ID
     public function updateTrajet(Request $request, $id): \Illuminate\Http\JsonResponse
     {
        // Utiliser le modèle Trajet pour trouver le trajet par son ID
    $trajet = Trajet::find($id);

    // Vérifier si le trajet a été trouvé
    if ($trajet) {
        // Mettre à jour les attributs du trajet avec les données de la requête
        // Vérifier chaque attribut individuellement et le mettre à jour s'il est présent dans la requête
        if ($request->has('pointdepart')) {
            $trajet->pointdepart = $request->input('pointdepart');
        }
        if ($request->has('pointarrive')) {
            $trajet->pointarrive = $request->input('pointarrive');
        }
        if ($request->has('datedepart')) {
            $trajet->datedepart = $request->input('datedepart');
        }
        if ($request->has('nbreplaces')) {
            $trajet->nbreplaces = $request->input('nbreplaces');
        }
        if ($request->has('qtebagages')) {
            $trajet->qtebagages = $request->input('qtebagages');
        }
        if ($request->has('description')) {
            $trajet->description = $request->input('description');
        }
        if ($request->has('trajetregulier')) {
            $trajet->trajetregulier = $request->input('trajetregulier');
        }
        if ($request->has('statut')) {
            $trajet->statut = $request->input('statut');
        }
        if ($request->has('id_utilisateur')) {
            $trajet->id_utilisateur = $request->input('id_utilisateur');
        }

        // Enregistrer les modifications dans la base de données
        $trajet->save();

        // Retourner une réponse JSON indiquant que le trajet a été mis à jour avec succès
        return response()->json(['message' => 'Trajet mis à jour avec succès'], Response::HTTP_OK);
    } else {
        // Retourner une réponse indiquant que le trajet n'a pas été trouvé
        return response()->json(['message' => 'Trajet non trouvé'], Response::HTTP_NOT_FOUND);
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
    
            // Créer un nouveau trajet avec les données validées
            $trajet = Trajet::create($validatedData);
    
          
            return response()->json([], 201);

        } catch (\Exception $e) {
            // Capturer et retourner les erreurs
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }
    


}

<?php

namespace App\Http\Controllers;
use App\Models\Trajet;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;



class TrajetController extends Controller
{
//     public function getAllTrajets()
//     {
//         // Récupérer tous les trajets à partir du modèle Trajet
//         $trajets = Trajet::all();
        
//         // Retourner les trajets en tant que réponse JSON
//         return response()->json($trajets);
//     }


//     // Méthode pour récupérer un trajet par son ID
//     public function getTrajet($id)
//     {
//         // Utiliser le modèle Trajet pour trouver le trajet par son ID
//         $trajet = Trajet::find($id);

//         // Vérifier si le trajet a été trouvé
//         if ($trajet) {
//             // Retourner le trajet en tant que réponse JSON
//             return response()->json($trajet);
//         } else {
//             // Retourner une réponse indiquant que le trajet n'a pas été trouvé
//             return response()->json(['message' => 'Trajet non trouvé'], Response::HTTP_NOT_FOUND);
//         }
//     }


//      // Méthode pour mettre à jour un trajet par son ID
//      public function updateTrajet(Request $request, $id)
//      {
//         // Utiliser le modèle Trajet pour trouver le trajet par son ID
//     $trajet = Trajet::find($id);
   
//     // Vérifier si le trajet a été trouvé
//     if ($trajet) {
//         // Mettre à jour les attributs du trajet avec les données de la requête
//         // Vérifier chaque attribut individuellement et le mettre à jour s'il est présent dans la requête
//         if ($request->has('pointdepart')) {
//             $trajet->pointdepart = $request->input('pointdepart');
//         }
//         if ($request->has('pointarrive')) {
//             $trajet->pointarrive = $request->input('pointarrive');
//         }
//         if ($request->has('datedepart')) {
//             $trajet->datedepart = $request->input('datedepart');
//         }
//         if ($request->has('nbreplaces')) {
//             $trajet->nbreplaces = $request->input('nbreplaces');
//         }
//         if ($request->has('qtebagages')) {
//             $trajet->qtebagages = $request->input('qtebagages');
//         }
//         if ($request->has('description')) {
//             $trajet->description = $request->input('description');
//         }
//         if ($request->has('trajetregulier')) {
//             $trajet->trajetregulier = $request->input('trajetregulier');
//         }
//         if ($request->has('statut')) {
//             $trajet->statut = $request->input('statut');
//         }
//         if ($request->has('id_utilisateur')) {
//             $trajet->id_utilisateur = $request->input('id_utilisateur');
//         }
        
//         // Enregistrer les modifications dans la base de données
//         $trajet->save();
        
//         // Retourner une réponse JSON indiquant que le trajet a été mis à jour avec succès
//         return response()->json(['message' => 'Trajet mis à jour avec succès'], Response::HTTP_OK);
//     } else {
//         // Retourner une réponse indiquant que le trajet n'a pas été trouvé
//         return response()->json(['message' => 'Trajet non trouvé'], Response::HTTP_NOT_FOUND);
//     }


//     }

//     // Méthode pour la création d'un trajet
// public function createTrajet(Request $request)
// {
//     // Validation des données
//     $validator = Validator::make($request->all(), [
//         'PointDepart' => 'required|string',
//         'PointArrive' => 'required|string',
//         'DateDepart' => 'required|date',
//         'NbrePlaces' => 'required|integer',
//         'QteBagages' => 'required|integer',
//         'Desciption' => 'required|string',
//         'TrajetRegulier' => 'required|boolean',
//         'Statut' => 'required|string',
//         'id_utilisateur' => 'required|integer',
//     ]);

//     // Vérifier s'il y a des erreurs de validation
//     if ($validator->fails()) {
//         return response()->json(['error' => $validator->errors()], 400);
//     }

//     // Créer un nouveau trajet
//     $trajet = Trajet::create([
//         'pointdepart' => $request->input('PointDepart'),
//         'pointarrive' => $request->input('PointArrive'),
//         'datedepart' => $request->input('DateDepart'),
//         'nbreplaces' => $request->input('NbrePlaces'),
//         'qtebagages' => $request->input('QteBagages'),
//         'description' => $request->input('Desciption'),
//         'trajetregulier' => $request->input('TrajetRegulier'),
//         'statut' => $request->input('Statut'),
//         'id_utilisateur' => $request->input('id_utilisateur'),
//     ]);

//     // Retourner une réponse JSON avec le trajet créé et le code de statut 201 (Créé)
//     return response()->json(['message' => 'Trajet créé avec succès', 'trajet' => $trajet], 201);
// }


} 

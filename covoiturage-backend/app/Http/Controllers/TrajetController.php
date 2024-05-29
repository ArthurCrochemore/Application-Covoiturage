<?php

namespace App\Http\Controllers;
use App\Models\Trajet;
use App\Models\Adresse;
use App\Models\Jours;
use App\Models\Utilisateur;
use App\Models\Reservation;
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
        // Retrieve the trajet
        $trajet = Trajet::with(['domicile', 'base', 'utilisateur', 'reservations.utilisateur'])->find($id);

        if ($trajet) {
            // Retrieve the domicile and base addresses
            $domicile = $trajet->domicile;
            $base = $trajet->base;

            $ptDepart = null;
            $ptArrive = null;
            $heureDepart = null;
            $heureArrive = null;

            if ($domicile && $base) {
                // Determine the departure and arrival points based on Domicile_Base
                if ($trajet->Domicile_Base) {
                    $ptDepart = $domicile->Intitule;
                    $ptArrive = $base->Intitule;
                    $heureArrive = $trajet->Heure_Depart;
                } else {
                    $ptDepart = $base->Intitule;
                    $ptArrive = $domicile->Intitule;
                    $heureDepart = $trajet->Heure_Depart;
                }
            }

            $type = $trajet->Trajet_Regulier ? "Régulier" : "Ponctuel";

            // Information conducteur
            $utilisateur = $trajet->utilisateur;

            // information passengers
            $passagers = $trajet->reservations->map(function($reservation) {
                return [
                    'nomPassager' => $reservation->utilisateur->Nom,
                    'prenomPassager' => $reservation->utilisateur->Prenom,
                    'adresse' => $reservation->adresse ? $reservation->adresse->Intitule : null,
                ];
            });

            $nbPassagers = $passagers->count();

            $result = [
                'idTrajet' => $trajet->Id_Trajet,
                'ptDepart' => $ptDepart,
                'ptArrive' => $ptArrive,
                'typeTrajet' => $type,
                'heureDepart' => $heureDepart,
                'heureArrive' => $heureArrive,
                'Date_Depart' => $trajet->Date_Depart,
                'nomConducteur' => $utilisateur ? $utilisateur->Nom : null,
                'uniteConducteur' => $utilisateur ? $utilisateur->Unite : null,
                'passagers' => $passagers,
                'nbPassagers' => $nbPassagers,
                'nbMaxPassagers' => $trajet->Nbre_Places
            ];

            return response()->json($result, 200);
        } else {
            return response()->json(['message' => 'Trajet non trouvé'], 404);
        }
    } catch (\Exception $e) {
        return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
    }
}


public function getAllTrajetsPassagers()
{
    try {
        $passager = Auth::user();
        $id = $passager->Id_Utilisateur;

        $reservations = Reservation::with(['trajet.domicile', 'trajet.base', 'trajet.utilisateur'])
            ->where('Id_Passager', $id)
            ->get();

        if ($reservations->isEmpty()) {
            return response()->json(['message' => 'Aucun trajet trouvé pour ce passager'], 404);
        }

        $result = $reservations->map(function ($reservation) {
            $trajet = $reservation->trajet;
            if (!$trajet) {
                return [
                    'idTrajet' => null,
                    'ptDepart' => null,
                    'ptArrive' => null,
                    'typeTrajet' => null,
                    'heureDepart' => null,
                    'heureArrive' => null,
                    'Date_Depart' => null,
                    'nomConducteur' => null,
                    'uniteConducteur' => null,
                    'nbMaxPassagers' => null
                ];
            }

            $domicile = $trajet->domicile;
            $base = $trajet->base;

            $ptDepart = null;
            $ptArrive = null;
            $heureDepart = null;
            $heureArrive = null;

            if ($domicile && $base) {
                if ($trajet->Domicile_Base) {
                    $ptDepart = $domicile->Intitule;
                    $ptArrive = $base->Intitule;
                    $heureArrive = $trajet->Heure_Depart;
                } else {
                    $ptDepart = $base->Intitule;
                    $ptArrive = $domicile->Intitule;
                    $heureDepart = $trajet->Heure_Depart;
                }
            }

            $type = $trajet->Trajet_Regulier ? "Régulier" : "Ponctuel";

            return [
                'idTrajet' => $trajet->Id_Trajet,
                'ptDepart' => $ptDepart,
                'ptArrive' => $ptArrive,
                'typeTrajet' => $type,
                'heureDepart' => $heureDepart,
                'heureArrive' => $heureArrive,
                'Date_Depart' => $trajet->Date_Depart,
                'nomConducteur' => $trajet->utilisateur ? $trajet->utilisateur->Nom : null,
                'uniteConducteur' => $trajet->utilisateur ? $trajet->utilisateur->Unite : null,
                'nbMaxPassagers' => $trajet->Nbre_Places
            ];
        });

        return response()->json($result, 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
    }
}

    public function getAllTrajetsConducteurs()
    {
        try {
            $conducteur = Auth::user();
            $id = $conducteur->id;

            $trajets = Trajet::with(['domicile', 'base', 'utilisateur'])
                ->where('Id_Conducteur', $id)
                ->get();

            if ($trajets->isEmpty()) {
                return response()->json(['message' => 'Aucun trajet trouvé pour ce conducteur'], 404);
            }


            $result = $trajets->map(function ($trajet) {
                $domicile = $trajet->domicile;
                $base = $trajet->base;

                $ptDepart = null;
                $ptArrive = null;
                $heureDepart = null;
                $heureArrive = null;

                if ($domicile && $base) {
                    if ($trajet->Domicile_Base) {
                        $ptDepart = $domicile->Intitule;
                        $ptArrive = $base->Intitule;
                        $heureArrive = $trajet->Heure_Depart;
                    } else {
                        $ptDepart = $base->Intitule;
                        $ptArrive = $domicile->Intitule;
                        $heureDepart = $trajet->Heure_Depart;
                    }
                }

                $type = $trajet->Trajet_Regulier ? "Régulier" : "Ponctuel";

                $passagers = $trajet->reservations->map(function($reservation) {
                    return [
                        'nomPassager' => $reservation->utilisateur->Nom,
                        'prenomPassager' => $reservation->utilisateur->Prenom,
                        'adresse' => $reservation->adresse ? $reservation->adresse->Intitule : null,
                    ];
                });

                $nbPassagers = $passagers->count();


                return [
                    'idTrajet' => $trajet->Id_Trajet,
                    'ptDepart' => $ptDepart,
                    'ptArrive' => $ptArrive,
                    'typeTrajet' => $type,
                    'heureDepart' => $heureDepart,
                    'heureArrive' => $heureArrive,
                    'Date_Depart' => $trajet->Date_Depart,
                    'nomConducteur' => $trajet->utilisateur ? $trajet->utilisateur->Nom : null,
                    'uniteConducteur' => $trajet->utilisateur ? $trajet->utilisateur->Unite : null,
                    'nbMaxPassagers' => $trajet->Nbre_Places,
                    'nbPassagers'=> $nbPassagers,
                    'status' => $nbPassagers == $trajet->Nbre_Places,
                ];
            });

            return response()->json($result, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }


    // public function getAllPropositionsTrajets() {
    //     // TODO : récupère tout les trajets que l'utilisateur (utiliser l'id de Auth) a proposé
    // }



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

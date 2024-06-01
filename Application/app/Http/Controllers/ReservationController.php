<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Trajet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function ReserverTrajet(Request $request)
        {
            $id = Auth::user()->Id_Utilisateur;

            $DateNow = now();
            Log::info('Date actuelle : ' . $DateNow);
            $ValidatedData = $request->validate([
                'Id_Trajet' => 'required|integer|exists:Trajet,Id_Trajet',
                'Id_Adresse' => 'required|integer|exists:Adresse,Id_Adresse',
            ]);
            $ValidatedData["Id_Passager"] = $id;
            $ValidatedData['Date_Reservation'] = $DateNow;
            $ValidatedData['Statut'] = 0;

            $trajet = Trajet::find($ValidatedData['Id_Trajet']);

            // On récupère le nb de passager
            $nbPassagers = $trajet->reservations()
                ->where('Statut', '!=', 2)
                ->count();

            // On vérifie qu'il n'y a pas de problemes
            if ($nbPassagers >= $trajet->Nbre_Places) {
                return redirect('/accueil')->with('error', 'La capacité du trajet est déjà atteinte.');
            }

            $Reservation = Reservation::create($ValidatedData);

            // On change l'etat du trajet si le nb de place max a été atteint
            if ($nbPassagers + 1 >= $trajet->Nbre_Places) {
                $trajet->Statut = true;
                $trajet->save();
            }

            // TODO : Ajouter domicile de l'utilisateur est base du trajet

            return redirect('/accueil')->with('success', 'Réservation créé avec succès!');
        }

    public function getReservation($id)
    {
        try {
            $reservation = Reservation::find($id);

            return [
                'nomPassager' => $reservation->utilisateur->Nom,
                'prenomPassager' => $reservation->utilisateur->Prenom,
                'unite' => $reservation->utilisateur->Unite,
                'domicile' => $reservation->adresse ? $reservation->adresse->Intitule : null,
            ];
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }

    public function accepterReservation($id)
    {
        try {
            $reservation = Reservation::find($id);

            if (!$reservation) {
                return response()->json(['message' => 'Reservation not found'], 404);
            }

            $reservation->Statut = 1;
            $reservation->save();

            return response()->json(['message' => 'Reservation accepted successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }

    public function refuserReservation($id)
    {
        try {
            $reservation = Reservation::find($id);

            if (!$reservation) {
                return response()->json(['message' => 'Reservation not found'], 404);
            }

            // On change le statut du trajet, il redevient visible s'il était complet
            $trajet = Trajet::find($reservation->Id_Trajet);
            $trajet->Statut = false;
            $trajet->save();

            $reservation->Statut = 2;
            $reservation->save();

            return response()->json(['message' => 'Reservation accepted successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
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

            $Reservation = Reservation::create($ValidatedData);

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

            $reservation->Statut = 2;
            $reservation->save();

            return response()->json(['message' => 'Reservation accepted successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }
}
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
            $ValidatedData['Statut'] = 1;

            $Reservation = Reservation::create($ValidatedData);

            // TODO : Ajouter domicile de l'utilisateur est base du trajet

            return redirect('/accueil')->with('success', 'Réservation créé avec succès!');
        }

    public function getReservation($id)
    {
        try {
            $reservation = Reservation::find($id);

            return response()->json([''=> $reservation]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }
}

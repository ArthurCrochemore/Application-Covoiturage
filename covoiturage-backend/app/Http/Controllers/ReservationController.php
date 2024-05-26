<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReservationController extends Controller
{
    public function ReserverTrajet(Request $request)
        {
            $DateNow = now();
            Log::info('Date actuelle : ' . $DateNow);
            $ValidatedData = $request->validate([
                'Id_Passager' => 'required|integer|exists:Utilisateur,Id_Utilisateur',
                'Id_Trajet' => 'required|integer|exists:Trajet,Id_Trajet',
                'Id_Adresse' => 'required|integer|exists:Adresse,Id_Adresse',
            ]);
            $ValidatedData['Date_Reservation'] = now();
            $ValidatedData['Statut'] = 1;

            $Reservation = Reservation::create($ValidatedData);

            return redirect('/accueil')->with('success', 'Réservation créé avec succès!');
        }
}

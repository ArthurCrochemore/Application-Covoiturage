<?php

namespace Tests\Feature;

use Tests\TestCase;

class ReservationTest extends TestCase
{

    public function testReserverTrajet()
    {
        // Créer des données pour le test
        $idPassager = 2; // Remplacez par l'ID réel de l'utilisateur
        $idTrajet = 1; // Remplacez par l'ID réel du trajet
        $idAdresse = 3; // Remplacez par l'ID réel de l'adresse

        // Effectuer une requête POST à la méthode ReserverTrajet avec les données nécessaires
        $response = $this->post('/reserver-trajet', [
            'Id_Passager' => $idPassager,
            'Id_Trajet' => $idTrajet,
            'Id_Adresse' => $idAdresse,
        ]);

        // Vérifier que la réservation a été créée dans la base de données
        $this->assertDatabaseHas('Reservation', [
            'Id_Passager' => $idPassager,
            'Id_Trajet' => $idTrajet,
            'Id_Adresse' => $idAdresse,
        ]);

        // Vérifier que l'utilisateur est redirigé vers la page d'accueil après la réservation
        $response->assertRedirect('/accueil');

        // Vérifier que le message de succès est présent dans la session
    }
}

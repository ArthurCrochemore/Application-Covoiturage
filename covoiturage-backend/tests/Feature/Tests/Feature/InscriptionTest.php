<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InscriptionTest extends TestCase
{

    public function test_creation_utilisateur()
    {
        $response = $this->withHeaders(['X-CSRF-TOKEN' => csrf_token(),])
            ->post('/utilisateur', [
            'NID' => '1234567890',
            'Nom' => 'Doe',
            'Prenom' => 'John',
            'Unite' => 'Finance',
            'Numero_De_Poste' => '1234',
            'Numero_De_Telephone' => '0123456789',
            'Mail' => 'john.doeee@example.com',
            'Mot_De_Passe' => 'password',
        ]);

        $response->assertStatus(302); // Vérifie que la redirection est effectuée (code 302)

        // Vérifie que l'utilisateur est bien créé dans la base de données
        $this->assertDatabaseHas('Utilisateur', [
            'Mail' => 'john.doeee@example.com',
        ]);
    }
}

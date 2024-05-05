<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InscriptionTest extends TestCase
{

    public function test_creation_utilisateur()
    {
        $response = $this->post('/utilisateur', [
            'nid' => '1234567890',
            'nom' => 'Doe',
            'prenom' => 'John',
            'unite' => 'Finance',
            'numeroposte' => '1234',
            'adressepostale' => '123 Rue des Fleurs',
            'tel' => '0123456789',
            'mail' => 'john.doeee@example.com',
            'coordonnees' => 'Paris, France',
            'mdp' => 'password',
        ]);

        $response->assertStatus(302); // Vérifie que la redirection est effectuée (code 302)

        // Vérifie que l'utilisateur est bien créé dans la base de données
        $this->assertDatabaseHas('utilisateur', [
            'mail' => 'john.doeee@example.com',
        ]);
    }
}

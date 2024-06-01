<?php

namespace Tests\Feature;

use App\Models\Utilisateur;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ConnexionTest extends TestCase
{
    use DatabaseTransactions;

    public function test_connexion_reussie()
    {
        $user = Utilisateur::factory()->createOne([
            'Mail' => 'test@example.com',
            'Mot_De_Passe' => Hash::make('password'),
        ]);
        echo "Email : " . $user->Mail . "\n";

        $response = $this->post('/login', [
            'Mail' => 'test@example.com',
            'Mot_De_Passe' => 'password',
        ]);

        $response->assertRedirect('/accueil');
        $this->assertAuthenticatedAs($user);
    }

    public function test_identifiants_incorrects()
    {
        $response = $this->post('/login',[
            'Mail' => 'test@example.com',
            'Mot_De_Passe' => 'wrongpassword',
        ]);

        $response->assertRedirect('/login')
            ->assertSessionHasErrors(['Mot_De_Passe']);
        $this->assertGuest();
    }
}

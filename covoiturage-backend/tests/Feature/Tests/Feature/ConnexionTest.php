<?php

namespace Tests\Feature;

use App\Models\Utilisateur;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ConnexionTest extends TestCase
{


    public function test_connexion_reussie()
    {
        $user = Utilisateur::factory()->create([
            'mail' => 'test@example.com',
            'mdp' => Hash::make('password'),
        ]);
        echo "Email : " . $user->mail . "\n";

        $response = $this->post('/login', [
            'mail' => 'test@example.com',
            'mdp' => 'password',
        ]);

        $response->assertRedirect('/accueil');
        $this->assertAuthenticatedAs($user);
    }

    public function test_identifiants_incorrects()
    {
        $response = $this->post('/login',[
            'mail' => 'test@example.com',
            'mdp' => 'wrongpassword',
        ]);

        $response->assertRedirect('/login')
            ->assertSessionHasErrors(['mdp']);
        $this->assertGuest();
    }
}

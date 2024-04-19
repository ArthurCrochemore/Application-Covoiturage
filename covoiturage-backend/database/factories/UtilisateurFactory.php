<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Utilisateur;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Utilisateur>
 */
class UtilisateurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        return [
            'nid' => $this->faker->numerify('####'),
            'nom' => $this->faker->lastName,
            'prenom' => $this->faker->firstName,
            'unite' => $this->faker->randomElement(['Ventes', 'Marketing', 'Finance', 'Ressources Humaines']),
            'numeroposte' => $this->faker->numerify('####'),
            'adressepostale' => $this->faker->address,
            'tel' => $this->faker->phoneNumber,
            'mail' => $this->faker->unique()->safeEmail,
            'coordonnees' => $this->faker->address,
            'mdp' => bcrypt('password'), 
            // 'remember_token' => Str::random(10),
        ];
    }
}

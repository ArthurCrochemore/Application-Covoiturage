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
            'NID' => $this->faker->numerify('####'),
            'Nom' => $this->faker->lastName,
            'Prenom' => $this->faker->firstName,
            'Unite' => $this->faker->randomElement(['Ventes', 'Marketing', 'Finance', 'Ressources Humaines']),
            'Numero_De_Poste' => $this->faker->numerify('####'),
            'Numero_De_Telephone' => $this->faker->phoneNumber,
            'Mail' => $this->faker->unique()->safeEmail,
            'Mot_De_Passe' => bcrypt('password'),
            // 'remember_token' => Str::random(10),
        ];
    }
}

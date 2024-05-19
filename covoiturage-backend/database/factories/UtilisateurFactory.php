<?php

namespace Database\Factories;

use App\Models\Utilisateur;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Utilisateur>
 */
class UtilisateurFactory extends Factory
{
    /**
     * Le nom du modèle associé à cette factory.
     *
     * @var string
     */
    protected $model = Utilisateur::class;

    /**
     * Définir l'état par défaut du modèle.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'NID' => $this->faker->randomNumber(),
            'Prenom' => $this->faker->firstName,
            'Nom' => $this->faker->lastName,
            'Mail' => $this->faker->unique()->safeEmail,
            'Unite' => $this->faker->word,
            'Numero_De_Poste' => $this->faker->phoneNumber,
            'Numero_De_Telephone' => $this->faker->phoneNumber,
            'Mot_De_Passe' => Hash::make('password')
        ];
    }
}

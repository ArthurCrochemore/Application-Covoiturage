<?php

namespace Database\Factories;

use App\Models\Utilisateur;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UtilisateurFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Utilisateur::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'NID' => $this->faker->unique()->randomNumber(8),
            'Nom' => $this->faker->lastName,
            'Prenom' => $this->faker->firstName,
            'Unite' => $this->faker->company,
            'Numero_De_Poste' => $this->faker->phoneNumber,
            'Numero_De_Telephone' => $this->faker->phoneNumber,
            'Mail' => $this->faker->unique()->safeEmail,
            'Mot_De_Passe' => bcrypt('password'), 
        ];
    }
}

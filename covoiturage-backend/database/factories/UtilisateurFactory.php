<?php

namespace Database\Factories;


use app\Models\Utilisateur;
use Hamcrest\Util;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<Utilisateur>
 */
class UtilisateurFactory extends Factory
{
    protected $model = Utilisateur::class;

    public function definition()
    {
        return [
            'nid' => $this->faker->unique()->regexify('[A-Za-z0-9]{10}'),
            'nom' => $this->faker->lastName,
            'prenom' => $this->faker->firstName,
            'unite' => $this->faker->company,
            'numeroposte' => $this->faker->numerify('##########'),
            'adressepostale' => $this->faker->address,
            'tel' => $this->faker->phoneNumber,
            'mail' => $this->faker->unique()->safeEmail,
            'coordonnees' => $this->faker->sentence,
            'mdp' => bcrypt('password'), // Hash du mot de passe
        ];
    }
}

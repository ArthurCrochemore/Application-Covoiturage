<?php

namespace Database\Factories;

use App\Models\Rapport;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rapport>
 */
class RapportFactory extends Factory
{
    /**
     * Le nom du modèle associé à cette factory.
     *
     * @var string
     */
    protected $model = Rapport::class;

    /**
     * Définir l'état par défaut du modèle.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Description' => $this->faker->text,
            'Date_Rapport' => $this->faker->dateTime,
            'Statut' => $this->faker->randomElement([0, 1, 2]),
            'Id_Utilisateur' => \App\Models\Utilisateur::factory()
        ];
    }
}

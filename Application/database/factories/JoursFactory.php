<?php

namespace Database\Factories;

use App\Models\Jours;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jours>
 */
class JoursFactory extends Factory
{
    /**
     * Le nom du modèle associé à cette factory.
     *
     * @var string
     */
    protected $model = Jours::class;

    /**
     * Définir l'état par défaut du modèle.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Lundi' => $this->faker->boolean,
            'Mardi' => $this->faker->boolean,
            'Mercredi' => $this->faker->boolean,
            'Jeudi' => $this->faker->boolean,
            'Vendredi' => $this->faker->boolean,
            'Samedi' => $this->faker->boolean,
            'Dimanche' => $this->faker->boolean
        ];
    }
}

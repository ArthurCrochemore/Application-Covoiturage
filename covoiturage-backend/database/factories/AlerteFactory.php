<?php

namespace Database\Factories;

use App\Models\Alerte;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Alerte>
 */
class AlerteFactory extends Factory
{
    /**
     * Le nom du modèle associé à cette factory.
     *
     * @var string
     */
    protected $model = Alerte::class;

    /**
     * Définir l'état par défaut du modèle.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Statut' => $this->faker->randomElement([0, 1, 2]),
            'Trajet_Regulier' => $this->faker->boolean,
            'Domicile_Base' => $this->faker->boolean,
            'Date_Alerte_Trajet' => $this->faker->date,
            'Id_Utilisateur' => \App\Models\Utilisateur::factory(),
            'Id_Jours' => \App\Models\Jours::factory(),
            'Id_Domicile' => \App\Models\Adresse::factory(),
            'Id_Base' => \App\Models\Adresse::factory()
        ];
    }
}

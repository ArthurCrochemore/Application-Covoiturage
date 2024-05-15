<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trajet>
 */
class TrajetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'Date_Depart' => $this->faker->dateTimeBetween('+1 day', '+1 month'),
            'Nbre_Places' => $this->faker->numberBetween(1, 10),
            'Qte_Bagages' => $this->faker->numberBetween(0, 5),
            'Description' => $this->faker->sentence,
            'Trajet_Regulier' => $this->faker->boolean(50),
            'Statut' => $this->faker->randomElement(['en cours', 'terminé', 'annulé']),
            'Id_Conducteur' => \App\Models\Utilisateur::factory()->create()->id,
            'Id_Domicile' => \App\Models\Adresse::factory()->create()->id,
            'Id_Base' => \App\Models\Adresse::factory()->create()->id,
            'Id_Jours' => \App\Models\Jours::factory()->create()->id,
        ];
    }
}

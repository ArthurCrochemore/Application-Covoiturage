<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trajet>
 */
class TrajetFactory extends Factory
{
    // /**
    //  * Define the model's default state.
    //  *
    //  * @return array<string, mixed>
    //  */

    // public function definition(): array
    // {
    //     return [
    //         'pointdepart' => $this->faker->city,
    //         'pointarrive' => $this->faker->city,
    //         'datedepart' => $this->faker->dateTimeBetween('+1 day', '+1 month'),
    //         'nbreplaces' => $this->faker->numberBetween(1, 10),
    //         'qtebagages' => $this->faker->numberBetween(0, 5),
    //         'description' => $this->faker->sentence,
    //         'trajetregulier' => $this->faker->boolean(50),
    //         'statut' => $this->faker->randomElement(['en cours', 'terminé', 'annulé']),
    //         'id_utilisateur' => \App\Models\Utilisateur::factory()->create()->id,
    //     ];
    // }
}

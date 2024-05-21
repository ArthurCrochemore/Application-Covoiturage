<?php

namespace Database\Factories;

use App\Models\Trajet;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TrajetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Trajet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'Date_Depart' => $this->faker->date,
            'Heure_Depart' => $this->faker->time,
            'Nbre_Places' => $this->faker->numberBetween(1, 10),
            'Qte_Bagages' => $this->faker->numberBetween(0, 5),
            'Description' => $this->faker->text(300),
            'Trajet_Regulier' => $this->faker->boolean,
            'Statut' => $this->faker->randomElement(['En cours', 'Terminé', 'Annulé']),
            'Domicile_Base' => $this->faker->boolean,
            'Id_Domicile' => function () {
                return \App\Models\Adresse::factory()->create()->Id_Adresse;
            },
            'Id_Base' => function () {
                return \App\Models\Adresse::factory()->create()->Id_Adresse;
            },
            'Id_Jours' => function () {
                return \App\Models\Jours::factory()->create()->Id_Jours;
            },
            'Id_Conducteur' => function () {
                return \App\Models\Utilisateur::factory()->create()->Id_Utilisateur;
            },
        ];
    }
}

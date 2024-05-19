<?php

namespace Database\Factories;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Le nom du modèle associé à cette factory.
     *
     * @var string
     */
    protected $model = Reservation::class;

    /**
     * Définir l'état par défaut du modèle.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Date_Reservation' => $this->faker->date,
            'Statut' => $this->faker->numberBetween(0, 1),
            'Id_Passager' => \App\Models\Utilisateur::factory(),
            'Id_Trajet' => \App\Models\Trajet::factory(),
            'Id_Adresse' => \App\Models\Adresse::factory()
        ];
    }
}

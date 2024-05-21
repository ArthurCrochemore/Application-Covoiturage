<?php

namespace Database\Factories;

use App\Models\Habiter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Habiter>
 */
class HabiterFactory extends Factory
{
    /**
     * Le nom du modèle associé à cette factory.
     *
     * @var string
     */
    protected $model = Habiter::class;

    /**
     * Définir l'état par défaut du modèle.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Id_Utilisateur' => \App\Models\Utilisateur::factory(),
            'Id_Adresse' => \App\Models\Adresse::factory()
        ];
    }
}

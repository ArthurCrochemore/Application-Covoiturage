<?php

namespace Database\Factories;

use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Le nom du modèle associé à cette factory.
     *
     * @var string
     */
    protected $model = Message::class;

    /**
     * Définir l'état par défaut du modèle.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Message' => $this->faker->text,
            'Date_Message' => $this->faker->dateTime,
            'Lu' => $this->faker->boolean,
            'Id_Expediteur' => \App\Models\Utilisateur::factory(),
            'Id_Recepteur' => \App\Models\Utilisateur::factory()
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Jours;
use Illuminate\Database\Eloquent\Factories\Factory;

class JoursFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Jours::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'Lundi' => $this->faker->boolean,
            'Mardi' => $this->faker->boolean,
            'Mercredi' => $this->faker->boolean,
            'Jeudi' => $this->faker->boolean,
            'Vendredi' => $this->faker->boolean,
            'Samedi' => $this->faker->boolean,
            'Dimanche' => $this->faker->boolean,
        ];
    }
}

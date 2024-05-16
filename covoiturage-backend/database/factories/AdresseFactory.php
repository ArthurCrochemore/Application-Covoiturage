<?php

namespace Database\Factories;

use App\Models\Adresse;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdresseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Adresse::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'Intitule' => $this->faker->streetAddress,
            'Ville' => $this->faker->city,
            'Est_Base_Aerienne' => $this->faker->boolean,
        ];
    }
}

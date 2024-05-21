<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Utilisateur;
use App\Models\Adresse;
use App\Models\Jours;
use App\Models\Trajet;

class TrajetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Création de 5 utilisateurs fictifs
        Utilisateur::factory()->count(5)->create();

        // Création de 5 adresses fictives
        Adresse::factory()->count(5)->create();

        // Création de 7 jours fictifs
        Jours::factory()->count(7)->create();

        // Création de 10 trajets fictifs avec des relations
        Trajet::factory()->count(10)->create([
            'Id_Domicile' => Adresse::inRandomOrder()->first()->Id_Adresse,
            'Id_Base' => Adresse::inRandomOrder()->first()->Id_Adresse,
            'Id_Jours' => Jours::inRandomOrder()->first()->Id_Jours,
            'Id_Conducteur' => Utilisateur::inRandomOrder()->first()->Id_Utilisateur,
        ]);
    }
}

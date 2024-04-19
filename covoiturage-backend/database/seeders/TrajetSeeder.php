<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\database\Seeders;
use App\Models\Trajet;
use App\Models\Utilisateur;

class TrajetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // // Créer 10 utilisateurs et pour chaque utilisateur, créer entre 1 et 5 trajets
        // \App\Models\Utilisateur::factory(10)->create()->each(function($utilisateur) {
        //     Trajet::factory(rand(1, 5))->create([
        //         'id_utilisateur' => $utilisateur->id
        //     ]);
        // });
        
    }
}

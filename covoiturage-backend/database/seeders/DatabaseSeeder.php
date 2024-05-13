<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder; 
use App\Models\Trajet;
use App\Models\Utilisateur;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
   /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Créer des utilisateurs
        Utilisateur::factory(10)->create()->each(function ($utilisateur) {
            // Créer des trajets pour chaque utilisateur
            $trajets = Trajet::factory()->count(rand(1, 5))->make(['id_utilisateur' => $utilisateur->id]);
            foreach ($trajets as $trajet) {
                dump('Utilisateur: ' . $utilisateur->id . ', Trajet: ' . $trajet->id_utilisateur);
            }
            // Enregistrer les trajets associés à l'utilisateur
            $utilisateur->trajets()->saveMany($trajets);
        });
}
}

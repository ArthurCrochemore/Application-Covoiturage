<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Utilisateur;

class UtilisateurSeeder extends Seeder
{
    public function run(): void
    {
        Utilisateur::factory()->count(50)->create();
    }
}

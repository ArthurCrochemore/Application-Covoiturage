<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Utilisateur;
use App\Models\Adresse;
use App\Models\Jours;
use App\Models\Trajet;

class TrajetSeeder extends Seeder
{
    public function run(): void
    {
        Trajet::factory()->count(3)->create();
    }
}

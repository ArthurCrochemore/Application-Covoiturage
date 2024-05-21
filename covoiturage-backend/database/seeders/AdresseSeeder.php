<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Adresse;

class AdresseSeeder extends Seeder
{
    public function run(): void
    {
        Adresse::factory()->count(20)->create();
    }
}

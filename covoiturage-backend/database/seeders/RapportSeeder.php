<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rapport;

class RapportSeeder extends Seeder
{
    public function run(): void
    {
        Rapport::factory()->count(3)->create();
    }
}

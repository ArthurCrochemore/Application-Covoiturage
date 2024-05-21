<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jours;

class JoursSeeder extends Seeder
{
    public function run(): void
    {
        Jours::factory()->count(10)->create();
    }
}

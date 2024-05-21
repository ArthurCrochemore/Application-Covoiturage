<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alerte;

class AlerteSeeder extends Seeder
{
    public function run(): void
    {
        Alerte::factory()->count(20)->create();
    }
}

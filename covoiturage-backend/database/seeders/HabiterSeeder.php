<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Habiter;

class HabiterSeeder extends Seeder
{
    public function run(): void
    {
        Habiter::factory()->count(3)->create();
    }
}

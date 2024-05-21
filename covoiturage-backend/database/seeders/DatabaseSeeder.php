<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UtilisateurSeeder::class,
            AdresseSeeder::class,
            MessageSeeder::class,
            RapportSeeder::class,
            JoursSeeder::class,
            TrajetSeeder::class,
            AlerteSeeder::class,
            ReservationSeeder::class,
            HabiterSeeder::class,
        ]);
    }
}

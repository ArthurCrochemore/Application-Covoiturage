<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reservation;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
        Reservation::factory()->count(50)->create();
    }
}

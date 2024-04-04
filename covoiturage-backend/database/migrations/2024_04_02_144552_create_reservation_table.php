<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservation', function (Blueprint $table) {
            $table->id('id_reservation');
            $table->timestamps();
            $table->dateTime('datereservation');
            $table->integer('statut');
            $table->integer('id_utilisateur');
            $table->integer('id_trajet');
            $table->foreign('id_utilisateur')->references('id_utilisateur')->on('utilisateur');
            $table->foreign('id_trajet')->references('id_trajet')->on('trajet');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation');
    }
};

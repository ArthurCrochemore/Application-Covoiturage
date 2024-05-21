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
        Schema::create('Reservation', function (Blueprint $table) {
            $table->id('Id_Reservation');
            $table->timestamps();
            $table->dateTime('Date_Reservation');
            $table->integer('Statut');
            $table->integer('Id_Passager');
            $table->integer('Id_Trajet');
            $table->integer('Id_Adresse');
            $table->foreign('Id_Passager')->references('Id_Utilisateur')->on('Utilisateur');
            $table->foreign('Id_Trajet')->references('Id_Trajet')->on('Trajet');
            $table->foreign('Id_Adresse')->references('Id_Adresse')->on('Adresse');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Reservation');
    }
};

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
        Schema::create('trajet', function (Blueprint $table) {
            $table->id('id_trajet');
            $table->string('pointdepart');
            $table->string('pointarrive');
            $table->dateTime('datedepart');
            $table->integer('nbreplaces');
            $table->integer('qtebagages');
            $table->string('description');
            $table->boolean('trajetregulier');
            $table->string('statut');
            $table->integer('id_utilisateur');
            $table->foreign('id_utilisateur')->references('id_utilisateur')->on('utilisateur');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trajet');
    }
};

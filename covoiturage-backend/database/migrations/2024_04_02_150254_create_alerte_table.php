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
        Schema::create('alerte', function (Blueprint $table) {
            $table->id('id_alerte');
            $table->integer('statut');
            $table->integer('id_utilisateur');
            $table->integer('Id_Trajet');
            $table->foreign('id_utilisateur')->references('id_utilisateur')->on('utilisateur');
            $table->foreign('Id_Trajet')->references('Id_Trajet')->on('trajet');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alerte');
    }
};

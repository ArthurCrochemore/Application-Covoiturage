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
        Schema::create('utilisateur', function (Blueprint $table) {
            $table->id('id_utilisateur');
            $table->string('nid');
            $table->string('nom');
            $table->string('prenom');
            $table->string('unite');
            $table->string('numeroposte');
            $table->string('adressepostale');
            $table->string('tel');
            $table->string('mail');
            $table->string('coordonnees');
            $table->string('mdp');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilisateur');
    }
};

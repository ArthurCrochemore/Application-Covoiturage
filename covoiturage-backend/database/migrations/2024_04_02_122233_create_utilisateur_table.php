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
        Schema::create('Utilisateur', function (Blueprint $table) {
            $table->id('Id_Utilisateur');
            $table->integer('NID');
            $table->string('Nom');
            $table->string('Prenom');
            $table->string('Mail');
            $table->string('Unite');
            $table->string('Numero_De_Poste');
            $table->string('Numero_De_Telephone');
            $table->string('Mot_De_Passe');



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Utilisateur');
    }
};

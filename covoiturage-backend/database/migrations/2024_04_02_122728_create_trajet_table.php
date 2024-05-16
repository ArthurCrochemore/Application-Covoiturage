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
        Schema::create('Trajet', function (Blueprint $table) {
            $table->bigIncrements('Id_Trajet');
            $table->date('Date_Depart');
            $table->time('Heure_Depart');
            $table->integer('Nbre_Places');
            $table->integer('Qte_Bagages');
            $table->string('Description', 300)->nullable();
            $table->boolean('Trajet_Regulier');
            $table->string('Statut');
            $table->boolean('Domicile_Base');
            $table->unsignedBigInteger('Id_Domicile');
            $table->unsignedBigInteger('Id_Base');
            $table->unsignedBigInteger('Id_Jours')->nullable();
            $table->unsignedBigInteger('Id_Conducteur');

            $table->foreign('Id_Domicile')->references('Id_Adresse')->on('Adresse');
            $table->foreign('Id_Base')->references('Id_Adresse')->on('Adresse');
            $table->foreign('Id_Jours')->references('Id_Jours')->on('Jours');
            $table->foreign('Id_Conducteur')->references('Id_Utilisateur')->on('Utilisateur');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Trajet');
    }
};

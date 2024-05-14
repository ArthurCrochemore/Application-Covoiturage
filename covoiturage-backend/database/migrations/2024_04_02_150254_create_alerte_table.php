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
        Schema::create('Alerte', function (Blueprint $table) {
            $table->bigIncrements('Id_Alerte');
            $table->integer('Statut');
            $table->boolean('Trajet_Regulier');
            $table->boolean('Domicile_Base');
            $table->date('DateAlerteTrajet');
            $table->unsignedBigInteger('Id_Utilisateur');
            $table->unsignedBigInteger('Id_Jours');
            $table->unsignedBigInteger('Id_Domicile');
            $table->unsignedBigInteger('Id_Base');
            $table->foreign('Id_Utilisateur')->references('Id_Utilisateur')->on('Utilisateur');
            $table->foreign('Id_Domicile')->references('Id_Adresse')->on('Adresse');
            $table->foreign('Id_Base')->references('Id_Adresse')->on('Adresse');
            $table->foreign('Id_Jours')->references('Id_Jours')->on('Jours');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Alerte');
    }
};

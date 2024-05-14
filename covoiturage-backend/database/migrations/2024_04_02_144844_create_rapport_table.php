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
        Schema::create('Rapport', function (Blueprint $table) {
            $table->id('Id_Rapport');

            $table->string('Description');
            $table->timestamp('Date_Rapport');
            $table->integer('Statut');
            $table->integer('Id_Utilisateur');
            $table->foreign('Id_Utilisateur')->references('Id_Utilisateur')->on('Utilisateur');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Rapport');
    }
};

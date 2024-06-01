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
        Schema::create('Habiter', function (Blueprint $table) {
            $table->unsignedBigInteger('Id_Utilisateur');
            $table->unsignedBigInteger('Id_Adresse');
            $table->primary(['Id_Utilisateur', 'Id_Adresse']);
            $table->foreign('Id_Utilisateur')->references('Id_Utilisateur')->on('Utilisateur')->onDelete('cascade');
            $table->foreign('Id_Adresse')->references('Id_Adresse')->on('Adresse')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Habiter');
    }
};

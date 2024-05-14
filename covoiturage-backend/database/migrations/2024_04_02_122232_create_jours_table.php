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
        Schema::create('Jours', function (Blueprint $table) {
            $table->id('Id_Jours');
            $table->boolean('Lundi');
            $table->boolean('Mardi');
            $table->boolean('Mercredi');
            $table->boolean('Jeudi');
            $table->boolean('Vendredi');
            $table->boolean('Samedi');
            $table->boolean('Dimanche');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Jours');
    }
};

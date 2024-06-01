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
        Schema::create('Message', function (Blueprint $table) {
            $table->id('Id_Message');
            $table->string('Message');
            $table->timestamp('Date_Message');
            $table->boolean('Lu');
            $table->integer('Id_Expediteur');
            $table->integer('Id_Recepteur');
            $table->foreign('Id_Expediteur')->references('Id_Utilisateur')->on('Utilisateur');
            $table->foreign('Id_Recepteur')->references('Id_Utilisateur')->on('Utilisateur');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Message');
    }
};

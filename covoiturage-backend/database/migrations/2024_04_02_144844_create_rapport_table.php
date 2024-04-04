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
        Schema::create('rapport', function (Blueprint $table) {
            $table->id('id_rapport');

            $table->string('description');
            $table->timestamp('daterapport');
            $table->integer('statut');
            $table->integer('id_utilisateur');
            $table->foreign('id_utilisateur')->references('id_utilisateur')->on('utilisateur');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rapport');
    }
};

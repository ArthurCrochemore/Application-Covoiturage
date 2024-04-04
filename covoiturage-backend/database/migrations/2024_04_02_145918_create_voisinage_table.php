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
        Schema::create('vosinage', function (Blueprint $table) {
            $table->id('id_voisinage');
            $table->integer('id_voisin1');
            $table->integer('id_voisin2');
            $table->foreign('id_voisin1')->references('id_utilisateur')->on('utilisateur');
            $table->foreign('id_voisin2')->references('id_utilisateur')->on('utilisateur');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vosinage');
    }
};

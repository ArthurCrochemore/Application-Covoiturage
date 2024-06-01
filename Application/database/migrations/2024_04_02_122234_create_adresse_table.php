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
        Schema::create('Adresse', function (Blueprint $table) {
            $table->id('Id_Adresse');
            $table->string('Intitule', 50);
            $table->string('Ville', 50);
            $table->boolean('Est_Base_Aerienne');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Adresse');
    }
};

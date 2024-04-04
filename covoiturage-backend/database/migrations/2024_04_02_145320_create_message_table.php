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
        Schema::create('message', function (Blueprint $table) {
            $table->id('id_message');
            $table->string('message');
            $table->timestamp('datemessage');
            $table->boolean('lu');
            $table->integer('id_expediteur');
            $table->integer('id_recepteur');
            $table->foreign('id_expediteur')->references('id_utilisateur')->on('utilisateur');
            $table->foreign('id_recepteur')->references('id_utilisateur')->on('utilisateur');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message');
    }
};

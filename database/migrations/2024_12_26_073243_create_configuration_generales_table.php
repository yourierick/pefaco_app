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
        Schema::create('configuration_generales', function (Blueprint $table) {
            $table->id();
            $table->string('nom_eglise');
            $table->string('devise');
            $table->text('logo');
            $table->double('pourcentage_eglise');
            $table->string('email', 100);
            $table->string('contacts', 100);
            $table->text('a_propos_de_nous');
            $table->text('historique');
            $table->text('notre_mission');
            $table->text('notre_vision');
            $table->text('notre_communaute');
            $table->string('localisation', 255);
            $table->string('nom_du_pasteur')->nullable();
            $table->text('pasteur_responsable', 255);
            $table->text('photo_du_pasteur_responsable')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configuration_generales');
    }
};

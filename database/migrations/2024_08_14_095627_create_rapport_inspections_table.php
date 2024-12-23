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
        Schema::create('rapport_inspections', function (Blueprint $table) {
            $table->id();
            $table->string('rapporteur');
            $table->string('mois');
            $table->string('annee');
            $table->string('paroisses_concernees', 255);
            $table->text('contexte');
            $table->text('constats');
            $table->text('recommandations');
            $table->string('statut');
            $table->string('notification');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rapport_inspections');
    }
};

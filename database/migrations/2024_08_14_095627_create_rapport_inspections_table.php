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
            $table->unsignedBigInteger('rapporteur_id')->nullable();
            $table->foreign('rapporteur_id')->references("id")->on('users')->onDelete('set null');
            $table->date('mois');
            $table->string('paroisses_concernees', 255);
            $table->text('contexte');
            $table->text('constats');
            $table->text('difficultes_rencontrees');
            $table->text('recommandations');
            $table->string('statut');
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

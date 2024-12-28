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
        Schema::create('membres', function (Blueprint $table) {
            $table->id();
            $table->integer('paroisse_id');
            $table->string('photo', 255)->nullable();
            $table->string('nom', 255);
            $table->string('sexe', 100);
            $table->string('nationalite', 100);
            $table->string('lieu_de_naissance', 100);
            $table->date('date_de_naissance');
            $table->string('adresse_de_residence_actuelle', 255);
            $table->string('adresse_de_residence_permanente', 255);
            $table->string('etat_civil', 100);
            $table->string('partenaire', 100)->nullable();
            $table->integer('nombre_enfants')->nullable();
            $table->string('profession', 100);
            $table->string('contacts', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('baptise', 10);
            $table->date('date_de_bapteme')->nullable();
            $table->string('statut');
            $table->string('fonction')->nullable();
            $table->string('responsabilites', 500)->nullable();
            $table->string('etat')->nullable();
            $table->string('motif_de_suspension', 500)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membres');
    }
};

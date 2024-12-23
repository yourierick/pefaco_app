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
        Schema::create('rapport_mensuels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('departement_id');
            $table->foreign('departement_id')->references('id')->on('departements')->cascadeOnDelete();
            $table->unsignedBigInteger('rapporteur_principal_id')->nullable();
            $table->foreign('rapporteur_principal_id')->references('id')->on('users')->onDelete("set null");
            $table->date('mois_de_rapportage');
            $table->text('objectifs');
            $table->text('vision');
            $table->text('mission');
            $table->json('previsions_pour_ce_mois')->nullable();
            $table->json('realisations_de_ce_mois')->nullable();
            $table->text('autres_a_rapporter');
            $table->text('situation_actuelle');
            $table->text("situation_de_la_logistique")->nullable();
            $table->integer("nombre_des_cultes_tenus")->default(0);
            $table->integer("effectif_total")->default(0);
            $table->integer("effectif_hommes")->default(0);
            $table->integer("effectif_femmes")->default(0);
            $table->integer("effectif_jeunes")->default(0);
            $table->integer("effectif_enfants")->default(0);
            $table->integer("moyenne_mensuel_total")->default(0);
            $table->integer("moyenne_mensuel_hommes")->default(0);
            $table->integer("moyenne_mensuel_femmes")->default(0);
            $table->integer("moyenne_mensuel_jeunes")->default(0);
            $table->integer("moyenne_mensuel_enfants")->default(0);
            $table->integer('nombre_des_personnes_baptises')->default(0);
            $table->double('situation_caisse')->default(0);
            $table->text('autres_contributions_a_renseigner')->nullable();
            $table->text('difficultes_defis');
            $table->text('recommandations');
            $table->json('previsions_mois_prochain')->nullable();
            $table->string('statut');
            $table->boolean('notification')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rapport_mensuels');
    }
};

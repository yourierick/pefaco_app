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
        Schema::create('rapport_de_districts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rapporteur_id')->nullable();
            $table->foreign('rapporteur_id')->references('id')->on('users')->onDelete("set null");
            $table->date('mois');
            $table->string('zone');
            $table->text('paroisses_concernees');
            $table->text('contexte');
            $table->integer('nombre_des_cultes_tenus')->default(0);
            $table->integer('moyenne_de_frequentation')->default(0);
            $table->integer('nombre_des_personnes_baptises')->default(0);
            $table->text('autres_evenements_a_rapporter')->nullable();
            $table->double('dime_des_dimes')->default(0);
            $table->double('total_offrande')->default(0);
            $table->boolean('accuse_de_reception_offrande')->default(false);
            $table->text('observation')->nullable();
            $table->text('difficultes_defis');
            $table->text('recommandations');
            $table->text('previsions_mois_prochain');
            $table->text('besoins_a_signaler');
            $table->string('statut');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rapport_de_districts');
    }
};

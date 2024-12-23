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
        Schema::create('rapport_de_cultes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('departement_id');
            $table->foreign('departement_id')->references('id')->on('departements');
            $table->unsignedBigInteger('rapporteur_id');
            $table->foreign('rapporteur_id')->references('id')->on('users');
            $table->string('rapporteur');
            $table->date('date');
            $table->string('moderateur', 100);
            $table->string('orateur', 100);
            $table->string('theme', 255)->nullable();
            $table->json('reference')->nullable();
            $table->text('synthese')->nullable();
            $table->integer('total_pers_dans_le_culte')->nullable();
            $table->integer('total_papas')->nullable();
            $table->integer('total_mamans')->nullable();
            $table->integer('total_jeunes')->nullable();
            $table->integer('total_enfants')->nullable();
            $table->double('total_offrande')->nullable();
            $table->json('don_special')->nullable();
            $table->json('autres_faits_a_renseigner')->nullable();
            $table->string('statut')->default('draft');
            $table->string('audience')->default('privé');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rapport_de_cultes');
    }
};

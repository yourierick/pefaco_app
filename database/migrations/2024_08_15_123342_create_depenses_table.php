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
        Schema::create('depenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('departement_id');
            $table->foreign('departement_id')->references('id')->on('departements')->onDelete("cascade");
            $table->string('requerant');
            $table->unsignedBigInteger('source_a_imputer_id')->nullable();
            $table->foreign('source_a_imputer_id')->references('id')->on('caisses')->onDelete("set null");
            $table->string('code_de_depense');
            $table->text('context')->nullable();
            $table->string('motif', 255);
            $table->double('montant');
            $table->string('statut')->default('draft');
            $table->boolean('consommation_depense')->default(false);
            $table->date('date_de_traitement')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depenses');
    }
};

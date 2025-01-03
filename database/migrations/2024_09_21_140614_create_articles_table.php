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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('departement_id')->nullable();
            $table->foreign('departement_id')->references('id')->on('departements')->onDelete("set null");
            $table->unsignedBigInteger('rapporteur_id');
            $table->foreign('rapporteur_id')->references('id')->on('users');
            $table->string('rapporteur');
            $table->string('titre');
            $table->text('description');
            $table->json('bibliotheque')->nullable();
            $table->string('video', '255')->nullable();
            $table->string('statut')->default('draft');
            $table->string('audience')->default('privé');
            $table->integer('like')->default(0);
            $table->integer('dislike')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};

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
        Schema::create('enseignements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('auteur_id');
            $table->foreign('auteur_id')->references('id')->on('users');
            $table->string('titre');
            $table->string('reference', '255');
            $table->text('enseignement')->nullable();
            $table->string('affiche_photo', '255');
            $table->string('audio', '255')->nullable();
            $table->string('video', '255')->nullable();
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
        Schema::dropIfExists('enseignements');
    }
};

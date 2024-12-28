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
        Schema::create('baptemes', function (Blueprint $table) {
            $table->id();
            $table->text('photo')->nullable();
            $table->string('nom', 255);
            $table->string('sexe', 100);
            $table->string('adresse_de_residence', 100);
            $table->string('date_de_naissance', 100);
            $table->string('date_de_bapteme', 100);
            $table->string('nom_de_bapteme', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baptemes');
    }
};

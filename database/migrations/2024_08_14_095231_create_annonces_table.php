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
        Schema::create('annonces', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('annonceur_id')->nullable();
            $table->foreign('annonceur_id')->references('id')->on('users')->onDelete("set null");
            $table->string('titre');
            $table->text('description');
            $table->string('photo_descriptive', '255');
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
        Schema::dropIfExists('annonces');
    }
};

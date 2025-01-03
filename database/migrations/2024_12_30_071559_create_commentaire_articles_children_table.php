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
        Schema::create('commentaire_articles_children', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('commentaire_articles_id');
            $table->foreign('commentaire_articles_id')->references('id')->on('commentaire_articles')->cascadeOnDelete();
            $table->string('commentaire', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commentaire_articles_children');
    }
};

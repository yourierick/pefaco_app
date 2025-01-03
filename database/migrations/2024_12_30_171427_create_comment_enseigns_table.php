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
        Schema::create('comment_enseigns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('enseignement_id');
            $table->foreign('enseignement_id')->references('id')->on('enseignements')->cascadeOnDelete();
            $table->string('commentaire', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment_enseigns');
    }
};

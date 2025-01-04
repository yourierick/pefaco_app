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
        Schema::create('child_commentens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('comment_enseign_id');
            $table->foreign('comment_enseign_id')->references('id')->on('comment_enseigns')->cascadeOnDelete();
            $table->string('commentaire', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child_commentens');
    }
};

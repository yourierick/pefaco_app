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
        Schema::create('communiques', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('communiquant_id')->nullable();
            $table->foreign('communiquant_id')->references('id')->on('users')->onDelete("set null");
            $table->string('titre', '255');
            $table->json('contenu');
            $table->json('accuse_de_reception')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('communiques');
    }
};

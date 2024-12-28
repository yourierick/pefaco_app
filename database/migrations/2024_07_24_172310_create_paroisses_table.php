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
        Schema::create('paroisses', function (Blueprint $table) {
            $table->id();
            $table->string('designation', 100);
            $table->string('localisation', 255);
            $table->unsignedBigInteger('zones_id')->nullable();
            $table->foreign('zones_id')->references('id')->on('zones')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paroisses');
    }
};

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
        Schema::dropIfExists('programmes');
        Schema::dropIfExists('horaire_hebdos');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('horaire_hebdos', function (Blueprint $table) {
            //
        });
    }
};

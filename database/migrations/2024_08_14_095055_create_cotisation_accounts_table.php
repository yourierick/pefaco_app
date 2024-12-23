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
        Schema::create('cotisation_accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cotisation_id');
            $table->foreign('cotisation_id')->references('id')->on('cotisations')->onDelete('cascade');
            $table->string('cotisant');
            $table->double('montant');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cotisation_accounts');
    }
};

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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('caisse_id')->nullable();
            $table->foreign('caisse_id')->references('id')->on('caisses')->onDelete('cascade');
            $table->date('date_de_la_transaction');
            $table->string('type_de_transaction');
            $table->string('code_de_depense')->nullable();
            $table->double('montant');
            $table->string('motif')->nullable();
            $table->string('source')->nullable();
            $table->double('pourcentage_eglise');
            $table->double('montant_net_restant');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

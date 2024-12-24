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
        Schema::create('custom_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('type'); //Type de notification (classe)
            $table->unsignedBigInteger('notifiable_id'); //ID du modèle notifiable; pour ce cas c'est User
            $table->string('notifiable_type'); //Type du modèle notifiable (ex. App\Models\User)
            $table->morphs('objectable'); //Objet lié (ex. Rapports, Communiqués, Annonces, Articles, ...)
            $table->json('data'); //Données JSON pour la notification
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_notifications');
    }
};

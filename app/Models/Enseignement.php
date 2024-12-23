<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enseignement extends Model
{
    use HasFactory;

    protected $fillable = [
        'auteur_id',
        'titre',
        'reference',
        'enseignement',
        'affiche_photo',
        'audio',
        'video',
        'statut',
        'audience',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'datetime',
        ];
    }

    public function auteur() {
        return $this->belongsTo(User::class, "auteur_id");
    }
}

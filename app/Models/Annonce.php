<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'annonceur_id',
        'statut',
        'audience',
        'titre',
        'description',
        'photo_descriptive',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'datetime',
        ];
    }
    
    public function annonceur() {
        return $this->belongsTo(User::class, "annonceur_id");
    }
}

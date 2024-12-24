<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RapportInspection extends Model
{
    use HasFactory;

    protected $fillable = [
        'rapporteur_id',
        'mois',
        'paroisses_concernees',
        'contexte',
        'constats',
        'difficultes_rencontrees',
        'recommandations',
        'statut',
    ];

    public function rapporteur() {
        return $this->belongsTo(User::class, "rapporteur_id");
    }

    protected function casts(): array
    {
        return [
            'mois'=>'date',
        ];
    }
}

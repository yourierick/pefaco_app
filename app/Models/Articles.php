<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'departement_id',
        'statut',
        'audience',
        'titre',
        'description',
        'bibliotheque',
        'video',
        'rapporteur_id',
        'rapporteur',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'datetime',
        ];
    }

    public function departement()
    {
        return $this->belongsTo(Departements::class, "departement_id");
    }

    public function rapporteur_user()
    {
        return $this->belongsTo(User::class, "rapporteur_id");
    }
}

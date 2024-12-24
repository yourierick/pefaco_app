<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RapportDeCulte extends Model
{
    use HasFactory;

    protected $fillable = [
        'rapporteur_id',
        'rapporteur',
        'departement_id',
        'date',
        'moderateur',
        'orateur',
        'theme',
        'reference',
        'synthese',
        'total_pers_dans_le_culte',
        'total_papas',
        'total_mamans',
        'total_jeunes',
        'total_enfants',
        'total_offrande',
        'don_special',
        'autres_faits_a_renseigner',
        'audience',
        'statut',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'datetime',
        ];
    }

    public function departement() {
        return $this->belongsTo(Departements::class, "departement_id");
    }

    public function user_rapporteur() {
        return $this->belongsTo(User::class, "rapporteur_id");
    }
}

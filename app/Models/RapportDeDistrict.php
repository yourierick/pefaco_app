<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RapportDeDistrict extends Model
{
    use HasFactory;

    protected $fillable = [
        'rapporteur_id',
        'mois',
        'zone',
        'paroisses_concernees',
        'contexte',
        'nombre_des_cultes_tenus',
        'moyenne_de_frequentation',
        'nombre_des_personnes_baptises',
        'autres_evenements_a_rapporter',
        'dime_des_dimes',
        'total_offrande',
        'autres_contributions_a_renseigner',
        'observation',
        'difficultes_defis',
        'recommandations',
        'previsions_mois_prochain',
        'besoins_a_signaler',
        'statut',
    ];

    public function casts(): array{
        return [
            "mois"=>"date",
        ];
    }

    public function rapporteur() {
        return $this->belongsTo(User::class, 'rapporteur_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($rapport) {
            event(new \App\Events\ObjectDeleted($rapport));
        });
    }
}

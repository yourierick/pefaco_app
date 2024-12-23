<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RapportMensuel extends Model
{
    use HasFactory;
    protected $fillable = [
        "departement_id",
        "rapporteur_principal_id",
        "mois_de_rapportage",
        "objectifs",
        "vision",
        "mission",
        "previsions_pour_ce_mois",
        "realisations_de_ce_mois",
        "autres_a_rapporter",
        "situation_actuelle",
        "situation_de_la_logistique",
        "nombre_des_cultes_tenus",
        "effectif_total",
        "effectif_hommes",
        "effectif_femmes",
        "effectif_jeunes",
        "effectif_enfants",
        "moyenne_mensuel_total",
        "moyenne_mensuel_hommes",
        "moyenne_mensuel_femmes",
        "moyenne_mensuel_jeunes",
        "moyenne_mensuel_enfants",
        "nombre_des_personnes_baptises",
        "situation_caisse",
        "autres_contributions_a_renseigner",
        "difficultes_defis",
        "recommandations",
        "previsions_mois_prochain",
        "statut",
        "notification",
    ];

    protected function casts(): array
    {
        return [
            'mois_de_rapportage' => 'date',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, "rapporteur_principal_id");
    }

    public function departement()
    {
        return $this->belongsTo(Departements::class, "departement_id");
    }
}

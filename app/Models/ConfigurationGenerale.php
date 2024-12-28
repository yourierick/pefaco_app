<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigurationGenerale extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo',
        'nom_eglise',
        'localisation',
        'email',
        'contacts',
        'pourcentage_eglise',
        'devise',
        'a_propos_de_nous',
        'historique',
        'notre_mission',
        'notre_vision',
        'notre_communaute',
        'pasteur_responsable',
    ];
}

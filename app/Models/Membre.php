<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membre extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo',
        'paroisse_id',
        'nom',
        'sexe',
        'nationalite',
        'lieu_de_naissance',
        'date_de_naissance',
        'adresse_de_residence_actuelle',
        'adresse_de_residence_permanente',
        'etat_civil',
        'partenaire',
        'nombre_enfants',
        'profession',
        'contacts',
        'email',
        'baptise',
        'date_de_bapteme',
        'statut',
        'fonction',
        'responsabilites',
        'etat',
        'motif_de_suspension',
    ];

    public function casts(): array {
        return [
            'date_de_naissance'=>'date',
            'date_de_bapteme'=>'date',
        ];
    }

    public function delete() {
        if ($this->photo && Storage::disk('public')->exists($this->photo)) {
            Storage::disk('public')->delete($this->photo);
        }

        return parent::delete();
    }
}

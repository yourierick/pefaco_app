<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'departement_id',
        'requerant_id',
        'requerant',
        'source_a_imputer_id',
        'context',
        'motif',
        'montant',
        'montant',
        'statut',
        'date_de_traitement',
        'montant_accorde',
        'notif',
        'code_de_depense'
    ];

    public function departement() {
        return $this->belongsTo(Departements::class, 'departement_id');
    }

    public function caisse() {
        return $this->belongsTo(Caisse::class, 'source_a_imputer_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($depense) {
            event(new \App\Events\ObjectDeleted($depense));
        });
    }
}

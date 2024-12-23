<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotisation extends Model
{
    use HasFactory;
    protected $fillable = [
        'departement_id',
        'motif',
        'date_debut',
        'date_fin',
        'statut',
        'montant_total_net',
    ];

    protected function casts(): array
    {
        return [
            'date_debut' => 'datetime',
            'date_fin' => 'datetime',
        ];
    }
    
    public function departement() {
        return $this->belongsTo(Departements::class, 'departement_id');
    }
}

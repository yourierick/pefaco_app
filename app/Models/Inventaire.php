<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'designation',
        'date_acquisition',
        'prix_unitaire',
        'quantite',
        'affectation',
        'etat',
    ];

    protected function casts(): array
    {
        return [
            'date_acquisition'=>'date',
        ];
    }
}

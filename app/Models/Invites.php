<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invites extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'sexe',
        'telephone',
        'adresse_de_residence',
        'eglise_de_provenance',
    ];
}

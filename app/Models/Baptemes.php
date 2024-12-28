<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baptemes extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo',
        'nom',
        'sexe',
        'adresse_de_residence',
        'date_de_naissance',
        'date_de_bapteme',
        'nom_de_bapteme',
    ];

    public function casts(): array {
        return [
            'date_de_naissance'=>'date',
            'date_de_bapteme'=>'date',
        ];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CotisationAccount extends Model
{
    use HasFactory;
    protected $fillable = [
        'cotisation_id',
        'cotisant',
        'montant',
    ];
}

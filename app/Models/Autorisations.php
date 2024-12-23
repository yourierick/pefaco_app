<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autorisations extends Model
{
    use HasFactory;

    protected $fillable = [
        'groupe_id',
        'table_name',
        'lecture',
        'ecriture',
        'autorisation_en_lecture',
        'autorisation_en_ecriture',
    ];
}

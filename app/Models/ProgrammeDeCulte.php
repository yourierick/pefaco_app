<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgrammeDeCulte extends Model
{
    use HasFactory;

    protected $fillable = [
        'jour',
        'interval_de_temps',
        'programme',
    ];
}

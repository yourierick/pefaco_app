<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    use HasFactory;

    protected $fillable = [
        'horaire_id',
        'departement',
        'jour',
        'programme',
    ];

    public function horaire()
    {
        return $this->belongsTo(HoraireHebdo::class, "horaire_id");
    }

}

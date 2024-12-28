<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qualites extends Model
{
    use HasFactory;
    protected $fillable = [
        'departement_id',
        'designation',
    ];

    public function departement() {
        return $this->belongsTo(Departements::class, 'departement_id');
    }
}

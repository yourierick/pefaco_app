<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paroisses extends Model
{
    use HasFactory;

    protected $fillable = [
        'designation',
        'localisation',
        'zones_id',
    ];

    public function zone() {
        return $this->belongsTo(Zones::class, 'zones_id');
    }
}

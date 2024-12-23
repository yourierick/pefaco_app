<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Communique extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'communiquant_id',
        'titre',
        'contenu',
        'accuse_de_reception',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'datetime',
        ];
    }

    public function communiquant() {
        return $this->belongsTo(User::class, "communiquant_id");
    }
}

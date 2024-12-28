<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Annonce extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'annonceur_id',
        'statut',
        'audience',
        'titre',
        'description',
        'photo_descriptive',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'datetime',
        ];
    }
    
    public function annonceur() {
        return $this->belongsTo(User::class, "annonceur_id");
    }

    public function delete() {
        if ($this->photo_descriptive && Storage::disk('public')->exists($this->photo_descriptive)) {
            Storage::disk('public')->delete($this->photo_descriptive);
        }

        return parent::delete();
    }
}

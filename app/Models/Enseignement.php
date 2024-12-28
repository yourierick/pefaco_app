<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Enseignement extends Model
{
    use HasFactory;

    protected $fillable = [
        'auteur_id',
        'titre',
        'reference',
        'enseignement',
        'affiche_photo',
        'audio',
        'video',
        'statut',
        'audience',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'datetime',
        ];
    }

    public function auteur() {
        return $this->belongsTo(User::class, "auteur_id");
    }

    public function delete() {
        if ($this->video && Storage::disk('public')->exists($this->video)) {
            Storage::disk('public')->delete($this->video);
        }
        if ($this->audio && Storage::disk('public')->exists($this->audio)) {
            Storage::disk('public')->delete($this->audio);
        }
        if ($this->affiche_photo && Storage::disk('public')->exists($this->affiche_photo)) {
            Storage::disk('public')->delete($this->affiche_photo);
        }

        return parent::delete();
    }
}

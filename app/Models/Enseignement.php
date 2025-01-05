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
        'lien_acces_youtube',
        'statut',
        'audience',
        'like',
        'dislike'
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
        if ($this->audio && Storage::disk('public')->exists($this->audio)) {
            Storage::disk('public')->delete($this->audio);
        }
        if ($this->affiche_photo && Storage::disk('public')->exists($this->affiche_photo)) {
            Storage::disk('public')->delete($this->affiche_photo);
        }

        return parent::delete();
    }

    public function commentaires() {
        return $this->hasMany(CommentEnseign::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($enseignement) {
            event(new \App\Events\ObjectDeleted($enseignement));
        });
    }
}

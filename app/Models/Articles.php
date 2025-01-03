<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Articles extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'departement_id',
        'statut',
        'audience',
        'titre',
        'description',
        'bibliotheque',
        'video',
        'rapporteur_id',
        'rapporteur',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'datetime',
        ];
    }

    public function departement()
    {
        return $this->belongsTo(Departements::class, "departement_id");
    }

    public function rapporteur_user()
    {
        return $this->belongsTo(User::class, "rapporteur_id");
    }

    public function delete() {
        if ($this->video && Storage::disk('public')->exists($this->video)) {
            Storage::disk('public')->delete($this->video);
        }

        $bibliotheque = json_decode($this->bibliotheque);
        foreach($bibliotheque as $path) {
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }

        return parent::delete();
    }

    public function commentaires() {
        return $this->hasMany(CommentaireArticles::class);
    }
}

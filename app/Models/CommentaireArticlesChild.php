<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentaireArticlesChild extends Model
{
    use HasFactory;

    protected $fillable = [
        'commentaire_articles_id',
        'commentaire',
    ];

    public function commentaire() {
        return $this->belongsTo(CommentaireArticles::class, 'commentaire_articles_id');
    }
}

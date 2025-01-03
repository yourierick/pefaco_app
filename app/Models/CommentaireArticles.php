<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentaireArticles extends Model
{
    use HasFactory;

    protected $fillable = [
        'articles_id',
        'commentaire',
    ];

    public function article() {
        return $this->belongsTo(Articles::class, 'articles_id');
    }

    public function commentairechildren() {
        return $this->hasMany(CommentaireArticlesChild::class);
    }
}

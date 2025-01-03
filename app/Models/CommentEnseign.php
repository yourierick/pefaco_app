<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentEnseign extends Model
{
    use HasFactory;

    protected $fillable = [
        'enseignement_id',
        'commentaire',
    ];

    public function enseignement() {
        return $this->belongsTo(Enseignement::class, 'enseignement_id');
    }

    public function commentaire_child() {
        return $this->hasMany(ChildCommentens::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildCommentens extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment_enseign_id',
        'commentaire',
    ];

    public function commentaireparent() {
        return $this->belongsTo(CommentEnseign::class, 'comment_enseign_id');
    }
}

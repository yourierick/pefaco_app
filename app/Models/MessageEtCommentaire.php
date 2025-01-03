<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageEtCommentaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'email',
        'telephone',
        'message',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($message_commentaire) {
            event(new \App\Events\ObjectDeleted($message_commentaire));
        });
    }
}

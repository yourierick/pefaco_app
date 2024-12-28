<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BulletinInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'email'
    ];
}

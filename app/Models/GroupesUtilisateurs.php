<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupesUtilisateurs extends Model
{
    use HasFactory;

    protected $fillable = [
        'groupe',
    ];
}
